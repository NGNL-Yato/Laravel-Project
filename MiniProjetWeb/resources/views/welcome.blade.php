<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Styles -->
        <link rel="stylesheet" href="style.css" />
        <link rel="stylesheet" href="mediaqueries.css" />
    </head>
    <body class="antialiased">
        <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
            @if (Route::has('login'))
                <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                    @auth
                    <nav id="desktop-nav">
                        <div class="logo">John Doe</div>
                        <div>
                            <ul class="nav-links">
                                <li><a href="#about">About</a></li>
                                <li><a href="#experience">Experience</a></li>
                                <li><a href="#projects">Projects</a></li>
                                <li><a href="#contact">Contact</a></li>
                            </ul>
                        </div>
                    </nav>
                    <nav id="hamburger-nav">
                        <div class="logo">John Doe</div>
                        <div class="hamburger-menu">
                            <div class="hamburger-icon" onclick="toggleMenu()">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                            <div class="menu-links">
                                <li><a href="#about" onclick="toggleMenu()">About</a></li>
                                <li><a href="#experience" onclick="toggleMenu()">Experience</a></li>
                                <li><a href="#projects" onclick="toggleMenu()">Projects</a></li>
                                <li><a href="#contact" onclick="toggleMenu()">Contact</a></li>
                            </div>
                        </div>
                    </nav>
                    <section id="profile">
                        <div class="section__pic-container">
                            <img src="./assets/profile-pic.png" alt="John Doe profile picture" />
                        </div>
                        <div class="section__text">
                            <p class="section__text__p1">Hello, I'm</p>
                            <h1 class="title">John Doe</h1>
                            <p class="section__text__p2">Frontend Developer</p>
                            <div class="btn-container">
                                <button class="btn btn-color-2" onclick="window.open('./assets/resume-example.pdf')">
                                    Download CV
                                </button>
                                <button class="btn btn-color-1" onclick="location.href='./#contact'">
                                    Contact Info
                                </button>
                            </div>
                            <div id="socials-container">
                                <img src="./assets/linkedin.png" alt="My LinkedIn profile" class="icon"
                                    onclick="location.href='https://linkedin.com/'" />
                                <img src="./assets/github.png" alt="My Github profile" class="icon"
                                    onclick="location.href='https://github.com/'" />
                            </div>
                        </div>
                    </section>
                    <script src="script.js"></script>
                    @else
                        <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
            
            </div>
        </div>
    </body>
</html>
