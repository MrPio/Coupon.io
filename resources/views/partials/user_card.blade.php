@props([
    'image'=>'account_default_img.png',
    'role'=>'staff',
    'privilege'=>0,
])


<link rel="stylesheet" href="{{asset('/css/partials/user_card.css')}}">


<div class="user--container">

        <div class="user--image" style="background-image: url(../../images/{{$image}});">
            <div class="change--user--image" style="background-image: url(../../images/brush.png);"></div>
        </div>
    <div class="user-details">


        <div class="user--name"><h1>{{$name . " " . $surname}}</h1></div>   {{--  TODO cambiare con Auth::user()-> name--}}
        <div class="user--role" style="display: flex;"><h3>{{$role}}</h3>
            @if($role == 'staff' && $privilege==1) <div class="privilege--image" style="background-image: url(../../images/crown.png);"></div>@endif
        </div>
    </div>
</div>
