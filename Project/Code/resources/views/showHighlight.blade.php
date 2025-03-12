{{-- showHighlight.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="highlight-detail-container">
    <h1 class="highlight-title">{{ $highlight->title }}</h1>
    <img class="highlight-thumbnail" src="{{ Storage::url($highlight->thumbnail) }}" alt="Thumbnail">
    <p class="highlight-detail">{{ $highlight->detail }}</p>

    @if($highlight->tags->count() > 0)
    <ul class="tags-list">
        @foreach($highlight->tags as $tag)
        <li class="tag-item">{{ $tag->name }}</li>
        @endforeach
    </ul>
    @endif

    <a href="{{ route('home') }}" class="back-btn">Back to Home</a>
</div>
@endsection
