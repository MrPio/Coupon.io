@props(['promotion'])

@php
    $has_coupon=Auth::check() && \App\Models\Resources\Coupon::where('user_id', Auth::user()->id)->where('promotion_id', $promotion->id)->exists();
    $is_coupled=$promotion->is_coupled;
    $promotions=$is_coupled?$promotion->coupled:[$promotion];
    $title=$is_coupled?count($promotion->coupled).' X 1':$promotion->product->name;
    $urls=$is_coupled?$promotions->pluck('product')->pluck('url')->toArray():[$promotion->product->url];
    $is_expired=$promotion->is_expired();
    $prices=[];
    foreach ($promotions as $p){
        if($p->flat_discount)
           array_push($prices,$p->product->price- $p->flat_discount);
        else
           array_push($prices,round($p->product->price* (100-$p->percentage_discount) /100,2));
    }

    $is_public=Gate::allows('isPublic') || !Auth::check();
@endphp

@extends('layouts.detail_page',
$is_public?['count' => count($promotions)]:
['count' => count($promotions),
'title'=>'Dettagli della promozione '.$promotion->id,
'subtitle'=>'Promozione su '.$title])


@section('title', $title)


@section('upper_row')
    <a class="detail_page--catalogue"
       href="{{route("promozioni.index")}}">Catalogo</a>
    <p style="margin: 0 8px">/</p>
    <a class="detail_page--category"
       href="{{route("promozioni.index",['category_id'=>$promotion->category_id])}}">{{$promotion->category->title}}</a>
    <p style="margin: 0 8px">/</p>
    <strong>{{$title}} </strong>

    @can('isStaff')
        <div class="detail_page--edit_container">
            @include('partials.button',[
                'id'=>'detail_page--edit',
                'text' => 'Modifica',
                'big' => true,
                'icon' => 'edit_white.svg',
                'black' => true,
            ])
        </div>
    @endcan
@endsection

@section('upper_container')
    @if($is_expired)
        <p class="detail_page--title h_center">Promozione scaduta il {{$promotion->ends_on}}</p>
    @endif
    <div id="detail_page--company" class="hover_animation shadow"
         onclick="window.location='{{route('promozioni.index',['company_id'=>$promotion->company_id])}}'"
         style="border-color: {{$promotion->company->color}};
                      background-color: {{$promotion->company->color}};">
        <img src="{{asset('images/aziende/'.$promotion->company->logo)}}" style="">
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
            @if($promotion->amount>$promotion->acquired and !$is_expired and Gate::allows('isUser'))
                <div class="detail_page--buttons_container">
                    <form id="detail_page--form_take">
                        @csrf
                        @include('partials.button',['id'=>'detail_page--button_take',
                        'text' => $has_coupon?'Vai al Coupon':'Acquisisci Coupon',
                         'black' => true,
                         'style' => 'margin:0 auto; width:30%',
                         'big'=>true])
                    </form>
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
            <p class="detail_page--title @if($is_expired) detail_page--expired @endif">{{$promotions[$i]->product->name}}</p>
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
            @if(!$is_coupled and $promotions[$i]->amount>$promotions[$i]->acquired and !$is_expired and $is_public)
                <form id="detail_page--form_take">
                    @csrf
                    @include('partials.button',['id'=>'detail_page--button_take','text' => $has_coupon?'Vai al Coupon':'Acquisisci Coupon', 'black' => true,'style' => 'margin-right:20px','big'=>true])
                </form>
            @endif

            @include('partials.button',['id'=>'detail_page--button_goto'.$i,'text' => 'Vai al negozio','big'=>true])
        </div>
    @endsection
@endfor

@section('script')
    @parent
    <script>
        $(() => {
            let urls = {!!  json_encode($urls)!!};
            $('button[id^="detail_page--button_goto"]').each((i, el) => {
                $(el).click(() => window.open(urls[i], '_blank'));
            });

            const button_take = $('#detail_page--button_take');
            button_take.click((e) => {
                e.preventDefault();

                @guest
                    window.location = '{{route('login')}}'
                @else

                sendPostAJAX({
                    formId: 'detail_page--form_take',
                    url: "{{route('takeCoupon')}}",
                    data: {'promotion_id': '{{$promotion->id}}'},
                    onSuccess: (promotion) => {
                        const remained = (promotion['amount'] - promotion['acquired']);
                        $("[id$='--subtitle']").text('(' + remained + ' rimasti)');
                        if (remained <= 0)
                            button_take.style.visibility = "collapse"
                        button_take.text('Vai al Coupon');
                    },
                    onError: (e, code) => {
                        if (code === 400 && e.error === 'user already has that coupon'){
                            window.open("{{route('coupon',$promotion->id)}}", "_blank");
                        }
                    },
                })
                @endguest
            });

            @can('isStaff')
            $('#detail_page--edit').click(() => window.location = '{{route('promozioni.edit',$promotion->id)}}')
            @endcan
        })
    </script>
@endsection

