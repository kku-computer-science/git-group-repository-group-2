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
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            white-space: normal;
        }

        .card-text {
            font-size: 1rem;
            color: #666;
            margin-top: 5px;
            margin-bottom: 10px;
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 3; /* จำกัดให้แสดง 3 บรรทัด */
            -webkit-box-orient: vertical;
            white-space: normal;
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
            border-bottom: solid 2px #ccc;
            margin-bottom: 20px;
        }

        /* สไตล์สำหรับมือถือ */
        @media (max-width: 576px) {
            .highlight-title {
                font-size: 1rem;
            }

            .card-text {
                font-size: 0.9rem;
                -webkit-line-clamp: 2; /* ในมือถือลดเหลือ 2 บรรทัดเพื่อให้ดูสมดุล */
            }
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
                <div class="col-4 mb-4"> <!-- เปลี่ยนจาก col-md-4 เป็น col-4 เพื่อบังคับ 3 การ์ดต่อแถว -->
                    <a href="{{ route('highlight.show', ['id' => $highlight->id]) }}" class="text-black text-decoration-none">
                        <div class="card highlight-card">
                            <img src="{{ Storage::url($highlight->thumbnail) }}" class="card-img-top" alt="Highlight Image">
                            <div class="card-body">
                                <h5 class="highlight-title">{{ $highlight->title }}</h5>
                                <p class="card-text">{{ $highlight->detail }}</p> <!-- เอาค่า Str::limit ออกเพื่อให้ CSS จัดการ -->
                                <div class="highlight-meta">
                                    <span class="date">เผยแพร่: {{ $highlight->created_at->format('d/m/Y') ?? 'N/A' }}</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection