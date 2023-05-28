@props([
    'companies'=>[],
    'categories'=>[],
    'promotion'=>null,
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
@endphp

@extends('layouts.management',[
    'title' => $is_edit?'Modifica la promozione '.$promotion->id:'Crea una nuova promozione',
    'subtitle' => $is_edit?'Modifica la promozione cambiando i seguenti campi':'Compila i seguenti campi per registrare una nuova promozione',
])

<link rel="stylesheet" href="{{asset('css/layouts/add_promotion.css')}}">
@section('content')
    <div id="add_promotion" class="promozione_add_edit--tabcontent">
        <div class="promozione_add_edit--form">
            <label></label>
            <div class="promozione_add_edit--product_image_container">
                <img id="product_image" src="{{asset('images/no_photo.webp')}}">
            </div>
        </div>
        <div class="promozione_add_edit--form_container">
            {!! Form::open(['id'=>'promotion_create_edit_form',
'route' => $is_edit?['promozioni.update', $promotion->id]:'promozioni.store',
'method'=>'POST'])!!}
            @if($is_edit)
                <input type="hidden" name="_method" value="PUT">
            @endif
            <div class="promozione_add_edit--form">
                {!! Form::label('azienda', 'Azienda:') !!}
                {!! Form::select('company_id', $company_items, true) !!}
            </div>
            <div class="promozione_add_edit--form">
                {!! Form::label('sconto', 'Sconto:') !!}

                <div class="round_rectangle promozione_add_edit--row">
                    {!! Form::select('discount_type', ['flat'=>'Sconto in €','percentage'=>'Sconto in %'], true) !!}
                    {!! Form::text('discount', '', [  'placeholder'=>'Sconto della promozione',]) !!}
                </div>
            </div>
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
            <div class="promozione_add_edit--form">
                {!! Form::label('descrizione', 'Descrizione:') !!}
                {!! Form::textarea('product_description', '', ['placeholder'=>'Descrizione dettagliata del prodotto in offerta']) !!}
            </div>
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
        $(() => {
            @if($is_edit)
            PromotionsCreateEdit.load({!! json_encode($promotion) !!}, {!! json_encode($promotion->product) !!})
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
                doFormValidation('promotion_create_edit_form', 'promozione_add_edit--errors');
            });
            form.on('reset', (event) => {
                @if($is_edit)
                event.preventDefault();
                PromotionsCreateEdit.load({!! json_encode($promotion) !!}, {!! json_encode($promotion->product) !!})
                @endif

                $('#promozione_add_edit--errors').find('.errors').html(' ');
                $('.error').removeClass('error');
                window.scrollTo({
                    top: 0, behavior: 'smooth'
                });
                if (image_url.val() !== '')
                    $('#product_image').attr('src', image_url.val());
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
