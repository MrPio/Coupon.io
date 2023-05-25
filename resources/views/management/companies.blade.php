@extends('layouts.management')

@section('content')
    <div class="content-container">
        <div class="search-bar">
            Search-bar: PLACEHOLDER
        </div>
        <div class="item-container">
            @foreach($companies as $company)
                <div class="company-row">
                    <div class="left-container">
                        <div class="image-container" style="background-color: {{ $company->color }}">
                            <img class="company-logo item-image-fixed-width" src="{{ asset('images/aziende/' . $company->logo) }}" alt="logo dell'azienda {{ $company->name }}">
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
                    <div class="right-container">
                        <div class="edit-company center-content">
                            <a href="#">
                                <svg width="48" height="48" viewBox="0 0 24 24"><path d="m7 17.013 4.413-.015 9.632-9.54c.378-.378.586-.88.586-1.414s-.208-1.036-.586-1.414l-1.586-1.586c-.756-.756-2.075-.752-2.825-.003L7 12.583v4.43zM18.045 4.458l1.589 1.583-1.597 1.582-1.586-1.585 1.594-1.58zM9 13.417l6.03-5.973 1.586 1.586-6.029 5.971L9 15.006v-1.589z"></path><path d="M5 21h14c1.103 0 2-.897 2-2v-8.668l-2 2V19H8.158c-.026 0-.053.01-.079.01-.033 0-.066-.009-.1-.01H5V5h6.847l2-2H5c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2z"></path></svg>
                            </a>
                        </div>
                        <div class="delete-company center-content">
                            <form action="{{ route('company.delete', ['id' => $company->id]) }}" method="POST" onsubmit="return confirm('Sei sicuro di voler cancellare l\'azienda {{ $company->name }}?');">
                                @csrf
{{--                                <input type="hidden" name="_method" value="POST">--}}
                                <button type="submit" style="background-color: inherit; border: none">
                                    <svg width="48" height="48" viewBox="0 0 24 24"><path d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2zm4.207 12.793-1.414 1.414L12 13.414l-2.793 2.793-1.414-1.414L10.586 12 7.793 9.207l1.414-1.414L12 10.586l2.793-2.793 1.414 1.414L13.414 12l2.793 2.793z"></path></svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="man-pagination">
            <?php
                $current_page = $companies->currentPage();
                $last_page = $companies->lastPage();
            ?>
            <div class="first-page">
                <a href="{{ $companies->url(1) }}">Inizio</a>
            </div>
            <div class="previous-page">
                <a href="#">
                    <svg class="svg-change-page" width="48" height="48" viewBox="0 0 24 24"><path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z"></path></svg>
                </a>
            </div>
            <div class="current-page">
                @csrf
                {{-- TODO: non so quale azione mettere alla form; forse non ci va messa --}}
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
                <a href="{{ $companies->url($last_page) }}">Fine: {{ $last_page }}</a>
            </div>
        </div>
    </div>
    <script>
        let current_page = {{ $current_page }};
        let last_page = {{ $last_page }};
        jQuery('img.company-logo').each(function () {
            this.onload = function() {
                if (this.naturalHeight > this.naturalWidth) {
                    this.classList.add('item-image-fixed-height');
                    this.classList.remove('item-image-fixed-width');
                }
            };
        });
        jQuery('input#page').on('focus', function () {
           $(this).val('');
        });
        jQuery('.next-page a').click(function () {
            if (current_page + 1 > last_page) {
                $(this).attr('href', '#');
            } else {
                $(this).attr('href', '{{ $companies->url($current_page + 1) }}');
            }
        });
        jQuery('.previous-page a').click(function () {
            if (current_page <= 1) {
                $(this).attr('href', '#');
            } else {
                $(this).attr('href', '{{ $companies->url($current_page - 1) }}');
            }
        });
    </script>
@endsection
