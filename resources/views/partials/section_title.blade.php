@php
    if(empty($imgFile))
        $imgFile='line_gray.svg';
    if(empty($color))
        $color='#282828';
@endphp

<div id="row">
    <h2 style="Color:{{$color}}; width: 20em">{{$title}}</h2>
    <img id="line_image" src="{{asset('images/'.$imgFile)}}" alt="non disponibile">
</div>