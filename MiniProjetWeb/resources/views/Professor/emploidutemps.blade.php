@extends('layouts.sidebar')

@section('content')
<div id="emploiSection">
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
                            $times = [' 09h00  -  10h45 ', '  11h00  -  12h45  ', '  13h00  -  14h45  ', '  15h00  -  16h45  ', '  17h00  -  18h45  '];
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
                                @if($sceance->day == $day && $sceance->time == $time)
                                {{ $sceance->title }}
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
                    <form method="POST" action="{{ route('Professor.Demande.store') }}">
                        @csrf
                        <div class="form-group">
                            <p id="DuplicateInfo"></p>
                            <p id="dateInfo">Date :</p>
                            <label for="contenu_demande">Contenu Demande</label>
                            <textarea id="contenu_demande" name="contenu_demande" class="form-control" required></textarea>
                        </div>
                        <input type="hidden" id="dateInfoInput" name="dateInfo">
                    <button type="submit" id="submitButton">Submit</button>                
                </form>
            </div>
        </div>
    </div>
</div>

@include('Professor.home')

<script>
    document.addEventListener("DOMContentLoaded", function() {
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

        var dateInfo = document.querySelector("#dateInfo");
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
                            du.textContent = 'Réservation pour le ' + date +'/'+month+'/'+ year + '  dans la tranche horaire : '+time;

                            dateInfo.textContent = 'Day Index: ' + dayIndex + ', Time: ' + time + ', Date: ' + date + ', Month: ' + month + ', Year: ' + year;

                            // Add the data-day and data-time to the dateInfo paragraph
                            dateInfo.dataset.day = dayIndex;
                            dateInfo.dataset.time = time;

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
                var dateInfoText = dateInfo.textContent;

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
