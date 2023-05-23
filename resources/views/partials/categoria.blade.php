@props([
    'id'=>0,
    'title'=>'Salute e bellezza',
    'subtitle'=>'Scorpri le nostre offerte riguardante prodotti di bellezza.',
    'image'=>'14.webp',
    'color'=>'#41ad5f'
])

<script>
    function gotoCatalog(category) {
        let url = '{!! route('catalogo',['category_id'=>'param_category'])!!}'
        url = url.replace('param_category', category)
        window.location = url;
    }

    $(() => {
        $('#coupon--categoria_{{$id}}').on('click', () => gotoCatalog('{{$id}}'))
    })
</script>

<link rel="stylesheet" href="{{asset('css/partials/categoria.css')}}">
<div id="coupon--categoria_{{$id}}"
     class="coupon--categoria hover_animation shadow">
    <div class="container--categoria" style="background-color: {{$color}}">
        <img class="image--categoria" src="{{asset('images/categorie/'.$image)}}" height="auto" alt="" width="260">
    </div>
    <div class="container_description--categoria">
        <h3 class="not-selectable"><b>{{$title}}</b></h3>
        <p class="not-selectable" style="word-wrap: break-word; white-space: pre-wrap;">{!!$subtitle!!}</p>
    </div>
    <button class="button_black button--categoria">Vedi tutto</button>
</div>
