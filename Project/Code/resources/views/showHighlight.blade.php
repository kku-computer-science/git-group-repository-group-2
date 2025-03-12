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

    /* ปุ่มอ่านเพิ่มเติม */
    .read-more-container {
        text-align: center;
        margin-top: 10px;
        padding-bottom: 30px;
    }

    .read-more-btn {
        display: inline-block;
        background: linear-gradient(90deg, #007bff, #00aaff);
        color: white;
        padding: 12px 25px;
        font-size: 16px;
        font-weight: 600;
        border-radius: 25px;
        text-decoration: none;
        transition: background 0.3s ease, transform 0.3s ease;
        box-shadow: 0 4px 8px rgba(0, 123, 255, 0.3);
    }

    .read-more-btn:hover {
        color: white;
        text-decoration: none;
        background: linear-gradient(90deg, #0056b3, #0099ff);
        box-shadow: 0 6px 12px rgba(0, 123, 255, 0.4);
    }

    /* Additional Images Section */
    .album-header {
        font-size: 2rem;
        font-weight: bold;
        text-align: center;
        margin: 40px 0 20px;
        color: #2c3e50;
    }

    .additional-images-container {
        width: 100%;
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-bottom: 30px;
        justify-content: center;
    }

    .additional-image {
        max-width: 400px;
        width: 100%;
        object-fit: cover;
        border-radius: 5px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        cursor: pointer;
        transition: transform 0.2s ease;
    }

    .additional-image:hover {
        transform: scale(1.02);
    }

    /* Modal Styles for Enlarged Image */
    .modal {
        display: none;
        position: fixed;
        z-index: 10000;
        padding-top: 60px;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.9);
    }

    .modal-content {
        margin: auto;
        display: block;
        max-width: 80%;
        max-height: 80%;
    }

    .close-modal {
        position: absolute;
        top: 20px;
        right: 35px;
        color: #fff;
        font-size: 40px;
        font-weight: bold;
        cursor: pointer;
    }
</style>

@section('content')
@if(isset($highlight))
<!-- Main Thumbnail -->
<div class="thumbnail-container">
    <img class="highlight-thumbnail" src="{{ Storage::url($highlight->thumbnail) }}" alt="Thumbnail">
</div>

<div class="meta-row">
    <div class="dates-container">
        <p>
            <strong><i class="fas fa-calendar-alt"></i> เผยแพร่:</strong>
            {{ $highlight->created_at->format('d/m/Y H:i') }}
        </p>
    </div>

    @if($highlight->tags->count() > 0)
    <div class="tags-container">
        <strong class="tags-title">แท็ก:</strong>
        <ul class="tags-list">
            @foreach($highlight->tags as $tag)
            <li class="tag-item">
                <i class="fas fa-tag tag-icon"></i>
                <a href="{{ route('searchByTag', ['tag' => $tag->name]) }}" class="tag-link">
                    {{ $tag->name }}
                </a>
            </li>
            @endforeach
        </ul>
    </div>
    @endif
</div>

<div class="highlight-detail-container">
    <div class="text-center">
        <h1 class="highlight-title">{{ $highlight->title }}</h1>
    </div>

    <div>
        <p class="highlight-detail">{{ $highlight->detail }}</p>
    </div>

    <div class="author-container d-flex justify-content-end">
        <h6>
            <i class="fas fa-user-circle" aria-hidden="true"></i>
            {{ $highlight->user->fname_th }} {{ $highlight->user->lname_th }}
        </h6>
    </div>
    <div class="author-container d-flex justify-content-end">
        <p>
            <i class="fas fa-clock"></i>
            <strong>อัปเดตล่าสุด:</strong>
            {{ $highlight->updated_at->format('d/m/Y H:i') }}
        </p>
    </div>

    <div class="text-center">
        <a href="{{ route('home') }}" class="back-btn">กลับไปหน้าแรก</a>
    </div>
</div>

<!-- Additional Images Section at the Bottom -->
@if($highlight->images && $highlight->images->count() > 0)
<div class="album-header">Image Album</div>
<div class="additional-images-container">
    @foreach($highlight->images as $image)
    <img class="additional-image" src="{{ Storage::url($image->image_path) }}" alt="Additional Image">
    @endforeach
</div>
@endif

<!-- Modal for Enlarged Image -->
<div id="imageModal" class="modal">
    <span class="close-modal">&times;</span>
    <img class="modal-content" id="modalImage">
</div>

@else
<p>ไม่มีข้อมูล</p>
@endif
@endsection

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Get the modal
        const modal = document.getElementById("imageModal");
        const modalImg = document.getElementById("modalImage");
        const closeModal = document.getElementsByClassName("close-modal")[0];

        // Add click event to each additional image
        const additionalImages = document.getElementsByClassName("additional-image");
        Array.from(additionalImages).forEach(image => {
            image.addEventListener("click", function() {
                modal.style.display = "block";
                modalImg.src = this.src;
            });
        });

        // Close the modal when the close button is clicked
        closeModal.addEventListener("click", function() {
            modal.style.display = "none";
        });

        // Optionally, close the modal when clicking outside the image
        modal.addEventListener("click", function(event) {
            if (event.target === modal) {
                modal.style.display = "none";
            }
        });
    });
</script>
