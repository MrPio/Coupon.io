@extends('layouts.management')

@php
    $is_edit = isset($company);
@endphp

{{-- TODO: riguardare questa parte --}}
<link rel="stylesheet" href="{{asset('css/layouts/add_promotion.css')}}">

@section('content')
    <div class="promozione_add_edit--form_container">
        @if($is_edit)
            {{ Form::model($company, ['id'=>'company_create_edit_form', 'route' => ['company.update', $company], 'method'=>'POST', 'files'=>true]) }}
{{--            _METHOD QUI --}}
        @else
            {{ Form::open(['id'=>'company_create_edit_form', 'route'=>'company.store', 'files'=>true]) }}
        @endif
        @if($is_edit)
            <input type="hidden" name="_method" value="PUT">
        @endif
        <div class="promozione_add_edit--form">
            {{ Form::label('name', 'Nome:') }}
            {{ Form::text('name') }}
        </div>
        <div class="promozione_add_edit--form">
            {{ Form::label('place', 'Luogo:') }}
            {{ Form::text('place') }}
        </div>
        <div class="promozione_add_edit--form">
            {{ Form::label('url', 'URL:') }}
            {{ Form::text('url') }}
        </div>
        <div class="promozione_add_edit--form">
{{--            TODO: si potrebbe fare una select volendo --}}
            {{ Form::label('type', 'Tipologia:') }}
            {{ Form::text('type') }}
        </div>
        <div class="promozione_add_edit--form">
            {{ Form::label('featured', 'In evidenza:') }}
            {{ Form::checkbox('featured', 1, false) }}
        </div>
        <div class="promozione_add_edit--form">
            {{ Form::label('logo', 'Logo:') }}
            {{ Form::File('logo') }}
        </div>
        <div class="promozione_add_edit--form">
{{--            TODO: Ovviamente lo farò meglio --}}
            {{ Form::label('color', 'Colore di background:') }}
            {{ Form::text('color') }}
        </div>
        <div class="promozione_add_edit--form">
            {{ Form::label('description', 'Descrizione:') }}
            {{ Form::textarea('description') }}
        </div>
        <div class="promozione_add_edit--form">
            <label></label>
            <div id="company_add_edit--errors"></div>
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
        {{ Form::close() }}
    </div>
@endsection

@section('script')
    @parent
    <script>
        $(() => {
            jQuery(":input").on('blur', (event) => {
                $('.error').removeClass('error');
                doElemValidation(event.target.name, 'company_create_edit_form',
                    'company_add_edit--errors');
            });

            // const form = $("form");
            // form.on('submit', (event) => {
            //     event.preventDefault();
            //     doFormValidation('promotion_create_edit_form',
            //         'promozione_add_edit--errors', {'name': 'ciao'})
            // });
        });
    </script>

@endsection




