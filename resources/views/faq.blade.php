@extends('layouts.public')
@section('title', 'FAQ')

@section('header')

@endsection

@section('subHeader')

@endsection

@section('content')
    {{--Domande--}}
    <div class="padding" style="margin-top: 80px;">
        @include('partials.section_title',['title'=>'FAQ'])
        @include('partials.faq')
    </div>
@endsection
