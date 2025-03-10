@extends('dashboards.users.layouts.user-dash-layout')
<link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.2.3/css/fixedHeader.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.0/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.2.3/css/fixedHeader.bootstrap4.min.css">

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Upload Highlight</h2>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('highlight.index') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="form-group">
                    <label for="title">Highlight Title:</label>
                    <input type="text" class="form-control" id="title" name="title" required>
                </div>

                <div class="form-group">
                    <label for="detail">Detail:</label>
                    <textarea class="form-control" id="detail" name="detail" rows="3" required></textarea>
                </div>

                <div class="form-group">
                    <label for="thumbnail">Upload Image (Thumbnail):</label>
                    <input type="file" class="form-control-file" id="thumbnail" name="thumbnail" accept="image/*" required>
                    <img id="preview" class="mt-2" width="150" style="display: none;">
                </div>

                <div class="form-group">
                    <label for="upload_date">Upload Date:</label>
                    <input type="date" class="form-control" id="upload_date" name="upload_date" required>
                </div>

                <div class="form-group">
                    <label for="tags">Tags:</label>
                    <input type="text" class="form-control" id="tags" name="tags" placeholder="e.g., Sports, News, Technology" required>
                </div>

                <button type="submit" class="btn btn-primary">Upload</button>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById("thumbnail").addEventListener("change", function(event) {
        const reader = new FileReader();
        reader.onload = function(){
            const output = document.getElementById("preview");
            output.src = reader.result;
            output.style.display = "block";
        };
        reader.readAsDataURL(event.target.files[0]);
    });
</script>
@endsection
