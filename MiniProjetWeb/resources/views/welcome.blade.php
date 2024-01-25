
@extends('layouts.app')
<!-- U extends the layout to add the top layout in all pages -->

@section('content')
    <!-- the section part is added to include pages inside the layouts -->
    <head>
        <style>
            .dropdown {
                position: relative;
                display: inline-block;
            }

            .dropdown-content {
                display: none;
                position: absolute;
                background-color: #3498db; /* Couleur de fond bleue */
                min-width: 160px;
                box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
                z-index: 1;
                border-radius: 0 0 10px 10px; /* Coins arrondis en bas */
                top: 100%; /* Placez le menu en dessous du lien */
                left: 0; /* Alignez le menu avec le coin gauche du lien */
            }

            .dropdown:hover .dropdown-content {
                display: block;
            }

            .dropdown-content a {
                color: #fff;
                padding: 10px;
                text-decoration: none;
                display: block;
            }

            /* Styles pour le reste de la page */
            .relative {
                text-align: center;
                margin-top: 50px; /* Ajoutez de l'espace au-dessus du titre */
            }

            .main-title {
                font-size: 2em;
            }

            .departements-list {
                list-style-type: none;
                padding: 0;
                margin: 0;
            }

            .departements-list li {
                display: inline-block;
                position: relative;
            }

            .departements-list li a {
                display: block;
                padding: 10px 15px;
                text-decoration: none;
                color: #000;
            }
        </style>
    </head>

    <body class="antialiased">
        <a href="http://localhost:8000/register"> link </a>
        <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
            <main class="main">
                <section class="hero">
                    <h1 class="main-title">
                        online platform of Faculty of sciences and technologies (FST)
                    </h1>
                    <div class="departements">
                        <h3 class="departements-title">Our Departements</h3>
                        <ul class="departements-list">
                            <li class="dropdown">
                                <a href="{{ route('departements.show', ['name' => 'Informatique']) }}">Informatique</a>
                                <div class="dropdown-content">
                                <a href="{{ route('filieres.index', ['search' => 'IDAI']) }}">IDAI</a>
                                <a href="{{ route('filieres.index', ['search' => 'AD']) }}">AD</a>
                                <a href="{{ route('filieres.index', ['search' => 'Formation 3']) }}">Formation 3</a>

                                </div>
                            </li>
                            <li class="dropdown">
                                <a href="{{ route('departements.show', ['name' => 'Mathematiques']) }}">Mathematiques</a>
                                <div class="dropdown-content">
                                <a href="#"> filieres 1</a>
                                <a href="#"> filieres 2</a>
                                <a href="#"> filieres 3</a>
                                </div>
                            </li>
                            <li class="dropdown">
                                <a href="{{ route('departements.show', ['name' => 'Physiques']) }}">Physiques</a>
                                <div class="dropdown-content">
                                <a href="#"> filieres 1</a>
                                <a href="#"> filieres 2</a>
                                <a href="#"> filieres 3</a>
                                </div>
                            </li>
                            <li class="dropdown">
                                <a href="{{ route('departements.show', ['name' => 'Chimie']) }}">Chimie</a>
                                <div class="dropdown-content">
                                <a href="#"> filieres 1</a>
                                <a href="#"> filieres 2</a>
                                <a href="#"> filieres 3</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </section>
                    <section class="announcements" style="margin-top: 50px;">
                    <div class="container">
                        <div class="section-title">
                            <h3>Latest Announcements</h3>
                        </div>
                        <div class="announcements-posts">
                            <div class="post">
                                <div class="imgBx">
                                    <img src="{{URL('assets/FST-Tanger.png')}}" alt="">
                                </div>
                                <div class="post-info">
                                    <h4 class="post-title"><a href="{{ route('annonce.index') }}">Lorem ipsum dolor sit amet.</a></h4>
                                    <p class="post-date">January 1st, 2024</p>
                                    <p class="post-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Hic unde delectus excepturi atque reiciendis sunt quibusdam distinctio, illum eaque...</p>
                                </div>
                            </div>
                            <div class="post">
                                <div class="imgBx">
                                    <img src="{{URL('assets/FST-Tanger.png')}}" alt="">
                                </div>
                                <div class="post-info">
                                    <h4 class="post-title"><a href="{{ route('annonce.index') }}">Lorem ipsum dolor sit amet.</a></h4>
                                    <p class="post-date">January 1st, 2024</p>
                                    <p class="post-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Hic unde delectus excepturi atque reiciendis sunt quibusdam distinctio, illum eaque...</p>
                                </div>
                            </div>
                            <div class="post">
                                <div class="imgBx">
                                    <img src="{{URL('assets/FST-Tanger.png')}}"  alt="">
                                </div>
                                <div class="post-info">
                                    <h4 class="post-title"><a href="{{ route('annonce.index') }}">Lorem ipsum dolor sit amet.</a></h4>
                                    <p class="post-date">January 1st, 2024</p>
                                    <p class="post-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Hic unde delectus excepturi atque reiciendis sunt quibusdam distinctio, illum eaque...</p>
                                </div>
                            </div>
        
                        </div>
                    </div>
                </section>
                <section class="formations">       
                </section>
                </div>
            </div>
        </div>
    </body>
@endsection