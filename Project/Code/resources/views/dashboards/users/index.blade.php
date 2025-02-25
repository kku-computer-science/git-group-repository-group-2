@extends('dashboards.users.layouts.user-dash-layout')
@section('title','Dashboard')

@section('content')

<h3 style="padding-top: 10px;">{{ __('message.welcome_message') }}</h3>
<br>
<h4>
    {{ __('message.hello_user', [
        'position' => app()->getLocale() === 'th' ? Auth::user()->position_th : (Auth::user()->position_en ?? ''),
        'fname' => app()->getLocale() === 'th' ? Auth::user()->fname_th : Auth::user()->fname_en,
        'lname' => app()->getLocale() === 'th' ? Auth::user()->lname_th : Auth::user()->lname_en
    ]) }}
</h4>

@endsection
