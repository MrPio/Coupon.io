@props([
    'black'=>false,
    'text'=>'',
    'icon'=>null,
    'id'=>null,
    'route'=>null,
    'style'=>null,
    'big'=>false,
    'form_type'=>null,
    'onClick'=>null,
 ])
<link rel="stylesheet" href="{{asset('css/partials/button.css')}}">
<button @isset($id) id="{{$id}}" @endisset
        style="@isset($style){{$style}};@endisset
         @if($big)width:180px; height:52px; font-size: 17px @endif"
        class="button_{{$black?'black':'white'}} scale_animation"
        @if($route) @isset($route) onclick="window.location='{{route($route)}}'" @endisset
        @elseif ($onClick) @isset($onClick) onclick="{{$onClick}}" @endisset @endif
        @isset($form_type) type='{{$form_type}}' @endisset>
    <div id="row" style="padding: 0 8px">
        @if (isset($icon))
            <img style="width: 1.4rem" src="{{asset('images/'.$icon)}}" alt="">
        @endif
        <p style="width: 100%;">{{$text}}</p>
    </div>
</button>
