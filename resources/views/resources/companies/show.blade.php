@props(['company'])

@php
    $is_public=!Auth::check() || Gate::allows('isPublic');
@endphp

@extends('layouts.detail_page',
$is_public?[]:
['title'=>'Dettagli dell\'azienda '.$company->name,
'subtitle'=>'Visualizza di seguito tutte le sue informazioni'])

@section('title', $company->name)

@section('upper_row')
    <a class="detail_page--category"
       href="{{route("aziende.index")}}">Aziende</a>
    <p style="margin: 0 8px">/</p>
    <strong>{{$company->name}} </strong>

    @can('isAdmin')
        <div class="detail_page--edit_container">
            @include('partials.button',[
                'id'=>'detail_page--edit',
                'text' => 'Modifica',
                'big' => true,
                'icon' => 'edit_white.svg',
                'black' => true,
            ])
        </div>
    @endcan
@endsection

@section('image_0')
    <div id="detail_page--company"
         class="hover_animation"
         onclick="window.location='{{route('promozioni.index',['company_id'=>$company])}}'"
         style="min-width:400px; width: 100%;height: 400px;
                margin: 20px 8px;
                border-color: {{$company->color}};
                background-color: {{$company->color}};
                {{--background-image: url(../../images/aziende/{{$company->logo}})"--}}">
        <img src="{{asset('images/aziende/'.$company->logo)}}">
    </div>
@endsection

@section('side_container_0')
    <div id="row">
        <p class="detail_page--title">{{$company->name}}</p>
        <p id="detail_page--subtitle" class="detail_page--subtitle">
            (aggiunta {{$company->created_at->diff(date('Y-m-d'))->days}}
            giorni fa)</p>
    </div>

    <div class="row">
        <strong class="detail_page--description">Indirizzo: </strong>
        <a href="https://www.google.it/maps/search/{{$company->place}}"
           class="detail_page--place">{{ $company->place }}</a>
    </div>

    <div class="row"
         style="margin-top: 10px">
        <strong class="detail_page--description">Ultima modifica: </strong>
        <p class="detail_page--place">{{ $company->updated_at->diff(date('Y-m-d'))->days }} giorni fa</p>
    </div>

    <div class="row"
         style="margin-top: 10px">
        <strong class="detail_page--description">Ragione sociale: </strong>
        <p class="detail_page--place">{{ $company->type}}</p>
    </div>

    <p class="detail_page--description">{!! $company->description !!}</p>

    <img class="detail_page--line" src="{{asset('images/line_gray.svg')}}">

    <div class="detail_page--buttons_container row">
        @include('partials.button',[
            'id'=>'detail_page--button_goto_catalog',
            'text' => 'Vai al catalogo',
            'big'=>true,
            'black' => true,
            'style' => 'margin-right:20px'
        ])
        @include('partials.button',[
            'id'=>'detail_page--button_goto_url',
            'text' => 'Vai al sito',
            'big'=>true,
        ])
    </div>
@endsection

@section('script')
    @parent
    <script>
        $(() => {
            const button_goto_url = document.getElementById('detail_page--button_goto_url');
            const button_goto_catalog = document.getElementById('detail_page--button_goto_catalog');
            button_goto_url.addEventListener('click', () => {
                window.open('{{$company->url}}', '_blank');
            });
            button_goto_catalog.addEventListener('click', () => {
                window.location = '{{route('promozioni.index',['company_id'=>$company])}}'
            });

            @can('isAdmin')
            $('#detail_page--edit').click(() => window.location = '{{route('aziende.edit',$company->id)}}')
            @endcan
        })
    </script>
@endsection
