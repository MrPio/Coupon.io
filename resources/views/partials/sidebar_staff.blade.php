<div id="man-sidebar">
    <ul class="man-main-list">
        <li class="man-main-item">
            <div>
                <button class="menu-button">
                    Gestione Promozioni
                </button>
                <ul class="sidebar-secondary-list">
                    <li><a href="#">Tutte le promozioni</a></li>
                    <li><a href="#">Aggiungi promozione</a></li>
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
                    <li><a href="#">I miei dati</a></li>
                </ul>
            </div>
        </li>
    </ul>
</div>
