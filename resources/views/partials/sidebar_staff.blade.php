<div id="man-sidebar">
    <div id="logo" class="man-logo">
        <img src="{{asset('images/cart_white.svg')}}" alt="">
        <a style="margin: 0; color: var(--color5)" href="{{route('home')}}">Cupon.io</a>
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
                <img src="{{asset('images/cart_white.svg')}}">
                <button class="menu-button">
                    Gestione Promozioni
                </button>
            </div>
            <ul class="sidebar-secondary-list">
                <li><a href="{{route('promozioni.index')}}">Modifica una promozione</a></li>
                <li><a href="{{route('promozioni.create')}}">Aggiungi una promozione</a></li>
            </ul>
        </li>
        @can('isPrivilegedStaff')
            <li class="man-main-item">
                <div class="row">
                    <img src="{{asset('images/chain.svg')}}">

                    <button class="menu-button">
                        Gestione Promozioni Abbinate
                    </button>
                </div>
                <ul class="sidebar-secondary-list">
                    <li><a href="{{route('promozioni.create',['coupled'=>true])}}">Aggiungi una promozione abbinata</a>
                    </li>
                </ul>
            </li>
        @endcan
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
