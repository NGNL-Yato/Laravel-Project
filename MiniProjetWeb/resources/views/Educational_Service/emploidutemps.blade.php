@extends('layouts.sidebar')

@section('content')
<div id="emploiSection">
    <div class="filter">
        <select id="salleFilter" style="width:120px;" onchange="location = this.value;">
            <option value="">Select Salle</option>
            @foreach($salles as $salle)
                <option value="{{ url('Educational_Service/emploidutemps/' . $salle->id) }}">@switch ($salle->type_salle)
                    @case(1)
                        TP
                        @break
                    @case(2)
                        Normal
                        @break
                    @case(3)
                        Amphi
                        @break
                    @case(4)
                        Autre
                        @break
                    @default
                        N/A
                    @endswitch- {{ $salle->nom_salle }}</option>
            @endforeach
        </select>
    </div>
    <div class="container">
        @if (URL::current() != URL::to('/Educational_Service/emploidutemps'))
            <div class="section-title">
                <h3>Emploi du temps de la salle : 
                    <br />

                    @switch ($currentsalle->type_salle)
                        @case(1)
                            TP
                            @break
                        @case(2)
                            Normal
                            @break
                        @case(3)
                            Amphi
                            @break
                        @case(4)
                            Autre
                            @break
                        @default
                            N/A
                    @endswitch
                    {{ $currentsalle->nom_salle }}
                </h3>
            </div>
            <br />
    </div>
        <div class="cd-schedule loading">
            <div class="timeline">
                <div class="week-navigation">
                    <button class="prev-week"><</button>
                    <button class="next-week">></button>
                </div>
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
                                <form method="POST" action="{{ route('department_chief.emploi.destroy', $sceance->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="background: none; border: none; color: red; cursor: pointer;">X</button>
                                </form>
                                @if($sceance->classe && $sceance->classe->Numero_groupe != null)
                                {{ $sceance->classe->Numero_groupe }} - {{ $sceance->classe->filiere->abreviation_nomfiliere }} | {{ $sceance->cours->module->nom_module }}
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
    </div>

    
    <div class="overlay" style="display: none;">
        <div class="event-modal">
            <div class="add_event hidden-form">
                <form method="POST" action="{{ route('educational_service.sceance.store') }}">
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
                            <option value="{{ $cours->id }}" data-id-class="{{ $cours->id_class }}">Groupe {{ $cours->classe->Numero_groupe }}-{{ $cours->classe->filiere->nom_filiere }} - {{ $cours->module->nom_module }}</option>
                        @endforeach
                    </select>
                    <input type="hidden" id="id_class" name="id_class">
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
    @else
    <h1 style="margin:100px">Choisir une salle </h1>
    @endif
</div>

@include('Educational_Service.home')

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var urlPath = window.location.pathname;
        var urlPathParts = urlPath.split('/');
        var id_salle = urlPathParts[urlPathParts.length - 1];
        document.getElementById('id_salle').value = id_salle;

        var emploiCase = document.querySelectorAll(".emploi-case");
        var eventForm = document.querySelector(".add_event");
        var overlay = document.querySelector(".overlay");
        var prevWeekButton = document.querySelector(".prev-week");
    var nextWeekButton = document.querySelector(".next-week");

    prevWeekButton.addEventListener("click", function() {
        firstDayDate.setDate(firstDayDate.getDate() - 7);
        updateDates();
    });

    nextWeekButton.addEventListener("click", function() {
        firstDayDate.setDate(firstDayDate.getDate() + 7);
        updateDates();
    });

    function updateDates() {
        dateElements.forEach((dateElement, index) => {
            var date = new Date(firstDayDate);
            date.setDate(date.getDate() + index);
            dateElement.textContent = date.getDate() + '/' + (date.getMonth() + 1) + '/' + date.getFullYear();
            dateElement.dataset.month = date.getMonth() + 1;
            dateElement.dataset.year = date.getFullYear();
        });
    }
        var firstDayDate = new Date();
        firstDayDate.setDate(firstDayDate.getDate() - firstDayDate.getDay() + 1);

        var dateElements = document.querySelectorAll(".date");

        dateElements.forEach((dateElement, index) => {
            var date = new Date(firstDayDate);
            date.setDate(date.getDate() + index);
            dateElement.textContent = date.getDate() + '/' + (date.getMonth() + 1) + '/' + date.getFullYear();
            dateElement.dataset.month = date.getMonth() + 1;
            dateElement.dataset.year = date.getFullYear();
        });

        var duplicateInfo = document.querySelector("#DuplicateInfo");
        emploiCase.forEach((caseElement) => {
            caseElement.addEventListener("click", (event) => {
                event.stopPropagation();
                if (!caseElement.classList.contains("hour-case") && !caseElement.classList.contains("occupied") && caseElement.innerHTML.trim() === '') {
                    eventForm.style.display = 'block';
                    overlay.style.display = 'block';

                    var dayIndex = caseElement.dataset.day;
                    var time = caseElement.dataset.time;
                    var dateElement = document.querySelectorAll("th .date")[dayIndex];
                    var date = dateElement.textContent;
                    var month = dateElement.dataset.month;
                    var year = dateElement.dataset.year;

                    duplicateInfo.textContent = 'Réservation pour le ' + date + ' dans la tranche horaire : '+time;
                    
                    var horaireValue = document.getElementById('horaire');
                    var jourValue = document.getElementById('jour'); 
                    var semaineValue = document.getElementById('semaine');
                    var moisValue = document.getElementById('mois');
                    var anneeValue = document.getElementById('annee');
                    document.getElementById('id_cours').addEventListener('change', function() {
                        var selectedOption = this.options[this.selectedIndex];
                        var id_class = selectedOption.getAttribute('data-id-class');
                        document.getElementById('id_class').value = id_class;
                        console.log(id_class);
                    });                    
                    var IdSalle = document.getElementById('id_salle');


                    horaireValue.value = time.substring(0, 2);
                    jourValue.value = dayIndex;
                    semaineValue.value = date.split('/')[0]; 
                    moisValue.value = date.split('/')[1];
                    anneeValue.value = date.split('/')[2];
                    @if (URL::current() != URL::to('/Educational_Service/emploidutemps'))
                    IdSalle.value = {{ $currentsalle->id }};
                    @endif

                    
                }
            });
        });

        document.addEventListener("click", (event) => {
            if (!eventForm.contains(event.target) && eventForm.style.display === 'block') {
                eventForm.style.display = 'none';
                overlay.style.display = 'none';
            }
        });

        document.getElementById('submitButton').addEventListener('click', function(event) {
            var contenuDemande = document.getElementById('contenu_demande');
            var dateInfoText = duplicateInfo.textContent;
            contenuDemande.value = dateInfoText + '\n\n' + contenuDemande.value;
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
