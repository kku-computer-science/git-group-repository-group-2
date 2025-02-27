<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Paper;
use App\Models\Source_data;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class ScopuscallController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $id = Crypt::decrypt($id);
        $data = User::find($id);

        $scopus_id = '57194219816';
        $start = 0;
        $count = 25;
        
        // Ensure Scopus ID is valid
        if (empty($scopus_id)) {
            return response()->json(['error' => 'Scopus ID is missing']);
        }
        
        // Send the request to the Scopus API
        $url = Http::get('https://api.elsevier.com/content/search/scopus', [
            'query' => "AU-ID($scopus_id)",
            'start' => $start,
            'count' => $count,
            'apikey' => '30f1d8889ba5e1281f8474a8794200df',
        ]);
        
        // Check the response
        $response = Http::withOptions(['verify' => false])->get('https://api.elsevier.com/content/abstract/scopus_id/85091954319', [
            'apiKey' => '30f1d8889ba5e1281f8474a8794200df',
            'httpAccept' => 'application/json',
        ]);        

        $content = $url["search-results"]["entry"];
        $links = $url["search-results"]["link"];

        do {
            $ref = 'prev';
            foreach ($links as $link) {
                if ($link['@ref'] == 'next') {
                    $link2 = $link['@href'];
                    $link2 = Http::get("$link2")->json();
                    $links = $link2["search-results"]["link"];
                    $nextcontent = $link2["search-results"]["entry"];
                    foreach ($nextcontent as $item) {
                        array_push($content, $item);
                    }
                }
            }
        } while ($ref != 'prev');

        foreach ($content as $item) {
            if (array_key_exists('error', $item)) {
                continue;
            } else {
                if (Paper::where('paper_name', '=', $item['dc:title'])->first() == null) {
                    $scoid = $item['dc:identifier'];
                    $scoid = explode(":", $scoid);
                    $scoid = $scoid[1];

                    $all = Http::get("https://api.elsevier.com/content/abstract/scopus_id/" . $scoid . "?filed=authors&apiKey=30f1d8889ba5e1281f8474a8794200df&httpAccept=application%2Fjson");
                    
                    $paper = new Paper;
                    $paper->paper_name = $item['dc:title'];
                    $paper->paper_type = $item['prism:aggregationType'];
                    $paper->paper_subtype = $item['subtypeDescription'];
                    $paper->paper_sourcetitle = $item['prism:publicationName'];
                    $paper->paper_url = $item['link'][2]['@href'];
                    $date = Carbon::parse($item['prism:coverDate'])->format('Y');
                    $paper->paper_yearpub = $date;

                    if (array_key_exists('prism:volume', $item)) {
                        $paper->paper_volume = $item['prism:volume'];
                    } else {
                        $paper->paper_volume = null;
                    }
                    if (array_key_exists('prism:issueIdentifier', $item)) {
                        $paper->paper_issue = $item['prism:issueIdentifier'];
                    } else {
                        $paper->paper_issue = null;
                    }
                    $paper->paper_citation = $item['citedby-count'];
                    $paper->paper_page = $item['prism:pageRange'];

                    if (array_key_exists('prism:doi', $item)) {
                        $paper->paper_doi = $item['prism:doi'];
                    } else {
                        $paper->paper_doi = null;
                    }

                    if (array_key_exists('item', $all['abstracts-retrieval-response'])) {
                        if (array_key_exists('xocs:meta', $all['abstracts-retrieval-response']['item'])) {
                            if (array_key_exists('xocs:funding-text', $all['abstracts-retrieval-response']['item']['xocs:meta']['xocs:funding-list'])) {
                                $funder = $all['abstracts-retrieval-response']['item']['xocs:meta']['xocs:funding-list']['xocs:funding-text'];
                                $paper->paper_funder = json_encode($funder);
                            } else {
                                $paper->paper_funder = null;
                            }
                        } else {
                            $paper->paper_funder = null;
                        }

                        $paper->abstract = $all['abstracts-retrieval-response']['item']['bibrecord']['head']['abstracts'];

                        if (array_key_exists('author-keywords', $all['abstracts-retrieval-response']['item']['bibrecord']['head']['citation-info'])) {
                            $key = $all['abstracts-retrieval-response']['item']['bibrecord']['head']['citation-info']['author-keywords']['author-keyword'];
                            $paper->keyword = json_encode($key);
                        } else {
                            $paper->keyword = null;
                        }
                    } else {
                        $paper->paper_funder = null;
                        $paper->abstract = null;
                        $paper->keyword = null;
                    }

                    $paper->save();

                    $source = Source_data::findOrFail(1);
                    $paper->source()->sync($source);

                    $all_au = $all['abstracts-retrieval-response']['authors']['author'];
                    $x = 1;
                    $length = count($all_au);

                    foreach ($all_au as $i) {
                        if (array_key_exists('ce:given-name', $i)) {
                            $i['ce:given-name'] = $i['ce:given-name'];
                        } else {
                            $i['ce:given-name'] = $i['preferred-name']['ce:given-name'];
                        }

                        if (User::where([['fname_en', '=', $i['ce:given-name']], ['lname_en', '=', $i['ce:surname']]])->orWhere([[DB::raw("concat(left(fname_en,1),'.')"), '=', $i['ce:given-name']], ['lname_en', '=', $i['ce:surname']]])->first() == null) {
                            if (Author::where([['author_fname', '=', $i['ce:given-name']], ['author_lname', '=', $i['ce:surname']]])->first() == null) {
                                $author = new Author;
                                $author->author_fname = $i['ce:given-name'];
                                $author->author_lname = $i['ce:surname'];
                                $author->save();
                                if ($x === 1) {
                                    $paper->author()->attach($author, ['author_type' => 1]);
                                } else if ($x === $length) {
                                    $paper->author()->attach($author, ['author_type' => 3]);
                                } else {
                                    $paper->author()->attach($author, ['author_type' => 2]);
                                }
                            } else {
                                $author = Author::where([['author_fname', '=', $i['ce:given-name']], ['author_lname', '=', $i['ce:surname']]])->first();
                                $authorid = $author->id;
                                if ($x === 1) {
                                    $paper->author()->attach($authorid, ['author_type' => 1]);
                                } else if ($x === $length) {
                                    $paper->author()->attach($authorid, ['author_type' => 3]);
                                } else {
                                    $paper->author()->attach($authorid, ['author_type' => 2]);
                                }
                            }
                        } else {
                            $us = User::where([['fname_en', '=', $i['ce:given-name']], ['lname_en', '=', $i['ce:surname']]])->orWhere([[DB::raw("concat(left(fname_en,1),'.')"), '=', $i['ce:given-name']], ['lname_en', '=', $i['ce:surname']]])->first();
                            if ($x === 1) {
                                $paper->teacher()->attach($us, ['author_type' => 1]);
                            } else if ($x === $length) {
                                $paper->teacher()->attach($us, ['author_type' => 3]);
                            } else {
                                $paper->teacher()->attach($us, ['author_type' => 2]);
                            }
                        }
                        $x++;
                    }

                } else {
                    $paper = Paper::where('paper_name', '=', $item['dc:title'])->first();
                    $paperid = $paper->id;
                    $user = User::find($id);

                    $hasTask = $user->paper()->where('paper_id', $paperid)->exists();
                    if ($hasTask != $paperid) {
                        $paper = Paper::find($paperid);
                        $useaut = Author::where([['author_fname', '=', $user->fname_en], ['author_lname', '=', $user->lname_en]])->first();
                        if ($useaut != null) {
                            $paper->author()->detach($useaut);
                            $paper->teacher()->attach($id);
                        } else {
                            $paper->teacher()->attach($id);
                        }
                    } else {
                        continue;
                    }
                }
            }
        }

        return redirect()->back();
    }

    public function index()
    {
        $year = range(Carbon::now()->year - 5, Carbon::now()->year);
        $paper = [];
        foreach ($year as $value) {
            $paper[] = Paper::where(DB::raw('(paper_yearpub)'), $value)->count();
        }

        return view('test')->with('year', json_encode($year, JSON_NUMERIC_CHECK))->with('paper', json_encode($paper, JSON_NUMERIC_CHECK));
    }
}