@props([
    'image'=>'amazon.png',
    'color'=>'#ffffff'
])

<link rel="stylesheet" href="{{asset('css/partials/card.css')}}">

<div class="card--azienda hover_animation shadow"
     style="background-color: {{$color}};">
    <div class="card--image" style="background-image: url(../../images/aziende/{{$image}});"></div>
</div>

