@props([
    'companies'=>[],
    'categories'=>[]
])

<?php

use Collective\Html\FormFacade as Form;
use Collective\Html\HtmlFacade as Html;

?>
<link rel="stylesheet" href="{{asset('css/partials/add_promotion.css')}}">

<div class="add_edit_navbar--container">
    <div class="tab">
        {{--        @can('isStaff')--}}
        <button class="tablinks" onclick="openTab(event, 'aggiungi')" id="defaultOpen"><h2>Aggiungi</h2></button>
        {{--        @endcan--}}
    </div>

    <div id="add_promotion" class="add_promotion--tabcontent">

        <div class="add_promotion--form_container">
            {!! Form::open(['route'=>'add.promotion'])!!}
            <div class="add_promotion--form">
                {!! Form::label('sconto', 'Sconto:', ['class'=>'add_promotion--label']) !!}
                {!! Form::text('sconto', '10%', ['class' => 'add_promotion--input']) !!}
            </div>
            <div class="add_promotion--form">
                {!! Form::label('azienda', 'Azienda:', ['class'=>'add_promotion--label']) !!}
                {!! Form::select('azienda', ['companies'=> $companies], null, ['class' => 'add_promotion--select']) !!}
            </div>
            <div class="add_promotion--form">
                {!! Form::label('azienda', 'Categoria:', ['class'=>'add_promotion--label']) !!}
                {!! Form::select('azienda', ['categories'=>$categories], null, ['class' => 'add_promotion--select']) !!}
            </div>
            <div class="add_promotion--form">
                {!! Form::label('nome_offerta', 'Nome offerta:', ['class'=>'add_promotion--label']) !!}
                {!! Form::text('nome_offerta', 'Nome offerta', ['class' => 'add_promotion--input']) !!}
            </div>
            <div class="add_promotion--form">
                {!! Form::label('data_emissione', 'Data emissione:', ['class'=>'add_promotion--label']) !!}
                {!! Form::date('data_emissione', null, ['class' => 'add_promotion--input']) !!}
            </div>
            <div class="add_promotion--form">
                {!! Form::label('data_scadenza', 'Data scadenza:', ['class'=>'add_promotion--label']) !!}
                {!! Form::date('data_scadenza', null, ['class' => 'add_promotion--input']) !!}
            </div>
            <div class="add_promotion--form">
                {!! Form::label('numero_coupon', 'Numero coupon:', ['class'=>'add_promotion--label']) !!}
                {!! Form::number('numero_coupon', '0', ['class' => 'add_promotion--input', 'min'=>0]) !!}
            </div>
            <div class="add_promotion--form">
                {!! Form::label('descrizione', 'Descrizione:', ['class'=>'add_promotion--label']) !!}
                {!! Form::textarea('descrizione', 'Descrizione', ['class' => 'add_promotion--textarea']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
