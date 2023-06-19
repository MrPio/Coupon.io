@props([
    'promotion_id'=>null,
    'title'=>'',
    'expiration'=>'',
    'image'=>'',
    'discount_perc'=>null,
    'discount_tot'=>null,
    'is_coupled'=>false,
    'is_expired'=>false,
    'whole_click'=>true,
    'editable'=>false,
    'goto'=> Gate::allows('isAdmin')?'management.promotionStats':'promozioni.show'

])

<link rel="stylesheet" href="{{asset('css/partials/coupon.css')}}">
<div id="coupon--coupon_{{$promotion_id}}"
     class="coupon--coupon hover_animation @if($is_expired)coupon--coupon_expired @endif"
     @if(isset($expiration) && $expiration=='expired') style="background-image: url({{asset('images/cupon_expired.png')}});"@endif>
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

    @include('partials.button',[
        'id' => 'coupon--button_goto_'.$promotion_id,
        'text' => "Vedi l'offerta",
        'style' => 'position: absolute;
                    bottom: 3rem;
                    left: 0;
                    right: 0;
                    margin: auto;'])
    @if($editable)
        <div id="coupon--like_{{$promotion_id}}" class="coupon--like shadow ripple">
            <img src="{{asset('images/edit_white.svg')}}">
        </div>
    @endif
</div>

<script>
    $(() => {
        $('#coupon--{{$whole_click?'coupon_'.$promotion_id:'button_goto_'.$promotion_id}}')
            .click(() => window.open('{{route($goto,$promotion_id)}}', '_blank'))

        @if($editable)
        $('#coupon--like_{{$promotion_id}}')
            .on('click', (e) => {
                window.location = '{{route('promozioni.edit',$promotion_id)}}'
                e.stopPropagation()
            })
        @endif
    })
</script>
