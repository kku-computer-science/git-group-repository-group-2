@extends('layouts.layout')

@section('content')
<style>
    /* สไตล์สำหรับบัตร highlight */
    .highlight-card {
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 10px;
        overflow: hidden;
        transition: all 0.3s ease;
        margin-bottom: 20px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .highlight-card:hover {
        box-shadow: 0 10px 20px rgba(0, 86, 179, 0.15), 0 4px 6px rgba(0, 86, 179, 0.08);
        border: 1px dashed #007bff;
    }

    /* สไตล์สำหรับรูปภาพ */
    .image-container img {
        width: 100%;
        height: 200px;
        object-fit: cover;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
    }

    /* สไตล์สำหรับรายละเอียด */
    .highlight-details {
        padding: 10px;
        text-align: left;
    }

    .highlight-title {
        font-size: 1.1rem;
        font-weight: bold;
        color: #333;
        margin: 0;
        text-overflow: ellipsis;
        overflow: hidden;
        white-space: nowrap;
    }

    .highlight-meta {
        font-size: 0.9rem;
        color: #666;
        margin-top: 5px;
    }

    .highlight-meta span {
        margin-right: 10px;
    }

    .highlight-meta .date {
        color: #007bff;
    }

    .highlight-meta .likes {
        color: #28a745;
    }

    .read-more-btn {
        display: inline-block;
        margin-top: 10px;
        padding: 8px 16px;
        background-color: #007bff;
        color: #fff;
        text-decoration: none;
        border-radius: 5px;
        font-size: 0.9rem;
        transition: background-color 0.3s ease;
    }

    .read-more-btn:hover {
        background-color: #0056b3;
        color: #fff;
    }

    .search-header {
        margin-bottom: 20px;
    }

    .search-header h2 {
        font-size: 2rem;
        color: #007bff;
        margin: 0 0 5px 0;
        margin-top: 20px;
    }

    .search-header .count {
        font-size: 1rem;
        color: #666;
    }

    /* สไตล์สำหรับเส้นขีดคั่น */
    .separator {
        border-bottom: solid  2px  #ccc;
        margin-bottom: 20px;
    }
</style>

<div class="container">
    <div class="search-header">
        <h2>ผลการค้นหาสำหรับ: {{ $tag->name }}</h2>
        <span class="count">ผลการค้นหาพบ: {{ $highlights->count() }} รายการ</span>
    </div>
    <div class="separator"></div> 

    <div class="row">
        @foreach($highlights as $highlight)
        <div class="col-md-4">
            <div class="highlight-card">
                <div class="image-container">
                    <img src="{{ Storage::url($highlight->thumbnail) }}" alt="{{ $highlight->title }}">
                </div>
                <div class="highlight-details">
                    <h3 class="highlight-title">{{ $highlight->title ?? 'ชื่อเรื่องเริ่มต้น' }}</h3>
                    <div class="highlight-meta">
                        <span class="date">เผยแพร่: {{ $highlight->created_at->format('d/m/Y') ?? 'N/A' }}</span>
                    </div>
                    <a href="{{ route('highlight.show', ['id' => $highlight->id]) }}" class="read-more-btn">อ่านเพิ่มเติม</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection