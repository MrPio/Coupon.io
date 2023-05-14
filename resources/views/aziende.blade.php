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
            @foreach($companies as $company)
                @include('partials.card',
    [
    'image' => $company->logo,
    'color' => $company->color
    ])
            @endforeach
        </div>

    </div>
@endsection
