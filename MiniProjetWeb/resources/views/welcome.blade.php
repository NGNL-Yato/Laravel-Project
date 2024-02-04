
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

        {{-- <a href="http://localhost:8000/register" class="btn" style="border-radius: 10px;margin-left:1rem"> Register </a> --}}
        <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
            <main class="main">
                <section class="hero">
                    <h1 class="main-title">
                        Platforme en Ligne de la Faculté des Sciences et Techniques et Tanger (FSTT)
                    </h1>
                    <div class="departements">
                        <h3 class="departements-title">Nos Départements</h3>
                        @include('departement')
                    </div>
                </section>

                <section class="formations">       
                </section>
                <section class="announcements" style="margin-top: 50px;">
                    <div class="container">
                        <div class="section-title">
                            <h3>Latest Announcements</h3>
                        </div>
                        @include('annonce')
                    </div>
                </section>
            <footer class="footer">
                <div class="container">
                    <div class="col">
                        <h3 class="col-title">Liens Utiles</h3>
                        <ul  class="footer-links">
                            <li><a href=""><i class='bx bx-right-arrow-alt'></i> Site de l'Université</a></li>
                            <li><a href=""><i class='bx bx-right-arrow-alt'></i> Enseignement Supérieur</a></li>
                            <li><a href=""><i class='bx bx-right-arrow-alt'></i> Portail des universités marocaines</a></li>
                            <li><a href=""><i class='bx bx-right-arrow-alt'></i> Le Conseil Supérieur de l’Enseignement</a></li>
                            <li><a href=""><i class='bx bx-right-arrow-alt'></i> CNRST</a></li>
                            <li><a href=""><i class='bx bx-right-arrow-alt'></i> Portail National du Maroc</a></li>
                        </ul>
                    </div>
                    <div class="col">
                        <h3 class="col-title">Contactez Nous </h3>
                        <ul class="contact">
                            <li><i class='bx bxs-phone'></i> + 212 (0) 5 39 39 39 54 / 55</li>
                            <li><i class='bx bxs-envelope' ></i> administration.fstt@uae.ac.ma</li>
                            <li><i class='bx bxs-pin'></i> Ancienne Route de l’Aéroport Km 10 Ziaten. BP : 416. Tanger - Maroc, Tanger, Maroc</li>
                        </ul>
                    </div>
                    <div class="col">
                        <h3 class="col-title">reseau sociaux</h3>
                        <ul class="follow-us">
                            <li><a href="https://www.facebook.com/fstt.ac.ma?mibextid=LQQJ4d"><i class='bx bxl-facebook-square' ></i></a></li>
                            <li><a href="https://instagram.com/fsttanger?igshid=Mzc1MmZhNjY="><i class='bx bxl-instagram'></i></a></li>
                            <li><a href="https://www.linkedin.com/school/fsttanger/"><i class='bx bxl-linkedin-square' ></i></a></li>
                            <li><a href="https://github.com/NGNL-Yato/Laravel-Project"><i class='bx bxl-linkedin-square' ></i></a></li>
                        </ul>
                    </div>
                    <div class="col">
                        <h3 class="col-title">A propos nous</h3>
                        <p>Ceci est un projet académique qui a été encadré par Monsieur le professeur AITKbir et Monsieur le professeur AL YUSUFI. </p>

                    </div>
                </div>
                <div class="bottom-footer">
                    <p>Faculté des Sciences et Techniques de Tanger - Université Abdelmalek Essaâdi</p>
                </div>
            </footer>
        </div>
    
@endsection