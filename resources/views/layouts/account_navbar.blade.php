@props([
    'image'=>'account_default_img.png',
    'role'=>'staff',
    'privilege'=>0,
])


<link rel="stylesheet" href="{{asset('css/layouts/account_navbar.css')}}">


<div class="account_navbar--container">
    <div class="tab">
        <button class="tablinks" onclick="openTab(event, 'profile')" id="defaultOpen"><h3>Profilo</h3></button>
        <button class="tablinks" onclick="openTab(event, 'projects')"><h3>I miei coupon</h3></button>
        <button class="tablinks" onclick="openTab(event, 'photos')"><h3>Le mie aziende preferite</h3></button>
    </div>

    <div id="profile" class="tabcontent">

        <div class="user--title"><h3>Ciao {{$name}}! Ecco i tuoi dati:</h3></div>


        <div class="row1">
            <div class="dat-col-titles">

                <div class="user--information--title"><h3>Nome</h3></div>
                <div class="user--information--title"><h3>Nome</h3></div>
                <div class="user--information--title"><h3>Nome</h3></div>
                <div class="user--information--title"><h3>Nome</h3></div>
                <div class="user--information--title"><h3>Nome</h3></div>

            </div>
            <div class="dat-col">

                <input class="user--information" id="name" type="text" name="name" value="{{$name}}" placeholder="Nome" required>
                <input class="user--information" id="surname" type="text" name="surname" placeholder="Cognome" required>
                <input class="user--information" id="username" type="text" name="username" placeholder="Username" required>
                <input class="user--information" id="password" type="password" name="password" placeholder="Password" required>
                <input class="user--information" id="password_confirmation" type="password" name="password_confirmation"
                       placeholder="Password confirm" required>

            </div>

        </div>

        <div class="row2">
            <div class="user--save--button"> @include('partials.button',['text' => 'Salva', 'type' => 'black', 'id'=>'user--save--information', 'big'=>false,])</div>
            <div class="user--edit--button"> @include('partials.button',['text' => 'Modifica', 'type' => 'black', 'id'=>'edit', 'big'=>false,])</div>
        </div>
    </div>


    <div id="projects" class="tabcontent">
        <div class="user--title"><h3>I tuoi copon:</h3></div>

        {{$username}}
{{--        <div class="grid_responsive" style="padding-top: 60px; row-gap: 50px;--}}
{{--        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr))">--}}
{{--            @foreach($companies as $company)--}}
{{--                @include('partials.card',--}}
{{--    [--}}
{{--    'image' => $company->logo,--}}
{{--    'color' => $company->color,--}}
{{--    'route' => route('catalogo_filtered',['company_id'=>$company->id]),--}}
{{--    ])--}}
{{--            @endforeach--}}
{{--        </div>--}}
    </div>

    <div id="photos" class="tabcontent">
        <div class="user--title"><h3>Le tueaziende preferite:</h3></div>
        <p>Content goes here.</p>
    </div>

</div>

<script>
    function openTab(evt, tabName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(tabName).style.display = "block";
        evt.currentTarget.className += " active";
    }

    // Get the element with id="defaultOpen" and click on it
    document.getElementById("defaultOpen").click();

    var button_edit = document.getElementById('edit');
    var button_save = document.getElementById('user--save--information');
    button_save.style.visibility="hidden"

    button_edit.addEventListener('click', function () {
        var field = document.getElementsByClassName("user--information");
        for (i = 0; i < field.length; i++) {
            field[i].style.pointerEvents = "auto";
        }
        button_save.style.visibility="visible"
    })


    button_save.addEventListener('click', function () {
        var field1 = document.getElementsByClassName("user--information");
        for (i = 0; i < field1.length; i++) {
            field1[i].style.pointerEvents = "none";
        }
        button_save.style.visibility="hidden"

    })

</script>

