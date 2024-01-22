<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link rel="icon" type="image/x-icon" href="assets/iconsite.png">

    <!-- Scripts -->
    @vite(["resources/CSS/home.css"])
    @vite(["resources/js/script.js","resources/CSS/style.css"])
</head>
<body>
    <div class = "main_container">
    <header class="header" id="header">
        <div class="WebSiteLogo">
            <a href ="{{ route('welcome') }}"> 
                <!-- Go to Main page when clicking on the logo -->  
                <img src="{{URL('assets/FST.png')}}" alt="Logo FST">
            </a>
        </div>        
        <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
        @if (Route::has('login'))
            @auth
                <div class="nav-btns">
                    <div class="Home">
                        <a class="dropdown-item" href="{{ route('auth.home') }}">
                         {{ __('Home') }}
                         <!-- Instead of recreating a newroute, just using the admin route to check for all the users
                            Since its checking if the user is an admin anyway, and redirect the admin in hes own pannel
                            at the end.-->
                        </a>
                    <a class="loga" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            @else
            <div class="login-modal">
                <div class="login-bx">
                    <h3 class="login-title">S'authentifier</h3>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="inputBx">
                            <input name="email" placeholder="email institutionnel" id="email" type="email" class="@error('email') is-invalid @enderror" value="{{ old('email') }}">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>
                        <div class="inputBx">
                            <input  name="password" placeholder="mot de passe" id="password" type="password" class="@error('password') is-invalid @enderror">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>
                        <button type="submit" class="submit-btn">
                            {{ __('Login') }}
                        </button>
                    </form>
                    </div>
                </div>
                <button type="submit" class="login-btn btn">Login</button>
                <div class="nav-toggler"><i class='bx bx-menu-alt-right'></i></div>
        @endauth
        @endif
        </div>
    </header>               
    <main class="py-4">
        @yield('content')
        <!-- Calls the layout thats gonna be added here -->
    </main>
    </div>
</body>
</html>
