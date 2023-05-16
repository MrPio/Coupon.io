@props([
    'title'=>'',
    'expiration'=>'',
    'image'=>'',
    'discount_perc'=>null,
    'discount_tot'=>null,
])

<link rel="stylesheet" href="{{asset('css/partials/coupon.css')}}">
<div class="coupon--coupon hover_animation">
    <div class="sconto--coupon">
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
        <img src="{{asset('images/aziende/'.$image)}}" class="image--coupon" alt="">
    @endif

    <h3 class="not-selectable" style="margin: 10px 0 0 0; word-wrap: break-word; white-space: pre-wrap;">{!!$title!!}</h3>

    <strong class="scadenza--coupon">Scade il {{$expiration}}</strong>

    <button class="button_white button--coupon ripple">Vedi l'offerta</button>
</div>
