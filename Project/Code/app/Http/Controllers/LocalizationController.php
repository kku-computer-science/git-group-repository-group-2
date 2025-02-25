<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;
use App\Models\ResearchGroup;
use App\Models\ResearchProject;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

class LocalizationController extends Controller
{
    public function index()
    {
        $resp = ResearchGroup::all();
        return view('welcome', compact('resp'));
        // return view('welcome');
    }
    public function switchLanguage($lang)
    {
        if (in_array($lang, ['en', 'th', 'zh'])) {
            session(['applocale' => $lang]);
            App::setLocale($lang); // กำหนด locale ใหม่
        }

        return redirect()->back();
    }
}
