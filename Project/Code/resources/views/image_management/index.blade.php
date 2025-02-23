@extends('dashboards.users.layouts.user-dash-layout')

<link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.2.3/css/fixedHeader.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.0/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.2.3/css/fixedHeader.bootstrap4.min.css">

@section('content')
<div class="container">
    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif

    <div class="card" style="padding: 16px;">
        <div class="card-body">
            <h4 class="card-title text-center">จัดการรูปภาพ</h4>

            <form action="{{ route('banners.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <input type="file" name="image" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">อัปโหลดรูป</button>
            </form>

            <table id="imageTable" class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>รูปภาพ</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @isset($banners)  <!-- ตรวจสอบว่า $banners ถูกตั้งค่าแล้ว -->
                        @forelse ($banners as $banner)
                        <tr>
                            <td>{{ $banner->id }}</td>
                            <td>
                                <!-- เพิ่มคลาส `image-clickable` สำหรับการคลิกที่รูปภาพ -->
                                <img class="image-clickable" src="{{ asset('storage/' . $banner->image_path) }}" width="150" data-toggle="modal" data-target="#imageModal" data-img="{{ asset('storage/' . $banner->image_path) }}">
                            </td>
                            <td>
                                <form action="{{ route('banners.destroy', $banner->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit">ลบ</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center">ไม่มีข้อมูลแบนเนอร์</td>
                        </tr>
                        @endforelse
                    @else
                        <tr>
                            <td colspan="3" class="text-center">ไม่มีข้อมูลแบนเนอร์</td>
                        </tr>
                    @endisset
                </tbody>
            </table>

        </div>
    </div>

    <!-- Modal สำหรับแสดงรูปภาพขนาดใหญ่ -->
    <div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">รูปภาพ</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- ที่นี่จะแสดงรูปภาพขนาดใหญ่ -->
                    <img id="modalImage" class="img-fluid" src="" alt="Image">
                </div>
            </div>
        </div>
    </div>

</div>

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.min.js" defer></script>
<script src="https://cdn.datatables.net/1.12.0/js/dataTables.bootstrap4.min.js" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function() {
        $('#imageTable').DataTable({
            order: [[0, 'asc']]
        });

        // เมื่อคลิกที่รูปภาพ ให้แสดงใน Modal
        $('.image-clickable').on('click', function() {
            var imageSrc = $(this).data('img');
            $('#modalImage').attr('src', imageSrc);
        });
    });
</script>
@stop