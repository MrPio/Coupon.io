@props(['was_in_signup'=>false])
<!DOCTYPE html>
<html>
<link rel="icon" href="{{ asset('images/cart.svg') }}" type="image/x-icon">
<head>
    <meta charset="UTF-8">
    <link href="{{ asset('css/partials/signIn.css') }}" rel="stylesheet" type="text/css">
    <title>Coupon.io | Autenticazione</title>
</head>
<body id="login--body">
<div class="login--container" id="container">
    <!-- Form di registrazione -->
    <div class="form-container sign-up-container">
        <form id="form_register" method="POST" action="{{ route('register') }}">
            @csrf
            <div id="logo" class="login--logo">
                <img src="{{asset('images/cart.svg')}}" alt="">
                <a style="margin: 0" href="/">Cupon.io</a>
            </div>
            <h1>Crea Account</h1>
            <p><!-- per lo spazio --></p>  <!-- TODO: sarebbe meglio farlo tramite css aggiungendo un padding -->
            <input id="name" type="text" name="name" placeholder="Nome" required
                   @if($was_in_signup)value="{{ old('name') }}"@endif>
            @if ($errors->first('name')and $was_in_signup)
                <ul>
                    @foreach($errors->get('name') as $message)
                        <li>{{ $message }}</li>
                    @endforeach
                </ul>
            @endif
            <input id="surname" type="text" name="surname" placeholder="Cognome" required
                   @if($was_in_signup)value="{{ old('surname') }}"@endif>
            @if ($errors->first('surname') and $was_in_signup)
                <ul>
                    @foreach($errors->get('surname') as $message)
                        <li>{{ $message }}</li>
                    @endforeach
                </ul>
            @endif
            <input id="username" type="text" name="username" placeholder="Username" required
                   @if($was_in_signup)value="{{ old('username') }}"@endif>
            @if ($errors->first('username')and $was_in_signup)
                <ul>
                    @foreach($errors->get('username') as $message)
                        <li>{{ $message }}</li>
                    @endforeach
                </ul>
            @endif
            <input id="password" type="password" name="password" placeholder="Password" required>
            <input id="password_confirmation" type="password" name="password_confirmation"
                   placeholder="Password confirm" required>
            @if ($errors->first('password')and $was_in_signup)
                <ul>
                    @foreach($errors->get('password') as $message)
                        <li>{{ $message }}</li>
                    @endforeach
                </ul>
            @endif
            @include('partials.button',
[
'text' => 'Registrati',
'type' => 'black',
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
'type' => 'black',
'id'=>'signIn_submit',
'big'=>true
])            </form>
    </div>
    <div class="overlay-container">
        <div class="overlay">
            <div class="overlay-panel overlay-left">
                <h1 style="color: var(--color5)">Bentornato!</h1>
                <p>Accedi per poter usufruire di tutti i nostri servizi!</p>
                @include('partials.button',
[
'text' => 'Accedi',
'id'=>'signIn',
'big'=>true,
])
            </div>
            <div class="overlay-panel overlay-right">
                <h1 style="color: var(--color5)">Salve</h1>
                <p>Registrati per iniziare ad acquisire coupon!</p>
                @include('partials.button',
[
'text' => 'Registrati',
'id'=>'signUp',
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
