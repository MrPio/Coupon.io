@props(['coupon'])

@php
    $promotion=$coupon->promotion;
    $is_coupled=$promotion->is_coupled;
    $promotions=$is_coupled?$promotion->coupled:[$promotion];
    $title=$is_coupled?'Promozione '.count($promotion->coupled).' X 1':$promotion->product->name;
    $prices=[];
    $original_prices=[];
    $is_expired=$promotion->is_expired();
    foreach ($promotions as $p){
     $original_prices[]=$p->product->price;
        if($p->flat_discount)
           $prices[]=$p->product->price- $p->flat_discount;
        else
           $prices[]=round($p->product->price* (100-$p->percentage_discount) /100,2);
    }
    $original_price= $is_coupled?array_sum($original_prices):$promotion->product->price;
    $final_price=$is_coupled?round(array_sum($prices)* (100-$promotion->extra_percentage_discount) /100,2):array_sum($prices);
@endphp

@extends('layouts.bare_scaffold')
@section('title', $title)

<link rel="stylesheet" href="{{asset('css/layouts/coupon.css')}}">

@section('body')
    <div class="coupon_page--scaffold">

        @if($is_expired)
            <p class="coupon_page--discount coupon_page--title_expired">Promozione scaduta il {{$promotion->ends_on}}</p>
        @endif
        @if($coupon->promotion->flat_discount)
            <p class="coupon_page--discount @if($is_expired)coupon_page--expired deleted @endif">Sconto di € {{ $coupon->promotion->flat_discount }}</p>
        @elseif($coupon->promotion->percentage_discount)
            <p class="coupon_page--discount @if($is_expired)coupon_page--expired deleted @endif">Sconto del {{ $coupon->promotion->percentage_discount }} %</p>
        @else
            <p class="coupon_page--discount @if($is_expired)coupon_page--expired deleted @endif">Sconto aggiuntivo del {{ $coupon->promotion->extra_percentage_discount }}
                %</p>
        @endif
        <div class="coupon_page--section @if($is_expired)coupon_page--expired @endif">
            <h1 class="coupon_page--title">{{$title}}</h1>
            @if(!$is_coupled)
                <p class="coupon_page--subtitle">{{$coupon->promotion->product->description}}</p>
            @else
                <p class="coupon_page--subtitle">Questa promozione racchiude i seguenti prodotti:</p>
                <ul class="coupon_page--subtitle_ul">
                    @foreach($promotion->coupled as $p)
                        <li class="coupon_page--subtitle_li">
                            <a href="{{route('promozioni.show',$p->id)}}">
                                {{$p->product->name}}
                            </a>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>

        <div class="row coupon_page--bottom_container @if($is_expired)coupon_page--expired @endif">
            <div>
                <p class="coupon_page--date">Possessore coupon:
                    <strong>{{$coupon->user->account->name}} {{$coupon->user->account->surname}}</strong></p>
                <p class="coupon_page--date">Data scadenza:
                    <strong>{{strftime('%e %B %Y', strtotime($coupon->end_on))}}</strong></p>
                <p class="coupon_page--date">Data acquisizione:
                    <strong>{{strftime('%e %B %Y', strtotime($coupon->created_at))}}</strong></p>
                <p class="coupon_page--date">Valore originale:
                    <strong>€ {{$original_price}}</strong></p>
                <p class="coupon_page--date">Valore finale:
                    <strong>€ {{$final_price}}</strong></p>
                <p class="coupon_page--date">Azienda emettitrice:
                    <strong>{{$promotion->company->name}}</strong></p>
            </div>
            <div>
                <div id="coupon_page--qrcode"></div>
                <p class="coupon_page--date" style="text-align: center"><strong>{{$coupon->uuid}}</strong></p>
            </div>
        </div>
        <div class="padding" style="margin-bottom: 40px">
            <p class="coupon_page--note">* Questa pagina costituisce un titolo valido solo prima della data di scadenza
                riportata sopra.</p>
            <p class="coupon_page--note">* L'offerta può essere usufruita presentando il codice QR presso una filiale
                dell'azienda, oppure online presso il portale dedicato della stessa.</p>
        </div>
    </div>
@endsection

<script type="text/javascript" src="{{asset('js/qrcode/qrcode.js')}}"></script>
<script>
    const rootStyles = getComputedStyle(document.documentElement);
    window.onload = () => {
        const qrcode = document.getElementById("coupon_page--qrcode")
        new QRCode(qrcode, {
            text: "{{$coupon->uuid}}",
            width: 220,
            height: 220,
            colorDark: rootStyles.getPropertyValue('--color3'),
            colorLight: rootStyles.getPropertyValue('--color4'),
            correctLevel: QRCode.CorrectLevel.H
        });
    }
</script>
