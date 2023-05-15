@props([
    'type'=>'white',
    'text'=>'',
    'icon'=>null,
    'id'=>null,
    'route'=>null,
    'style'=>null
 ])
<button @isset($id) id="{{$id}}" @endisset
        @isset($style) style="{{$style}}" @endisset
        class="{{$type=='white'?'button_white':'button_black'}} ripple"
        @isset($route) onclick="window.location='{{route($route)}}'" @endisset >
    <div id="row" style="padding: 0 8px">
        @if (isset($icon))
            <img style="width: 1.4rem" src="{{asset('images/'.$icon)}}" alt="">
        @endif
        <p style="width: 100%">{{$text}}</p>
    </div>
</button>
