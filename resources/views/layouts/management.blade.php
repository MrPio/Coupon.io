{{--@inject('gate', 'Illuminate\Support\Facades\Gate')--}}
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
        })
    </script>
    @endsection
