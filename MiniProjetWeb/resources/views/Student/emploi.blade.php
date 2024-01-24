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
                    <tr>
                        <th class = "Empty_Space"></th><!--Empty to leave a space in the first td-->
                        @foreach($jours as $jour)
                            <th>{{ $jour->nom }}</th>
                        @endforeach
                    </tr>
                    @foreach($horaires as $horaire)
                        <tr>
                            <td class="hour-case">{{ $horaire->heure_debut }} - {{ $horaire->heure_fin }}</td>
                            @foreach($jours as $jour)
                                <td>  </td>
                            @endforeach
                        </tr>
                    @endforeach
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
                    <label for="">departement</label>
                    <div class="inputBx">
                        <input type="text">
                    </div>
                </div>
                <button type="submit" class="btn eventBtn">Add Event</button>
            </form>
        </div>
    </div>
</div>
@endsection

@include('Etudiant.home')