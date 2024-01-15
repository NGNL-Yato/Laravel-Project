@vite(["resources/js/etudiant-script.js","resources/CSS/style.css"])

<body class="body-etudiant">
    <nav class="sidebar">
        <div class="WebSiteLogo">
            <a href ="{{ route('welcome') }}"> 
                <!-- Go to Main page when clicking on the logo -->  
                <img src="{{URL('assets/FST.png')}}" alt="Logo FST">
            </a>
        </div>
        <ul>
            <li><a href="#" id="announces" data-id="announces"  class="active">Annonces</a></li>
            <li><a href="#"  id="emploi" data-id="emploi" class="">Emploi du temps</a></li>
            <li><a href="#" id="demande" data-id="demande" class="">Faire un demande</a></li>
        </ul>
        <div class="user-box">
            <div class="user-img">
                <img src="https://placehold.jp/3d4070/ffffff/150x150.png" alt="">
            </div>
            <p class="user-id">UserName</p>
        </div>
    </nav>
    <main class="main-etudiant">

        <div class="announces-box" id="announcesSection">
            <div class="container">

            <div class="section-title">
                <h3>Mes annonces</h3>
            </div>
            <div class="section-container">

            <div class="announce-post">
                <div class="top-side">
                    <h3 class="announce-title">test test test...</h3>
                    <p class="announce-prof">Ikram ben abdel</p>
                    <div class="img-box">
                        <img src="https://placehold.co/400x400" alt="" srcset="">
                    </div>
                </div>
                <div class="bottom-side">
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Recusandae numquam laborum quod iusto doloribus ducimus, nesciunt excepturi suscipit natus voluptatibus reprehenderit fugiat. Sed similique dolorum vero molestias, ipsam eum earum?</p>
                </div>
            </div>
            <div class="announce-post">
                <div class="top-side">

                    <h3 class="announce-title">test test test...</h3>
                    <p class="announce-prof">Ikram ben abdel</p>
                    <div class="img-box">
                        <img src="https://placehold.co/400x400" alt="" srcset="">
                    </div>
                </div>
                <div class="bottom-side">
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Recusandae numquam laborum quod iusto doloribus ducimus, nesciunt excepturi suscipit natus voluptatibus reprehenderit fugiat. Sed similique dolorum vero molestias, ipsam eum earum?</p>
                </div>
            </div>
            <div class="announce-post">
                <div class="top-side">

                    <h3 class="announce-title">test test test...</h3>
                    <p class="announce-prof">Ikram ben abdel</p>
                    <div class="img-box">
                        <img src="https://placehold.co/400x400" alt="" srcset="">
                    </div>
                </div>
                <div class="bottom-side">
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Recusandae numquam laborum quod iusto doloribus ducimus, nesciunt excepturi suscipit natus voluptatibus reprehenderit fugiat. Sed similique dolorum vero molestias, ipsam eum earum?</p>
                </div>
            </div>
            <div class="announce-post">
                <div class="top-side">
                    <h3 class="announce-title">test test test...</h3>
                    <p class="announce-prof">Ikram ben abdel</p>
                    <div class="img-box">
                        <img src="https://placehold.co/400x400" alt="" srcset="">
                    </div>
                </div>
                <div class="bottom-side">
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Recusandae numquam laborum quod iusto doloribus ducimus, nesciunt excepturi suscipit natus voluptatibus reprehenderit fugiat. Sed similique dolorum vero molestias, ipsam eum earum?</p>
                </div>
            </div>
        </div>
         </div>

        </div>

        <div id="emploiSection">
            <div class="container">
                <div class="section-title">
                    <h3>Emploi du temps</h3>
                </div>
                 <br />
                <div class="cd-schedule loading">
                    <div class="timeline">
                        <table class="emploi-temps">
                            <tr>
                                <th class = "Empty_Space"></th><!--Empty to leave a space in the first td-->
                                <th>Lundi</th>
                                <th>Mardi</th>
                                <th>Mercredi</th>
                                <th>Jeudi</th>
                                <th>Vendredi</th>
                                <th>Samedi</th>
                            </tr>
                            <tr>
                                <td>09:00 - 10:45</td>
                            </tr>
                            <tr>
                                <td>11:00 - 13:45</td>
                            </tr>
                            <tr>
                                <td>14:00 - 15:45</td>
                            </tr>
                            <tr>
                                <td>16:00 - 17:45</td>
                            </tr>
                            <tr>
                                <td>18:00 - 19:45</td>
                            </tr>
                        </table>
                    </div> <!-- .timeline -->
                    <div class="event-modal">
                        <header class="header">
                            <div class="content">
                                <span class="event-date"></span>
                                <h3 class="event-name"></h3>
                            </div>

                            <div class="header-bg"></div>
                        </header>

                        <div class="body">
                            <div class="event-info"></div>
                            <div class="body-bg"></div>
                        </div>
                    </div>

                    <div class="cover-layer"></div>
                </div>
            </div>

        </div>
        <div class="faire-demande" id="demandeSection">
            <div class="container">

            <div class="section-title">
                <h3>Faire une demande</h3>
            </div>
            <div class="section-container">
                <form action="">
                    <div class="inputBx">
                        <label for="#subject">subject :</label>
                        <input type="text" class="subject" id="subject">
                     </div>
                     <div class="inputBx">
                        <label for="#sendTo">Send to :</label>
                        <input type="text" class="sendTo" id="sentTo">
                     </div>
                     <div class="inputBx">
                        <label for="#demande">votre demande :</label>
                        <textarea name="" id="demande" cols="30" rows="10"></textarea>
    
                     </div>
                     <button type="submit" class="btn demande-btn">Send</button>
                </form>
            </div>
        </div>
        </div>
    </main>
