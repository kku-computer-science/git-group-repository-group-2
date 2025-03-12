@extends('dashboards.users.layouts.user-dash-layout')
@section('content')

<div class="container">
    @if ($errors->any())
    <div class="alert alert-danger">
        <strong>{{ __('message.whoops') }}</strong> {{ __('message.problem_with_input') }}<br><br>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="card" style="padding: 16px;">
        <div class="card-body">
            <h4 class="card-title">Edit Highlight</h4>


            <form action="{{ route('highlights.update', $highlight->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group row">
                    <p class="col-sm-3"><b>Title : </b></p>
                    <div class="col-sm-8">
                        <input name="title" value="{{ old('title', $highlight->title) }}" class="form-control" placeholder="{{ __('message.title') }}">
                    </div>
                </div>

                <div class="form-group row">
                    <p class="col-sm-3"><b>Detail : </b></p>
                    <div class="col-sm-8">
                        <textarea name="detail" class="form-control" style="height:90px">{{ old('detail', $highlight->detail) }}</textarea>
                    </div>
                </div>

                <div class="form-group row">
                    <p class="col-sm-3"><b>Thumbnails : </b></p>
                    <div class="col-sm-8">
                        <input type="file" name="thumbnails[]" class="form-control" multiple>
                        @if($highlight->thumbnails)
                        @foreach(json_decode($highlight->thumbnails) as $thumbnail)
                        <img src="{{ asset('storage/' . $thumbnail) }}" width="100" class="mt-2" />
                        @endforeach
                        @endif
                    </div>
                </div>


                <div class="form-group row">
                    <p class="col-sm-3"><b>Tags : </b></p>
                    <div class="col-sm-8">
                        <input name="tags" value="{{ old('tags', implode(',', $highlight->tags->pluck('name')->toArray())) }}" class="form-control" placeholder="{{ __('message.tags') }}">
                    </div>
                </div>

                <button type="submit" class="btn btn-primary mt-5">Submit</button>
                <a class="btn btn-light mt-5" href="{{ route('highlights.index') }}">Back</a>
            </form>
        </div>
    </div>
</div>

@stop