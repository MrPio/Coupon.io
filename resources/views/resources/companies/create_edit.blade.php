@extends('layouts.management')

@php
    $is_edit = isset($company);
@endphp

{{-- TODO: riguardare questa parte --}}
<link rel="stylesheet" href="{{asset('css/layouts/add_promotion.css')}}">

@section('title', 'Aggiungi azienda')

@section('content')
    @if($is_edit)
        <div class="promozione_add_edit--form">
            <label></label>
            <div id="product_image_container" class="promozione_add_edit--product_image_container"
                 style="background-color: {{ $company->color }}">
                <img id="product_image" src="{{asset('images/aziende/'.$company->logo)}}">
            </div>
        </div>
    @endif
    <div class="promozione_add_edit--form_container">
        @if($is_edit)
            {{ Form::model($company, ['id'=>'company_create_edit_form', 'route' => ['aziende.update', $company], 'method'=>'POST', 'files'=>true]) }}
            @method('PUT')
        @else
            {{ Form::open(['id'=>'company_create_edit_form', 'route'=>'aziende.store', 'files'=>true, 'method' => 'POST']) }}
            @method('POST')
        @endif
        {{ Form::token() }}
        <div class="promozione_add_edit--form">
            {{ Form::label('name', 'Nome:') }}
            {{ Form::text('name','',['placeholder' => 'Il nome dell\'azienda']) }}
        </div>
        <div class="promozione_add_edit--form">
            {{ Form::label('place', 'Luogo:') }}
            {{ Form::text('place','',['placeholder' => 'Il luogo dell\'azienda']) }}
        </div>
        <div class="promozione_add_edit--form">
            {{ Form::label('url', 'URL:') }}
            {{ Form::text('url','',['placeholder' => 'La home page dell\'azienda']) }}
        </div>
        <div class="promozione_add_edit--form">
            {{--            TODO: si potrebbe fare una select volendo --}}
            {{ Form::label('type', 'Tipologia:') }}
            {{ Form::text('type','',['placeholder' => 'La tipologia dell\'azienda']) }}
        </div>
        <div class="promozione_add_edit--form">
            {{ Form::label('featured', 'In evidenza:') }}
            {{ Form::checkbox('featured', 1, $is_edit ? $company->featured : 0) }}
        </div>
        <div class="promozione_add_edit--form">
            {{ Form::label('logo', 'Logo:') }}
            {{ Form::File('logo') }}
        </div>
        <div class="promozione_add_edit--form">
            {{ Form::label('color', 'Colore:') }}
            {{ Form::text('color','',['placeholder' => 'Il colore dell\'azienda']) }}
        </div>
        <div class="promozione_add_edit--form">
            {{ Form::label('description', 'Descrizione:') }}
            {{ Form::textarea('description','',['placeholder' => 'Una descrizione dell\'azienda']) }}
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
                        'id' => 'reset_button',
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
                        'id'=>'company_add_edit--delete_button',
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
    <script src="{{asset('js/forms/companies.create_edit.js')}}"></script>
    <script>
        function init() {
            @if($is_edit)
            CompaniesCreateEdit.load({!! json_encode($company) !!})
            @endif
        }

        $(() => {
            init();

            const form = $("#company_create_edit_form");
            $(":input").on('blur', (event) => {
                $('.error').removeClass('error');
                doElemValidation(event.target.name, 'company_create_edit_form',
                    'company_add_edit--errors');
                if (event.target.name === 'color')
                    $('#product_image_container').css('background-color',
                        $('[name=' + event.target.name + ']').val());
                if (event.target.name === 'logo')
                    $('#product_image').attr('src',
                        "{{asset('images/aziende/')}}" + '/' + $('[name=' + event.target.name + ']').val().split('\\').pop());
            });

            $('#color').on('input', function () {
                jQuery('.image-container').css('background-color', $(this).val());
            });

            $('#reset_button').on('click', function () {
                event.preventDefault();
                form[0].reset();
                init();
                jQuery('.image-container').css('background-color', $('#color').val());
                $('#company_add_edit--errors').find('.errors').html(' ');
                $('.error').removeClass('error');
                window.scrollTo({
                    top: 0, behavior: 'smooth'
                });
            });

            @if($is_edit)
            $('#company_add_edit--delete_button').on('click', (event) => {
                event.preventDefault();
                if (confirm('Sei sicuro di voler rimuovere l\'azienda {{ $company->name }}?')) {
                    sendDeleteAJAX({
                        url: "{{ route('aziende.destroy', $company->id) }}",
                        token: '{{ csrf_token() }}',
                        onSuccess: () => window.location.href = '{{ route('aziende.index') }}'
                    });
                }
            })
            @endif

            form.on('submit', (event) => {
                event.preventDefault();
                doFormValidation('company_create_edit_form', 'company_add_edit--errors',
                    {featured:$('[name="featured"]').prop('checked')==true?1:0});
            });
        });
    </script>
@endsection




