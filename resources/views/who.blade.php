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
            <h1 style="margin-bottom: 40px"> Benvenuto in Coupon.io!</h1>
            <p>Siamo qui per offrirti le migliori <a id="offerte" href="/#home--promozioni_in_evidenza">offerte</a>
                disponibili online. Che tu stia cercando sconti su abbigliamento, elettronica, viaggi o qualsiasi altra
                cosa, siamo qui per aiutarti a risparmiare denaro.
                <br>
                <br>
                La nostra piattaforma è facile da usare e ti permette di trovare rapidamente e facilmente i <a href="">coupon</a>
                che
                desideri. Basta navigare tra le diverse <a href="/categorie">categorie</a> o utilizzare la barra di
                ricerca per trovare i
                migliori affari. Abbiamo una vasta selezione di coupon da <a href="/aziende">aziende</a> e rivenditori
                rinomati,
                garantendo che
                tu possa fare acquisti in modo intelligente senza dover pagare il prezzo pieno.
                <br>
                <br>
                Sappiamo quanto sia importante per te risparmiare denaro senza dover rinunciare alla qualità, quindi ci
                impegniamo a fornire solo coupon validi e funzionanti. Ogni offerta viene attentamente selezionata e
                verificata per garantire che tu possa usufruire dei migliori sconti disponibili.
                <br>
                <br>
                Quindi, se sei pronto a risparmiare denaro sui tuoi acquisti online, unisciti a noi oggi stesso. Esplora
                le nostre offerte, trova il coupon perfetto per te e inizia a risparmiare oggi stesso!</p>
        </div>
    </div>
@endsection
