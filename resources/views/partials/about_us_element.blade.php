@props(['title' => '', 'subtitle' => '','image_file'=>'about_us_1.png', 'route'=>null])

<link rel="stylesheet" href="{{ asset('css/partials/about_us_element.css') }}">
<div id="about_us--base" class="hover_animation shadow" @if(isset($route)) onclick="window.location='{{ route($route)}}'" @endif>
    <div id="about_us--content">
        <h2>{{$title}}</h2>
        <h4>{{$subtitle}}</h4>
    </div>
    <img id="about_us--image" src="{{asset('images/'.$image_file)}}" alt="">
</div>
