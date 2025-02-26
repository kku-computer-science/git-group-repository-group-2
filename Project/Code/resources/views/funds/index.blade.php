@extends('dashboards.users.layouts.user-dash-layout')

<link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.2.3/css/fixedHeader.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.0/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.2.3/css/fixedHeader.bootstrap4.min.css">

@section('content')

<div class="container">
    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ __('message.success_message') }}</p>
    </div>
    @endif
    <div class="card" style="padding: 16px;">
        <div class="card-body">
            <h4 class="card-title">{{ __('message.research_grant') }}</h4>
            <a class="btn btn-primary btn-menu btn-icon-text btn-sm mb-3" href="{{ route('funds.create') }}">
                <i class="mdi mdi-plus btn-icon-prepend"></i> {{ __('message.add') }}</a>
            <div class="table-responsive">
                <table id="example1" class="table table-striped">
                    <thead>
                        <tr>
                            <th>{{ __('message.no') }}</th>
                            <th>{{ __('message.fund_name') }}</th>
                            <th>{{ __('message.fund_type') }}</th>
                            <th>{{ __('message.fund_level') }}</th>

                            <!-- <th>Create by</th> -->
                            <th>{{ __('message.action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($funds as $i=>$fund)
                        <tr>

                            <td>{{ $i+1 }}</td>
                            <td>{{ Str::limit($fund->fund_name,80) }}</td>
                            <td>
                                @if($fund->fund_type == 'ทุนภายนอก')
                                {{ __('message.external_fund') }}
                                @elseif($fund->fund_type == 'ทุนภายใน')
                                {{ __('message.internal_fund') }}
                                @else
                                {{ $fund->fund_type }}
                                @endif
                            </td>
                            <td>
                                @if($fund->fund_level == 'สูง')
                                {{ __('message.high') }}
                                @elseif($fund->fund_level == 'กลาง')
                                {{ __('messagef.medium') }}
                                @elseif($fund->fund_level == 'ต่ำ')
                                {{ __('message.low') }}
                                @else
                                {{ $fund->fund_level }}
                                @endif
                            </td>
                            <!-- <td>{{ $fund->user->fname_en }} {{ $fund->user->lname_en }}</td> -->

                            <td>
                                @csrf
                                <form action="{{ route('funds.destroy',$fund->id) }}" method="POST">
                                    <li class="list-inline-item">
                                        <a class="btn btn-outline-primary btn-sm" type="button" data-toggle="tooltip" data-placement="top" title="view" href="{{ route('funds.show',$fund->id) }}"><i class="mdi mdi-eye"></i></a>
                                    </li>
                                    @if(Auth::user()->can('update',$fund))
                                    <li class="list-inline-item">
                                        <a class="btn btn-outline-success btn-sm" type="button" data-toggle="tooltip" data-placement="top" title="Edit" href="{{ route('funds.edit',Crypt::encrypt($fund->id)) }}"><i class="mdi mdi-pencil"></i></a>
                                    </li>
                                    @endif

                                    @if(Auth::user()->can('delete',$fund))
                                    @csrf
                                    @method('DELETE')

                                    <li class="list-inline-item">
                                        <button class="btn btn-outline-danger btn-sm show_confirm" type="submit" data-toggle="tooltip" title="Delete" data-language="{{ app()->getLocale() }}">
                                            <i class="mdi mdi-delete"></i>
                                        </button>
                                    </li>



                                    @endcan
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="http://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js" defer></script>
<script src="https://cdn.datatables.net/1.12.0/js/dataTables.bootstrap4.min.js" defer></script>
<script src="https://cdn.datatables.net/fixedheader/3.2.3/js/dataTables.fixedHeader.min.js" defer></script>
<script>
    $(document).ready(function() {
        var table = $('#example1').DataTable({
            fixedHeader: true
        });
    });
</script>
<script type="text/javascript">
    $('.show_confirm').click(function(event) {
        var form = $(this).closest("form");
        var language = $(this).data("language");
        event.preventDefault();

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


@endsection