<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    <title>Coupon.io | 404 Not found</title>
</head>

<body style="background-color: var(--color4)">
<div style=" padding: 3rem 2rem;display: grid; row-gap: 3rem; justify-content: center">
    <h1 style="font-family: montserrat_bold,serif;text-align: center;">404</h1>
    <img style="margin: auto" src="{{asset('images/404.gif')}}" alt="">
    <h1 style="font-family: flamenco_regular,serif;text-align: center">Oops! The page you're looking for cannot be found.</h1>
</div>
</body>
</html>
