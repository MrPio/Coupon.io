@extends('layouts.public')

<link rel="stylesheet" href="{{asset('css/layouts/detail_page.css')}}">

@section('content')
    <div class="padding">
        <div class="detail_page--header row">
            @yield('upper_row')
        </div>

        @yield('upper_container')
        <div class="detail_page--container">
            <div id="detail_page--image">
                @yield('image')
            </div>
            <div id="detail_page--side_bar">
                @yield('side_container')
            </div>
        </div>
    </div>
@endsection