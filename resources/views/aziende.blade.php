@extends('layouts.public')
@section('title', 'Aziende')

@section('header')

@endsection

@section('subHeader')

@endsection

<script>
    function onclick() {
        window.location = '/catalogo'
    }
</script>

@section('content')
    {{-- Catalogo --}}
    <div class="padding" style="margin-top: 80px">
        @include('partials.section_title',['title'=>'Aziende'])

        <div class="grid_responsive" style="padding-top: 60px; row-gap: 50px;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr))">
            @foreach($companies as $company)
                @include('partials.card',
                [
                'image' => $company->logo,
                'color' => $company->color,
                'route' => route('azienda',$company),
                ])
            @endforeach
        </div>

    </div>
@endsection
