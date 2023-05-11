@props(['title' => '', 'subtitle' => '','image_file'=>'about_us_1.png'])

<link rel="stylesheet" href="{{ asset('css/components/about_us_element.css') }}">
<div id="base">
    <div id="content">
        <h2>{{$title}}</h2>
        <h4>{{$subtitle}}</h4>
    </div>
    <img id="image" src="{{asset('images/'.$image_file)}}" alt="">
</div>