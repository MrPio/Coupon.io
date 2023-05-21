@props(['code'=>404,'subtitle'=>'Oops!'])
        <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    <title>Coupon.io | 404 Not found</title>
</head>

<body style="background-color: var(--color4)">

    <div id="logo" class="padding">
        <img src="{{asset('images/cart.svg')}}" alt="">
        <a href="/">Cupon.io</a>
    </div>
<div style=" padding: 2rem 2rem;display: grid; row-gap: 2rem; justify-content: center">
    <h1 style="font-family: montserrat_bold,serif;text-align: center;">Errore {{$code}}</h1>
    <img width="60%" style="margin: auto" src="{{asset('images/errors/'.$code.'.gif')}}" alt="">
    <h1 style="font-family: flamenco_regular,serif;text-align: center">Oops! {{$subtitle}}</h1>
</div>

</body>
</html>
