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

@endsection

@section('script')
    @parent
    <script>
        // $(() => {
        //     jQuery(":input").on('blur', (event) => {
        //         $('.error').removeClass('error');
        //         doElemValidation(event.target.name, 'faq_create_edit_form',
        //             'faq_add_edit--errors');
        //     });
        // })

        $(() => {
            @if($is_edit)
            init();
            @endif

            const form = $("#promozione_create_edit_form");

            $(":input").on('blur', (event) => {
                $('.error').removeClass('error');
                doElemValidation(event.target.name, 'faq_create_edit_form',
                    'faq_add_edit--errors');
            });

            form.on('submit', (event) => {
                event.preventDefault();
                doFormValidation('faq_create_edit_form',
                    'faq_add_edit--errors')
            });

            form.on('reset', (event) => {
                @if($is_edit)
                event.preventDefault();
                init();
                @endif

                $('#faq_add_edit--errors').find('.errors').html(' ');
                $('.error').removeClass('error');
                window.scrollTo({
                    top: 0, behavior: 'smooth'
                });
            })

            @if($is_edit)
            $('#promozione_add_edit--delete_button').on('click', (event) => {
                event.preventDefault();
                if (confirm('Sei sicuro di voler rimuovere la FAQ {{$faq->id}}?')) {
                    sendDeleteAJAX({
                        url: "{{route('faqs.destroy',[$faq])}}",
                        token: '{{ csrf_token() }}',
                        onSuccess: () => window.location.href = '{{route('faqs.index')}}'
                    });
                }
            })
            @endif
        })
    </script>
@endsection
