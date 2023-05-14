@extends('layouts.public')
@section('title', 'Aziende')

@section('header')

@endsection

@section('subHeader')

@endsection


@section('content')
    {{-- Catalogo --}}
    <div class="padding" style="margin-top: 80px">
        @include('partials.section_title',['title'=>'Aziende'])

        <div class="grid_responsive" style="padding-top: 60px; row-gap: 50px">
            @include('partials.card')
            @include('partials.card', ['image' => 'spotify.png','color' => '#190b10'])
            @include('partials.card', ['image' => 'conad.png','color' => '#ffffff'])
            @include('partials.card', ['image' => 'lidl.png','color' => '#fff100'])
            @include('partials.card', ['image' => 'unieuro.webp','color' => '#0d1d41'])
        </div>

    </div>
@endsection
