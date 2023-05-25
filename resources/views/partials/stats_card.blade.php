@props(['promotions'=>[],
     'active_name'=>'',
     'companies'=>[],
     'active_company'=>-1,
     'active_type'=>'all',
     'active_category'=>-1
 ])


<link rel="stylesheet" href="{{asset('css/partials/stats_card.css')}}">
<div class="stats--container">
    <div class="stat--card">
        <div style="margin-top: 10px;"><h2>Totale coupon acquisiti:</h2></div>
        <div class="stat--card--number"><h1>{{$number}}</h1></div>


        <div class="stats--filter">
            <div class="stats--filter--title">
                <h2>Filtra per:</h2>
            </div>

            <div id="round_rectangle" class="stats--searchBar">

                <select class="stat--select" id="stat--select" name="time_search" style="min-width: 100px;">
                    <option value="all" @if($active_type=='all')@endif selected>Tutti</option>
                    <option value="month" @if($active_type=='month')@endif selected>Ultimo mese</option>
                    <option value="week" @if($active_type=='month')@endif selected>Utlima settimana</option>
                    <option value="day" @if($active_type=='day')@endif selected>Oggi</option>

                </select>

                <input id="coupon--search" onkeyup="search(event.key)"
                       placeholder="Nome prodotto"
                       value="{{$active_name}}"
                >
                <img style="margin: auto 0;cursor: pointer" width="18px" src="{{asset('images/delete.svg')}}" alt=""
                     onclick="reset()">
                <img style="margin: auto 0;cursor: pointer" width="26px" src="{{asset('images/search.svg')}}" alt=""
                     onclick="search()">
            </div>


        </div>

    </div>
    <div class="stats--coupon_filter" id="stats--coupon_filter">
        @foreach($promotions as $promotion)
            @if(!$promotion->is_coupled)
            @include('partials.coupon',
        [
            'promotion_id' => $promotion->id,
            'title'=>$promotion->product->name,
            'expiration'=>$promotion->ends_on,
            'image'=>$promotion->product->image_path,
            'discount_perc'=>$promotion->percentage_discount,
            'discount_tot'=>$promotion->flat_discount,
        ])
            @endif
        @endforeach
    </div>
</div>

<script>
    function search(key) {
        if (key == null || key === 'Enter') {
            const search = document.getElementById('coupon--search').value;
            const type = document.getElementById('stat--select').value;

            // generazione stringa url dinamica
            let url = '{!! route('management.stats',[
                            'name'=>'param_name',
                            'type'=>'param_type',
                        ])!!}';

            //sostituisco i campi con i valori in input dall'admin
            console.error(':name')
            url = url.replace('param_name', search);
            url = url.replace('param_type', type);
            window.location = url;
        }
    }

    function reset() {
        window.location = "/admin/stats";
    }

    window.onload = function () {
        const type_select = document.getElementById('stat--select')
        type_select.addEventListener("change", function () {
            search()
        });
        const input = document.getElementById('coupon--search');
        const length = input.value.length;
        input.selectionStart = 0;
        input.selectionEnd = length;
        input.focus();
    }
</script>
