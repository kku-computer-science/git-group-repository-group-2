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
        height: 850px;
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

    /* Back Button */
    .back-btn-container {
        text-align: center;
        margin-top: 10px;
        padding-bottom: 30px;
    }

    .back-btn-btn {
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

    .back-btn-btn:hover {
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
        box-shadow: none;
        border: none;
        display: block;
        background: transparent;
    }

    /* Modal Styles for Enlarged Image */
    .modal {
        display: none;
        position: fixed;
        z-index: 10000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: hidden;
        background-color: #1a1a1a;
        padding: 0;
        align-items: center;
        justify-content: center;
    }

    .modal-image-wrapper {
        position: relative;
        max-width: 95%;
        max-height: 95vh;
        width: auto;
        height: auto;
        border: none;
        box-sizing: border-box;
        background: transparent;
    }

    .modal-content {
        display: block;
        width: 100%;
        height: 100%;
        max-width: 100%;
        max-height: 90vh;
        object-fit: contain;
        border-radius: 0;
        box-shadow: none;
    }

    .close-modal {
        position: absolute;
        top: 20px;
        right: 35px;
        color: #fff;
        font-size: 40px;
        font-weight: bold;
        cursor: pointer;
        transition: color 0.3s ease;
    }

    .close-modal:hover {
        color: #bbb;
    }

    .prev-btn,
    .next-btn {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background: rgba(255, 255, 255, 0.2);
        color: #fff;
        border: none;
        padding: 10px;
        /* ลด padding เพื่อให้ปุ่มเล็กลง */
        font-size: 20px;
        /* ลดขนาดไอคอน */
        cursor: pointer;
        transition: background 0.3s ease, opacity 0.3s ease;
        opacity: 0.7;
        border-radius: 50%;
        width: 40px;
        /* กำหนดความกว้าง */
        height: 40px;
        /* กำหนดความสูง */
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .prev-btn:hover,
    .next-btn:hover {
        background: rgba(255, 255, 255, 0.4);
        opacity: 1;
    }

    .prev-btn {
        left: 200px;
    }

    .next-btn {
        right: 200px;
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
            <span class="close-modal">×</span>
            <div class="modal-image-wrapper">
                <img class="modal-content" id="modalImage" alt="ภาพขยาย">
            </div>
            <button class="prev-btn"><i class="fas fa-chevron-left"></i></button>
            <button class="next-btn"><i class="fas fa-chevron-right"></i></button>
        </div>

        <div class="back-btn-container">
            <a href="{{ route('home') }}" class="back-btn-btn">กลับไปหน้าหลัก</a>
        </div>


    @else
        <p>ไม่มีข้อมูล</p>
    @endif
@endsection

<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Get the modal elements
        const modal = document.getElementById("imageModal");
        const modalImg = document.getElementById("modalImage");
        const closeModal = document.querySelector(".close-modal");
        const prevBtn = document.querySelector(".prev-btn");
        const nextBtn = document.querySelector(".next-btn");

        // Get all additional images
        const additionalImages = document.getElementsByClassName("additional-image");
        const imagesArray = Array.from(additionalImages);
        let currentIndex = 0;

        // Function to update modal image
        function updateModalImage(index) {
            if (index >= 0 && index < imagesArray.length) {
                modalImg.src = imagesArray[index].src;
                currentIndex = index;
                // Hide buttons if at start or end
                prevBtn.style.display = currentIndex === 0 ? "none" : "block";
                nextBtn.style.display = currentIndex === imagesArray.length - 1 ? "none" : "block";
            }
        }

        // Open modal when clicking an image
        imagesArray.forEach((image, index) => {
            image.addEventListener("click", function () {
                modal.style.display = "flex"; /* ใช้ flex เพื่อจัดกึ่งกลาง */
                updateModalImage(index);
            });
        });

        // Close the modal
        closeModal.addEventListener("click", function () {
            modal.style.display = "none";
        });

        // Close modal when clicking outside the image
        modal.addEventListener("click", function (event) {
            if (event.target === modal) {
                modal.style.display = "none";
            }
        });

        // Previous button
        prevBtn.addEventListener("click", function () {
            updateModalImage(currentIndex - 1);
        });

        // Next button
        nextBtn.addEventListener("click", function () {
            updateModalImage(currentIndex + 1);
        });

        // Optional: Keyboard navigation
        document.addEventListener("keydown", function (event) {
            if (modal.style.display === "flex") {
                if (event.key === "ArrowLeft") {
                    updateModalImage(currentIndex - 1);
                } else if (event.key === "ArrowRight") {
                    updateModalImage(currentIndex + 1);
                } else if (event.key === "Escape") {
                    modal.style.display = "none";
                }
            }
        });
    });
</script>