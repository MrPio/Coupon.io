@props(['coupon'])

@extends('layouts.bare_scaffold')
@section('title', $coupon->promotion->product->name)

<link rel="stylesheet" href="{{asset('css/layouts/coupon.css')}}">

@section('body')
    <div class="coupon_page--scaffold">

        @if($coupon->promotion->flat_discount)
            <p class="coupon_page--discount">Sconto di € {{ $coupon->promotion->flat_discount }}</p>
        @elseif($coupon->promotion->percentage_discount)
            <p class="coupon_page--discount">Sconto del {{ $coupon->promotion->percentage_discount }} %</p>
        @endisset
        <div class="coupon_page--section">
            <h1 class="coupon_page--title">{{$coupon->promotion->product->name}}</h1>
            <p class="coupon_page--subtitle">{{$coupon->promotion->product->description}}</p>
        </div>

        <div class="row coupon_page--bottom_container">
            <div>
                <p class="coupon_page--date">Possessore coupon:
                    <strong>{{$coupon->user->account->name}} {{$coupon->user->account->surname}}</strong></p>
                <p class="coupon_page--date">Data scadenza:
                    <strong>{{strftime('%e %B %Y', strtotime($coupon->end_on))}}</strong></p>
                <p class="coupon_page--date">Data acquisizione:
                    <strong>{{strftime('%e %B %Y', strtotime($coupon->created_at))}}</strong></p>
                <p class="coupon_page--date">Valore originale:
                    <strong>€ {{$coupon->promotion->product->price}}</strong></p>
                <p class="coupon_page--date">Azienda emettitrice:
                    <strong>{{$coupon->promotion->company->name}}</strong></p>
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

<script type="text/javascript" src="{{asset('js/qrcode.js')}}"></script>
<script>
    const rootStyles = getComputedStyle(document.documentElement);
    window.onload = () => {
        const qrcode = document.getElementById("coupon_page--qrcode")
        console.log(qrcode)
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
