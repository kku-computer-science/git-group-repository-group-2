@extends('dashboards.users.layouts.user-dash-layout')
<link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.2.3/css/fixedHeader.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.0/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.2.3/css/fixedHeader.bootstrap4.min.css">
<!-- SweetAlert2 -->
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.3.3/dist/sweetalert2.min.css" rel="stylesheet">

<style>
    .badge-info {
        background-color: black;
        color: white;
    }

    /* Optional: Add a bit of padding to the textarea */
    #detail {
        padding: 10px;
    }

    /* Positioning the View Highlight button at the bottom right */
    .view-highlight-btn {
        position: fixed;
        bottom: 20px;
        right: 20px;
        padding: 10px 20px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
        z-index: 1000;
    }

    .view-highlight-btn:hover {
        background-color: #0056b3;
    }
</style>

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Upload Highlight</h2>
    <a href="{{ route('highlight.view') }}" class="btn btn-dark">Manage Highlight</a> <br> <br>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('highlight.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- ฟิลด์อื่นๆ ของฟอร์ม -->
                <div class="form-group">
                    <label for="title">Title:</label>
                    <input type="text" class="form-control" id="title" name="title" required>
                </div>

                <div class="form-group">
                    <label for="detail">Detail:</label>
                    <textarea class="form-control" id="detail" name="detail" rows="3" required oninput="autoResize(this)"></textarea>
                </div>

                <!-- Field สำหรับอัปโหลดภาพเดิม (เดิมอยู่) -->
                <div class="form-group">
                    <label for="thumbnail">Upload Image (Head):</label>
                    <input type="file" class="form-control-file" id="thumbnail" name="thumbnail" accept="image/*" required>
                    <img id="preview" class="mt-2" width="150" style="display: none;">
                </div>

                <!-- Field ใหม่สำหรับอัปโหลดภาพเพิ่มเติม -->
                <div class="form-group">
                    <label for="additional_thumbnails">Upload Additional Images (Detail):</label>
                    <input type="file" class="form-control-file" id="additional_thumbnails" name="additional_thumbnails[]" accept="image/*" multiple>
                    <div id="additional-preview-container" class="mt-2"></div>
                </div>


                <div class="form-group">
                    <label for="tags">Tags:</label>
                    <input type="text" class="form-control" id="tags" name="tags" placeholder="e.g., Sports, News, Technology">
                    <div id="tag-list" class="mt-2"></div>
                </div>

                <!-- hidden input field for storing tags -->
                <input type="hidden" id="tags-input" name="tags">

                <button type="submit" class="btn btn-primary">Upload</button>
            </form>
        </div>
    </div>

    <!-- ปุ่ม Manage Highlight -->

</div>



<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.3.3/dist/sweetalert2.min.js"></script>
<script>
    document.getElementById("thumbnail").addEventListener("change", function(event) {
        const reader = new FileReader();
        reader.onload = function() {
            const output = document.getElementById("preview");
            output.src = reader.result;
            output.style.display = "block";
        };
        reader.readAsDataURL(event.target.files[0]);
    });

    // Display alert messages using SweetAlert2
    @if(session('success'))
    Swal.fire({
        icon: 'success',
        title: 'Success!',
        text: "{{ session('success') }}",
        showConfirmButton: false,
        timer: 1500
    });
    @elseif(session('error'))
    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: "{{ session('error') }}",
        showConfirmButton: true
    });
    @endif

    document.getElementById('tags').addEventListener('keypress', function(event) {
        if (event.key === 'Enter') {
            event.preventDefault();
            const tagInput = event.target.value.trim();
            if (tagInput) {
                // Create a new tag element
                const tag = document.createElement('span');
                tag.classList.add('badge', 'badge-info', 'mr-2', 'mb-2', 'tag-item');
                tag.textContent = tagInput;

                // Create a delete button (x) inside the tag
                const deleteButton = document.createElement('span');
                deleteButton.classList.add('ml-2', 'delete-tag');
                deleteButton.textContent = '×';
                deleteButton.style.cursor = 'pointer';
                deleteButton.onclick = function() {
                    tag.remove(); // Remove the tag when clicked
                    updateTagsInput(); // Update the hidden input after removing a tag
                };

                // Append the delete button to the tag
                tag.appendChild(deleteButton);

                // Add the tag to the tag list
                const tagList = document.getElementById('tag-list');
                tagList.appendChild(tag);

                // Clear the input field
                event.target.value = '';

                // Update hidden input field with current tags
                updateTagsInput();
            }
        }
    });

    // Function to update hidden input field with current tags
    function updateTagsInput() {
        const tags = [];
        const tagElements = document.querySelectorAll('#tag-list .tag-item');
        tagElements.forEach(tag => {
            tags.push(tag.textContent.replace('×', '').trim());
        });
        document.getElementById('tags-input').value = tags.join(','); // Store tags as a comma-separated string
    }

    // Function to resize textarea as user types
    function autoResize(textarea) {
        textarea.style.height = 'auto'; // Reset the height
        textarea.style.height = (textarea.scrollHeight) + 'px'; // Set the height to scrollHeight
    }

    document.querySelector("form").addEventListener("submit", function() {
        updateTagsInput(); // อัปเดตค่าของ #tags-input ก่อนส่งฟอร์ม
    });

    // Add event listener for blur to update tags when user leaves the input field
    document.getElementById('tags').addEventListener('blur', function() {
        if (this.value.trim()) {
            const event = new KeyboardEvent('keypress', {
                key: 'Enter'
            });
            this.dispatchEvent(event);
        }
    });
    // Preview สำหรับ field additional_thumbnails
    document.getElementById("additional_thumbnails").addEventListener("change", function(event) {
        const previewContainer = document.getElementById("additional-preview-container");
        previewContainer.innerHTML = ''; // เคลียร์ตัวอย่างเก่า
        const files = event.target.files;
        for (let i = 0; i < files.length; i++) {
            const file = files[i];
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.createElement("img");
                img.src = e.target.result;
                img.width = 150;
                img.style.marginRight = "10px";
                img.style.marginBottom = "10px";
                previewContainer.appendChild(img);
            };
            reader.readAsDataURL(file);
        }
    });
</script>

@endsection