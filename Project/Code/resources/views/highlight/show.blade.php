@extends('dashboards.users.layouts.user-dash-layout')

@section('content')
<div class="container">
    <div class="card col-md-10" style="padding: 16px;">
        <div class="card-body">
            <h4 class="card-title">{{ __('message.highlight_detail')}}</h4>
            <p class="card-description">{{ __('message.info_highlight_detail')}}</p>

            <!-- แสดง Title -->
            <div class="row mt-2">
                <p class="card-text col-sm-3"><b>{{ __('message.title')}}</b></p>
                <p class="card-text col-sm-9">{{ $highlight->title }}</p>
            </div>

            <!-- แสดง Description -->
            <div class="row mt-2">
                <p class="card-text col-sm-3"><b>{{ __('message.description')}}</b></p>
                <p class="card-text col-sm-9">{{ $highlight->description }}</p>
            </div>

            <!-- แสดง Detail -->
            <div class="row mt-2">
                <p class="card-text col-sm-3"><b>{{ __('message.detail')}}</b></p>
                <p class="card-text col-sm-9">{{ $highlight->detail }}</p>
            </div>

            <!-- แสดง Tags -->
            <div class="row mt-2">
                <p class="card-text col-sm-3"><b>{{ __('message.tags')}}</b></p>
                <p class="card-text col-sm-9">
                    @foreach($highlight->tags as $tag)
                        <span class="badge badge-primary">{{ $tag->name }}</span>
                    @endforeach
                </p>
            </div>

            <!-- แสดง Image -->
            <div class="row mt-2">
                <p class="card-text col-sm-3"><b>{{ __('message.image')}}</b></p>
                <p class="card-text col-sm-9">
                    <img src="{{ asset('storage/thumbnails/' . $highlight->thumbnail) }}" class="img-fluid" width="200px">
                </p>
            </div>

            <!-- ปุ่มกลับ -->
            <a class="btn btn-primary mt-5" href="{{ route('highlights.index') }}">{{ __('message.back')}}</a>
        </div>
    </div>
</div>
@stop
