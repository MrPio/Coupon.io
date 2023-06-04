@extends('layouts.management',['title' => 'Revisiona le statistiche','subtitle' => 'Trovi di seguito le statistiche sui coupon acquisiti dagli utenti'])
@section('title', 'Statistiche')

@section('content')
    <div style="display: flex; justify-content: center; margin-top: 30px">
        @include('partials.stats_card')
    </div>


@endsection
