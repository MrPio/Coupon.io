@props(['coupon'])
@extends('layouts.public')
@section('title', $coupon->promotion->product->name)

@section('header')
    {{--    <div class="row">--}}
    {{--        <h2>Promozione su: {{$promotion->product->name}}</h2>--}}
    {{--    </div>--}}
@endsection

<link rel="stylesheet" href="{{asset('css/layouts/coupon.css')}}">
@section('content')

    <div class="padding">
ciao
    </div>
@endsection