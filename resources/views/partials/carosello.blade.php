<link rel="stylesheet" href="{{asset('css/partials/carosello.css')}}">

<div class="slider">
    <div class="slide-track">
        @foreach($companies as $company)
            @include('partials.card',
[
'image' => $company->logo,
'color' => $company->color
])
        @endforeach
    </div>
</div>


