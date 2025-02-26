@extends('dashboards.users.layouts.user-dash-layout')

@section('content')
<div class="container">
    <div class="card col-md-8" style="padding: 16px;">
        <div class="card-body">
            <h4 class="card-title">{{ __('message.fund_detail')}}</h4>
            <p class="card-description">{{ __('message.research_fund')}}</p>
            <div class="row">
                <p class="card-text col-sm-3"><b>{{ __('message.research_fund_name')}}</b></p>
                <p class="card-text col-sm-9">{{ $fund->fund_name }}</p>
            </div>
            <div class="row">
                <p class="card-text col-sm-3"><b>{{ __('message.year')}}</b></p>
                <p class="card-text col-sm-9">{{ $fund->fund_year }}</p>
            </div>
            <div class="row">
                <p class="card-text col-sm-3"><b>{{ __('message.fund_detail')}}</b></p>
                <p class="card-text col-sm-9">{{ $fund->fund_details }}</p>
            </div>
            <div class="row">
                <p class="card-text col-sm-3"><b>{{ __('message.specify_type')}}</b></p>
                <p class="card-text col-sm-9">@if($fund->fund_type == 'ทุนภายนอก')
                    {{ __('message.external_fund') }}
                    @elseif($fund->fund_type == 'ทุนภายใน')
                    {{ __('message.internal_fund') }}
                    @else
                    {{ $fund->fund_type }}
                    @endif
                </p>
            </div>
            <div class="row">
                <p class="card-text col-sm-3"><b>{{ __('message.level')}}</b></p>
                <p class="card-text col-sm-9">{{ $fund->fund_level }}</p>
            </div>
            <div class="row">
                <p class="card-text col-sm-3"><b>{{ __('message.supporting')}}</b></p>
                <p class="card-text col-sm-9">{{ $fund->fund_name }}</p>
            </div>
            <div class="row">
                <p class="card-text col-sm-3"><b>{{ __('message.add_detail')}}</b></p>
                <p class="card-text col-sm-9">
                    @if(app()->getLocale() == 'th')
                    {{ $fund->user->fname_th }} {{ $fund->user->lname_th }}
                    @elseif(app()->getLocale() == 'en')
                    {{ $fund->user->fname_en }} {{ $fund->user->lname_en }}
                    @elseif(app()->getLocale() == 'zh')
                    {{ $fund->user->fname_zh }} {{ $fund->user->lname_zh }}
                    @else
                    {{ $fund->user->fname_th }} {{ $fund->user->lname_th }} <!-- ค่าเริ่มต้น -->
                    @endif
                </p>
            </div>
            <div class="pull-right mt-5">
                <a class="btn btn-primary btn-sm" href="{{ route('funds.index') }}"> {{ __('message.back')}}</a>
            </div>
        </div>

    </div>


</div>
@endsection