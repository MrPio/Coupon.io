<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="{{('css/partials/signIn.css')}}">
</head>

<body style="background-color: #282828">
<div class="container" id="container">
    <div class="form-container sign-up-container">
        <form action="#">
            <h1>Create Account</h1>
            <p><!-- per lo spazio--></p>
            <input type="text" placeholder="Name"/>
            <input type="email" placeholder="Email"/>
            <input type="password" placeholder="Password"/>

            <button>Sign Up</button>
        </form>
    </div>
    <div class="form-container sign-in-container">
        <form action="{{ route('login') }}" method="post">
            @csrf
            <h1>Sign in</h1>
            <p><!-- per lo spazio--></p>
            <input placeholder="Username" name="username" value="{{old('name')}}"/>
            <input type="password" name="password" placeholder="Password"/>
            <input type="checkbox" id="remember" name="remember" value="remember">
            <a href="#">Forgot your password?</a>
            <button type="submit"> Sign In </button>

            @if ($errors->first('username'))
                <ul class="errors">
                    @foreach ($errors->get('username') as $message)
                        <li>{{ $message }}</li>
                    @endforeach
                </ul>
            @endif
        </form>
    </div>

    <div class="overlay-container">
        <div class="overlay">
            <div class="overlay-panel overlay-left">
                <h1>Welcome Back!</h1>
                <p>To keep connected with us please login with your personal info</p>
                <button class="ghost" id="signIn">Sign In</button>
            </div>
            <div class="overlay-panel overlay-right">
                <h1>Hello, Friend!</h1>
                <p>Enter your personal details and start journey with us</p>
                <button class="ghost" id="signUp">Sign Up</button>
            </div>
        </div>
    </div>
</div>


<script>
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
