<div id="man-sidebar">
        <div id="logo" class="man-logo">
            <img src="{{asset('images/cart_white.svg')}}" alt="">
            <a style="margin: 0; color: var(--color5)" href="/">Cupon.io</a>
        </div>
    <ul class="man-main-list">
        <li class="man-main-item">
            <div>
                <button class="menu-button">
                    Gestione Promozioni
                </button>
                <ul class="sidebar-secondary-list">
                    <li><a href="#">Tutte le promozioni</a></li>
                    <li><a href="/staff/aggiungi_promozione">Aggiungi promozione</a></li>
                </ul>
            </div>
        </li>
        @can('isPrivilegedStaff')
        <li class="man-main-item">
            <div>
                <button class="menu-button">
                    Gestione Promozioni Abbinate
                </button>
                <ul class="sidebar-secondary-list">
                    <li><a href="#">Aggiungi promozione abbinata</a></li>
                </ul>
            </div>
        </li>
        @endcan
        <li class="man-main-item">
            <div>
                <button class="menu-button">
                    Profilo
                </button>
                <ul class="sidebar-secondary-list">
                    <li><a href="{{route('account')}}">I miei dati</a></li>
                </ul>
            </div>
        </li>
    </ul>

    <div class="man-logout-button">
        @auth('web')
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                @include('partials.button',['text' => 'Esci','icon' => 'user.svg', 'id'=>'logout_button','form_type' => 'submit'])
            </form>
        @endauth
    </div>
</div>
