@props([
    'image'=>'amazon.png',
    'color'=>'#ffffff'
])

<link rel="stylesheet" href="{{asset('css/partials/card.css')}}">

<body>
    <div class="card--azienda" style="background-color: {{$color}}">
        <img class="image--azienda" src="{{asset('images/aziende/'.$image)}}" alt="">
    </div>
</body>

