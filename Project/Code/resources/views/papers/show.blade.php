
@extends('dashboards.users.layouts.user-dash-layout')

@section('content')
<div class="container">
    <div class="card" style="padding: 16px;">
        <div class="card-body">
            <h4 class="card-title">{{ __('message.detail_jour')}}</h4>
            <p class="card-description">{{ __('message.jour')}}
            <div class="row mt-3">
                <p class="card-text col-sm-3"><b>{{ __('message.journal_name')}}</b></p>
                <p class="card-text col-sm-9">{{ $paper->paper_name }}</p>
            </div>
            <div class="row mt-2">
                <p class="card-text col-sm-3"><b>{{ __('message.abstract')}}</b></p>
                <p class="card-text col-sm-9">{{ $paper->abstract }}</p>
            </div>
            <div class="row mt-2">
                <p class="card-text col-sm-3"><b>{{ __('message.keyword')}}</b></p>
                <p class="card-text col-sm-9">
                    {{ $paper->keyword }}
                </p>


                <!-- <p class="card-text col-sm-9">{{ $paper->keyword }}</p> -->
            </div>
            <div class="row mt-2">
                <p class="card-text col-sm-3"><b>{{ __('message.journal_type')}}</b></p>
                <p class="card-text col-sm-9">{{ $paper->paper_type }}</p>
            </div>

            <div class="row mt-2">
                <p class="card-text col-sm-3"><b>{{ __('message.document_type')}}</b></p>
                <p class="card-text col-sm-9">{{ $paper->paper_subtype }}</p>
            </div>
            <div class="row mt-2">
                <p class="card-text col-sm-3"><b>{{ __('message.publication')}}</b></p>
                <p class="card-text col-sm-9">{{ $paper->publication }}</p>
            </div>
            <div class="row mt-2">
                <p class="card-text col-sm-3"><b>{{ __('message.author')}}</b></p>
                <p class="card-text col-sm-9">

                    @foreach($paper->author as $teacher)
                    @if($teacher->pivot->author_type == 1)
                    <b>First Author:</b> {{ $teacher->author_fname}} {{ $teacher->author_lname}} <br>
                    @endif
                    @endforeach
                    @foreach($paper->teacher as $teacher)
                    @if($teacher->pivot->author_type == 1)
                    <b>First Author:</b> {{ $teacher->fname_en}} {{ $teacher->lname_en}} <br>
                    @endif 
                    @endforeach

                    @foreach($paper->author as $teacher)
                    @if($teacher->pivot->author_type == 2)
                    <b>Co Author:</b> {{ $teacher->author_fname}} {{ $teacher->author_lname}} <br>
                    @endif
                    @endforeach
                    @foreach($paper->teacher as $teacher)
                    @if($teacher->pivot->author_type == 2)
                    <b>Co Author:</b> {{ $teacher->fname_en}} {{ $teacher->lname_en}} <br>
                    @endif 
                    @endforeach

                    @foreach($paper->author as $teacher)
                    @if($teacher->pivot->author_type == 3)
                    <b>Corresponding Author:</b> {{ $teacher->author_fname}} {{ $teacher->author_lname}} <br>
                    @endif
                    @endforeach
                    @foreach($paper->teacher as $teacher)
                    @if($teacher->pivot->author_type == 3)
                    <b>Corresponding Author:</b> {{ $teacher->fname_en}} {{ $teacher->lname_en}} <br>
                    @endif 
                    @endforeach
                    



                </p>
            </div>

            <div class="row mt-2">
                <p class="card-text col-sm-3"><b>{{ __('message.sourceTitle')}}</b></p>
                <p class="card-text col-sm-9">{{ $paper->paper_sourcetitle }}</p>
            </div>
            <div class="row mt-2">
                <p class="card-text col-sm-3"><b>{{ __('message.year')}}</b></p>
                <p class="card-text col-sm-9">{{ $paper->paper_yearpub }}</p>
            </div>
            <div class="row mt-2">
                <p class="card-text col-sm-3"><b>{{ __('message.volumn')}}</b></p>
                <p class="card-text col-sm-9">{{ $paper->paper_volume }}</p>
            </div>
            <div class="row mt-2">
                <p class="card-text col-sm-3"><b>{{ __('message.issum_number')}}</b></p>
                <p class="card-text col-sm-9">{{ $paper->paper_issue}}</p>
            </div>
            <div class="row mt-2">
                <p class="card-text col-sm-3"><b>{{ __('message.page')}}</b></p>
                <p class="card-text col-sm-9">{{ $paper->paper_page }}</p>
            </div>
            <div class="row mt-2">
                <p class="card-text col-sm-3"><b>{{ __('message.doi')}}</b></p>
                <p class="card-text col-sm-9">{{ $paper->paper_doi }}</p>
            </div>
            <div class="row mt-2">
                <p class="card-text col-sm-3"><b>{{ __('message.url')}}</b></p>
                <a href="{{ $paper->paper_url }}" target="_blank" class="card-text col-sm-9">{{ $paper->paper_url }}</a>
            </div>

            <a class="btn btn-primary mt-5" href="{{ route('papers.index') }}">{{ __('message.back')}}</a>
        </div>
    </div>

</div>
@endsection