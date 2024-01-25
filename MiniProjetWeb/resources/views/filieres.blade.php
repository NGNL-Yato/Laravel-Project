@extends('layouts.app')

@section('content')
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: 'Nunito', sans-serif;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 2em;
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #3498db;
            min-width: 160px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2), 0 12px 32px rgba(0, 0, 0, 0.1);
            z-index: 1;
            border-radius: 5px;
            top: 100%;
            left: 0;
            opacity: 0;
            transform: translateY(-10px);
            transition: opacity 0.2s, transform 0.2s;
        }

        .dropdown:hover .dropdown-content {
            display: block;
            opacity: 1;
            transform: translateY(0);
        }

        .dropdown-content a {
            color: #fff;
            padding: 10px;
            text-decoration: none;
            display: block;
        }

        .bg-dots-darker {
            background-repeat: no-repeat;
        }
        .relative {
            text-align: center;
            margin-top: 50px;
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

        /* Nouveau style pour la table */
        .filiere-info {
            background-color: #3490dc;
            color: #ffffff;
            padding: 20px;
            border-radius: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 40px;
            width: 125%;
           
           
          
        }

        .filiere-info table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            
        }

        .filiere-info table th, .filiere-info table td {
            border: 1px solid #ffffff;
            padding: 10px;
            text-align: left;
        }

        .filiere-info table th {
            background-color: #1e3a8a;
            color: #fff;
        }

        .filiere-info table td {
            background-color: #3c64b2;
            color: #fff;
        }
    </style>

    <body class="antialiased full-height">
        <a href="http://localhost:8000/register"> link </a>
        <div class="flex items-center justify-center min-h-screen bg-dots-darker bg-center bg-cover bg-no-repeat bg-fixed" style="background-image: url('{{URL('assets/FST-Tanger.png')}}');">
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
                                    <a href="#">filieres 1</a>
                                    <a href="#">filieres 2</a>
                                    <a href="#">filieres 3</a>
                                </div>
                            </li>
                            <li class="dropdown">
                                <a href="{{ route('departements.show', ['name' => 'Physiques']) }}">Physiques</a>
                                <div class="dropdown-content">
                                    <a href="#">filieres 1</a>
                                    <a href="#">filieres 2</a>
                                    <a href="#">filieres 3</a>
                                </div>
                            </li>
                            <li class="dropdown">
                                <a href="{{ route('departements.show', ['name' => 'Chimie']) }}">Chimie</a>
                                <div class="dropdown-content">
                                    <a href="#">filieres 1</a>
                                    <a href="#">filieres 2</a>
                                    <a href="#">filieres 3</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </section>
                <!-- Affichage des informations des filières -->
                <div class="container">
                    <h1>Liste des Filières</h1>

                    @if($filieres->count() > 0)
                        @foreach($filieres as $filiere)
                            <!-- Affichage des informations de la filière -->
                            <div class="filiere-info p-8 rounded-md shadow-md">
                                <h2 class="text-2xl font-bold mb-4">{{ $filiere->nom_filiere }}</h2>
                                <table class="table">
                                    <tbody>
                                        @foreach($filiere->getAttributes() as $key => $value)
                                            <tr>
                                                <th>{{ $key }}</th>
                                                <td>{{ $value }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endforeach
                    @else
                        <p>Aucune filière disponible pour le moment.</p>
                    @endif
                </div>
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
            </main>
        </div>
    </body>
@endsection
