@extends('layouts.public')
@section('title', 'Who')

@section('header')

@endsection

@section('subHeader')

@endsection

@section('content')
    {{--Chi siamo--}}
    <link rel="stylesheet" href="{{asset('css/partials/who.css')}}">
    <div class="padding" style="margin-top: 80px;">
        @include('partials.section_title',['title'=>'Chi siamo'])
        <div class="content">
            <h1 style="margin-bottom: 40px"><strong>Coupon.io</strong></h1>
            <p>Lorem ipsum dolor sit amen lorem ispus dolor, Lorem ipsum dolor sit amen lorem ispus dolor,Lorem ipsum
                dolor sit amen lorem ispus dolor</p>
        </div>
    </div>
@endsection
