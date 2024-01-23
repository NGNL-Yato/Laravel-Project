@extends('layouts.sidebar')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="link-container col-md-4">
                <a href="{{ URL('Educational_Service/Salle?type=departement') }}" class="link-block">Salles du Département</a>
            </div>
            <div class="link-container col-md-4">
                <a href="{{ URL('Educational_Service/Salle?type=service_pedagogique') }}" class="link-block">Salles du Service pédagogique</a>
            </div>
        </div>
    </div>
@endsection

@include('Educational_Service.home')
