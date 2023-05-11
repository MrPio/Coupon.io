@php
    $url = $_SERVER['REQUEST_URI'];
@endphp

        <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    <title>Coupon.io | @yield('title', 'Home')</title>
</head>

<body>
<div id="page">
    {{-- Top yellow block --}}
    <div id="top_block">
        <div class="padding" style="margin-bottom: 40px">
            <div id="row">

                {{-- Logo --}}
                <div id="logo">
                    <img src="{{asset('images/cart.svg')}}" alt="">
                    <a href="/">Cupon.io</a>
                </div>

                {{-- Navbar --}}
                @include('layouts.navbar')

                {{-- Accedi --}}
                @guest
                    <div style="margin-top: 8px">
                    @include('partials.button',['text' => 'Accedi','icon' => 'user.svg'])
                    </div>
                @endguest
            </div>
        </div>
        <div class="padding">
            @yield('header')
        </div>
    </div>

    @yield('subHeader')

    @yield('content')

    {{-- Footer --}}
    @include('layouts.footer')
</div>
</body>
</html>