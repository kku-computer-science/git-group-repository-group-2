@extends('layouts.layout')

@section('content')
<style>
    .highlight-detail-container {
        display: block;
        max-width: 800px;
        /* ขนาดที่ต้องการ */
        width: 100%;
        /* ให้ container มีความกว้าง 100% ของพื้นที่ที่สามารถใช้งาน */
        margin: 40px auto;
        /* จัดให้อยู่กลางหน้าจอ */
        padding: 20px;
        background-color: #f9f9f9;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        text-align: center;
        color: black;
        /* เพิ่มให้แน่ใจว่าเนื้อหาภายในถูกจัดกลาง */
    }


    .highlight-title {
        font-size: 2rem;
        color: #333;
        margin-bottom: 20px;
        text-align: center;
        font-weight: bold;
    }

    .thumbnail-container {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 20px;
    }

    .highlight-thumbnail {
        display: block;
        max-width: 100%;
        height: 300px;
        /* กำหนดความสูงที่ต้องการ */
        object-fit: cover;
        /* ให้ภาพครอบคลุมพื้นที่ */
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    @media (max-width: 768px) {
        .highlight-thumbnail {
            height: 250px;
            /* ปรับขนาดตามอุปกรณ์ */
        }
    }

    @media (max-width: 480px) {
        .highlight-thumbnail {
            height: 200px;
            /* ปรับขนาดสำหรับหน้าจอมือถือ */
        }
    }


    .highlight-detail {
        font-size: 1.1rem;
        color: #555;
        line-height: 1.6;
        margin-bottom: 30px;
    }

    .tags-container {
        margin-bottom: 30px;
    }

    .tags-title {
        font-size: 1.2rem;
        color: #444;
        margin-bottom: 10px;
    }

    .tags-list {
        list-style-type: none;
        padding: 0;
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .tag-item {
        background-color: #e0e0e0;
        padding: 8px 16px;
        border-radius: 20px;
        color: #333;
        font-size: 1rem;
        transition: background-color 0.3s ease;
    }

    .tag-item:hover {
        background-color: #007bff;
        color: white;
    }

    .back-btn {
        display: inline-block;
        margin-top: 20px;
        padding: 12px 20px;
        background-color: #007bff;
        color: white;
        text-decoration: none;
        border-radius: 4px;
        font-weight: bold;
        transition: background-color 0.3s ease;
    }

    .back-btn:hover {
        background-color: #0056b3;
    }

    /* สไตล์เพิ่มเติมสำหรับวันที่ */
    .dates-container {
        margin-bottom: 30px;
        font-size: 1rem;
        color: #777;
        text-align: left;
    }

    .dates-container p {
        margin: 5px 0;
    }
</style>
<div class="highlight-detail-container">
    <h1 class="highlight-title">{{ $highlight->title }}</h1>

    <!-- Thumbnail -->
    <div class="thumbnail-container">
        <img class="highlight-thumbnail" src="{{ Storage::url($highlight->thumbnail) }}" alt="Thumbnail">
    </div>

    <!-- Detail Section -->
    <p class="highlight-detail">{{ $highlight->detail }}</p>

    <!-- Tags Section -->
    @if($highlight->tags->count() > 0)
    <div class="tags-container">
        <h3 class="tags-title">Tags:</h3>
        <ul class="tags-list">
            @foreach($highlight->tags as $tag)
            <li class="tag-item">{{ $tag->name }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <!-- Dates Section -->
    <div class="dates-container">
        <p><strong>Created At:</strong> {{ $highlight->created_at->format('d M Y, H:i') }}</p>
        <p><strong>Updated At:</strong> {{ $highlight->updated_at->format('d M Y, H:i') }}</p>
    </div>

    <!-- Back Button -->
    <a href="{{ route('home') }}" class="back-btn">Back to Home</a>
</div>
@endsection


