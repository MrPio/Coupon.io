@props([
    'companies'=>[],
    'categories'=>[],
    'promotion'=>null,
    'is_coupled'=>false,
    'promotions'=>[],
])

@php
    use Collective\Html\FormFacade as Form;
    use Collective\Html\HtmlFacade as Html;
    $is_edit=$promotion!=null;
    $company_items=[];
    $category_items=[];
    foreach ($companies as $company)
        $company_items[$company->id]=$company->name;
    foreach ($categories as $category)
        $category_items[$category->id]=$category->title;
    $promotions_with_null=[null]+$promotions;
@endphp

@extends('layouts.management',[
    'title' => $is_edit?('Modifica la promozione '.($is_coupled?'abbinata ':'').$promotion->id):'Crea una nuova promozione'.($is_coupled?' abbinata ':''),
    'subtitle' => $is_edit?'Modifica la promozione cambiando i seguenti campi':'Compila i seguenti campi per registrare una nuova promozione',
])

<link rel="stylesheet" href="{{asset('css/layouts/add_promotion.css')}}">
@section('content')
    <div id="add_promotion" class="promozione_add_edit--tabcontent">
        @if(!$is_coupled)
            <div class="promozione_add_edit--form">
                <label></label>
                <div class="promozione_add_edit--product_image_container">
                    <img id="product_image" src="{{asset('images/no_photo.webp')}}">
                </div>
            </div>
        @endif
        <div class="promozione_add_edit--form_container">
            {!! Form::open(['id'=>'promotion_create_edit_form',
'route' => $is_edit?['promozioni.update', $promotion->id]:'promozioni.store',
'method'=>'POST'])!!}
            @if($is_edit)
                <input type="hidden" name="_method" value="PUT">
            @endif

            @if($is_coupled)
                <div class="promozione_add_edit--form">
                    {!! Form::label('promozioni', 'Da abbinare:') !!}
                    <div class="round_rectangle promozione_add_edit--row4">
                        {!! Form::select('promotion_1', $promotions, false) !!}
                        {!! Form::select('promotion_2', $promotions, false) !!}
                        {!! Form::select('promotion_3', $promotions_with_null, null) !!}
                        {!! Form::select('promotion_4', $promotions_with_null, null) !!}
                    </div>
                </div>
            @endif

            <div class="promozione_add_edit--form">
                {!! Form::label('azienda', 'Azienda:') !!}
                {!! Form::select('company_id', $company_items, true) !!}
            </div>
            <div class="promozione_add_edit--form">
                {!! Form::label('sconto', $is_coupled?'Sconto extra:':'Sconto:') !!}


                @if(!$is_coupled)
                    <div class="round_rectangle promozione_add_edit--row">
                        {!! Form::select('discount_type', ['flat'=>'Sconto in €','percentage'=>'Sconto in %'], true) !!}
                        {!! Form::text('discount', '', [  'placeholder'=>'Sconto della promozione',]) !!}
                    </div>
                @else
                    {!! Form::text('extra_percentage_discount', '', [  'placeholder'=>'Sconto percentuale extra',]) !!}
                @endif
            </div>
            @if(!$is_coupled)
                <div class="promozione_add_edit--form">
                    {!! Form::label('nome_offerta', 'Nome prodotto:') !!}
                    {!! Form::text('product_name', '', ['placeholder'=>'Nome del prodotto sul quale applicare lo sconto']) !!}
                </div>
                <div class="promozione_add_edit--form">
                    {!! Form::label('', 'Costo originale:') !!}
                    {!! Form::text('product_price', '', ['placeholder'=>'Costo originale del prodotto in €']) !!}
                </div>
                <div class="promozione_add_edit--form">
                    {!! Form::label('', 'URL prodotto:') !!}
                    {!! Form::text('product_url', '', ['placeholder'=>'Il link URL della pagina del negozio del prodotto']) !!}
                </div>
                <div class="promozione_add_edit--form">
                    {!! Form::label('', 'URL immagine:') !!}
                    {!! Form::text('product_image_path', '', ['placeholder'=>'Il link URL dell\'immagine del prodotto']) !!}
                </div>
            @endif
            <div class="promozione_add_edit--form">
                {!! Form::label('categoria', 'Categoria:') !!}
                {!! Form::select('category_id', $category_items, true) !!}
            </div>
            <div class="promozione_add_edit--form">
                {!! Form::label('data_emissione', 'Data emissione:') !!}
                {!! Form::date('starting_from', date('Y-m-d',time())) !!}
            </div>
            <div class="promozione_add_edit--form">
                {!! Form::label('data_scadenza', 'Data scadenza:') !!}
                {!! Form::date('ends_on', date('Y-m-d',strtotime("+1 month", time()))) !!}
            </div>
            <div class="promozione_add_edit--form">
                {!! Form::label('numero_coupon', 'Numero coupons:') !!}
                {!! Form::number('amount', '100', ['min'=>1]) !!}
            </div>
            @if(!$is_coupled)
                <div class="promozione_add_edit--form">
                    {!! Form::label('descrizione', 'Descrizione:') !!}
                    {!! Form::textarea('product_description', '', ['placeholder'=>'Descrizione dettagliata del prodotto in offerta']) !!}
                </div>
            @endif
            <div class="promozione_add_edit--form">
                <label></label>
                <div id="promozione_add_edit--errors"></div>
            </div>
            <div class="promozione_add_edit--form">
                <label></label>
                <div class="promozione_add_edit--col">
                    <div class="promozione_add_edit--row">
                        @include('partials.button',[
                            'text' => 'Reimposta',
                            'big'=>true,
                            'form_type'=>'reset',
                            'style' => 'width:100%;'
                        ])
                        @include('partials.button',[
                            'text' => 'Conferma',
                            'black' =>true,
                            'form_type'=>'submit',
                            'big'=>true,
                            'style' => 'width:100%;'
                        ])
                    </div>
                    @if($is_edit)
                        @include('partials.button',[
                            'text' => 'Elimina',
                            'red' =>true,
                            'id'=>'promozione_add_edit--delete_button',
                            'big'=>true,
                            'style' => 'width:100%;'
                        ])
                    @endif
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection

@section('script')
    @parent
    <script src="{{asset('js/forms/promotions.create_edit.js')}}"></script>
    <script>
        function init() {
            @if($is_edit)
            @if($is_coupled)
            PromotionsCreateEdit.load({!! json_encode($promotion) !!}, null, {!! json_encode($promotion->coupled) !!})
            @else
            PromotionsCreateEdit.load({!! json_encode($promotion) !!}, {!! json_encode($promotion->product) !!})
            @endif
            @endif
        }

        $(() => {
            @if($is_edit)
            init();
            @endif

            const form = $("#promotion_create_edit_form");
            const image_url = $("[name='product_image_path']")

            $(":input").on('blur', (event) => {
                $('.error').removeClass('error');
                doElemValidation(event.target.name, 'promotion_create_edit_form',
                    'promozione_add_edit--errors');
                if (event.target.name === 'product_image_path' && image_url.val() !== '')
                    $('#product_image').attr('src', image_url.val());
            });

            form.on('submit', (event) => {
                event.preventDefault();
                doFormValidation('promotion_create_edit_form',
                    'promozione_add_edit--errors',
                    {is_coupled: {!! json_encode($is_coupled) !!}==false?0:1});
            });

            form.on('reset', (event) => {
                @if($is_edit)
                event.preventDefault();
                init();
                @endif

                $('#promozione_add_edit--errors').find('.errors').html(' ');
                $('.error').removeClass('error');
                window.scrollTo({
                    top: 0, behavior: 'smooth'
                });
                @if(!$is_coupled)
                if (image_url.val() !== '')
                    $('#product_image').attr('src', image_url.val());
                @endif
            })

            @if($is_edit)
            $('#promozione_add_edit--delete_button').on('click', (event) => {
                event.preventDefault();
                if (confirm('Sei sicuro di voler rimuovere la promozione {{$promotion->id }}?')) {
                    sendDeleteAJAX({
                        url: "{{route('promozioni.destroy',$promotion->id)}}",
                        token: '{{ csrf_token() }}',
                        onSuccess: () => window.location.href = '{{route('promozioni.index')}}'
                    });
                }
            })
            @endif
        })
    </script>
@endsection
