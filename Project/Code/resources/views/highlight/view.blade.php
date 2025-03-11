@extends('dashboards.users.layouts.user-dash-layout')

@section('content')
<div class="container">
    <h2>Highlight List</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Title</th>
                <th>Detail</th>
                <th>Thumbnail</th>
                <th>Tags</th>
                <th>Detail</th>
            </tr>
        </thead>
        <tbody>
            @foreach($highlights as $highlight)
            <tr>
                <td>{{ $highlight->title }}</td>
                <td>{{ $highlight->detail }}</td>
                <td>
                    @if (filter_var($highlight->thumbnail, FILTER_VALIDATE_URL))
                    <img src="{{ $highlight->thumbnail }}" width="100">
                    @else
                    <img src="{{ asset('storage/' . $highlight->thumbnail) }}" width="100">
                    @endif
                </td>

                <td>
                    @foreach($highlight->tags as $tag)
                    <span class="badge badge-info">{{ $tag->name }}</span>
                    @endforeach
                </td>
                <td>{{ $highlight->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection