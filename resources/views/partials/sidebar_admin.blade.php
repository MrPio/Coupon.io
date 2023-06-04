<div id="man-sidebar">
    <div id="logo" class="man-logo">
        <img src="{{asset('images/cart_white.svg')}}" alt="">
        <a style="margin: 0; color: var(--color5)" href="{{ route('home') }}">Cupon.io</a>
    </div>

    <ul class="man-main-list">
        <li class="man-main-item">
            <div class="row">
                <img src="{{asset('images/home.svg')}}">
                <button id="sidebar_staff--home_button" class="menu-button">
                    Home
                </button>
            </div>
        </li>
        <li class="man-main-item">
            <div class="row">
                <img src="{{asset('images/company.svg')}}">
                <button class="menu-button">
                    Gestione Aziende
                </button>
            </div>
                <ul class="sidebar-secondary-list">
                    <li><a href="{{ route('aziende.index') }}">Tutte le aziende</a></li>
                    <li><a href="{{ route('aziende.create') }}">Aggiungi azienda</a></li>
                </ul>
        </li>
        <li class="man-main-item">
            <div class="row">
                <img src="{{asset('images/cart_white.svg')}}">
                <button id="sidebar_admin--catalogo_button" class="menu-button">
                    Sfoglia il Catalogo
                </button>
            </div>
        </li>
        <li class="man-main-item">
            <div class="row">
                <img src="{{asset('images/staff.svg')}}">
                <button class="menu-button">
                    Gestione Staff
                </button>
            </div>
                <ul class="sidebar-secondary-list">
                    <li><a href="{{ route('management.staff') }}">Staff</a></li>
                    <li><a href="{{ route('staff.create') }}">Aggiungi staff</a></li>
                </ul>
        </li>
        <li class="man-main-item">
            <div class="row">
                <img src="{{asset('images/user_search.svg')}}">
                <button class="menu-button">
                    Gestione Utenti
                </button>
            </div>
                <ul class="sidebar-secondary-list">
                    <li><a href="{{ route('management.users') }}">Tutti gli utenti</a></li>
                </ul>
        </li>
        <li class="man-main-item">
            <div class="row">
                <img src="{{asset('images/faq.svg ')}}">
                <button class="menu-button">
                    Gestione FAQ
                </button>
            </div>
                <ul class="sidebar-secondary-list">
                    <li><a href="{{route('faqs.index')}}">Tutte le FAQ</a></li>
                    <li><a href="{{route('faqs.create')}}">Aggiungi FAQ</a></li>
                </ul>
        </li>
        <li class="man-main-item">
            <div class="row">
                <img src="{{asset('images/stats.svg')}}">
                <button class="menu-button">
                    Statistiche
                </button>
            </div>
                <ul class="sidebar-secondary-list">
                    <li><a href="{{route('management.stats')}}">Coupon emessi</a></li>
                </ul>
        </li>
        <li class="man-main-item">
            <div class="row">
                <img src="{{asset('images/user_white.svg ')}}">
                <button class="menu-button">
                    Profilo
                </button>
            </div>
                <ul class="sidebar-secondary-list">
                    <li><a href="{{route('account')}}">I miei dati</a></li>
                </ul>
        </li>
    </ul>
</div>
