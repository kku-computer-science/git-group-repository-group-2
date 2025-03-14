
@extends('dashboards.users.layouts.user-dash-layout')
<link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.2.3/css/fixedHeader.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.0/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.2.3/css/fixedHeader.bootstrap4.min.css">
@section('title','Dashboard')
@section('content')
<div class="container">
    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif
    <div class="card" style="padding: 16px;">
        <div class="card-body">
            <h4 class="card-title">{{ __('message.published_research')}}</h4>
            <a class="btn btn-primary btn-menu btn-icon-text btn-sm mb-3" href="{{ route('papers.create') }}"><i class="mdi mdi-plus btn-icon-prepend"></i>{{ __('message.add')}}</a>
            @if(Auth::user()->hasRole('teacher'))
            <!-- <a class="btn btn-primary btn-menu btn-icon-text btn-sm mb-3" href="{{ route('callscopus',Auth::user()->id) }}"><i class="mdi mdi-refresh btn-icon-prepend"></i> Call Paper</a> -->
            <a class="btn btn-primary btn-icon-text btn-sm mb-3" href="{{ route('callscopus',Crypt::encrypt(Auth::user()->id)) }}"><i class="mdi mdi-refresh btn-icon-prepend icon-sm"></i>{{ __('message.call_paper')}}</a>
            @endif
            <!-- <div class="table-responsive"> -->
            <table id="example1" class="table table-striped">
                <thead>
                    <tr>
                        <th>{{ __('message.no')}}</th>
                        <th>{{ __('message.paper_name')}}</th>
                        <th>{{ __('message.paper_type')}}</th>
                        <th>{{ __('message.year_submit')}}</th>
                        <!-- <th>ผู้เขียน</th>   -->
                        <!-- <th>Source Title</th> -->
                        <th width="280px">{{ __('message.action')}}</th>
                    </tr>
                    <thead>
                    <tbody>
                        @foreach ($papers->sortByDesc('paper_yearpub') as $i=>$paper)
                        <tr>
                            <td>{{ $i+1 }}</td>
                            <td>{{ Str::limit($paper->paper_name,50) }}</td>
                            <td>
                                @if(app()->getLocale() == 'th')
                                {{ Str::limit($paper->paper_type, 50) }}
                                @elseif(app()->getLocale() == 'en')
                                {{ Str::limit($paper->paper_type, 50) }}
                                @elseif(app()->getLocale() == 'zh')
                                {{ Str::limit($paper->paper_type, 50) }}
                                @else
                                {{ Str::limit($paper->paper_type, 50) }} <!-- ค่าเริ่มต้น -->
                                @endif
                            </td>

                            <td>{{ $paper->paper_yearpub }}</td>
                            <!-- <td>@foreach($paper->teacher->take(1) as $teacher)
                                    {{ $teacher->fname_en }} {{ $teacher->lname_en }},
                                    @endforeach
                                    @foreach($paper->author->take(1) as $teacher)
                                    {{ $teacher->author_fname }} {{ $teacher->author_lname }}
                                    @if (!$loop->last),@endif

                                    @endforeach

                                </td> -->
                            <!-- <td>{{ Str::limit($paper->paper_sourcetitle,50) }}</td> -->

                            <td>
                                <form action="{{ route('papers.destroy',$paper->id) }}" method="POST">

                                    <li class="list-inline-item">
                                        <a class="btn btn-outline-primary btn-sm" type="button" data-toggle="tooltip" data-placement="top" title="view" href="{{ route('papers.show',$paper->id) }}"><i class="mdi mdi-eye"></i></a>
                                    </li>
                                    @if(Auth::user()->can('update',$paper))
                                    <li class="list-inline-item">
                                        <a class="btn btn-outline-success btn-sm" type="button" data-toggle="tooltip" data-placement="top" title="Edit" href="{{ route('papers.edit',Crypt::encrypt($paper->id)) }}"><i class="mdi mdi-pencil"></i></a>
                                    </li>
                                    @endif
                                    <!-- @csrf
                                        @method('DELETE')
                                        <li class="list-inline-item">
                                         <button class="btn btn-outline-danger btn-sm show_confirm" type="submit"
                                                data-toggle="tooltip" data-placement="top" title="Delete"><i
                                                 class="mdi mdi-delete"></i></button>
                                        </li> -->
                                    <!-- <button type="submit" class="btn btn-danger">Delete</button> -->
                                </form>
                            </td>
                        </tr>
                        @endforeach
                <tbody>
            </table>
            <br>

            <!-- </div> -->
            <br>

        </div>
    </div>

</div>
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="http://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js" defer></script>
<script src="https://cdn.datatables.net/1.12.0/js/dataTables.bootstrap4.min.js" defer></script>
<script src="https://cdn.datatables.net/fixedheader/3.2.3/js/dataTables.fixedHeader.min.js" defer></script>
<script>
    $(document).ready(function() {
        var table1 = $('#example1').DataTable({
            responsive: true,
        });
    });
</script>
<script type="text/javascript">
    $('.show_confirm').click(function(event) {
        var form = $(this).closest("form");
        var name = $(this).data("name");
        event.preventDefault();

        var language = 'th';

        var title, text, successMessage, buttonText;
        if (language === 'th') {
            title = 'คุณแน่ใจหรือไม่?';
            text = 'หากคุณลบข้อมูลนี้ มันจะหายไปตลอดกาล.';
            successMessage = 'ลบสำเร็จ';
            buttonText = ['ยกเลิก', 'ลบ'];
        } else if (language === 'cn') {
            title = '你确定吗？';
            text = '如果删除此内容，将永远消失。';
            successMessage = '删除成功';
            buttonText = ['取消', '删除'];
        } else {
            title = 'Are you sure?';
            text = 'If you delete this, it will be gone forever.';
            successMessage = 'Delete Successfully';
            buttonText = ['Cancel', 'Delete'];

        }

        swal({
                title: title,
                text: text,
                icon: "warning",
                buttons: buttonText,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    swal(successMessage, {
                        icon: "success",
                        buttons: buttonText[1]

                    }).then(function() {
                        location.reload();
                        form.submit();
                    });
                }
            });
    });
</script>
@stop