@extends('dashboards.users.layouts.user-dash-layout')

@section('content')
<div class="container">
    <div class="card col-md-10" style="padding: 16px;">
        <div class="card-body">
            <h4 class="card-title">Highlight Detail</h4>

            <!-- แสดง Title -->
            <div class="row mt-2">
                <p class="card-text col-sm-3"><b>Title : </b></p>
                <p class="card-text col-sm-9">{{ $highlight->title }}</p>
            </div>

            <!-- แสดง Detail -->
            <div class="row mt-2">
                <p class="card-text col-sm-3"><b>Detail : </b></p>
                <p class="card-text col-sm-9">{{ $highlight->detail }}</p>
            </div>

            <!-- แสดง Tags -->
            @if($highlight->tags->count() > 0)
            <div class="row mt-2">
                <p class="card-text col-sm-3"><b>Tags : </b></p>
                <div class="card-text col-sm-9">
                    @foreach($highlight->tags as $tag)
                    <span class="badge badge-primary">{{ $tag->name }}</span>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- แสดง Main Image -->
            <div class="row mt-2">
                <p class="card-text col-sm-3"><b>{{ __('message.image') }}</b></p>
                <p class="card-text col-sm-9">
                    <img src="{{ asset('storage/thumbnails/' . $highlight->thumbnail) }}" class="img-fluid" width="200px">
                </p>
            </div>

            <!-- แสดง Additional Images ถ้ามี -->
            @if($highlight->images && $highlight->images->count() > 0)
            <div class="row mt-2">
                <p class="card-text col-sm-3"><b>Additional Images :</b></p>
                <div class="card-text col-sm-9">
                    @foreach($highlight->images as $image)
                    <img src="{{ asset('storage/' . $image->image_path) }}" class="img-fluid" width="200px" style="margin:5px;">
                    @endforeach
                </div>
            </div>
            @endif

            <!-- ปุ่มกลับ -->
            <a class="btn btn-primary mt-5" href="{{ route('highlights.index') }}">{{ __('message.back') }}</a>
        </div>
    </div>
</div>
@stop