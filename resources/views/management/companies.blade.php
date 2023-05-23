@extends('layouts.management')

@section('content')
    <div class="content-container">
        <div class="search-bar">
            Search-bar: PLACEHOLDER
        </div>
        <div class="item-container">
            @foreach($companies as $company)
                <div class="company-row">
                    <div class="image-container" style="background-color: {{ $company->color }}">
                        <img src="{{ asset('images/aziende/' . $company->logo) }}" alt="logo dell'azienda {{ $company->name }}">
                    </div>
                    <div class="company-info">
                        <table>
                            <tr>
                                <td>Nome:</td>
                                <td class="company-name">{{ $company->name }}</td>
                            </tr>
                            <tr>
                                <td>Tipo:</td>
                                <td>{{ $company->type }}</td>
                            </tr>
                            <tr>
                                <td>Luogo:</td>
                                <td>{{ $company->place }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <script>
        jQuery('img').each(function (){
            console.log(this);
            if (this.naturalWidth > this.naturalWidth) {
                this.classList.add('item-image-fixed-height');
            } else {
                this.classList.add('item-image-fixed-width');
            }
        });
    </script>
@endsection
