@props(['categorie'=>[]])

@extends('layouts.public')
@section('title', 'Categorie')

@section('header')

@endsection

@section('subHeader')

@endsection


@section('content')
    {{-- Catalogo --}}
    <div class="padding" style="margin-top: 80px;">
        @include('partials.section_title',['title'=>'Categorie'])

        <div class="grid_responsive" style="padding-top: 100px; row-gap: 100px">

            @foreach ($categories as $category)
                @include('partials.categoria',
[
    'title' => $category->title,
    'subtitle' => $category->subtitle,
    'image' => $category->image,
    'color' => $category->color,
])
            @endforeach
        </div>
    </div>
@endsection
