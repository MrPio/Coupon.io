<link rel="stylesheet" href="{{asset('css/layouts/user_account_content.css')}}">

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div id='account_navbar--container' class="account_navbar--container">
    <div class="tab @can('isUser') tab_3col @elsecan('isNotPublic') tab_2col @endcan">
        <button class="tablinks " onclick="openTab(event, 'profile')" id="defaultOpen"><h2>Profilo</h2></button>
        <button class="tablinks " onclick="openTab(event, 'password')"><h2>Password</h2></button>
        @can('isUser')
            <button class="tablinks " onclick="openTab(event, 'myCoupons')"><h2>I miei coupon</h2></button>
        @endcan
    </div>

    <div id="profile" class="tabcontent">
        <div class="user--title"><h2>Ciao {{$account->name}}! Ecco i tuoi dati:</h2></div>

        {{ Form::open(['route' => 'account', 'id' => 'user--form', 'class' => 'user--form','method'=>'POST']) }}
        <div class="user--lineContainer">
            {{ Form::label('name', 'Nome:') }}
            {{ Form::text('name', $account->name, ['placeholder' => $account->name,  'id' => 'name', 'required']) }}
        </div>
        <div class="user--lineContainer">
            {{ Form::label('surname', 'Cognome:') }}
            {{ Form::text('surname', $account->surname, ['placeholder' => $account->surname, 'id' => 'surname', 'required']) }}
        </div>
        <div class="user--lineContainer">
            {{ Form::label('gender', 'Genere:') }}
            {{ Form::select('gender', ['male' => 'Maschio', 'female' => 'Femmina', 'unknown' => 'Non specifico'],
                             $account->gender, [ 'id' => 'gender','required']) }}
        </div>
        <div class="user--lineContainer">
            {{ Form::label('birth', 'Data di nascita:') }}
            {{ Form::date('birth',date($account->birth), [ 'id' => 'birth_date','required']) }}
        </div>
        <div class="user--lineContainer">
            {{ Form::label('username', 'Username:') }}
            {{ Form::text('username', $account->username, ['placeholder' => $account->username, 'id' => 'username', 'required']) }}
        </div>
        <div class="user--lineContainer">
            {{ Form::label('email', 'E-mail:') }}
            {{ Form::email('email', $account->email, ['placeholder' => $account->email, 'id' => 'email', 'required']) }}
        </div>
        <div class="user--lineContainer">
            {{ Form::label('phone', 'Telefono:') }}
            {{ Form::tel('phone', $account->phone, ['placeholder' => $account->phone, 'id' => 'phone', 'required']) }}
        </div>
        <div class="user--lineContainer user--button_container">
            <label></label>
            <div class="user--row">
                @include('partials.button',[
                         'text' => 'Salva',
                         'black' => true,
                         'id'=>'user--save--information',
                         'form_type'=>'submit',
                         'big'=>true,
                         'style' => 'width:100%;',])
                @include('partials.button',[
                         'text' => 'Modifica',
                         'black' => true,
                         'form_type'=>'button',
                         'id'=>'user--edit--information',
                         'big'=>true,
                         'style' => 'width:100%;',])
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
            {{ Form::label('current_password', 'Vecchia:') }}
            {{ Form::password('current_password',[ 'id' => 'current_password', 'required']) }}
        </div>

        <div class="user--lineContainer">
            {{ Form::label('password', 'Nuova:') }}
            {{ Form::password('password',[ 'id' => 'password', 'required']) }}
        </div>

        <div class="user--lineContainer">
            {{ Form::label('password_confirmation', 'Conferma:') }}
            {{ Form::password('password_confirmation',[ 'id' => 'password_confirmation', 'required']) }}
        </div>
        <div class="user--lineContainer user--button_container">
            <label></label>
            @include('partials.button',[
                                 'text' => 'Salva',
                                 'black' => true,
                                 'id'=>'user--password--save--information',
                                 'form_type'=>'submit',
                                 'big'=>true,
                     'style' => 'width:100%;',])
        </div>


    </div>


    @can('isUser')
        <div id="myCoupons" class="tabcontent">
            <div class="user--title"><h2>I tuoi coupon:</h2></div>

            <div class="grid_responsive" style="padding-top: 50px; row-gap: 30px;
         grid-template-columns: repeat(auto-fill, minmax(280px, 1fr))">

                @foreach ($account->user->coupons as $coupon)
{{--t--}}

                    @include('partials.coupon',
                            [
                            'promotion_id' => $coupon->promotion->id,
                            'title'=>$coupon->promotion->is_coupled?'Promozione '.count($coupon->promotion->coupled).' x 1':$coupon->promotion->product->name,
                            'expiration'=>$coupon->promotion->ends_on,
                            'image'=>$coupon->promotion->is_coupled?$coupon->promotion->company->logo:$coupon->promotion->product->image_path,
                            'discount_perc'=>$coupon->promotion->is_coupled?$coupon->promotion->extra_percentage_discount:$coupon->promotion->percentage_discount,
                            'discount_tot'=>$coupon->promotion->flat_discount,
                            'is_coupled'=>$coupon->promotion->is_coupled,
                            'is_expired' => $coupon->promotion->is_expired(),
                            'goto' => 'coupon',
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

    const button_edit = document.getElementById('user--edit--information');
    const button_save = document.getElementById('user--save--information');
    button_save.style.visibility = "hidden"

    button_edit.addEventListener('click', function () {
        const fields = $('.user--lineContainer').find('input, select');
        fields.each((i, el) => el.style.pointerEvents = "auto")
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


