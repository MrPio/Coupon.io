@extends('layouts.management')

@php
    $is_edit = isset($company);
@endphp

{{-- TODO: riguardare questa parte --}}
<link rel="stylesheet" href="{{asset('css/layouts/add_promotion.css')}}">

@section('title', 'Aggiungi azienda')

@section('content')
    @if($is_edit)
    <div style="padding: 1em">
        <div class="image-container" style="background-color: {{ $company->color }}; width: var(--image-container-size); margin-left: auto; margin-right: auto">
            <img class="company-logo item-image-fixed-width" src="{{ asset('images/aziende/' . $company->logo) }}" alt="logo dell'azienda {{ $company->name }}">
        </div>
    </div>
    @endif
    <div class="promozione_add_edit--form_container">
        @if($is_edit)
            {{ Form::model($company, ['id'=>'company_create_edit_form', 'route' => ['company.update', $company], 'method'=>'POST', 'files'=>true]) }}
            @method('PUT')
        @else
            {{ Form::open(['id'=>'company_create_edit_form', 'route'=>'company.store', 'files'=>true, 'method' => 'POST']) }}
            @method('POST')
        @endif
        {{ Form::token() }}
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
            {{ Form::checkbox('featured', 1, $is_edit ? $company->featured : 0) }}
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
    <script>
        $(() => {
            const form = $("#company_create_edit_form");
            $(":input").on('blur', (event) => {
                $('.error').removeClass('error');
                doElemValidation(event.target.name, 'company_create_edit_form',
                    'company_add_edit--errors');
            });

            $('#color').on('input', function() {
                jQuery('.image-container').css('background-color', $(this).val());
            });

            $('#reset_button').on('click', function() {
                event.preventDefault();
                form[0].reset();
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
                        url: "{{ route('company.destroy', $company->id) }}",
                        token: '{{ csrf_token() }}',
                        onSuccess: () => window.location.href = '{{ route('management.companies') }}'
                    });
                }
            })
            @endif

            form.on('submit', (event) => {
                let form_data = new FormData(document.getElementById('company_create_edit_form'));
                // TODO: forse non ce n'è bisogno (della riga sotto)
                form_data.append('_token', '{{ csrf_token() }}' );

                event.preventDefault();
                $.ajax({
                    url: form.attr('action'),
                    type: 'POST',
                    data: form_data,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        if (response.status === 'company-added') {
                            document.getElementById('company_create_edit_form').reset();
                            Swal.fire({
                                title: 'Azienda aggiunta con successo!',
                                text: 'Per visualizzare l\'azienda visita il catalogo delle aziende',
                                icon: 'success',
                                confirmButtonText: 'OK'
                            })
                        }
                        if (response.status === 'company-modified'){
                            if (response.image !== null){
                                let image_path = "{{ asset('images/aziende/') }}" + "/" + response.image;
                                console.log(image_path);
                                jQuery('.company-logo').attr('src', image_path);
                            }

                            Swal.fire({
                                title: 'Azienda modificata con successo!',
                                text: 'Per visualizzare l\'azienda visita il catalogo delle aziende',
                                icon: 'success',
                                confirmButtonText: 'OK'
                            })
                        }
                    },
                    error: function (xhr, status, error) {
                        let errs = JSON.parse(xhr.responseText);
                        populateErrors(errs, xhr.status, 'company_add_edit--errors')
                    }
                });
            });

        });


    </script>
@endsection




