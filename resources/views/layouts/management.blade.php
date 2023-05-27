{{--@inject('gate', 'Illuminate\Support\Facades\Gate')--}}

@php
    $account=Auth::user()
@endphp

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
                    <h2>Bentornato, {{Auth::user()->name}}</h2>
                    <p>Questa è la tua dashboard
                        da {{Gate::allows('isAdmin')?'amministratore':'membro dello staff'}}</p>
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
            @yield('content')
        </div>
    </div>


    <script>
        $(() => {
            let buttons = $('.menu-button');
            let secondary_lists = $('.sidebar-secondary-list');
            $('.man-main-item:nth-child(odd)').addClass('striped');

            for (let i = 0; i < buttons.length; i++) {
                buttons[i].addEventListener('click', function (event, index = i) {
                    for (let j = 0; j < secondary_lists.length; j++) {
                        if (j !== index) {
                            secondary_lists[j].style.display = "none";
                        }
                    }
                    let parent = event.target.parentNode;
                    let list = parent.children[1];
                    if (list.style.display === "list-item") {
                        list.style.display = "none";
                    } else {
                        list.style.display = "list-item";
                    }
                });
            }

            $('#man-profile').click(()=>window.location='{{route('account')}}')
        })
    </script>
@endsection
