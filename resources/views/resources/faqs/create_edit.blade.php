@props([
    'id'=>'',
    'question'=>'',
    'answer'=>''
])

@php
    use Collective\Html\FormFacade as Form;
    use Collective\Html\HtmlFacade as Html;
        $is_edit = isset($faq);
@endphp

@extends('layouts.management',
[
    'title'=>$is_edit?'Modifica la FAQ':'Aggiungi una FAQ',
    'subtitle'=>$is_edit?'Modifica i campi domanda e risposta.':'Compila i campi domanda e risposta.'
])

<link rel="stylesheet" href="{{asset('css/layouts/add_promotion.css')}}">

@section('content')
    <div class="promozione_add_edit--form_container">
        @if($is_edit)
            {{ Form::model($faq, ['id'=>'faq_create_edit_form', 'route' => ['faqs.update', $faq], 'method'=>'POST', 'files'=>true]) }}
            {{--            _METHOD QUI --}}
        @else
            {{ Form::open(['id'=>'faq_create_edit_form', 'route'=>'faqs.store', 'files'=>true]) }}
        @endif
        @if($is_edit)
            <input type="hidden" name="_method" value="PUT">
        @endif
            <div class="promozione_add_edit--form">
                {{ Form::label('question', 'Domanda:') }}
                {{ Form::textarea('question') }}
            </div>
            <div class="promozione_add_edit--form">
                {{ Form::label('answer', 'Risposta:') }}
                {{ Form::textarea('answer') }}
            </div>
            <div class="promozione_add_edit--form">
                <label></label>
                <div id="faq_add_edit--errors"></div>
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
    </div>

@endsection
