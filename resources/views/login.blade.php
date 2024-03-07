<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}">
</head>

<body>
    <div class="container" id="container">
        <div class="form-container sign-up-container">
            <form action="{{ route('signup') }}" method="POST">
                @csrf
                <h2>Créer un compte</h2>
                <input type="text" name="name" required placeholder="votre nom et prénom" />
                <input type="text" name="city" required placeholder="la ville" />
                <input type="text" name="address" required placeholder="l'adresse" />
                <input type="tel" name="phone" minlength="10" maxlength="10" required
                    placeholder="numero de télephone" />
                <input type="email" name="email" required placeholder="email" />
                <input type="password" name="password" minlength="6" required placeholder="mot de passe" />
                <button>S'inscrire</button>
            </form>
        </div>
        <div class="form-container sign-in-container">
            <form action="{{ route('login.verify') }}" method="POST">
                @csrf
                <h2>Connéxion</h2>
                <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required />
                <input type="password" name="password" placeholder="Mot de passe" value="{{ old('password') }}"
                    required />
                @if (session()->has('error'))
                    <p style="color:rgb(250, 74, 74)">{{ session()->get('error') }}</p>
                @endif
                <button>Connéxion</button>
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Content de te revoir!</h1>
                    <p>Pour rester en contact avec nous, veuillez vous connecter avec vos informations personnelles</p>
                    <button class="ghost" id="signIn">Connéxion</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Salut l'ami!</h1>
                    <p>Entrez vos données personnelles et commencez vos achats avec nous</p>
                    <button class="ghost" id="signUp">S'inscrire</button>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <p>
            <a href="{{ route('home') }}">{{$site_name}}</a>
        </p>
    </footer>
    <script src="{{ asset('assets/js/login.js') }}"></script>
</body>

</html>
