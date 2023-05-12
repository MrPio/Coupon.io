@extends('layouts.public')
@section('title', 'Categorie')

@section('header')

@endsection

@section('subHeader')

@endsection


@section('content')
    {{-- Catalogo --}}
    <div class="padding" style="margin-top: 80px">
        @include('partials.section_title',['title'=>'Categorie'])
    </div>
@endsection
