@props([
     'companies'=>[],
 ])
@php
    $is_public=!Auth::check() || Gate::allows('isPublic');
    $is_admin=!$is_public && Gate::allows('isAdmin')
@endphp
@extends($is_public?'layouts.public':'layouts.management',
$is_public?[]:['title'=>'Ecco la lista delle aziende',
'subtitle'=>'Modifica o elimina le aziende del sito.'])

@section('title', 'Aziende')

@section('content')
    {{-- Catalogo --}}
    <div class="{{$is_public?'padding':''}}" style="margin-top: {{$is_public?'80':'20'}}px">
        @if($is_public)
        @include('partials.section_title',['title'=>'Aziende'])
        @endif

        <div class="grid_responsive" style="padding-top: 60px; row-gap: 50px;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr))">
            @foreach($companies as $company)
                @include('partials.card',
                [
                    'image' => $company->logo,
                    'color' => $company->color,
                    'route' => route('aziende.show',$company),
                    'company_id'=>$company->id,
                    'editable' => $is_admin
                ])
            @endforeach
        </div>

    </div>
@endsection

<script>
    function onclick() {
        window.location = '{{route('promozioni.index')}}'
    }
</script>