@props(['promotion'])

@php
    $has_coupon=Auth::check() && \App\Models\Resources\Coupon::where('user_id', Auth::user()->id)->where('promotion_id', $promotion->id)->exists();
@endphp

@extends('layouts.detail_page')
@section('title', $promotion->product->name)


@section('upper_row')
    <a class="detail_page--category"
       href="{{route("catalogo",['category_id'=>$promotion->category_id])}}">{{$promotion->category->title}}</a>
    <p style="margin: 0 8px">/</p>
    <strong>{{$promotion->product->name}} </strong>
@endsection

@section('upper_container')
    <div id="detail_page--company" class="hover_animation shadow"
         onclick="window.location='{{route('catalogo',['company_id'=>$promotion->company_id])}}'"
         style="border-color: {{$promotion->company->color}};
                      background-color: {{$promotion->company->color}};
                      background-image: url(../../images/aziende/{{$promotion->company->logo}})">
    </div>
@endsection

@section('image')
    <img src="{{$promotion->product->image_path}}">
@endsection

@section('side_container')
    <div id="row">
        <p class="detail_page--title">{{$promotion->product->name}}</p>
        <p id="detail_page--subtitle" class="detail_page--subtitle">({{$promotion->amount-$promotion->acquired}}
            rimasti)</p>
    </div>

    <p class="detail_page--description">{!! $promotion->product->description !!}</p>

    <img class="detail_page--line" src="{{asset('images/line_gray.svg')}}">

    <div id="detail_page--price_container">
        <div class="row">
            <p class="detail_page--old_price">€ {{ $promotion->product->price }}</p>
            @if($promotion->flat_discount)
                <p class="detail_page--discount">- € {{ $promotion->flat_discount }}</p>
            @elseif($promotion->percentage_discount)
                <p class="detail_page--discount">- {{ $promotion->percentage_discount }} %</p>
            @endisset
        </div>
        <p class="detail_page--new_price">
            @if($promotion->flat_discount)
                € {{ $promotion->product->price- $promotion->flat_discount}}
            @elseif($promotion->percentage_discount)
                € {{ round($promotion->product->price* (100-$promotion->percentage_discount) /100,2)}}
            @endif
        </p>
    </div>
    <div class="detail_page--buttons_container row">
        @auth
            @if($promotion->amount>$promotion->acquired and Auth::user()->user)
                @include('partials.button',['id'=>'detail_page--button_take','text' => $has_coupon?'Vai al Coupon':'Acquisisci Coupon', 'black' => true,'style' => 'margin-right:20px','big'=>true])
            @endif
        @endauth
        @include('partials.button',['id'=>'detail_page--button_goto','text' => 'Vai al negozio','big'=>true])
    </div>
@endsection

<script>
    window.onload = function () {
        const button_goto = document.getElementById('detail_page--button_goto');
        const button_take = document.getElementById('detail_page--button_take');
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
                    else{
                        window.location = '{{route('coupon',$promotion->id)}}'
                    }
                })
                .then(promotion => {
                    const remained = (promotion['amount'] - promotion['acquired']);
                    document.getElementById('detail_page--subtitle').textContent =
                        '(' + remained + ' rimasti)'
                    if (remained <= 0)
                        button_take.style.visibility = "collapse"
                    button_take.textContent = 'Vai al Coupon'
                    {{--                    window.location='{{route('coupon',$promotion->id)}}'--}}
                })
            @endguest
        });
    }
</script>