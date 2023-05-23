<link rel="stylesheet" href="{{asset('css/layouts/account_navbar.css')}}">


<div class="account_navbar--container">
    <div class="tab">
        <button class="tablinks" onclick="openTab(event, 'profile')" id="defaultOpen"><h3>Profilo</h3></button>
        <button class="tablinks" onclick="openTab(event, 'projects')"><h3>I miei coupon</h3></button>
        <button class="tablinks" onclick="openTab(event, 'photos')"><h3>Le mie aziende preferite</h3></button>
    </div>

    <div id="profile" class="tabcontent">

        <div class="user--title"><h3>Ciao {{$user->name}}! Ecco i tuoi dati:</h3></div>


        <div class="row1">
            <div class="dat-col-titles">

                <div class="user--information--title"><h3>Nome:</h3></div>
                <div class="user--information--title"><h3>Cognome:</h3></div>
                <div class="user--information--title"><h3>Generali:</h3></div>
                <div class="user--information--title"><h3>E-mail:</h3></div>
                <div class="user--information--title"><h3>Telefono:</h3></div>
                <div class="user--information--title"><h3>Password:</h3></div>
                <div class="user--information--title"><h3>Password:</h3></div>

            </div>
            <div class="dat-col">
                <form class="user--form" action="{{route('account')}}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <input class="user--information" id="name" type="text" value="{{$user->name}}" name="name" placeholder="{{$user->name}}"
                           required>

                    <input class="user--information" id="surname" value="{{$user->surname}}" type="text" name="surname"
                           placeholder="{{$user->surname}}" required>

                    <div id="row" style="justify-content: space-between">
                        <select class="user--select" id="gender" name="gender" style="min-width: 100px;">
                            <option value="male">Maschio</option>
                            <option value="female">Femmina</option>
                            <option value="unknown">Non specifico</option>
                        </select>

                        <input class="user--select" style="margin-left: 10px; width: 100px" type="date" id="birth_date"
                               name="birth_date">
                    </div>

                    <input class="user--information" value="{{$user->username}}"id="username" type="text" name="username"
                           placeholder="{{$user->username}}" required>

                    <input class="user--information" id="email" type="email" value="{{$user->email}}" name="email" placeholder="{{$user->email}}"
                           required>

                    <input class="user--information" id="password" type="password" name="password"
                           placeholder="Password" required>

                    <input class="user--information" id="password_confirmation" type="password"
                           name="password_confirmation"
                           placeholder="Password confirm" required>

                    <button id="submit--modifyUser--form" type="submit" style="display: none"></button>


                </form>
            </div>

        </div>

        <div class="row2">
            <div
                class="user--edit--button"> @include('partials.button',['text' => 'Modifica', 'black' => true, 'id'=>'edit', 'big'=>false])</div>

            <div
                class="user--save--button"> @include('partials.button',['text' => 'Salva', 'black' => true, 'id'=>'user--save--information', 'onClick'=>"document.getElementById('submit--modifyUser--form').click()",  'big'=>false, 'form_type'=>'button'])</div>

        </div>
    </div>


    <div id="projects" class="tabcontent">
        <div class="user--title"><h3>I tuoi copon:</h3></div>

    </div>

    {{--    <div id="photos" class="tabcontent">--}}
    {{--        <div class="user--title"><h3>Le tueaziende preferite:</h3></div>--}}
    {{--        <div class="grid_responsive" style="padding-top: 60px; row-gap: 50px;--}}
    {{--        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr))">--}}
    {{--            @foreach($companies as $company)--}}
    {{--                @include('partials.card',--}}
    {{--    [--}}
    {{--    'image' => $company->logo,--}}
    {{--    'color' => $company->color,--}}
    {{--    'route' => route('$company',['company'=>$company]),--}}
    {{--    ])--}}
    {{--            @endforeach--}}
    {{--        </div>--}}
    {{--    </div>--}}

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
    button_save.style.visibility = "hidden"

    button_edit.addEventListener('click', function () {
        var field1 = document.getElementsByClassName("user--information");
        var field2 = document.getElementsByClassName("user--select");

        for (i = 0; i < field1.length; i++) {
            field1[i].style.pointerEvents = "auto";
        }
        for (i = 0; i < field2.length; i++) {
            field2[i].style.pointerEvents = "auto";
        }
        button_save.style.visibility = "visible"
    })


    button_save.addEventListener('click', function () {
        var field1 = document.getElementsByClassName("user--information");
        var field2 = document.getElementsByClassName("user--select");
        for (i = 0; i < field1.length; i++) {
            field1[i].style.pointerEvents = "none";
        }
        for (i = 0; i < field2.length; i++) {
            field2[i].style.pointerEvents = "none";
        }
        button_save.style.visibility = "hidden"

    })

</script>

