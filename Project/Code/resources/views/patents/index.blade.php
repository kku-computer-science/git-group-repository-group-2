
@extends('dashboards.users.layouts.user-dash-layout')

@section('title', 'Dashboard')

@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.2.3/css/fixedHeader.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.0/css/dataTables.bootstrap4.min.css">
    <style>
        .table-hover tbody tr:hover {
            background-color: #f8f9fa;
        }
    </style>
@endpush

@section('content')

<div class="container">
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <p>{{ $message }}</p>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <h4 class="card-title">{{ __('message.other_academic') }}</h4>

            <a class="btn btn-primary btn-sm mb-3" href="{{ route('patents.create') }}">
                <i class="mdi mdi-plus"></i> ADD
            </a>

            <div class="table-responsive">
                <table id="example1" class="table table-striped table-hover table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>{{ __('message.no') }}</th>
                            <th>{{ __('message.academic_name') }}</th>
                            <th>{{ __('message.academic_type') }}</th>
                            <th>{{ __('message.date_re') }}</th>
                            <th>{{ __('message.re_number') }}</th>
                            <th>{{ __('message.patent_author') }}</th>
                            <th width="200px">{{ __('message.action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($patents as $i => $paper)
                        <tr>
                            <td>{{ $i+1 }}</td>
                            <td>{{ Str::limit($paper->ac_name, 50) }}</td>
                            <td>{{ $paper->ac_type }}</td>
                            <td>{{ $paper->ac_year }}</td>
                            <td>{{ Str::limit($paper->ac_refnumber, 50) }}</td>
                            <td>
                                @foreach($paper->user as $a)
                                    {{ $a->fname_th }} {{ $a->lname_th }} @if (!$loop->last),@endif
                                @endforeach
                            </td>
                            <td class="text-center">
                                <a class="btn btn-outline-primary btn-sm" href="{{ route('patents.show', $paper->id) }}" title="View">
                                    <i class="mdi mdi-eye"></i>
                                </a>

                                @if(Auth::user()->can('update', $paper))
                                    <a class="btn btn-outline-success btn-sm" href="{{ route('patents.edit', $paper->id) }}" title="Edit">
                                        <i class="mdi mdi-pencil"></i>
                                    </a>
                                @endif

                                @if(Auth::user()->can('delete', $paper))
                                    <form action="{{ route('patents.destroy', $paper->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm show_confirm" title="Delete">
                                            <i class="mdi mdi-delete"></i>
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div> <!-- /.table-responsive -->
        </div> <!-- /.card-body -->
    </div> <!-- /.card -->

</div> <!-- /.container -->

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.min.js" defer></script>
    <script src="https://cdn.datatables.net/1.12.0/js/dataTables.bootstrap4.min.js" defer></script>
    <script src="https://cdn.datatables.net/fixedheader/3.2.3/js/dataTables.fixedHeader.min.js" defer></script>

    <script>
        $(document).ready(function() {
            $('#example1').DataTable({
                responsive: true,
                fixedHeader: true,
                autoWidth: false,
                pageLength: 10,
            });
        });

        $('.show_confirm').click(function(event) {
            event.preventDefault();
            var form = $(this).closest("form");
            swal({
                title: "Are you sure?",
                text: "If you delete this, it will be gone forever.",
                icon: "warning",
                buttons: buttonText, 
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    swal("Deleted Successfully", {
                        icon: "success",
                        buttons: buttonText[1]

                    }).then(function() {
                        form.submit();
                    });
                }
            });
        });
    </script>
@endpush

@stop
