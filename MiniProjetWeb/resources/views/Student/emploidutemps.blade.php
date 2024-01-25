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

@include('Student.home')

@endsection
