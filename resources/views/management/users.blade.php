@extends('layouts.management')

@section('content')
    <div class="content-container">
        <div class="search-bar">
            Search-bar: PLACEHOLDER
        </div>
        <div class="item-container">
            @foreach($users as $user)
                    <?php
                    $image_path = $user->account->image_path;
                    if (isset($image_path) && file_exists('storage/' . $image_path)) {
                        $image_path = 'storage/' . $image_path;
                    } else {
                        $image_path = 'images/account_default_img.png';
                    }
                    ?>
                <div class="company-row">
                    <div class="left-container">
                        <div class="account-image-container" style="background-color: white">
                            <img style="height: 100%" src="{{ asset($image_path) }}" alt="immagine del profilo di {{ $user->account->username }}">
                        </div>
                        <div class="company-info">
                            <table>
                                <tr>
                                    <td>Nome / Cognome:</td>
                                    <td class="row-value">{{ $user->account->name . ' / ' . $user->account->surname }}</td>
                                </tr>
                                <tr>
                                    <td>Nome utente:</td>
                                    <td class="row-value">{{ $user->account->username }}</td>
                                </tr>
                                <tr>
                                    <td>Email:</td>
                                    <td class="row-value">{{ $user->account->email }}</td>
                                </tr>
                                <tr>
                                    <td>Telefono:</td>
                                    <td class="row-value">{{ $user->account->phone }}</td>
                                </tr>
                                <tr>
                                    <td>Ultimo accesso:</td>
                                    <td class="row-value">{{ $user->account->last_access }}</td>
                                </tr>
                                <tr>
                                    <td>Coupon acquisiti:</td>
                                    <td class="row-value">{{ $user->numberOfCoupon }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="right-container">
                        <div class="delete-object center-content">
                            <form action="{{ route('user.delete', ['id' => $user->id]) }}" method="POST" onsubmit="return confirm('Sei sicuro di voler rimuovere {{ $user->account->username }} dagli utenti del sito?');">
                                @csrf
                                <div class="button-container delete-button-container center-content">
                                    <button type="submit" style="background-color: rgb(0, 0, 0, 0); border: none">
                                        <svg viewBox="64 64 896 896" width="43.74" height="41.6"><path d="M864 256H736v-80c0-35.3-28.7-64-64-64H352c-35.3 0-64 28.7-64 64v80H160c-17.7 0-32 14.3-32 32v32c0 4.4 3.6 8 8 8h60.4l24.7 523c1.6 34.1 29.8 61 63.9 61h454c34.2 0 62.3-26.8 63.9-61l24.7-523H888c4.4 0 8-3.6 8-8v-32c0-17.7-14.3-32-32-32zm-200 0H360v-72h304v72z"></path></svg>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        {{--        TODO: far anche vedere quanti item ci stanno --}}
        <div class="man-pagination">
            <?php
            $current_page = $users->currentPage();
            $last_page = $users->lastPage();
            ?>
            <div class="first-page">
                <a href="{{ $users->url(1) }}">Inizio</a>
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
                <a href="{{ $users->url($last_page) }}">Fine: {{ $last_page }}</a>
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
            next_page.attr('href', '{{ $users->url($current_page + 1) }}');
        }
        let previous_page = jQuery('.previous-page a');
        if (current_page <= 1) {
            previous_page.attr('href', '#');
        } else {
            previous_page.attr('href', '{{ $users->url($current_page - 1) }}');
        }
    </script>
@endsection
