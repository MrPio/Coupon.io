@php
    $is_edit = isset($staff);
@endphp
@extends('layouts.management',[
    'title' => $is_edit?('Modifica l\'account dello staff '.$staff->id):'Aggiungi un nuovo membro dello staff',
    'subtitle' => $is_edit?'Modifica l\'account dello staff cambiando i seguenti campi':'Compila i seguenti campi per registrare un nuovo membro dello staff',
])

<link rel="stylesheet" href="{{asset('css/layouts/add_promotion.css')}}">


@section('content')
    <div class="promozione_add_edit--form_container">
        <?php
        $is_privileged = $is_edit && $staff->privileged;
        $companies_container_class = $is_privileged ? "hidden-container" : "";
        ?>
        @if($is_edit)
            {{ Form::model($staff->account, ['id' => 'staff_create_edit_form', 'route' => ['staff.update', $staff->id], 'method'=>'POST']) }}
            @method('PUT')
        @else
            {{ Form::open(['id' => 'staff_create_edit_form', 'route'=>'staff.store', 'method'=>'POST']) }}
            @method('POST')
        @endif
        <div class="promozione_add_edit--form">
            {{ Form::label('name', 'Nome:') }}
            {{ Form::text('name') }}
        </div>
        <div class="promozione_add_edit--form">
            {{ Form::label('surname', 'Cognome:') }}
            {{ Form::text('surname') }}
        </div>
        <div class="promozione_add_edit--form">
            {{ Form::label('gender', 'Genere:') }}
            {{ Form::radio('gender', 'male') }} Mashio
            {{ Form::radio('gender', 'female') }} Femmina
            {{ Form::radio('gender', 'unknown', true) }} Non specificato
        </div>
        <div class="promozione_add_edit--form">
            {{ Form::label('birth', 'Data di nascita:') }}
            {{ Form::date('birth') }}
        </div>
        <div class="promozione_add_edit--form">
            {{ Form::label('email', 'E-mail:') }}
            {{ Form::email('email') }}
        </div>
        <div class="promozione_add_edit--form">
            {{ Form::label('phone', 'Telefono:') }}
            {{ Form::text('phone') }}
        </div>
        <div class="promozione_add_edit--form">
            {{ Form::label('privileged', 'Privilegiato:') }}
            {{ Form::checkbox('privileged', 1, $is_privileged) }}
        </div>
        <div class="promozione_add_edit--form">
            {{ Form::label('username', 'Username:') }}
            {{ Form::text('username') }}
        </div>
        <div class="promozione_add_edit--form">
            {{ Form::label('password', 'Password:') }}
            {{ Form::password('password') }}
        </div>
        <div id="companies-container" class="promozione_add_edit--form {{ $companies_container_class }}">
            {{ Form::label('companies[]', 'Aziende:') }}
            {{ Form::select('companies[]', $companies_name, null, ['multiple' => 'multiple', 'style' => 'border-radius: 1.5em']) }}
        </div>
        <div class="promozione_add_edit--form">
            <label></label>
            <div id="staff_add_edit--errors"></div>
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
                        'id'=>'staff_add_edit--delete_button',
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
                doElemValidation(event.target.name, 'staff_create_edit_form',
                    'staff_add_edit--errors');
            });

            $("#privileged").on("change", function () {
                $("#companies-container").toggleClass("hidden-container");
            });

            @if($is_edit)
            $('#staff_add_edit--delete_button').on('click', (event) => {
                event.preventDefault();
                if (confirm('Sei sicuro di voler rimuovere {{ $staff->account->username }} dallo staff?')) {
                    sendDeleteAJAX({
                        url: "{{ route('staff.destroy', $staff->id) }}",
                        token: '{{ csrf_token() }}',
                        onSuccess: () => window.location.href = '{{ route('management.staff') }}'
                    });
                }
            })
            @endif

            const form = $("#staff_create_edit_form");
            const htmlForm = document.getElementById("staff_create_edit_form");

            form.on("submit", (event) => {
                let data = {
                    privileged: $('[name="privileged"]').prop('checked') == true ? 1 : 0,
                }
                if ($("#password").val() !== "")
                    data['validate_password'] = 1

                event.preventDefault();
                doFormValidation('staff_create_edit_form', 'staff_add_edit--errors', data,
                    (response) => {
                        if (response.status === 'staff-added') {
                            htmlForm.reset();
                            Swal.fire({
                                title: 'Operazione andata a buon fine',
                                text: 'Staff aggiunto con successo',
                                icon: 'success',
                                confirmButtonText: 'OK'
                            })
                        }
                        if (response.status === 'staff-modified') {
                            Swal.fire({
                                title: 'Operazione andata a buon fine',
                                text: 'Staff modificato con successo',
                                icon: 'success',
                                confirmButtonText: 'OK'
                            })
                        }
                    });
            });
        });
    </script>
@endsection
