@extends('dashboards.users.layouts.user-dash-layout')

@section('content')
<style>
    td.detail {
        white-space: nowrap;
        /* ไม่ให้ข้อความไปต่อบรรทัดใหม่ */
        overflow: hidden;
        /* ซ่อนข้อความที่เกิน */
        text-overflow: ellipsis;
        /* แสดง "..." เมื่อข้อความเกิน */
        max-width: 200px;
        /* กำหนดขนาดสูงสุดของข้อความ */
    }

    /* กำหนดสไตล์สำหรับ additional images */
    .additional-img {
        margin-right: 5px;
    }
</style>

<div class="container">
    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif

    <div class="card" style="padding: 16px;">
        <div class="card-body">
            <h2>Highlight List</h2>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Detail</th>
                        <th>Thumbnail</th>
                        <th>Additional Images</th>
                        <th>Tags</th>
                        <th>Action</th>
                        <th>Favorite</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($highlights as $highlight)
                        <tr>
                            <td class="detail">{{ $highlight->title }}</td>
                            <td class="detail">{!! nl2br(e($highlight->detail)) !!}</td>
                            <td>
                                @if (filter_var($highlight->thumbnail, FILTER_VALIDATE_URL))
                                    <img src="{{ $highlight->thumbnail }}" width="100">
                                @else
                                    <img src="{{ asset('storage/' . $highlight->thumbnail) }}" width="100">
                                @endif
                            </td>
                            <td>
                                @if($highlight->images->count() > 0)
                                    @foreach($highlight->images->take(2) as $image)
                                        <img class="additional-img" src="{{ Storage::url($image->image_path) }}" width="50"
                                            alt="Additional Image">
                                    @endforeach
                                @else
                                    <span>N/A</span>
                                @endif
                            </td>
                            <td>
                                @foreach($highlight->tags->take(3) as $tag)
                                    <span class="badge badge-info">{{ $tag->name }}</span>
                                @endforeach
                            </td>
                            <td>
                                <form action="{{ route('highlights.destroy', $highlight->id) }}" method="POST">
                                    <a class="btn btn-outline-primary btn-sm"
                                        href="{{ route('highlights.show', $highlight->id) }}">
                                        <i class="mdi mdi-eye"></i>
                                    </a>
                                    <a class="btn btn-outline-success btn-sm"
                                        href="{{ route('highlights.edit', $highlight->id) }}">
                                        <i class="mdi mdi-pencil"></i>
                                    </a>
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-outline-danger btn-sm show_confirm" type="submit">
                                        <i class="mdi mdi-delete"></i>
                                    </button>
                                </form>
                            </td>
                            <td>
                                <button class="btn btn-outline-warning btn-sm favorite-btn" data-id="{{ $highlight->id }}">
                                    <i class="mdi {{ $highlight->is_favorite ? 'mdi-star' : 'mdi-star-outline' }}"></i>
                                </button>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script>
    $('.show_confirm').click(function(event) {
        var form = $(this).closest("form");
        event.preventDefault();
        swal({
                title: `Are you sure?`,
                text: "If you delete this, it will be gone forever.",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    swal("Deleted Successfully", {
                        icon: "success",
                    }).then(function() {
                        form.submit();
                    });
                }
            });
    });
</script>

<script>
    $(document).ready(function () {
        $('.favorite-btn').click(function () {
            var btn = $(this);
            var highlightId = btn.data('id');

            // ส่ง AJAX เพื่อบันทึกสถานะ Favorite
            $.ajax({
                url: '/highlights/favorite/' + highlightId,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function (response) {
                    if (response.favorited) {
                        btn.find('i').removeClass('mdi-star-outline').addClass('mdi-star');
                    } else {
                        btn.find('i').removeClass('mdi-star').addClass('mdi-star-outline');
                    }
                }
            });
        });
    });
</script>

@stop