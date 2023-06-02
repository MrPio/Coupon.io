@props([
    'companies_count'=>0,
    'staffs_count'=>0,
    'users_count'=>0,
    'promotions_count'=>0,
    'faqs_count'=>0,
])

@extends('layouts/management')

@section('content')
    <div class="man-container grid_responsive ">
        @include('partials.man_card',[
            'image'=>'company.svg',
            'title'=>'Aziende',
            'subtitle'=>'Totale aziende: '.$companies_count,
            'center_text'=>'Gestisci le aziende affiliate',
            'route'=>route('management.companies'),
        ])
        @include('partials.man_card',[
            'image'=>'staff.svg',
            'title'=>'Staff',
            'subtitle'=>'Totale membri: '.$staffs_count,
            'center_text'=>'Gestisci il personale staff del sito',
            'route'=>route('management.staff'),
        ])
        @include('partials.man_card',[
            'image'=>'user_white.svg',
            'title'=>'Utenti',
            'subtitle'=>'Totale registrati: '.$users_count,
            'center_text'=>'Gestisci gli utenti iscritti',
            'route'=>route('management.users'),
        ])
        @include('partials.man_card',[
            'image'=>'faq.svg',
            'title'=>'FAQ',
            'subtitle'=>'Totale FAQs: '.$faqs_count,
            'center_text'=>'Gestisci le FAQs',
            'route'=>route('faqs.index'),
        ])
        @include('partials.man_card',[
            'image'=>'stats.svg',
            'title'=>'Statistiche',
            'subtitle'=>'Totale promozioni: '.$promotions_count,
            'center_text'=>'Revisiona le statistiche',
            'route'=>route('management.stats'),
        ])
    </div>
@endsection
