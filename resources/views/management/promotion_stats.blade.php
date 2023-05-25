@extends('layouts.management')

<link rel="stylesheet" href="{{asset('css/partials/promotion_stats.css')}}">

@section('content')
    <div class="stats--graph--container">


        <div class="stats--graph--coupon">
            @include('partials.coupon',
               [
                   'promotion_id' => $promotion->id,
                   'title'=>$promotion->product->name,
                   'expiration'=>$promotion->ends_on,
                   'image'=>$promotion->product->image_path,
                   'discount_perc'=>$promotion->percentage_discount,
                   'discount_tot'=>$promotion->flat_discount,
               ])
        </div>

        <div class="stats--graph--coupon" style="width: 100%">
            @include('partials.graph')
        </div>
    </div>

@endsection
