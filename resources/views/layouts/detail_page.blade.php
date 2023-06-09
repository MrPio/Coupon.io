@props(['count'=>1,'title'=>'','subtitle'=>''])
@php
    $is_public=!Auth::check() || Gate::allows('isPublic');
@endphp
@extends($is_public?'layouts.public':'layouts.management',
$is_public?[]:[
    'title' => $title,
    'subtitle' => $subtitle,
])

<link rel="stylesheet" href="{{asset('css/layouts/detail_page.css')}}">

@section('content')
    <div class="{{$is_public?'padding':''}}">
        <div class="detail_page--header row">
            @yield('upper_row')
        </div>

        @yield('upper_container')

        @for($i=0;$i<$count;$i++)
            <div class="detail_page--container">
                <div id="detail_page--image">
                    @yield('image_'.$i)
                </div>
                <div id="detail_page--side_bar">
                    @yield('side_container_'.$i)
                </div>
            </div>
        @endfor

    </div>
@endsection