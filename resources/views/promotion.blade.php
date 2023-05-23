@extends('layouts.detail_page',['count' => count($promotions)])
@props(['promotion'])

@php
    $has_coupon=Auth::check() && \App\Models\Resources\Coupon::where('user_id', Auth::user()->id)->where('promotion_id', $promotion->id)->exists();
    $is_coupled=$promotion->is_coupled;
    $promotions=$is_coupled?$promotion->coupled:[$promotion];
    $title=$is_coupled?count($promotion->coupled).' X 1':$promotion->product->name;
    $urls=$is_coupled?$promotions->pluck('product')->pluck('url')->toArray():[$promotion->product->url];
    $prices=[];
    foreach ($promotions as $p)
        if($p->flat_discount)
           array_push($prices,$p->product->price- $p->flat_discount);
        else
           array_push($prices,round($p->product->price* (100-$p->percentage_discount) /100,2));
@endphp

@section('title', $title)


@section('upper_row')
    <a class="detail_page--category"
       href="{{route("catalogo",['category_id'=>$promotion->category_id])}}">{{$promotion->category->title}}</a>
    <p style="margin: 0 8px">/</p>
    <strong>{{$title}} </strong>
@endsection

@section('upper_container')
    <div id="detail_page--company" class="hover_animation shadow"
         onclick="window.location='{{route('catalogo',['company_id'=>$promotion->company_id])}}'"
         style="border-color: {{$promotion->company->color}};
                      background-color: {{$promotion->company->color}};
                      background-image: url(../../images/aziende/{{$promotion->company->logo}})">
    </div>

{{--    Barra in alto contenente il riepilogo del costo. Da visualizzare solo se è una promozione abbinata--}}
    @if($is_coupled)
        <div class="detail_page--top_container">
            <div class="row h_center">
                <p class="detail_page--title">
                    Promozione abbinata: {{$title}}
                </p>
                <p id="detail_page--subtitle" class="detail_page--subtitle">
                    ({{$promotion->amount-$promotion->acquired}}
                    rimasti)</p>
            </div>
            <div class=" row" style="justify-content: center">
                <p class="detail_page--old_price">
                    @foreach($prices as $price)
                        € {{$price}} {{end($prices)==$price?'=':'+'}}
                    @endforeach
                    € {{array_sum($prices)}}
                </p>
                <p class="detail_page--discount">- % {{ $promotion->extra_percentage_discount }}</p>
            </div>
            <p class="detail_page--new_price" style="text-align: center">
                € {{round(array_sum($prices)* (100-$promotion->extra_percentage_discount) /100,2)}}
            </p>
            @if($promotion->amount>$promotion->acquired and Gate::allows('isUser'))
                <div class="detail_page--buttons_container">
                    @include('partials.button',['id'=>'detail_page--button_take',
                    'text' => $has_coupon?'Vai al Coupon':'Acquisisci Coupon',
                     'black' => true,
                     'style' => 'margin:0 auto; width:30%',
                     'big'=>true])
                </div>
            @endif
        </div>
            <img class="detail_page--line" src="{{asset('images/line_gray.svg')}}">

    @endif

@endsection

@for($i=0;$i<count($promotions);$i++)
    @section('image_'.$i)
        <img src="{{$promotions[$i]->product->image_path}}">
    @endsection

    @section('side_container_'.$i)
        <div id="row">
            <p class="detail_page--title">{{$promotions[$i]->product->name}}</p>
            @if(!$is_coupled)
                <p id="detail_page--subtitle" class="detail_page--subtitle">
                    ({{$promotion->amount-$promotion->acquired}}
                    rimasti)</p>
            @endif
        </div>

        <p class="detail_page--description">{!! $promotions[$i]->product->description !!}</p>

        <img class="detail_page--line" src="{{asset('images/line_gray.svg')}}">

        <div id="detail_page--price_container">
            <div class="row">
                <p class="detail_page--old_price">€ {{ $promotions[$i]->product->price }}</p>
                @if($promotions[$i]->flat_discount)
                    <p class="detail_page--discount">- € {{ $promotions[$i]->flat_discount }}</p>
                @elseif($promotions[$i]->percentage_discount)
                    <p class="detail_page--discount">- {{ $promotions[$i]->percentage_discount }} %</p>
                @endisset
            </div>
            <p class="detail_page--new_price">€ {{$prices[$i]}}</p>
        </div>
        <div class="detail_page--buttons_container row">
            @if(!$is_coupled and $promotions[$i]->amount>$promotions[$i]->acquired and Gate::allows('isUser'))
                @include('partials.button',['id'=>'detail_page--button_take','text' => $has_coupon?'Vai al Coupon':'Acquisisci Coupon', 'black' => true,'style' => 'margin-right:20px','big'=>true])
            @endif

            @include('partials.button',['id'=>'detail_page--button_goto'.$i,'text' => 'Vai al negozio','big'=>true])
        </div>
    @endsection
@endfor

<script src="{{asset('js/jquery.min.js')}}"></script>
<script>
    $(() => {
        let urls = {!!  json_encode($urls)!!};
        $('button[id^="detail_page--button_goto"]').each((i,el) => {
            $(el).click(()=> window.open(urls[i], '_blank'));
        });

        const button_take = document.getElementById('detail_page--button_take');
        button_take.addEventListener('click', () => {
            @guest
                window.location = '{{route('login')}}'
            @else
            fetch('{{route('takeCoupon',['promotion_id'=>$promotion->id])}}')
                .then(response => {
                    if (response.ok)
                        return response.json();
                    else
                        window.location = '{{route('coupon',$promotion->id)}}'
                })
                .then(promotion => {
                    const remained = (promotion['amount'] - promotion['acquired']);
                    document.getElementById('detail_page--subtitle').textContent =
                        '(' + remained + ' rimasti)'
                    if (remained <= 0)
                        button_take.style.visibility = "collapse"
                    button_take.textContent = 'Vai al Coupon'
                    {{--window.location = '{{route('coupon',$promotion->id)}}'--}}
                })
            @endguest
        });
    })
</script>
