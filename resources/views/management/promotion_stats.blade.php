@extends('layouts.management')

@section('title', 'Grafico')

<link rel="stylesheet" href="{{asset('css/partials/stats.css')}}">

@section('content')
    <div class="stats--graph--container">


        <div class="stats--graph--coupon">
            @include('partials.coupon',
                            [
                            'promotion_id' => $promotion->id,
                            'title'=>$promotion->is_coupled?'Promozione '.count($promotion->coupled).' x 1':$promotion->product->name,
                            'expiration'=>$promotion->ends_on,
                            'image'=>$promotion->is_coupled?$promotion->company->logo:$promotion->product->image_path,
                            'discount_perc'=>$promotion->is_coupled?$promotion->extra_percentage_discount:$promotion->percentage_discount,
                            'discount_tot'=>$promotion->flat_discount,
                            'is_coupled'=>$promotion->is_coupled,
                            'is_expired' => $promotion->is_expired(),
                        ])
        </div>

        <div class="stats--graph">
            @include('partials.graph')
        </div>
    </div>

@endsection
