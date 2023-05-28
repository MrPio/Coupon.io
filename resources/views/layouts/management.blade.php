@php
    $account=Auth::user()
@endphp
@props([
    'title'=>'Bentornato, '.$account->name,
    'subtitle'=>'Questa è la tua dashboard da ' . (Gate::allows('isAdmin')?'amministratore':'membro dello staff'),
])

@extends('layouts.bare_scaffold')
@section('title','Home')

<link rel="stylesheet" type="text/css" href="{{ asset('css/misc/company.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/misc/account.css') }}">
@section('body')
    <div id="man-container">
        @can('isAdmin')
            @include('partials/sidebar_admin')
        @endcan

        @can('isStaff')
            @include('partials/sidebar_staff')
        @endcan

        <div id="man-content">
            <div class="man-header row">
                <div style="padding: 3.4em 0;">
                    <h2>{{$title}}</h2>
                    <p>{{$subtitle}}</p>
                </div>
                <div id="man-profile" class="man-profile">
                    <img class="man-profile_img" src="
                     @if($account->image_path != null)
                     {{asset('storage/'.$account->image_path)}}
                     @else
                     {{asset('images/account_default_img.png')}}
                     @endif">
                    <h4>{{$account->name}} {{$account->surname}}</h4>
                    <img class="man-profile_arrow" src="{{asset('images/arrow_down.svg')}}">
                </div>
            </div>
            <div class="man-bottom_header">
                @yield('header')
            </div>
            <div class="man-content_container">
                @yield('content')
            </div>
        </div>
    </div>


    <script>
        $(() => {
            let buttons = $('.menu-button');
            let secondary_lists = $('.sidebar-secondary-list');
            $('.man-main-item:nth-child(odd)').addClass('striped');

            for (let i = 0; i < buttons.length; i++) {
                buttons[i].addEventListener('click', function (event, index = i) {
                    let parent = event.target.parentNode.parentNode;
                    let list = parent.children[1];
                    for (let j = 0; j < buttons.length; j++)
                        if (j !== index) {
                            let el = buttons[j].parentNode.parentNode.children[1];
                            if (el != null)
                                el.style.display = "none";
                        }

                    if (list.style.display === "list-item")
                        list.style.display = "none";
                    else
                        list.style.display = "list-item";
                });
            }

            $('#man-profile').click(() => window.location = '{{route('account')}}')
            $('#sidebar_staff--home_button').click(() => window.location = '{{route('home')}}')
        })
    </script>
@endsection
