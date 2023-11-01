@props(['code'=>404,'subtitle'=>'Oops!'])
        <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    <title>Coupon.io | Errore {{$code}}</title>
</head>

<body style="background-color: var(--color4); overflow: hidden">

<div class="row padding">
    <div id="logo">
        <img src="{{asset('images/cart.svg')}}" alt="">
        <a href="{{ route('home') }}">Cupon.io</a>
    </div>
</div>
<div style=" padding: 2rem 2rem;display: grid; row-gap: 2rem; justify-content: center">
    <h1 style="font-family: montserrat_bold,serif;text-align: center;">Errore {{$code}}</h1>
    <img width="60%" style="margin: auto" src="{{asset('images/errors/'.$code.'.gif')}}" alt="">
    <h1 style="font-family: flamenco_regular,serif;text-align: center">Oops! {{$subtitle}}</h1>

    @include('partials.button',[
    'big' => true,
    'text' => 'Indietro',
    'black' => true,
    'style' => 'width:65%; margin: auto',
    'onClick'=>'history.back()'
])
</div>
</body>
</html>
