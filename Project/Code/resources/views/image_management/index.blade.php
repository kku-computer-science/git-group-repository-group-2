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
            <h4 class="card-title text-center">{{ __('message.img')}}</h4>
    
            <form action="{{ route('banners.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="image_th">{{ __('message.img_th')}}</label>
                    <input type="file" class="form-control" name="image_th" id="image_th">
                </div>
                
                <div class="form-group">
                    <label for="image_en">{{ __('message.img_en')}}</label>
                    <input type="file" class="form-control" name="image_en" id="image_en">
                </div>
                
                <div class="form-group">
                    <label for="image_zh">{{ __('message.zh')}}</label>
                    <input type="file" class="form-control" name="image_zh" id="image_zh">
                </div>
                
                <button type="submit" class="btn btn-primary">{{ __('message.save')}}</button>
            </form>
    
            <table id="imageTable" class="table table-striped">
                <thead>
                    <tr>
                        <th>{{ __('message.id')}}</th>
                        <th>{{ __('message.images')}}</th>
                        <th>{{ __('message.action')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @isset($banners)
                        @forelse ($banners as $banner)
                        <tr>
                            <td>{{ $banner->id }}</td>
                            <td>
                                <div style="display: flex; gap: 10px;">
                                    <div>
                                        <strong>TH:</strong>
                                        <img class="image-clickable" src="{{ asset('storage/' . $banner->image_path_th) }}" width="100" data-bs-toggle="modal" data-bs-target="#imageModal" onclick="showImageModal('{{ asset('storage/' . $banner->image_path_th) }}')">
                                    </div>
                                    <div>
                                        <strong>EN:</strong>
                                        <img class="image-clickable" src="{{ asset('storage/' . $banner->image_path_en) }}" width="100" data-bs-toggle="modal" data-bs-target="#imageModal" onclick="showImageModal('{{ asset('storage/' . $banner->image_path_en) }}')">
                                    </div>
                                    <div>
                                        <strong>ZH:</strong>
                                        <img class="image-clickable" src="{{ asset('storage/' . $banner->image_path_zh) }}" width="100" data-bs-toggle="modal" data-bs-target="#imageModal" onclick="showImageModal('{{ asset('storage/' . $banner->image_path_zh) }}')">
                                    </div>
                                </div>
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
    <!-- Modal -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageModalLabel">ดูรูปภาพ</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img id="modalImage" src="" class="img-fluid" alt="Expanded Image">
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

<script>
    function showImageModal(imageSrc) {
        document.getElementById('modalImage').src = imageSrc;
    }
</script>
@stop