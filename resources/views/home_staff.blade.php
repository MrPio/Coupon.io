@props([
    'companies_count'=>0,
    'promotions_count'=>0,
    'promotions_coupled_count'=>0,
])

@section('title', 'Staff')

@extends('layouts.management')

@section('content')
    <div class="man-container grid_responsive ">
        @include('partials.man_card',[
            'image'=>'company.svg',
            'title'=>'Aziende',
            'subtitle'=>Gate::allows('isPrivilegedStaff')?'Puoi modificarle tutte': 'Di tua competenza: '.$companies_count,
            'center_text'=>'Gestisci le aziende',
            'route'=>route('aziende.index'),
        ])
        @include('partials.man_card',[
            'image'=>'cart_white.svg',
            'title'=>'Promozioni',
            'subtitle'=>'Tue promozioni: '.$promotions_count,
            'center_text'=>'Gestisci le promozioni',
            'route'=>route('promozioni.index',['type'=>'single']),
        ])
        @if($staff->privileged)
            @include('partials.man_card',[
                'image'=>'chain.svg',
                'title'=>'Promozioni Abbinate',
                'subtitle'=>'Tue promozioni abbinate: '.$promotions_coupled_count,
                'center_text'=>'Gestisci le promozioni abbinate',
                'route'=>route('promozioni.index',['type'=>'coupled']),
            ])
        @endif
    </div>
@endsection
