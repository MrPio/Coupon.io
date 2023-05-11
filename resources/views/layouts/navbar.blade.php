<div id="navbar">
    <ul>
        <li><a class="{{ $url == '/' ? 'navbar_active' : '' }}" href="{{ route('home') }}" title="Home">Home</a></li>
        <li><a class="{{ $url == '/catalogo' ? 'navbar_active' : '' }}" href="{{ route('catalogo') }}" title="Catalogo">Catalogo</a></li>
        <li><a class="{{ $url == '/aziende' ? 'navbar_active' : '' }}" href="{{ route('aziende') }}" title="Aziende">Aziende</a></li>
        <li><a class="{{ $url == '/categorie' ? 'navbar_active' : '' }}" href="{{ route('categorie') }}" title="Categorie">Categorie</a></li>
    </ul>
</div>