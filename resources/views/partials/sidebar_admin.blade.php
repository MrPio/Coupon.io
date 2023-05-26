<div id="man-sidebar">
    <ul class="man-main-list">
        <li class="man-main-item">
            <div>
                <button class="menu-button">
                    Gestione Aziende
                </button>
                <ul class="sidebar-secondary-list">
                    <li><a href="{{ route('management.companies') }}">Tutte le aziende</a></li>
                    <li><a href="#">Aggiungi azienda</a></li>
                </ul>
            </div>
        </li>
        <li class="man-main-item">
            <div>
                <button class="menu-button">
                    Gestione Staff
                </button>
                <ul class="sidebar-secondary-list">
                    <li><a href="{{ route('management.staff') }}">Staff</a></li>
                    <li><a href="#">Aggiungi staff</a></li>
                </ul>
            </div>
        </li>
        <li class="man-main-item">
            <div>
                <button class="menu-button">
                    Gestione Utenti
                </button>
                <ul class="sidebar-secondary-list">
                    <li><a href="{{ route('management.users') }}">Tutti gli utenti</a></li>
                </ul>
            </div>
        </li>
        <li class="man-main-item">
            <div>
                <button class="menu-button">
                    Gestione FAQ
                </button>
                <ul class="sidebar-secondary-list">
                    <li><a href="#">Tutte le FAQ</a></li>
                    <li><a href="#">Aggiungi FAQ</a></li>
                </ul>
            </div>
        </li>
        <li class="man-main-item">
            <div>
                <button class="menu-button">
                    Statistiche
                </button>
                <ul class="sidebar-secondary-list">
                    <li><a href="{{route('management.stats')}}">Statistica 1</a></li>
                    <li><a href="#">Statistica 2</a></li>
                </ul>
            </div>
        </li>
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
</div>
