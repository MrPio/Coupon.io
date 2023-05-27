@props([
    'image'=>'cart_white.svg',
    'title'=>'Aziende',
    'subtitle'=>'Totale aziende: 99',
    'center_text'=>'Gestisci le aziende affiliate',
    'route'=>'#',
])
<link rel="stylesheet" href="{{asset('/css/partials/man_card.css')}}">
<div id="man_card--container_{{str_replace(' ','_',$title)}}" class="man_card--container hover_animation shadow scale_animation">
    <div class="man_card--upper_container">
        <div class="man_card--image_container">
            <img src="{{asset('images/'.$image)}}">
        </div>
        <div>
            <h2>{{$title}}</h2>
            <p>{{$subtitle}}</p>
        </div>
    </div>
    <h2 class="man_card--center_text">{{$center_text}}</h2>
    <div class="man_card--arrow_container">
        <img class="man_card--arrow" src="{{asset('images/arrow_right.svg')}}">
    </div>
</div>

<script>
    $(()=>{
        $('#man_card--container_{{str_replace(' ','_',$title)}}').click(()=>window.location='{{$route}}')
    })
</script>