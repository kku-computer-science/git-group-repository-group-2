@extends('layouts.layout')

<style>
    /* Reset default margins and paddings */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    /* Container styling */
    .container {
        max-width: 1200px;
        margin-top: 2rem;
        margin-bottom: 2rem;
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


    /* Card styling */
    .highlight-card {
        height: 100%;
        display: flex;
        flex-direction: column;
        border: none;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        overflow: hidden;
    }

    .highlight-card:hover {
        box-shadow: 0 10px 20px rgba(0, 86, 179, 0.15), 0 4px 6px rgba(0, 86, 179, 0.08);
        border: 1px dashed #007bff;
    }

    /* Image styling */
    .highlight-card .card-img-top {
        width: 100%;
        height: 200px;
        object-fit: cover;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
    }

    /* Card body styling */
    .highlight-card .card-body {
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        padding: 15px;
    }

    /* Title styling */
    .highlight-card .card-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 10px;
        line-height: 1.2;
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        /* เพิ่ม */
        -webkit-line-clamp: 2;
        /* จำกัด 2 บรรทัด */
        -webkit-box-orient: vertical;
        /* เพิ่ม */
        white-space: normal;
        /* เปลี่ยนจาก nowrap เป็น normal */
    }

    /* Text styling */
    .highlight-card .card-text {
        font-size: 1rem;
        color: #666;
        margin-top: 5px;
        margin-bottom: 10px;
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        /* จำกัดให้แสดง 3 บรรทัด */
        -webkit-box-orient: vertical;
        white-space: normal;
    }

    /* Button styling */
    .highlight-card .read-more-btn {
        display: inline-block;
        font-size: 1rem;
        color: #fff;
        background-color: #007bff;
        padding: 8px 16px;
        border-radius: 25px;
        text-decoration: none;
        text-align: center;
        transition: background-color 0.3s ease, transform 0.3s ease;
        align-self: flex-end;
    }

    .highlight-card .read-more-btn:hover {
        background-color: #0056b3;
        transform: translateY(-2px);
        color: #fff;
    }

    /* Responsive adjustments */
    @media (max-width: 576px) {
        .highlight-card .card-img-top {
            height: 150px;
        }

        .highlight-card .card-title {
            font-size: 1.1rem;
            -webkit-line-clamp: 2;
            /* ยังคงจำกัด 2 บรรทัด */
        }

        .highlight-card .card-text {
            font-size: 0.9rem;
            -webkit-line-clamp: 2;
            /* ปรับจากโค้ดเดิมให้เหลือ 2 บรรทัดในหน้าจอเล็ก */
        }
    }
</style>

@section('content')
    <div class="container mt-4">
        <h1 class="text-center mb-4">รายการไฮไลท์ทั้งหมด</h1>

        <div class="row">
            @foreach($highlights as $highlight)
                <div class="col-4 mb-4"> <!-- เปลี่ยนจาก col-md-4 เป็น col-4 เพื่อบังคับ 3 การ์ดต่อแถว -->
                    <a href="{{ route('highlight.show', ['id' => $highlight->id]) }}" class="text-black text-decoration-none">
                        <div class="card highlight-card">
                            <img src="{{ Storage::url($highlight->thumbnail) }}" class="card-img-top" alt="Highlight Image">
                            <div class="card-body">
                                <h5 class="highlight-title">{{ $highlight->title }}</h5>
                                <p class="card-text">{{ $highlight->detail }}</p>
                                <!-- เอาค่า Str::limit ออกเพื่อให้ CSS จัดการ -->
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-center">
            {{ $highlights->links() }}
        </div>
    </div>
@endsection