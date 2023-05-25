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

                <select class="stat--select" id="time_search" name="time_search" style="min-width: 100px;">
                    <option value="all">Tutti</option>
                    <option value="year">Ultimo anno</option>
                    <option value="week">Utlima settimana</option>
                    <option value="day">Oggi</option>

                    {{--            <option value="all" @if($active_type=='all') selected @endif>Tutte</option>--}}
                    {{--            <option value="single" @if($active_type=='single') selected @endif>Promozioni semplici</option>--}}
                    {{--            <option value="coupled" @if($active_type=='coupled') selected @endif>Promozioni abbinate</option>--}}
                </select>

                {{--        <input id="coupon--search" onkeyup="search(event.key)"--}}
                {{--               placeholder="Nome prodotto"--}}
                {{--               value="{{$active_name}}">--}}
                <img style="margin: auto 0;cursor: pointer" width="18px" src="{{asset('images/delete.svg')}}" alt=""
                     onclick="reset()">
                <img style="margin: auto 0;cursor: pointer" width="26px" src="{{asset('images/search.svg')}}" alt=""
                     onclick="search()">
            </div>
        </div>
    </div>
</div>
