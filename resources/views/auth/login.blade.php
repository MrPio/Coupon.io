<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link href="{{ asset('css/partials/signIn.css') }}" rel="stylesheet" type="text/css">
    <title>Accesso</title>
</head>
<body style="background-color: #282828">
    <div class="container" id="container">
        <!-- Form di registrazione -->
        <div class="form-container sign-up-container">
            <form id="form_register" method="POST" action="{{ route('register') }}">
                @csrf
                <h1>Crea Account</h1>
                <p><!-- per lo spazio --></p>  <!-- TODO: sarebbe meglio farlo tramite css aggiungendo un padding -->
                <input id="name" type="text" name="name" placeholder="Nome" required>
                @if ($errors->first('name'))
                    <ul>
                        @foreach($errors->get('name') as $message)
                            <li>{{ $message }}</li>
                        @endforeach
                    </ul>
                @endif
                <input id="surname" type="text" name="surname" placeholder="Cognome" required>
                @if ($errors->first('surname'))
                    <ul>
                        @foreach($errors->get('surname') as $message)
                            <li>{{ $message }}</li>
                        @endforeach
                    </ul>
                @endif
                <input id="username" type="text" name="username" placeholder="Username" required>
                @if ($errors->first('username'))
                    <ul>
                        @foreach($errors->get('username') as $message)
                            <li>{{ $message }}</li>
                        @endforeach
                    </ul>
                @endif
                <input id="password" type="password" name="password" placeholder="Password" required>
                <button id="tasto_di_prova" onclick="submitForm('form_register')">Registrati</button>
            </form>
        </div>
        <!-- Form di login -->
        <div class="form-container sign-in-container">
            <form id="form_login" method="POST" action="{{ route('login') }}">
                @csrf
                <h1>Accedi</h1>
                <p><!-- per lo spazio --></p>  <!-- TODO: sarebbe meglio farlo tramite css aggiungendo un padding -->
                <input id="username" type="text" name="username" placeholder="Username" required value="{{ old('username') }}">
                @if ($errors->first('username'))
                    <ul>
                        @foreach($errors->get('username') as $message)
                            <li>{{ $message }}</li>
                        @endforeach
                    </ul>
                @endif
                <input id="password" type="password" name="password" placeholder="Password" required>
                @if ($errors->first('password'))
                    <ul>
                        @foreach($errors->get('password') as $message)
                            <li>{{ $message }}</li>
                        @endforeach
                    </ul>
                @endif
                <input id="remember" type="checkbox" name="remember" value="remember">
                <a href="#">Hai dimenticato la password?</a>
                <button onclick="submitForm('form_login')">Accedi</button>
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Bentornato!</h1>
                    <p>Accedi per poter usufruire di tutti i nostri servizi!</p>
                    <button class="ghost" id="signIn">Accedi</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Salve</h1>
                    <p>Registrati per iniziare ad acquisire coupon!</p>
                    <button class="ghost" id="signUp">Registrati</button>
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
        const container = document.getElementById('container');
        signUpButton.addEventListener('click', () => {
            container.classList.add("right-panel-active");
        });
        signInButton.addEventListener('click', () => {
            container.classList.remove("right-panel-active");
        });
    </script>
</body>
</html>
