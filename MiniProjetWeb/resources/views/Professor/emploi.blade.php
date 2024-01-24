@include("Professor.home")
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
                        <td class="hour-case">09:00 - 10:45</td>
                        <td>  </td>
                        <td>  </td>
                        <td>  </td>
                        <td>  </td>
                        <td>  </td>
                        <td>  </td>
                    </tr>
                    <tr>
                        <td class="hour-case">11:00 - 13:45</td>
                        <td>  </td>
                        <td>  </td>
                        <td>  </td>
                        <td>  </td>
                        <td>  </td>
                        <td>  </td>
                    </tr>
                    <tr>
                        <td class="hour-case">14:00 - 15:45</td>
                        <td>  </td>
                        <td>  </td>
                        <td>  </td>
                        <td>  </td>
                        <td>  </td>
                        <td>  </td>
                    </tr>
                    <tr>
                        <td class="hour-case">16:00 - 17:45</td>
                        <td>  </td>
                        <td>  </td>
                        <td>  </td>
                        <td>  </td>
                        <td>  </td>
                        <td>  </td>
                    </tr>
                    <tr>
                        <td class="hour-case">18:00 - 19:45</td>
                        <td>  </td>
                        <td>  </td>
                        <td>  </td>
                        <td>  </td>
                        <td>  </td>
                        <td>  </td>
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
        {{-- </div> --}}
        <div class="layer-form">
            <div class="add_event">
                <form action="">
                    <div class="formBx">
                        <label for="">Type de demande</label>
                        <div class="inputBx">
                            <input type="text">
                        </div>
                    </div>
                    <div class="formBx">
                        <label for="">Titre</label>
                        <div class="inputBx">
                            <input type="text">
                        </div>
                    </div>
                    <div class="formBx">
                        <label for="role">to :</label>
                        <select id="role" name="role">
                            <option value="3">Chef de Filiere</option>
                            <option value="4">Chef de departement</option>
                            <option value="5">Responsable de scolarite</option> 
                        </select>
                    </div>
                    <div class="formBx">
                        <label for="">Contenu du demande</label>
                        <textarea name="" id="" cols="30" rows="10" placeholder=""></textarea>
                    </div>
                    <button type="submit" class="btn eventBtn">Add Event</button>
                </form>
            </div>

        </div>


    </div>

</div>
