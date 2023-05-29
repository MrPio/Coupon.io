@extends('layouts.management')

@php
    $is_edit = isset($company);
@endphp

{{-- TODO: riguardare questa parte --}}
<link rel="stylesheet" href="{{asset('css/layouts/add_promotion.css')}}">

@section('content')
    <div class="promozione_add_edit--form_container">
        @if($is_edit)
            {{ Form::model($company, ['route' => ['company.update', $company], 'method'=>'put']) }}
        @else
            {{ Form::open(['route'=>'company.store']) }}
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
            {{ Form::label('color', 'Colore di background:') }}
            {{ Form::text('color') }}
        </div>
        <div class="promozione_add_edit--form">
            {{ Form::label('description', 'Descrizione:') }}
            {{ Form::textarea('description') }}
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

