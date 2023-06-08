<link rel="stylesheet" href="{{asset('css/partials/carosello.css')}}">

<div class="slider-container">
    <div class="slider" style="width: calc(450px * {{$companies->count()*2}}) ;">
        <div class="slide-track" id="width" style="width: calc(380px * {{$companies->count()*2}});">
            @foreach($companies as $company)
                @if($company->featured)
                    @include('partials.card',
        [
        'image' => $company->logo,
        'color' => $company->color,
        'route' => route('aziende.show',$company),
        ])
                @endif
            @endforeach

            @foreach($companies as $company)
                @if($company->featured)
                    @include('partials.card',
    [
    'image' => $company->logo,
    'color' => $company->color,
    'route' => route('aziende.show',$company),

    ])
                @endif
            @endforeach
        </div>
    </div>
</div>

