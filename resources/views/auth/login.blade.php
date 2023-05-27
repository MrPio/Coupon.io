@props(['was_in_signup'=>false])
        <!DOCTYPE html>
<html>
<link rel="icon" href="{{ asset('images/cart.svg') }}" type="image/x-icon">
<head>
    <meta charset="UTF-8">
    <link href="{{ asset('css/partials/signIn.css') }}" rel="stylesheet" type="text/css">
    <title>Coupon.io | Autenticazione</title>
</head>
<body id="login--body" class="login--body">

<div class="login--container" id="container">
    <!-- Form di registrazione -->
    <div class="form-container sign-up-container">
        <form id="form_register" method="POST" action="{{ route('register') }}" autocomplete="off">
            @csrf
            <div id="logo" class="login--logo">
                <img src="{{asset('images/cart.svg')}}" alt="">
                <a style="margin: 0" href="/">Cupon.io</a>
            </div>
            <h1>Crea Account</h1>
            <p><!-- per lo spazio --></p>  <!-- TODO: sarebbe meglio farlo tramite css aggiungendo un padding -->
            <input id="name" class="login--white" type="text" name="name" placeholder="Nome" required
                   @if($was_in_signup)value="{{ old('name') }}"@endif>

            <input id="surname" class="login--white" type="text" name="surname" placeholder="Cognome" required
                   @if($was_in_signup)value="{{ old('surname') }}"@endif>

            <div id="row" style="width:50%;justify-content: space-between">
                <select id="gender" class="login--white" name="gender" style="min-width: 100px;">
                    <option value="male">Maschio</option>
                    <option value="female">Femmina</option>
                    <option value="unknown">Non specifico</option>
                </select>
                <input style="margin-left: 10px; width: 100px" type="date" class="login--white" id="birth_date" name="birth_date"
                       @if($was_in_signup)value="{{ old('birth_date') }}"@endif>
            </div>

            <input id="username" type="text" name="username" placeholder="Username" required
                   @if($was_in_signup)value="{{ old('username') }}"@endif>

            <input id="email" type="email" class="login--white" name="email" placeholder="Email" required
                   @if($was_in_signup)value="{{ old('email') }}"@endif>
            <input id="password" type="password" name="password" placeholder="Password" required>
            <input id="password_confirmation" type="password" name="password_confirmation"
                   placeholder="Password confirm" required>
            @if ($was_in_signup)
                <ul>
                    @foreach($errors->all() as $message)
                        <li>{{ $message }}</li>
                    @endforeach
                </ul>
            @endif
            @include('partials.button',
[
'text' => 'Registrati',
'black' => true,
'id'=>'signUp_submit',
'big'=>true,
])
        </form>
    </div>

    <!-- Form di login -->
    <div class="form-container sign-in-container">
        <form id="form_login" method="POST" action="{{ route('login') }}">
            @csrf
            <div id="logo" class="login--logo">
                <img src="{{asset('images/cart.svg')}}" alt="">
                <a style="margin: 0" href="/">Cupon.io</a>
            </div>
            <h1>Accedi</h1>
            <p><!-- per lo spazio --></p>  <!-- TODO: sarebbe meglio farlo tramite css aggiungendo un padding -->
            <input id="username" type="text" name="username" placeholder="Username" required
                   @if(!$was_in_signup)value="{{ old('username') }}"@endif>
            <input id="password" type="password" name="password" placeholder="Password" required>
            @if ($errors->first('username') and !$was_in_signup)
                <ul>
                    @foreach($errors->get('username') as $message)
                        <li>{{ $message }}</li>
                    @endforeach
                </ul>
            @endif
            @if ($errors->first('password')and !$was_in_signup)
                <ul>
                    @foreach($errors->get('password') as $message)
                        <li>{{ $message }}</li>
                    @endforeach
                </ul>
            @endif
            {{--                <input id="remember" type="checkbox" name="remember" value="remember">--}}
            <a href="{{route('password.request')}}">Hai dimenticato la password?</a>
            @include('partials.button',
[
'text' => 'Accedi',
'black' => true,
'id'=>'signIn_submit',
'big'=>true
])            </form>
    </div>
    <div class="overlay-container">
        <div class="overlay">
            <div class="overlay-panel overlay-left">
                <h1 style="color: var(--color3)">Bentornato!</h1>
                <p style="color: var(--color3)">Accedi per poter usufruire di tutti i nostri servizi!</p>
                @include('partials.button',
[
'text' => 'Accedi',
'id'=>'signIn',
'black' => true,
'big'=>true,
])
            </div>
            <div class="overlay-panel overlay-right">
                <h1 style="color: var(--color3)">Salve</h1>
                <p style="color: var(--color3)">Registrati per iniziare ad acquisire coupon!</p>
                @include('partials.button',
[
'text' => 'Registrati',
'id'=>'signUp',
'black' => true,
'big'=>true,
])
            </div>
        </div>
    </div>
</div>

<script>
    function submitForm(formId) {
        document.getElementById(formId).submit();
    }

    const signUpButton = document.getElementById('signUp');
    const signInButton = document.getElementById('signIn');
    const signUpSubmitButton = document.getElementById('signUp_submit');
    const signInSubmitButton = document.getElementById('signIn_submit');
    const container = document.getElementById('container');
    signUpButton.addEventListener('click', () => {
        container.classList.add("right-panel-active");
    });
    signInButton.addEventListener('click', () => {
        container.classList.remove("right-panel-active");
    });
    signUpSubmitButton.addEventListener('click', () => {
        submitForm('form_register')
    });
    signInSubmitButton.addEventListener('click', () => {
        submitForm('form_login')
    });
    @if($was_in_signup)signUpButton.click() @endif
</script>
</body>
</html>
