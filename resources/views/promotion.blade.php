@props(['promotion'])

@php
    $has_coupon=\App\Models\Resources\Coupon::where('user_id', Auth::user()->id)->where('promotion_id', $promotion->id)->exists();
@endphp

@extends('layouts.public')
@section('title', $promotion->product->name)

@section('header')
@endsection

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
             onclick="window.location='{{route('catalogo_filtered',['company_id'=>$promotion->company_id])}}'"
             style="border-color: {{$promotion->company->color}};
                      background-color: {{$promotion->company->color}};
                      background-image: url(../../images/aziende/{{$promotion->company->logo}})">
        </div>
        <div class="promotion--container">
            <div id="promotion--image">
                <img src="{{$promotion->product->image_path}}">
            </div>
            <div id="promotion--side_bar">
                <div id="row">
                    <p class="promotion--title">{{$promotion->product->name}}</p>
                    <p id="promotion--subtitle" class="promotion--subtitle">({{$promotion->amount-$promotion->acquired}}
                        rimasti)</p>
                </div>

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
                    <p class="promotion--new_price">
                        @if($promotion->flat_discount)
                            € {{ $promotion->product->price- $promotion->flat_discount}}
                        @elseif($promotion->percentage_discount)
                            € {{ round($promotion->product->price* (100-$promotion->percentage_discount) /100,2)}}
                        @endif
                    </p>
                </div>
                <div class="promotion--buttons_container row">
                    @if($promotion->amount>$promotion->acquired and Auth::user()->user)
                        @include('partials.button',['id'=>'promotion--button_take','text' => $has_coupon?'Vai al Coupon':'Acquisisci Coupon', 'type' => 'black','style' => 'margin-right:20px','big'=>true])
                    @endif
                    @include('partials.button',['id'=>'promotion--button_goto','text' => 'Vai al negozio','big'=>true])
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    window.onload = function () {
        const button_goto = document.getElementById('promotion--button_goto');
        const button_take = document.getElementById('promotion--button_take');
        button_goto.addEventListener('click', () => {
            window.open('{{$promotion->product->url}}', '_blank');
        });
        button_take.addEventListener('click', () => {
            @guest
                window.location = '{{route('login')}}'
            @else
            fetch('{{route('takeCoupon',['promotion_id'=>$promotion->id])}}')
                .then(response => {
                    if (response.ok)
                        return response.json();
                    else
                        window.location='{{route('coupon',$promotion->id)}}'
                })
                .then(promotion => {
                    const remained = (promotion['amount'] - promotion['acquired']);
                    document.getElementById('promotion--subtitle').textContent =
                        '(' + remained + ' rimasti)'
                    if (remained <= 0)
                        button_take.style.visibility = "collapse"
                    button_take.textContent='Vai al Coupon'
{{--                    window.location='{{route('coupon',$promotion->id)}}'--}}
                })
            @endguest
        });
    }
</script>