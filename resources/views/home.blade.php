@extends('layouts.public')
@section('title', 'Home')

@section('header')
    <h1>The Perfect<br>Coupons Just For You</h1>
    <h4>Discover the best offers from the best brandes.<br>All our offers are constantly up-to-date,</h4>
    <div id="row">
        <div id="button_white" class="ripple">Explore more</div>
        <div id="button_black" class="ripple">Who we are</div>
    </div>
@endsection

@section('subHeader')
    {{-- Purple block--}}
    <div id="block_purple" style="margin-top: -50px">
        @include('partials.section_title',['title'=>'Le nostre Aziende','imgFile'=>'line_white.svg', 'color'=>'#ffffff'])
    </div>
    {{-- Oblique purple separator --}}
    <img src="{{asset('images/wave001.svg')}}" alt="non disponibile"
         style="margin: -1px 0 0 -4px">
@endsection


@section('content')
    {{-- Categorie --}}
    <div class="padding" style="margin-top: 80px">
        @include('partials.section_title',['title'=>'Il nostro catalogo'])
    </div>

    {{-- Coupon in evidenza --}}
    <div class="padding" style="margin-top: 80px">
        @include('partials.section_title',['title'=>'Cupon in evidenza'])
    </div>

    {{-- Riguardo noi --}}
    <div class="padding" style="margin-top: 80px">
        @include('partials.section_title',['title'=>'Riguardo noi'])
        <div class="grid_layout " style="margin-top: 40px">
            @include('partials.about_us_element', ['image_file' => 'about_us_1.png', 'title' => 'Frequently Asked Questions','subtitle' => 'Lorem ipsum dolor sit amen lorem ispus dolor'])
            @include('partials.about_us_element', ['image_file' => 'about_us_2.png', 'title' => 'Frequently Asked Questions','subtitle' => 'Lorem ipsum dolor sit amen lorem ispus dolor'])
            @include('partials.about_us_element', ['image_file' => 'about_us_3.png', 'title' => 'Frequently Asked Questions','subtitle' => 'Lorem ipsum dolor sit amen lorem ispus dolor'])
        </div>
    </div>
@endsection
