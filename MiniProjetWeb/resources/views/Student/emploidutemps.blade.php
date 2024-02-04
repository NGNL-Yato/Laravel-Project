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
                                {{ $sceance->cours->module->nom_module }}
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
    </div>
</div>

@include('Student.home')

<script>
document.addEventListener("DOMContentLoaded", function() {
    var firstDayDate = new Date();
    firstDayDate.setHours(0, 0, 0, 0); // reset the time
    while (firstDayDate.getDay() !== 1) { //start with the monday 
        firstDayDate.setDate(firstDayDate.getDate() - 1);
    }

    var dateElements = document.querySelectorAll('.date');

    dateElements.forEach((dateElement, index) => {
        var date = new Date(firstDayDate);
        date.setDate(date.getDate() + index);
        var options = { year: 'numeric', month: '2-digit', day: '2-digit' };
        dateElement.textContent = new Intl.DateTimeFormat('fr-FR', options).format(date);
    });
});
</script>
@endsection
