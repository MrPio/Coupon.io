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

        <div class="grid_responsive" style="padding-top: 100px; row-gap: 100px">
            @include('partials.card')
            @include('partials.card')
            @include('partials.card')
            @include('partials.card')
            @include('partials.card')
            @include('partials.card')
        </div>

    </div>
@endsection
