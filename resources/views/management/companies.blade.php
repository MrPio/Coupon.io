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
                        <img class="company-logo" src="{{ asset('images/aziende/' . $company->logo) }}"
                             alt="logo dell'azienda {{ $company->name }}">
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
        <div id="man-pagination">
            <div id="first-page">
                <a href="{{ $companies->url(1) }}">Inizio</a>
            </div>
            <div id="previous-page">
                <a>
                    <svg class="svg-change-page" width="24" height="24" viewBox="0 0 24 24"><path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z"></path></svg>
                </a>
            </div>
            <div id="current-page">
                @csrf
                {{-- TODO: non so quale azione mettere alla form; forse non ci va messa --}}
                <form method="GET">
                    <input type="text" name="page" id="page" pattern="[0-9]*" inputmode="numeric" value="{{ $companies->currentPage() }}" required>
                </form>
            </div>
            <div id="next-page">
                <svg class="svg-change-page" width="24" height="24" viewBox="0 0 24 24"><path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z"></path></svg>
            </div>
            <div id="last-page">
                <?php
                $last_page = $companies->lastPage()
                ?>
                <a href="{{ $companies->url($last_page) }}">Fine: {{ $last_page }}</a>
            </div>
        </div>
    </div>
    <script>
        jQuery('img.company-logo').each(function () {
            this.onload = function() {

                console.log(this.naturalWidth, this.naturalHeight);

                if (this.naturalWidth > this.naturalHeight) {
                    this.classList.add('item-image-fixed-width');
                } else {
                    this.classList.add('item-image-fixed-height');
                }
            };
        });
    </script>
@endsection
