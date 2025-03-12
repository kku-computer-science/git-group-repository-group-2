@extends('layouts.layout')

<style>
    /* Reset default margins and paddings */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    /* Full-Screen Thumbnail */
    .thumbnail-container {
        width: 100%;
        margin-bottom: 30px;
    }

    .highlight-thumbnail {
        width: 100%;
        height: 600px;
        object-fit: cover;
        border-radius: 0; 
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15); 
    }

    /* Content Container */
    .highlight-detail-container {
        max-width: 1400px;
        width: 100%;
        margin: 40px auto;
        padding: 20px;
        transition: transform 0.3s ease;
    }

    .highlight-detail-container:hover {
        transform: translateY(-5px);
    }

    /* Title Styling */
    .highlight-title {
        font-size: 2.5rem;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 15px;
        line-height: 1.2;
        text-align: center;
        text-transform: capitalize;
    }

    /* Dates and Tags Row */
    .meta-row {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 20px;
        margin-bottom: 20px;
        flex-wrap: wrap;
    }

    .dates-container {
        font-size: 1rem;
        color: #6c757d;
        padding: 10px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .dates-container p {
        margin: 0;
    }

    .dates-container i {
        color: #007bff;
    }

    /* Tags Section */
    .tags-container {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
    }

    .tags-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: #2c3e50;
    }

    .tags-list {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        padding: 0;
        margin: 0;
        list-style: none;
    }

    .tag-item {
        background: #e3f2fd;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.95rem;
        color: #1a73e8;
        transition: background 0.3s ease, transform 0.3s ease;
    }

    .tag-item:hover {
        background: #bbdefb;
        transform: scale(1.05);
    }

    .tag-item a {
        color: #1a73e8;
        text-decoration: none;
    }

    .tag-icon {
        display: inline-block;
        margin-right: 5px;
        color: #1a73e8;
    }

    /* Detail Section */
    .highlight-detail {
        font-size: 1.2rem;
        line-height: 1.8;
        color: #333;
        margin-bottom: 20px;
        white-space: pre-wrap;
        background: #fff;
        padding: 15px;
        border-radius: 8px;
        box-shadow: inset 0 1px 5px rgba(0, 0, 0, 0.05);
    }

    /* Author Section */
    .author-container {
        font-size: 1rem;
        color: #6c757d;
        text-align: right;
        margin-top: 15px;
    }

    .author-container h6 {
        margin: 0;
        display: flex;
        align-items: center;
        gap: 5px;
        justify-content: flex-end;
    }

    .author-container i {
        color: #007bff;
        font-size: 1.2rem;
    }

    /* Back Button */
    .back-btn {
        display: inline-block;
        font-size: 1.1rem;
        color: #fff;
        background: #007bff;
        padding: 10px 20px;
        border-radius: 25px;
        text-decoration: none;
        transition: background 0.3s ease, transform 0.3s ease;
        margin-top: 20px;
    }

    .back-btn:hover {
        background: #0056b3;
        transform: translateY(-2px);
    }
</style>

@section('content')
@if(isset($highlight))
<div class="thumbnail-container">
    <img class="highlight-thumbnail" src="{{ Storage::url($highlight->thumbnail) }}" alt="Thumbnail">
</div>

<div class="meta-row">
    <div class="dates-container">
        <p><strong><i class="fas fa-calendar-alt"></i> เผยแพร่:</strong> {{ $highlight->created_at->format('d/m/Y H:i') }}</p>
    </div>

    @if($highlight->tags->count() > 0)
    <div class="tags-container">
        <strong class="tags-title">แท็ก:</strong>
        <ul class="tags-list">
            @foreach($highlight->tags as $tag)
            <li class="tag-item">
                <i class="fas fa-tag tag-icon"></i> {{ $tag->name }}
            </li>
            @endforeach
        </ul>
    </div>
    @endif
<<<<<<< HEAD

    <!-- Dates Section -->
    <div class="dates-container">
        <p><strong>Created At:</strong> {{ $highlight->created_at->format('d M Y, H:i') }}</p>
        <p><strong>Updated At:</strong> {{ $highlight->updated_at->format('d M Y, H:i') }}</p>
    </div>

    <!-- Back Button -->
    <a href="{{ route('home') }}" class="back-btn">Back to Home</a>
</div>
@endsection

=======
</div>

<div class="highlight-detail-container">
    <div class="text-center">
        <h1 class="highlight-title">{{ $highlight->title }}</h1>
    </div>

    <div>
        <p class="highlight-detail">{{ $highlight->detail }}</p>
    </div>

    
    <div class="author-container d-flex justify-content-end">
        <h6><i class="fas fa-user-circle" aria-hidden="true"></i> {{ $highlight->user->fname_th }} {{ $highlight->user->lname_th }}</h6>
    </div>
    <div class="author-container d-flex justify-content-end">
        <p><i class="fas fa-clock"></i> <strong>อัปเดตล่าสุด:</strong> {{ $highlight->updated_at->format('d/m/Y H:i') }}</p>
    </div>

    
    <div class="text-center">
        <a href="{{ route('home') }}" class="back-btn">กลับไปหน้าแรก</a>
    </div>
</div>
@else
<p>ไม่มีข้อมูล</p>
@endif
@endsection
>>>>>>> 44be5cf9069b18c8dc2f5022bc743096f4de8ffc
