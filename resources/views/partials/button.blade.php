@props(['type'=>'white','text'=>'','icon'=>null, 'route'=>null])
<button id="{{$type=='white'?'button_white':'button_black'}}" class="ripple" type="button" @if(isset($route)) onclick="window.location='{{ route($route)}}'" @endif>
    <div id="row" style="padding:  0 8px">
        @if (isset($icon))
            <img style="width: 1.4rem" src="{{asset('images/'.$icon)}}" alt="">
        @endif
        <p style="width: 100%">{{$text}}</p>
    </div>
</button>
