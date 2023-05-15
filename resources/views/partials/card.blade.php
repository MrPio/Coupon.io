@props([
    'image'=>'amazon.png',
    'color'=>'#ffffff',
    'route'=>null,
])

<link rel="stylesheet" href="{{asset('css/partials/card.css')}}">

<div class="card--azienda hover_animation shadow"
     @if(isset($route)) onclick="window.location='{{$route}}'" @endif
     style="background-color: {{$color}};">
    <div class="card--image" style="background-image: url(../../images/aziende/{{$image}});"></div>
</div>

