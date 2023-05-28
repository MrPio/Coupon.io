<div id="man-sidebar">
    <div id="logo" class="man-logo">
        <img src="{{asset('images/cart_white.svg')}}" alt="">
        <a style="margin: 0; color: var(--color5)" href="/">Cupon.io</a>
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
                    <li><a href="{{ route('management.companies') }}">Tutte le aziende</a></li>
                    <li><a href="#">Aggiungi azienda</a></li>
                </ul>
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
                    <li><a href="#">Aggiungi staff</a></li>
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
                    <li><a href="#">Tutte le FAQ</a></li>
                    <li><a href="#">Aggiungi FAQ</a></li>
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
                    <li><a href="{{route('management.stats')}}">Statistica 1</a></li>
                    <li><a href="#">Statistica 2</a></li>
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

    <div class="man-logout-button">
        @auth('web')
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                @include('partials.button',['text' => 'Esci','icon' => 'user.svg', 'id'=>'logout_button','form_type' => 'submit', 'big' => true])
            </form>
        @endauth
    </div>
</div>
