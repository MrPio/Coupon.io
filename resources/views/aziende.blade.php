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
    </div>
@endsection
