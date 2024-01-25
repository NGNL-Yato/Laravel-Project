@extends('layouts.sidebar')

@section('content')
<div id="emploiSection">
    <div class="filter">
        <select id="salleFilter" onchange="location = this.value;">
            <option value="">Select Salle</option>
            @foreach($salles as $salle)
                <option value="{{ url('Educational_Service/emploidutemps/' . $salle->id) }}">{{ $salle->nom_salle }}</option>
            @endforeach
        </select>
    </div>
    <div class="container">
        <div class="section-title">
            <h3>Emploi du temps</h3>
        </div>
         <br />
        <div class="cd-schedule loading">
            <div class="timeline">
                <table class="emploi-temps">
                    <thead>
                        <tr>
                            <th></th> 
                            @php
                            $times = ['09h00  -  10h45', '11h00  -  12h45', '13h00  -  14h45', '15h00  -  16h45', '17h00  -  18h45'];
                            $days = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi'];
                            @endphp
                            @foreach($days as $day)
                            <th>{{ $day }} <span class="date"></span></th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($times as $time)
                        <tr>
                            <td class="emploi-case">{{ $time }}</td>
                            @foreach($days as $index => $day)
                            <td class="emploi-case" data-day="{{ $index }}" data-time="{{ $time }}">
                                @foreach($sceances as $sceance)
                                @if($sceance->jour == $index && $sceance->horaire == intval(substr($time, 0, 2)))
                                @if($sceance->classe && $sceance->classe->Numero_groupe != null)
                                {{ $sceance->classe->Numero_groupe }} {{ $sceance->classe->filiere->nom_filiere }} - {{ $sceance->cours->module->nom_module }}
                                @else
                                {{ $sceance->type_sceance}}
                                @endif
                                @endif  
                                @endforeach
                            </td>
                            @endforeach
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div> <!-- .timeline -->
        <div class="overlay">
            <div class="event-modal">
                <div class="add_event hidden-form">
                        <form method="POST" action="{{ route('Department_chief.sceance.store') }}">
                            @csrf
                            <h2 id='DuplicateInfo' ></h2>
                            <label for="etat_sceance">Etat Sceance:</label>
                            <select id="etat_sceance" name="etat_sceance">
                                <option value="programme">Programmé</option>
                                <option value="potentiel">Potentiel</option>
                                <option value="annule">Annulé</option>
                            </select>

                            <label for="type_sceance">Type Sceance:</label>
                            <select id="type_sceance" name="type_sceance">
                                <option value="TP">TP</option>
                                <option value="TD">TD</option>
                                <option value="Cours">Cours</option>
                                <option value="Other">Other</option>
                            </select>

                            <label for="id_cours">Cours:</label>
                            <select id="id_cours" name="id_cours">
                                @foreach($cours as $cours)
                                    <option value="{{ $cours->id }}">{{ $cours->classe->Numero_groupe }} {{ $cours->classe->filiere->nom_filiere }} - {{ $cours->module->nom_module }}</option>
                                @endforeach
                            </select>
                            <input type="hidden" id="id_salle" name="id_class">
                            <input type="hidden" id="id_salle" name="id_salle">
                            <input type="hidden" id="horaire" name="horaire">
                            <input type="hidden" id="jour" name="jour">
                            <input type="hidden" id="semaine" name="semaine">
                            <input type="hidden" id="mois" name="mois">
                            <input type="hidden" id="annee" name="annee">

                            <button type="submit">Create Sceance</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@include('Department_chief.home')

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var urlPath = window.location.pathname;
        var urlPathParts = urlPath.split('/');
        var id_salle = urlPathParts[urlPathParts.length - 1];
        document.getElementById('id_salle').value = id_salle;

        var emploiCase = document.querySelectorAll(".emploi-case");
        var eventForm = document.querySelector(".add_event");
        var textarea = document.querySelector("#contenu_demande");
        var overlay = document.querySelector(".overlay");
        // Get the date of the first day of the week (Monday)
        var firstDayDate = new Date();
        firstDayDate.setDate(firstDayDate.getDate() - firstDayDate.getDay() + 1);

        // Get the date elements
        var dateElements = document.querySelectorAll(".date");

        dateElements.forEach((dateElement, index) => {
            var date = new Date(firstDayDate);
            date.setDate(date.getDate() + index);
            dateElement.textContent = date.getDate();
            dateElement.dataset.month = date.getMonth() + 1; // JavaScript months are 0-based
            dateElement.dataset.year = date.getFullYear();
        });

        var duplicateInfo = document.querySelector("#DuplicateInfo");
            emploiCase.forEach((caseElement) => {
                if (caseElement.innerHTML.trim() === '') {
                    caseElement.addEventListener("click", (event) => {
                        event.stopPropagation();
                        if (!caseElement.classList.contains("hour-case") && !caseElement.classList.contains("occupied")) {
                            eventForm.style.display = 'block';
                            overlay.style.display = 'block';

                            // Retrieve the day data so that we can add it to the form and send it in the request 
                            var dayIndex = caseElement.dataset.day;
                            var time = caseElement.dataset.time;
                            var dateElement = document.querySelectorAll("th .date")[dayIndex];
                            var date = dateElement.textContent;
                            var month = dateElement.dataset.month;
                            var year = dateElement.dataset.year;

                            // Set the text of the dateInfo paragraph
                            duplicateInfo.textContent = 'Réservation pour le ' + date +'/'+month+'/'+ year + '  dans la tranche horaire : '+time;
                            
                            // retrieve the data inputs for later use
                            var horaireValue = document.getElementById('horaire');
                            var jourValue = document.getElementById('jour'); 
                            var semaineValue = document.getElementById('semaine');
                            var moisValue = document.getElementById('mois');
                            var anneeValue = document.getElementById('annee');
                            var IdClass = document.getElementById('id_class');

                            // Set the values of the input fields
                            horaireValue.value = time.substring(0, 2);
                            jourValue.value = dayIndex;
                            semaineValue.value = date; 
                            moisValue.value = month;
                            anneeValue.value = year;
                            IdClass.value = id_salle;


                            console.log(dateInfo.innerHTML);
                        }
                    });
                } else {
                    caseElement.classList.add("no-hover");
                }
            });

            document.addEventListener("click", (event) => {
                if (!eventForm.contains(event.target) && eventForm.style.display === 'block') {
                    eventForm.style.display = 'none';
                    overlay.style.display = 'none';
                }
            });

            document.getElementById('submitButton').addEventListener('click', function(event) {
                // Get the text content of the dateInfo paragraph

                // Add the dateInfo text to the contenu_demande textarea
                var contenuDemande = document.getElementById('contenu_demande');
                contenuDemande.value = dateInfoText + '\n\n' + contenuDemande.value;
            });

        document.addEventListener("click", (event) => {
            if (!eventForm.contains(event.target) && eventForm.style.display === 'block') {
                eventForm.style.display = 'none';
                overlay.style.display = 'none';
            }
        });

        document.addEventListener("click", (event) => {
            if (!eventForm.contains(event.target) && eventForm.style.display === 'block') {
                eventForm.style.display = 'none';
                overlay.style.display = 'none';
            }
        });
    });
</script>
@endsection
