@props(['promotions'=>[]])

@extends('layouts.public')
@section('title', 'Catalogo')

@section('header')
    <div id="round_rectangle" class="row">
        <input style="width: calc(100% - 125px)" placeholder="Festa della mamma">
        <img style="margin: 0 14px;cursor: pointer" width="16px" src="{{asset('images/delete.svg')}}" alt="">
        <img style="cursor: pointer" width="26px" src="{{asset('images/search.svg')}}" alt="">
    </div>
    <select name="Promozione" style="margin-top: 30px">
        <option value="simple">Promozioni semplici</option>
        <option value="coupled">Promozioni abbinate</option>
    </select>
@endsection

@section('subHeader')

@endsection


@section('content')
    {{-- Catalogo --}}
    <div class="padding" style="margin-top: 80px">
        @include('partials.section_title',['title'=>'Catalogo'])

        <div class="grid_responsive" style="padding-top: 50px; row-gap: 20px;
         grid-template-columns: repeat(auto-fill, minmax(240px, 1fr))">

            @foreach ($promotions as $promotion)
                @include('partials.coupon',
                [
                    'title'=>$promotion->product->name,
                    'expiration'=>$promotion->ends_on,
                    'image'=>$promotion->product->image_path,
                    'discount_perc'=>$promotion->percentage_discount,
                    'discount_tot'=>$promotion->flat_discount,
                ])
            @endforeach
        </div>
    </div>
@endsection
