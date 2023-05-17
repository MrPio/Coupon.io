@props(['promotions'=>[], 'search_input'=>''])

<script>
    function search(key) {
        if (key == null || key === 'Enter') {
            const search = document.getElementById('coupon--search').value;
            window.location = "/catalogo/" + search;
        }
    }

    function reset() {
        window.location = "/catalogo";
    }

    window.onload = function () {
        const input = document.getElementById('coupon--search');
        const length = input.value.length;
        input.selectionStart = 0;
        input.selectionEnd = length;
        input.focus();
    }
</script>

@extends('layouts.public')
@section('title', 'Catalogo')

@section('header')
    <div id="round_rectangle" class="row"
    style="display: grid; grid-template-columns: min-content auto 26px 48px;">
        <select name="Promozione">
            <option value="simple">Promozioni semplici</option>
            <option value="coupled">Promozioni abbinate</option>
        </select>

        <input id="coupon--search" onkeyup="search(event.key)"
               placeholder="Nome prodotto"
               value="{{$search_input}}">
        <img style="margin: auto 0;cursor: pointer" width="18px" src="{{asset('images/delete.svg')}}" alt=""
             onclick="reset()">
        <img style="margin: auto 0;cursor: pointer" width="26px" src="{{asset('images/search.svg')}}" alt="" onclick="search()">
    </div>

@endsection

@section('subHeader')

@endsection


@section('content')
    {{-- Catalogo --}}
    <div class="padding" style="margin-top: 80px">
        @include('partials.section_title',['title'=>'Catalogo'])

        @if($promotions->isEmpty())
            <h1 style="margin-top: 60px; opacity: 0.25; text-align: center">Nessun risultato.</h1>
        @endif

        <div class="grid_responsive" style="padding-top: 50px; row-gap: 20px;
         grid-template-columns: repeat(auto-fill, minmax(240px, 1fr))">
            @foreach ($promotions as $promotion)
                @include('partials.coupon',
                [
                'promotion_id' => $promotion->id,
                    'title'=>$promotion->product->name,
                    'expiration'=>$promotion->ends_on,
                    'image'=>$promotion->product->image_path,
                    'discount_perc'=>$promotion->percentage_discount,
                    'discount_tot'=>$promotion->flat_discount,
                ])
            @endforeach
        </div>

        {{ $promotions->render('pagination.paginator') }}
    </div>
@endsection
