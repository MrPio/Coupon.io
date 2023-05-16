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
    <h1>The Perfect<br>Coupons Just For You</h1>
    <h4>Discover the best offers from the best brandes.<br>All our offers are constantly up-to-date,</h4>
    <div id="row">
        @include('partials.button',['id'=>'home--explore_more','text' => 'Explore more','style'=>'margin-right: 20px;'])
        @include('partials.button',['text' => 'Who we are','type' => 'black', 'route'=>'who'])
    </div>
@endsection

@section('subHeader')
    {{-- Purple block--}}
    <div id="block_purple" style="margin-top: -50px">
        @include('partials.section_title',['title'=>'Le nostre Aziende','imgFile'=>'line_white.svg', 'color'=>'#ffffff'])
    </div>

    {{--Carosello--}}
    @include('partials.carosello')

    {{-- Oblique purple separator --}}
    <img src="{{asset('images/wave001.svg')}}" alt="non disponibile"
         style="margin: -1px 0 0 -4px">
@endsection


@section('content')
    {{-- Categorie --}}
    <div class="padding" style="margin-top: 80px">
        @include('partials.section_title',['title'=>'Il nostro catalogo'])
    </div>

    {{----}}
    @include('partials.slider_promotion')

    {{-- Coupon in evidenza --}}
    <div id="home--promozioni_in_evidenza" class="padding" style="margin-top: 80px">
        @include('partials.section_title',['title'=>'Promozioni in evidenza'])
    </div>

    <div id="home--categorie_in_evidenza" class="padding" style="margin-top: 80px">
        @include('partials.section_title',['title'=>'Le nostre Categorie'])
    </div>

    @include('partials.slider_categories')

    {{-- Riguardo noi --}}
    <div class="padding" style="margin-top: 80px">
        @include('partials.section_title',['title'=>'Riguardo noi'])
        <div class="grid_3_col " style="margin-top: 40px">
            @include('partials.about_us_element', ['image_file' => 'about_us_1.png', 'title' => 'Frequently Asked Questions','subtitle' => 'Lorem ipsum dolor sit amen lorem ispus dolor', 'route'=>null])
            @include('partials.about_us_element', ['image_file' => 'about_us_2.png', 'title' => 'Domande frequenti','subtitle' => 'Qui puoi trovare le risposte alle tue domande!', 'route'=>'faq'])
            @include('partials.about_us_element', ['image_file' => 'about_us_3.png', 'title' => 'Dove siamo','subtitle' => 'Scopri dove ci troviamo e vienici a trovare!', 'route'=>'where'])
        </div>
    </div>
@endsection
