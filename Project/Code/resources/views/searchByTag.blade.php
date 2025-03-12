@extends('layouts.layout')

@section('content')
<style>
    /* กำหนดขนาดของรูปภาพให้เหมาะสม */
    .image-container img {
        width: 100%;
        /* กำหนดให้รูปภาพขยายเต็มความกว้าง */
        height: auto;
        /* ปรับความสูงอัตโนมัติตามอัตราส่วนของรูปภาพ */
        object-fit: cover;
        /* ใช้ cover เพื่อให้รูปภาพครอบกรอบโดยไม่เสียอัตราส่วน */
    }

    /* เพิ่มสไตล์ให้กับชื่อเรื่อง */
    .highlight-title {
        font-size: 1.1rem;
        font-weight: bold;
        color: #333;
        text-overflow: ellipsis;
        overflow: hidden;
        white-space: nowrap;
    }

    /* เพิ่มสไตล์ให้กับบัตร highlight */
    .highlight-card {
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 10px;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .highlight-card:hover {
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
    }

    /* เพิ่ม padding และตกแต่งให้กับชื่อแท็ก */
    .highlight-details {
        padding: 10px;
    }
</style>

<div class="container">
    <h2>ผลการค้นหาจากแท็ก: {{ $tag->name }}</h2>

    @if($highlights->count() > 0)
    <div class="row">
        @foreach($highlights as $highlight)
        <div class="col-md-4">
            <div class="highlight-card">
                <a href="{{ route('highlight.show', ['id' => $highlight->id]) }}">
                    <img src="{{ Storage::url($highlight->thumbnail) }}" alt="{{ $highlight->title }}">
                    <h3>{{ $highlight->title ?? 'ชื่อเรื่องเริ่มต้น' }}</h3>
                </a>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <p>ไม่มีโพสต์ที่ตรงกับแท็กนี้</p>
    @endif
</div>
@endsection