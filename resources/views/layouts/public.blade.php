@php
    $url = $_SERVER['REQUEST_URI'];
@endphp

        <!DOCTYPE html>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<link rel="icon" href="{{ asset('images/cart.svg') }}" type="image/x-icon">
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
                <div style="margin-top: 12px">
                    @guest
                        @include('partials.button',['text' => 'Accedi','icon' => 'user.svg', 'route'=>'login'])
                    @endguest
                    @auth('web')
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            @include('partials.button',['text' => 'Esci','icon' => 'user.svg', 'id'=>'logout_button','form_type' => 'submit'])
                        </form>
                    @endauth
                </div>
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
