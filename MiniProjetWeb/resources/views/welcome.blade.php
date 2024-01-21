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
                                    <img src="{{URL('assets/FST-Tanger.png')}}" alt="">
                                </div>
                                <div class="post-info">
                                    <h4 class="post-title"><a href="#">Lorem ipsum dolor sit amet.</a></h4>
                                    <p class="post-date">January 1st, 2024</p>
                                    <p class="post-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Hic unde delectus excepturi atque reiciendis sunt quibusdam distinctio, illum eaque...</p>
                                </div>
                            </div>
                            <div class="post">
                                <div class="imgBx">
                                    <img src="{{URL('assets/FST-Tanger.png')}}" alt="">
                                </div>
                                <div class="post-info">
                                    <h4 class="post-title"><a href="#">Lorem ipsum dolor sit amet.</a></h4>
                                    <p class="post-date">January 1st, 2024</p>
                                    <p class="post-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Hic unde delectus excepturi atque reiciendis sunt quibusdam distinctio, illum eaque...</p>
                                </div>
                            </div>
                            <div class="post">
                                <div class="imgBx">
                                    <img src="{{URL('assets/FST-Tanger.png')}}"  alt="">
                                </div>
                                <div class="post-info">
                                    <h4 class="post-title"><a href="#">Lorem ipsum dolor sit amet.</a></h4>
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