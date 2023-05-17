@props(['promotion'])
@extends('layouts.public')
@section('title', $promotion->product->name)

@section('header')
    {{--    <div class="row">--}}
    {{--        <h2>Promozione su: {{$promotion->product->name}}</h2>--}}
    {{--    </div>--}}
@endsection

<script>
    window.onload = function () {
        document.getElementById('promotion--button_goto').addEventListener('click', () => {
            window.open('{{$promotion->product->url}}', '_blank');
        });
        @guest
        document.getElementById('promotion--button_take').style.opacity = '0.4';
        @endguest
    }
</script>

<link rel="stylesheet" href="{{asset('css/layouts/promotion.css')}}">
@section('content')

    <div class="padding">

        <div class="promotion--header row">
            <a class="promotion--category"
               href="{{route("catalogo_with_category",$promotion->category_id)}}">{{$promotion->category->title}}</a>
            <p style="margin: 0 8px">/</p>
            <strong>{{$promotion->product->name}} </strong>
        </div>

        <div id="promotion--company" class="hover_animation shadow"
             onclick="window.location='{{route('catalogo_with_company',$promotion->company_id)}}'"
             style="border-color: {{$promotion->company->color}};
                      background-color: {{$promotion->company->color}};
                      background-image: url(../../images/aziende/{{$promotion->company->logo}})">
        </div>
        <div class="promotion--container">
            <div id="promotion--image">
                <img src="{{$promotion->product->image_path}}">
            </div>
            <div id="promotion--side_bar">
                <p class="promotion--title">{{$promotion->product->name}}</p>
                <p class="promotion--description">{!! $promotion->product->description !!}</p>

                <img class="promotion--line" src="{{asset('images/line_gray.svg')}}">

                <div id="promotion--price_container">
                    <div class="row">
                        <p class="promotion--old_price">€ {{ $promotion->product->price }}</p>
                        @if($promotion->flat_discount)
                            <p class="promotion--discount">- € {{ $promotion->flat_discount }}</p>
                        @elseif($promotion->percentage_discount)
                            <p class="promotion--discount">- {{ $promotion->percentage_discount }} %</p>
                        @endisset
                    </div>
                    <p class="promotion--new_price">€ {{ $promotion->product->price }}</p>
                </div>
                <div class="promotion--buttons_container row">
                    @include('partials.button',['id'=>'promotion--button_take','text' => 'Acquisisci Coupon', 'type' => 'black','style' => 'margin-right:20px; width:200px; height:52px'])
                    @include('partials.button',['id'=>'promotion--button_goto','text' => 'Vai al negozio','style' => ' width:200px; height:52px'])
                </div>
            </div>
        </div>
    </div>
@endsection
