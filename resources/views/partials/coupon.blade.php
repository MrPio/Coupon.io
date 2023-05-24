@props([
    'promotion_id'=>null,
    'title'=>'',
    'expiration'=>'',
    'image'=>'',
    'discount_perc'=>null,
    'discount_tot'=>null,
    'is_coupled'=>false,
    'is_expired'=>false,
])

<link rel="stylesheet" href="{{asset('css/partials/coupon.css')}}">
<div class="coupon--coupon hover_animation @if($is_expired)coupon--coupon_expired @endif"
     @if(isset($promotion_id) and !$is_expired) onclick="window.location='{{"/promozione/".$promotion_id}}'" @endif
     @if(isset($expiration) && $expiration=='expired') style="background-image: url(../../images/cupon_expired.png);"@endif>
    <div class="sconto--coupon @if($is_expired)coupon--coupon_title_expired @endif">
        @if($discount_perc !==null)
            <h1><b>{{$discount_perc}}%</b></h1>
        @endif
        @if($discount_perc !==null and $discount_tot !==null)
            <h1><b> + </b></h1>
        @endif
        @if($discount_tot !==null)
            <h1><b>€ {{$discount_tot}}</b></h1>
        @endif
        <h3>DI SCONTO</h3>
    </div>

    @if(str_contains($image,'http://') or str_contains($image,'https://'))
        <img src="{{$image}}" class="image--coupon" alt="">
    @else
        <div class="image--coupon">
            <img src="{{asset('images/aziende/'.$image)}}"
                 style="max-width: 100%; max-height: 110px;
                     position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    margin: auto"
                 alt="">
        </div>
    @endif

    <h3 class="not-selectable"
        style="margin: 10px 0 0 0; word-wrap: break-word; white-space: pre-wrap;">{!!$title!!}</h3>

    <strong class="scadenza--coupon">{{$is_expired?'Scaduta':'Scade'}} il {{$expiration}}</strong>

    @if(!$is_expired)
        @include('partials.button',['text' => "Vedi l'offerta",
    'style' => 'position: absolute;
                bottom: 3rem;
                left: 0;
                right: 0;
                margin: auto;'])
    @endif
</div>
