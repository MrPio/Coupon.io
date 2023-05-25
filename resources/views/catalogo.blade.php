@props(['promotions'=>[],
     'active_name'=>'',
     'companies'=>[],
     'active_company'=>-1,
     'active_type'=>'all',
     'active_category'=>-1
 ])

@extends('layouts.public')
@section('title', 'Catalogo')

@section('header')
    <div id="round_rectangle" class="row"
         style="display: grid; grid-template-columns: min-content auto 26px 48px;">
        <select id="coupon--type" name="promotion" value>
            <option value="all" @if($active_type=='all') selected @endif>Tutte</option>
            <option value="single" @if($active_type=='single') selected @endif>Promozioni semplici</option>
            <option value="coupled" @if($active_type=='coupled') selected @endif>Promozioni abbinate</option>
        </select>

        <input id="coupon--search" onkeyup="search(event.key)"
               placeholder="Nome prodotto"
               value="{{$active_name}}">
        <img style="margin: auto 0;cursor: pointer" width="18px" src="{{asset('images/delete.svg')}}" alt=""
             onclick="reset()">
        <img style="margin: auto 0;cursor: pointer" width="26px" src="{{asset('images/search.svg')}}" alt=""
             onclick="search()">
    </div>

    <div id="catalogo--aziende_filter">
        @foreach($companies as $company)
            @php $active=$active_company==$company->id @endphp
            @include('partials.small_card',
                [
                    'text' => $company->name . " (" . $company->promotions_count . ")",
                    'active' => $active,
                    'href' =>route('catalogo',[
                            'company_id'=>$active?null:$company->id,
                            'name'=>$active_name,
                            'type'=>$active_type,
                            'category_id'=>$active_category,
                        ]),
                ])
        @endforeach
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
                    'title'=>$promotion->is_coupled?'Promozione '.count($promotion->coupled).' x 1':$promotion->product->name,
                    'expiration'=>$promotion->ends_on,
                    'image'=>$promotion->is_coupled?$promotion->company->logo:$promotion->product->image_path,
                    'discount_perc'=>$promotion->is_coupled?$promotion->extra_percentage_discount:$promotion->percentage_discount,
                    'discount_tot'=>$promotion->flat_discount,
                    'is_coupled'=>$promotion->is_coupled,
                    'is_expired' => strtotime($promotion->ends_on) <time()
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
            let url = '{!! route('catalogo',[
                            'company_id'=>$active_company,
                            'name'=>'param_name',
                            'type'=>'param_type',
                            'category_id'=>$active_category,
                        ])!!}';
            console.error(':name')
            url = url.replace('param_name', search);
            url = url.replace('param_type', type);
            window.location=url;
        }
    }

    function reset() {
        window.location = "/catalogo";
    }

    window.onload = function () {
        const type_select = document.getElementById('coupon--type')
        type_select.addEventListener("change", function() {
            search()
        });
        const input = document.getElementById('coupon--search');
        const length = input.value.length;
        input.selectionStart = 0;
        input.selectionEnd = length;
        input.focus();
    }
</script>