@props([
    'companies'=>[],
    'promotions'=>[],
    'categories'=>[],
])

@extends('layouts.public')
@section('title', 'Home')

<script>
    // Soluzione brillante di Millucci alternativa al passaggio di funzioni agli @_include
    window.onload = function () {
        document.getElementById('home--explore_more').addEventListener('click', () => {
            document.getElementById('home--promozioni_in_evidenza').scrollIntoView({behavior: 'smooth'});
        });
    }
</script>

@section('header')
    <h1>I Coupon<br>perfetti solo per te</h1>
    <h4>Scopri le migliori promozioni delle migliori aziende. Sfoglia il nostro catalogo<br>e crea il tuo account per poter riscattare i coupon delle promozioni che desideri e poter usufruire dello sconto.</h4>
    <div id="row" style="margin-top: 30px">
        @include('partials.button',['id'=>'home--explore_more','text' => 'Esplora','style'=>'margin-right: 20px;'])
        @include('partials.button',['text' => 'Altre info','black' => true, 'route'=>'faqs.index'])
    </div>
@endsection

@section('subHeader')
    {{-- Purple block--}}
    <div id="block_purple" style=" z-index: 0">
        @include('partials.section_title',['title'=>'Le nostre Aziende'])
    </div>

    {{--Carosello--}}
    @include('partials.carosello')

    {{-- Oblique purple separator --}}
{{--    <img src="{{asset('images/wave001.svg')}}" alt="non disponibile"--}}
{{--         style="margin: -1px 0 0 -4px">--}}
@endsection


@section('content')
    {{-- Coupon in evidenza --}}
    <div id="home--promozioni_in_evidenza" class="padding" style="margin-top: 20px">
        @include('partials.section_title',['title'=>'Promozioni in evidenza'])
    </div>
    @include('partials.slider_promotion',['promotions'=>$promotions])


    {{-- Categorie --}}
    <div id="home--categorie_in_evidenza" class="padding" style="margin-top: 80px">
        @include('partials.section_title',['title'=>'Il nostro catalogo'])
    </div>
    @include('partials.slider_categories')

    {{-- Riguardo noi --}}
    <div class="padding" style="margin-top: 80px; overflow: hidden">
        @include('partials.section_title',['title'=>'Riguardo noi'])
        <div class="grid_3_col " style="margin-top: 40px">
            @include('partials.about_us_element', ['image_file' => 'faq.png', 'title' => 'Domande frequenti','subtitle' => 'Qui puoi trovare le risposte alle tue domande!', 'route'=>'faqs.index'])
            @include('partials.about_us_element', ['image_file' => 'who.png', 'title' => 'Chi siamo','subtitle' => 'Coupon.io permette agli utenti di trovare il miglior prezzo online.', 'route'=>'who'])
            @include('partials.about_us_element', ['image_file' => 'where.png', 'title' => 'Dove siamo','subtitle' => 'Scopri dove ci troviamo e vienici a trovare!', 'route'=>'where'])
        </div>
    </div>
@endsection
