@props(['promotion'])
@extends('layouts.public')
@section('title', $promotion->product->name)

@section('header')
    <div class="row">
        <h2>Promozione su: {{$promotion->product->name}}</h2>
    </div>
@endsection

@section('subHeader')
@endsection


@section('content')

{{--    TODO--}}
@endsection
