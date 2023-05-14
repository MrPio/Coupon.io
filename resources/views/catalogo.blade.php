@extends('layouts.public')
@section('title', 'Catalogo')

@section('header')

@endsection

@section('subHeader')

@endsection


@section('content')
    {{-- Catalogo --}}
    <div class="padding" style="margin-top: 80px">
        @include('partials.section_title',['title'=>'Catalogo'])

        <div class="grid_responsive" style="padding-top: 50px; row-gap: 20px">
            @include('layouts.coupon')
            @include('layouts.coupon')
            @include('layouts.coupon')
            @include('layouts.coupon')
            @include('layouts.coupon')
            @include('layouts.coupon')
            @include('layouts.coupon')
            @include('layouts.coupon')

        </div>

    </div>
@endsection
