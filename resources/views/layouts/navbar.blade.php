<div id="navbar">
    <ul>
        <li><a class="{{ $url=='/' ? 'navbar_active' : '' }}"
               href="{{ route('home') }}"
               title="Vai alla home">
                Home
            </a>
        </li>
        <li><a class="{{ str_contains($url , '/promozioni') ? 'navbar_active' : '' }}"
               href="{{ route('promozioni.index') }}"
               title="Sfoglia il nostro catalogo">
                Catalogo
            </a>
        </li>
        <li><a class="{{ str_contains($url , '/aziende')  ? 'navbar_active' : '' }}"
               href="{{ route('aziende.index') }}"
               title="Visualizza le nostre aziende.">
                Aziende
            </a>
        </li>
        <li><a class="{{ str_contains($url , '/categorie')  ? 'navbar_active' : '' }}"
               href="{{ route('categories') }}"
               title="Sfoglia le nostre categorie">
                Categorie
            </a>
        </li>
        <li><a class=""
               href= "{{ asset('Documentazione.pdf')}}"
               target="_blank"
               title="documentazione">
                Documentazione
            </a>
        </li>
        @auth()
            <li><a class="{{ $url == '/account' ? 'navbar_active' : '' }}"
                   href="{{ route('account') }}"
                   title="Visualizza il tuo profilo">
                    Profilo
                </a>
            </li>
        @endauth
    </ul>
</div>
