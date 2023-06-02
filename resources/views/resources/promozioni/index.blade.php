@props(['promotions'=>[],
     'active_name'=>'',
     'companies'=>[],
     'active_company'=>-1,
     'active_type'=>'all',
     'active_category'=>-1,
 ])
@php
    $is_public=!Auth::check() || Gate::allows('isPublic');
@endphp
@extends($is_public?'layouts.public':'layouts.management',
$is_public?[]:['title'=>'Sfoglia il catalogo delle promozioni',
'subtitle'=>'Filtra per azienda, tipologia, nome e categoria.'])

@section('title', 'Catalogo')

@section('header')
    <div class="round_rectangle row"
         style="display: grid; grid-template-columns: min-content auto 26px 48px;">
        <select id="coupon--type" name="promotion" value>
            <option value="all" @if($active_type=='all') selected @endif>Tutte</option>
            <option value="single" @if($active_type=='single') selected @endif>Promozioni semplici</option>
            <option value="coupled" @if($active_type=='coupled') selected @endif>Promozioni abbinate</option>
        </select>

        <input id="coupon--search" onkeyup="search(event.key)"
               placeholder="Nome prodotto"
               value="{{$active_name}}">
        <img class="clickable" style="margin: auto 0;cursor: pointer" width="18px" src="{{asset('images/delete.svg')}}"
             alt=""
             onclick="reset()">
        <img class="clickable" style="margin: auto 0;cursor: pointer" width="26px" src="{{asset('images/search.svg')}}"
             alt=""
             onclick="search()">
    </div>

    <div id="catalogo--aziende_filter">
        @foreach($companies as $company)
            @php $active=$active_company==$company->id @endphp
            @include('partials.small_card',
                [
                    'text' => $company->name . " (" . $company->promotions_count . ")",
                    'active' => $active,
                    'href' =>route('promozioni.index',[
                            'company_id'=>$active?null:$company->id,
                            'name'=>$active_name,
                            'type'=>$active_type,
                            'category_id'=>$active_category,
                        ]),
                ])
        @endforeach
    </div>
@endsection

@section('content')
    {{-- Catalogo --}}
    <div class="{{$is_public?'padding':''}}" style="margin-top: {{$is_public?'80':'20'}}px">
        @if($is_public)
            @include('partials.section_title',['title'=>'Catalogo'])
        @endif

        @if($promotions->isEmpty())
            <h1 style="margin-top: 60px; opacity: 0.25; text-align: center">Nessun risultato.</h1>
        @endif

        <div class="grid_responsive" style="padding-top: 50px; row-gap: 20px;
         grid-template-columns: repeat(auto-fill, minmax(240px, 1fr))">
            @foreach ($promotions as $promotion)
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
                'editable' => !$is_public,
                ])
            @endforeach
        </div>

        {{ $promotions->render('pagination.paginator') }}
    </div>
@endsection

<script>
    function search(key) {
        if (key == null || key === 'Enter') {
            const search = document.getElementById('coupon--search').value;
            const type = document.getElementById('coupon--type').value;
            let url = '{!! route('promozioni.index',[
                        'company_id'=>$active_company,
                        'name'=>'param_name',
                        'type'=>'param_type',
                        'category_id'=>$active_category,
                    ])!!}';
            url = url.replace('param_name', search);
            url = url.replace('param_type', type);
            window.location = url;
        }
    }

    function reset() {
        window.location = "{{route('promozioni.index')}}";
    }

    window.onload = function () {
        const type_select = document.getElementById('coupon--type')
        type_select.addEventListener("change", function () {
            search()
        });
        const input = document.getElementById('coupon--search');
        const length = input.value.length;
        input.selectionStart = 0;
        input.selectionEnd = length;
        input.focus();
    }
</script>
