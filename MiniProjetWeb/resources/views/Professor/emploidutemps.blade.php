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
                            <th>Time</th>
                            <th>Lundi</th>
                            <th>Mardi</th>
                            <th>Mercredi</th>
                            <th>Jeudi</th>
                            <th>Vendredi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $times = ['9 - 10h45', '11 - 12h45', '13 - 14h45', '15 - 16h45', '17 - 18h45'];
                        $days = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi'];
                        @endphp
                        @foreach($times as $time)
                        <tr>
                            <td>{{ $time }}</td>
                            @foreach($days as $day)
                            <td>
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
            <div class="add_event">
            
            <form action="">
                <div class="formBx">
                    <label for="">Titre</label>
                    <div class="inputBx">
                        <input type="text">
                    </div>
                </div>
                <div class="formBx">
                    <label for="">Type de sceance</label>
                    <div class="inputBx">
                        <input type="text">
                    </div>
                </div>
                <div class="formBx">
                    <label for="">Classe</label>
                    <div class="inputBx">
                        <input type="text">
                    </div>
                </div>
                <div class="formBx">
                    <label for="">Departement</label>
                    <div class="inputBx">
                        <input type="text">
                    </div>
                </div>
                <button type="submit" class="btn eventBtn">Add Event</button>
            </form>
        </div>
    </div>
</div>


@include('Professor.home')

@endsection
