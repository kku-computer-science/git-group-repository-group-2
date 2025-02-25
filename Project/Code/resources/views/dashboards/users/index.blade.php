@extends('dashboards.users.layouts.user-dash-layout')
@section('title','Dashboard')

@section('content')

<h3 style="padding-top: 10px;">{{ __('message.welcome_message') }}</h3>
<br>
<h4>{{ __('message.greeting', ['position' => Auth::user()->position_th, 'fname' => Auth::user()->fname_th, 'lname' => Auth::user()->lname_th]) }}</h4>

@endsection
