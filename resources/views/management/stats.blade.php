@extends('layouts.management')

@section('title', 'Statistiche')

@section('content')
    <div style="display: flex; justify-content: center; margin-top: 30px">
        @include('partials.stats_card')
    </div>


@endsection
