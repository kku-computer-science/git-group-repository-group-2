@extends('dashboards.users.layouts.user-dash-layout')

@section('content')
<div class="container">
    <div class="card col-md-8" style="padding: 16px;">
        <div class="card-body">
            <h4 class="card-title">รายละเอียดผลงานวิชาการอื่นๆ (สิทธิบัตร, อนุสิทธิบัตร,ลิขสิทธิ์)</h4>
            <p class="card-description">ข้อมูลรายละเอียดผลงานวิชาการอื่นๆ (สิทธิบัตร, อนุสิทธิบัตร,ลิขสิทธิ์)</p>
            <div class="row">
                <p class="card-text col-sm-3"><b>{{ __('message.name') }}</b></p>
                <p class="card-text col-sm-9">{{ $patent->ac_name }}</p>
            </div>
            <div class="row">
                <p class="card-text col-sm-3"><b>{{ __('message.Type') }}</b></p>
                <p class="card-text col-sm-9">{{ $patent->ac_type }}</p>
            </div>
            <div class="row">
                <p class="card-text col-sm-3"><b>{{ __('message.RegistrationDate') }}</b></p>
                <p class="card-text col-sm-9">{{ $patent->ac_year }}</p>
            </div>
            <div class="row">
                <p class="card-text col-sm-3"><b>{{ __('message.registration_number') }}</b></p>
                <p class="card-text col-sm-9">{{ __('message.id_number') }} : {{ $patent->ac_refnumber }}</p>
            </div>
            <div class="row">
                <p class="card-text col-sm-3"><b>{{ __('message.created_by') }}</b></p>
                <p class="card-text col-sm-9">@foreach($patent->user as $a)
                    {{ $a->fname_th }} {{ $a->lname_th }}
                @if (!$loop->last),@endif
                @endforeach
                </p>
            </div>
            <div class="row">
                <p class="card-text col-sm-3"><b>{{ __('message.collaborator') }}</b></p>
                <p class="card-text col-sm-9">
                @foreach($patent->author as $a)
                    {{ $a->author_fname }} {{ $a->author_lname }}
                @if (!$loop->last),@endif
                @endforeach</p>
            </div>
            
            <div class="pull-right mt-5">
                <a class="btn btn-primary btn-sm" href="{{ route('patents.index') }}"> {{ __('message.back') }}</a>
            </div>
        </div>
    </div>
</div>
@endsection