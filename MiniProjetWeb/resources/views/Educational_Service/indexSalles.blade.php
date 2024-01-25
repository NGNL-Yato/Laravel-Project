@extends('layouts.sidebar')

@section('content')
    <div class="container index-formation">
        <div class="row justify-content-center">
            <div class="link-container col-md-4">
                <a href="{{ URL('Educational_Service/Salle?type=departement') }}" class="link-block"><i class='bx bxs-building'></i> Salles du Département</a>
            </div>
            <div class="link-container col-md-4">
                <a href="{{ URL('Educational_Service/Salle?type=service_pedagogique') }}" class="link-block"><i class='bx bxs-server'></i> Salles du Service pédagogique</a>
            </div>
            <div class="link-container col-md-4">
                <a href="{{ URL('Educational_Service/Salle') }}" class="link-block"><i class='bx bxs-buildings'></i> Toutes les salles</a>
            </div>
        </div>
    </div>
@endsection

@include('Educational_Service.home')
