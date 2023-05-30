<link rel="stylesheet" href="{{asset('css/layouts/user_account_content.css')}}">

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div id='account_navbar--container' class="account_navbar--container">
    <div class="tab">
        <button class="tablinks" onclick="openTab(event, 'profile')" id="defaultOpen"><h2>Profilo</h2></button>
        <button class="tablinks" onclick="openTab(event, 'password')"><h2>Password</h2></button>
        @can('isUser')
            <button class="tablinks" onclick="openTab(event, 'myCoupons')"><h2>I miei coupon</h2></button>
        @endcan
        @can('isStaff')
        @endcan
        @can('isAdmin')
        @endcan
    </div>

    <div id="profile" class="tabcontent">

        <div class="user--title"><h2>Ciao {{$account->name}}! Ecco i tuoi dati:</h2></div>

        {{ Form::open(['route' => 'account', 'id' => 'user--form', 'class' => 'user--form','method'=>'POST']) }}

        <div class="user--lineContainer">
            {{ Form::label('name', 'Nome:', ['class' => 'user--information--title']) }}
            {{ Form::text('name', $account->name, ['class' => 'user--information','placeholder' => $account->name,  'id' => 'name', 'required']) }}
        </div>

        <div class="user--lineContainer">
            {{ Form::label('surname', 'Cognome:', ['class' => 'user--information--title']) }}
            {{ Form::text('surname', $account->surname, ['class' => 'user--information','placeholder' => $account->surname, 'id' => 'surname', 'required']) }}
        </div>


        <div class="user--lineContainer">
            {{ Form::label('gender', 'Genere:', ['class' => 'user--information--title']) }}
            {{ Form::select('gender', ['male' => 'Maschio', 'female' => 'Femmina', 'unknown' => 'Non specifico'],
                             $account->gender, ['class' => 'user--information', 'id' => 'gender','required']) }}
        </div>


        <div class="user--lineContainer">
            {{ Form::label('birth', 'Data di nascita:',['class' => 'user--information--title']) }}
            {{ Form::date('birth',date($account->birth), ['class' => 'user--information', 'id' => 'birth_date','required']) }}
        </div>

        <div class="user--lineContainer">
            {{ Form::label('username', 'Username:', ['class' => 'user--information--title']) }}
            {{ Form::text('username', $account->username, ['class' => 'user--information','placeholder' => $account->username, 'id' => 'username', 'required']) }}
        </div>

        <div class="user--lineContainer">
            {{ Form::label('email', 'E-mail:', ['class' => 'user--information--title']) }}
            {{ Form::email('email', $account->email, ['class' => 'user--information','placeholder' => $account->email, 'id' => 'email', 'required']) }}
        </div>

        <div class="user--lineContainer">
            {{ Form::label('phone', 'Telefono:', ['class' => 'user--information--title']) }}
            {{ Form::tel('phone', $account->phone, ['class' => 'user--information','placeholder' => $account->phone, 'id' => 'phone', 'required']) }}
        </div>


        <div class="user--lineContainer">
            <div class="user--edit--button">
                @include('partials.button',[
                                 'text' => 'Modifica',
                                 'black' => true,
                                 'form_type'=>'button',
                                 'id'=>'edit',
                                 'big'=>false])
            </div>

            <div class="user--save--button">
                @include('partials.button',[
                                     'text' => 'Salva',
                                     'black' => true,
                                     'id'=>'user--save--information',
                                     'form_type'=>'submit',
                                     'big'=>false])
            </div>
        </div>

        <div class="user--lineContainer">
            <div id="user--edit_errors" class="user--edit_errors"></div>
        </div>

        {!! Form::close() !!}

    </div>


    <div id="password" class="tabcontent">
        <div class="user--title"><h2>Cambia password:</h2></div>
        {{ Form::open(['route' => 'change_password', 'id' => 'user--password--form', 'class' => 'user--password--form','method'=>'POST']) }}

        <div class="user--lineContainer">
            {{ Form::label('current_password', 'Vecchia password:', ['class' => 'user--information--title']) }}
            {{ Form::password('current_password',['class' => 'user--password--information', 'id' => 'current_password', 'required']) }}
        </div>

        <div class="user--lineContainer">
            {{ Form::label('password', 'Nuova password:', ['class' => 'user--information--title']) }}
            {{ Form::password('password',['class' => 'user--password--information', 'id' => 'password', 'required']) }}
        </div>

        <div class="user--lineContainer">
            {{ Form::label('password_confirmation', 'Conferma password:', ['class' => 'user--information--title']) }}
            {{ Form::password('password_confirmation',['class' => 'user--password--information', 'id' => 'password_confirmation', 'required']) }}
        </div>
        <div class="user--lineContainer">
            <div class="user--password--save--information">
                @include('partials.button',[
                                     'text' => 'Salva',
                                     'black' => true,
                                     'id'=>'user--password--save--information',
                                     'form_type'=>'submit',
                                     'big'=>false])
            </div>
        </div>


    </div>


    @can('isUser')
        <div id="myCoupons" class="tabcontent">
            <div class="user--title"><h2>I tuoi coupon:</h2></div>

            <div class="grid_responsive" style="padding-top: 50px; row-gap: 30px;
         grid-template-columns: repeat(auto-fill, minmax(280px, 1fr))">

                @foreach ($account->user->coupons as $coupon)
                    @include('partials.coupon',
                        [
                            'promotion_id' => $coupon->promotion->id,
                            'title'=>$coupon->promotion->product->name,
                            'expiration'=>$coupon->promotion->ends_on,
                            'image'=>$coupon->promotion->product->image_path,
                            'discount_perc'=>$coupon->promotion->percentage_discount,
                            'discount_tot'=>$coupon->promotion->flat_discount,
                        ])
                @endforeach
            </div>
        </div>
    @endcan

</div>


<script>
    $(() => {
        const form = $("#user--form");

        $(":input").on('blur', (event) => {
            $('.error').removeClass('error');
            doElemValidation(event.target.name, 'user--form', 'user--edit_errors');
        });

        form.on('submit', (event) => {
            event.preventDefault();
            doFormValidation('user--form', 'user--edit_errors');
        });
    })


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
        button_edit.style.visibility = "hidden"
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
        button_edit.style.visibility = "visible"

    })

    @if(session('status') === 'password-updated')
    Swal.fire({
        title: 'Password cambiata!',
        text: 'Tienila al sicuro!!',
        icon: 'success',
        confirmButtonText: 'OK'
    })
    @elseif($errors->updatePassword->any())
    Swal.fire({
        title: 'Opss! Qualcosa è andato storto.',
        text: 'Controlla e riprova.',
        icon: 'error',
        confirmButtonText: 'OK'
    })
    @endif
</script>


