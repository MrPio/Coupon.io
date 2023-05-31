@props(['promotions'=>[],
     'active_name'=>'',
     'companies'=>[],
     'active_company'=>-1,
     'active_type'=>'all',
     'active_category'=>-1
 ])


<link rel="stylesheet" href="{{asset('css/partials/stats.css')}}">
<div class="stats--container">
    <div class="stat--card">
        <div class="stat--first_row">
            <div class="stat--first_row_content">
                <div style="margin-top: 10px;"><h2>Totale coupon acquisiti:</h2></div>
                <div class="stat--card--number"><h1>{{$number_of_coupons}}</h1></div>
            </div>

            <div class="stat--first_row_content">
                <div style="margin-top: 10px;"><h2>Totale promozioni interessate:</h2></div>
                <div class="stat--card--number"><h1>{{$number_of_promotions}}</h1></div>
            </div>
        </div>

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
            </div>
        </div>

    </div>
    <div class="stats--coupon_filter" id="stats--coupon_filter">
        @foreach($promotions as $promotion)
            @include('partials.coupon',
                            [
                            'promotion_id' => $promotion->id,
                            'title'=>$promotion->is_coupled?'Promozione '.count($promotion->coupled).' x 1':$promotion->product->name,
                            'expiration'=>$promotion->ends_on,
                            'image'=>$promotion->is_coupled?$promotion->company->logo:$promotion->product->image_path,
                            'discount_perc'=>$promotion->is_coupled?$promotion->extra_percentage_discount:$promotion->percentage_discount,
                            'discount_tot'=>$promotion->flat_discount,
                            'is_coupled'=>$promotion->is_coupled,
                            'is_expired' => $promotion->is_expired(),
                        ])
        @endforeach
    </div>

    <div class="man-pagination">
        <?php
        $current_page = $promotions->currentPage();
        $last_page = $promotions->lastPage();
        ?>
        <div class="first-page">
            <a href="{{ $promotions->url(1) }}">Inizio</a>
        </div>
        <div class="previous-page">
            <a href="#">
                <svg class="svg-change-page" width="48" height="48" viewBox="0 0 24 24"><path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z"></path></svg>
            </a>
        </div>
        <div class="current-page">
            @csrf
            <form method="GET">
                <input type="text" name="page" id="page" pattern="[0-9]*" inputmode="numeric" value="{{ $current_page }}" required>
            </form>
        </div>
        <div class="next-page">
            <a>
                <svg class="svg-change-page" width="48" height="48" viewBox="0 0 24 24"><path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z"></path></svg>
            </a>
        </div>
        <div class="last-page">
            <a href="{{ $promotions->url($last_page) }}">Fine: {{ $last_page }}</a>
        </div>
    </div>
</div>



<script>
    let current_page = {{ $current_page }};
    let last_page = {{ $last_page }};
    jQuery('input#page').on('focus', function () {
        $(this).val('');
    });
    let next_page = jQuery('.next-page a');
    if (current_page + 1 > last_page) {
        next_page.attr('href', '#')
    } else {
        next_page.attr('href', '{{ $promotions->url($current_page + 1) }}');
    }
    let previous_page = jQuery('.previous-page a');
    if (current_page <= 1) {
        previous_page.attr('href', '#');
    } else {
        previous_page.attr('href', '{{ $promotions->url($current_page - 1) }}');
    }
</script>

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
