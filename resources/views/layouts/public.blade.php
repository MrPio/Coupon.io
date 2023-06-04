@php
    $url = $_SERVER['REQUEST_URI'];
@endphp
@extends('layouts.bare_scaffold')

@section('body')

    {{-- Top yellow block --}}
    <div id="top_block" style="z-index: 1">
        <div class="padding" style="margin-bottom: 40px">
            <div id="row">

                {{-- Logo --}}
                <div id="logo">
                    <img src="{{asset('images/cart.svg')}}" alt="">
                    <a href="{{ route('home') }}">Cupon.io</a>
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
@endsection
