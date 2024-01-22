@extends('layouts.sidebar')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="link-container col-md-4">
                <a href="{{URL('Educational_Service/professeur')}}" class="link-block">Professeur</a>
            </div>
            <div class="link-container col-md-4">
                <a href="{{URL('Educational_Service/etudiant')}}" class="link-block">Etudiants</a>
            </div>
            <div class="link-container col-md-4">
                <a href="{{URL('Educational_Service/users')}}" class="link-block">Utilisateurs</a>
            </div>
        </div>
    </div>
@endsection

@include('Educational_Service.home')