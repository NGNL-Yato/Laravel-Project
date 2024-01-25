@extends('layouts.app')
<!-- U extends the layout to add the top layout in all pages -->

@section('content')
<!-- the section part is added to include pages inside the layouts -->
    <body class="antialiased">
    <a href = "http://localhost:8000/register"> link </a>
        <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
            <main class="main">
                <section class="hero">
                        <h1 class="main-title">
                            online platform of Faculty of sciences and technologies (FST)
                        </h1>
                        <div class="departements">
                            <h3 class="departements-title">Our Departements</h3>
                            <ul class="departements-list">
                                <li>Informatique</li>
                                <li>Mathematiques</li>
                                <li>Physiques</li>
                                <li>Chimie</li>
                            </ul>
                    </div>            
                </section>
                <section class="announcements">
                    <div class="container">
                        <div class="section-title">
                            <h3>Latest Announcements</h3>
                        </div>
                        <div class="announcements-posts">
                            <div class="post">
                                <div class="imgBx">
                                    <img src="{{URL('assets/hero.png')}}" alt="">
                                </div>
                                <div class="post-info">
                                    <span class="sous-title">new announcements</span>
                                    <h4 class="post-title"><a href="#">Lorem ipsum dolor sit amet consectetur adipisicing elit.</a></h4>
                                    <p class="post-date">January 1st, 2024</p>
                                    <p class="post-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Hic unde delectus excepturi atque reiciendis sunt quibusdam distinctio, illum eaque...</p>
                                    <button  class="post-btn" data-id="1">Learn more <i class='bx bx-down-arrow-alt'></i></button>
                                </div>
                            </div>
                            {{-- <div class="full-post" style="display: none">
                                <div class="post-full-image">
                                    <h4 class="post-title"><a href="#">Lorem ipsum dolor sit amet consectetur adipisicing elit.</a></h4>
                                    <p class="post-date">January 1st, 2024</p>
                                </div>
                                <div class="full-post-content">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eligendi nostrum ab rerum esse soluta quod quos minima at possimus maiores molestias aut, accusantium deserunt nobis perferendis facilis fugiat dolor repudiandae. Lorem ipsum dolor sit amet consectetur, adipisicing elit. Temporibus rerum quod quisquam! Asperiores labore minima distinctio quaerat, ducimus similique neque facere suscipit laboriosam fugit, dolore consectetur! Dolores delectus excepturi tenetur? Lorem ipsum dolor sit amet consectetur, adipisicing elit. Odit ad animi atque voluptatem incidunt molestiae dolorem repudiandae corrupti provident soluta at commodi excepturi, inventore quasi pariatur eos quo veritatis suscipit. </p>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eligendi nostrum ab rerum esse soluta quod quos minima at possimus maiores molestias aut, accusantium deserunt nobis perferendis facilis fugiat dolor repudiandae. Lorem ipsum dolor sit amet consectetur, adipisicing elit. Temporibus rerum quod quisquam! Asperiores labore minima distinctio quaerat, ducimus similique neque facere suscipit laboriosam fugit, dolore consectetur! Dolores delectus excepturi tenetur? Lorem ipsum dolor sit amet consectetur, adipisicing elit. Odit ad animi atque voluptatem incidunt molestiae dolorem repudiandae corrupti provident soluta at commodi excepturi, inventore quasi pariatur eos quo veritatis suscipit. </p>
                                </div>
                            </div> --}}
                            <div class="post">
                                <div class="imgBx">
                                    <img src="{{URL('assets/hero.png')}}" alt="">
                                </div>
                                <div class="post-info">
                                    <span class="sous-title">new announcements</span>
                                    <h4 class="post-title"><a href="#">Lorem ipsum dolor sit amet consectetur adipisicing elit.</a></h4>
                                    <p class="post-date">January 1st, 2024</p>
                                    <p class="post-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Hic unde delectus excepturi atque reiciendis sunt quibusdam distinctio, illum eaque...</p>
                                    <button  class="post-btn" data-id="2">Learn more <i class='bx bx-down-arrow-alt'></i></button>
                                </div>
                            </div>
                            <div class="post">
                                <div class="imgBx">
                                    <img src="{{URL('assets/hero.png')}}" alt="">
                                </div>
                                <div class="post-info">
                                    <span class="sous-title">new announcements</span>
                                    <h4 class="post-title"><a href="#">Lorem ipsum dolor sit amet consectetur adipisicing elit.</a></h4>
                                    <p class="post-date">January 1st, 2024</p>
                                    <p class="post-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Hic unde delectus excepturi atque reiciendis sunt quibusdam distinctio, illum eaque...</p>
                                    <button  class="post-btn" data-id="3">Learn more <i class='bx bx-down-arrow-alt'></i></button>
                                </div>
                            </div>
                            <div class="post">
                                <div class="imgBx">
                                    <img src="{{URL('assets/hero.png')}}" alt="">
                                </div>
                                <div class="post-info">
                                    <span class="sous-title">new announcements</span>
                                    <h4 class="post-title"><a href="/announce.blade.php">Lorem ipsum dolor sit amet consectetur adipisicing elit.</a></h4>
                                    <p class="post-date">January 1st, 2024</p>
                                    <p class="post-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Hic unde delectus excepturi atque reiciendis sunt quibusdam distinctio, illum eaque...</p>
                                    <button  class="post-btn" data-id="4">Learn more <i class='bx bx-down-arrow-alt'></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="formations">       
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
                            </ul>
                        </div>
                        <div class="col">
                            <h3 class="col-title">A propos nous</h3>
                            <p>
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Nihil, sapiente quos iure, dolorum rem numquam veritatis, deserunt illum expedita neque sint provident adipisci fugit quibusdam odit enim accusantium laborum. Nesciunt?
                            </p>
                        </div>
                    </div>
                    <div class="bottom-footer">
                        <p>Faculté des Sciences et Techniques de Tanger - Université Abdelmalek Essaâdi</p>
                    </div>
                </footer>
        </div>
    </body>
@endsection