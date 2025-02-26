@extends('layouts.layout')
@section('content')
<div class="container card-2">
    <p class="title">{{ trans('message.researchers_research') }}</p>
    @foreach($request as $res)
    <span>
        <ion-icon name="caret-forward-outline" size="small"></ion-icon>
        @if(app()->getLocale() == 'en')
         {{$res->program_name_en}}
        @elseif(app()->getLocale() == 'zh')
         {{$res->program_name_zh}}
        @else
            {{$res->program_name_th}}
        @endif
    </span>
    <div class="d-flex">
        <div class="ml-auto">
            <form class="row row-cols-lg-auto g-3" method="GET" action="{{ route('searchresearchers',['id'=>$res->id])}}">
                <div class="col-md-8">
                    <div class="input-group">
                        <input type="text" class="form-control" name="textsearch" placeholder="{{ trans('message.researchinterests_research') }}">
                    </div>
                </div>
                <!-- <div class="col-12">
                        <label class="visually-hidden" for="inlineFormSelectPref">Preference</label>
                        <select class="form-select" id="inlineFormSelectPref">
                            <option selected> Choose...</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div> -->
                <div class="col-md-4">
                    <button type="submit" class="btn btn-outline-primary">{{ trans('message.search_research') }}</button>
                </div>
            </form>
        </div>
    </div>


    <div class="row row-cols-1 row-cols-md-2 g-0">
        @foreach($users as $r)
        <a href=" {{ route('detail',Crypt::encrypt($r->id))}}">
            <div class="card mb-3">
                <div class="row g-0">
                    <div class="col-sm-4">
                        <img class="card-image" src="{{ $r->picture}}" alt="">
                    </div>
                    <div class="col-sm-8 overflow-hidden" style="text-overflow: clip; @if(app()->getLocale() == 'en') max-height: 220px; @else max-height: 210px;@endif">
                        <div class="card-body">
                            @if(app()->getLocale() == 'en' || app()->getLocale() == 'zh')
                                @if($r->doctoral_degree == 'Ph.D.')
                                    <h5 class="card-title">{{ $r->{'fname_en'} }} {{ $r->{'lname_en'} }}, {{$r->doctoral_degree}}</h5>
                                @else
                                    <h5 class="card-title">{{ $r->{'fname_en'} }} {{ $r->{'lname_en'} }}</h5>
                                @endif

                                <h5 class="card-title-2">{{ $r->{'academic_ranks_en'} }}</h5>
                            @elseif(app()->getLocale() == 'th')
                                <h5 class="card-title">
                                    {{ $r->{'position_th'} }} {{ $r->{'fname_th'} }} {{ $r->{'lname_th'} }}
                                </h5>
                            @endif

                            <p class="card-text-1">{{ trans('message.expertise') }}</p>
                            @php
                                $sortColumn = app()->getLocale() === 'en' ? 'expert_name_en' : (app()->getLocale() === 'zh' ? 'expert_name_zh' : 'expert_name_th');
                            @endphp
                            <div class="card-expertise">
                                @foreach($r->expertise->sortBy($sortColumn) as $exper)
                                    <p class="card-text"> {{ $exper->$sortColumn }} </p>
                                @endforeach
                            </div>
                        </div>
                    </diV>
                </div>
            </div>
        </a>
        @endforeach
        @endforeach
    </div>
</div>

@stop