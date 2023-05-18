@props([
    'text'=>'',
    'href'=>null,
    'active'=>false,
])

<link rel="stylesheet" href="{{asset('css/partials/small_card.css')}}">

<a id="small_card"
   class="small_card--text{{$active?'_active':''}}  scale_animation"
   @isset($href)href="{{ $href }}" @endisset >
    {{ $text }}
</a>


