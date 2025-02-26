@extends('dashboards.users.layouts.user-dash-layout')

@section('content')
<div class="container">
    <div class="card col-md-8" style="padding: 16px;">
        <div class="card-body">
            <h4 class="card-title">{{ __('message.book_detail') }}</h4>
            <p class="card-description">{{ __('message.book_info') }}</p>
            <div class="row">
                <p class="card-text col-sm-3"><b>{{ __('message.book_name') }}</b></p>
                <p class="card-text col-sm-9">{{ $paper->ac_name }}</p>
            </div>
            <div class="row">
                <p class="card-text col-sm-3"><b>{{ __('message.year') }}</b></p>
                <p class="card-text col-sm-9">{{  date('Y', strtotime($paper->ac_year))+543 }}</p>
            </div>
            <div class="row">
                <p class="card-text col-sm-3"><b>{{ __('message.publication') }}</b></p>
                <p class="card-text col-sm-9">{{ $paper->ac_sourcetitle }}</p>
            </div>
            <div class="row">
                <p class="card-text col-sm-3"><b>{{ __('message.Page') }}</b></p>
                <p class="card-text col-sm-9">{{ $paper->ac_page }}</p>
            </div>

            <div class="pull-right mt-5">
                <a class="btn btn-primary btn-sm" href="{{ route('books.index') }}"> {{ __('message.back') }}</a>
            </div>
        </div>

    </div>


</div>
@endsection