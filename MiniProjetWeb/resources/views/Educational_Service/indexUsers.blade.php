@extends('layouts.sidebar')

@section('content')
    <div class="container index-formation">
        <div class="row justify-content-center">
            <div class="link-container col-md-4">
                <a href="{{URL('Educational_Service/professeur')}}" class="link-block"><i class='bx bxs-chalkboard' ></i> Professeur</a>
            </div>
            <div class="link-container col-md-4">
                <a href="{{URL('Educational_Service/etudiant')}}" class="link-block"><i class='bx bxs-graduation' ></i> Etudiants</a>
            </div>
            <div class="link-container col-md-4">
                <a href="{{URL('Educational_Service/users')}}" class="link-block"><i class='bx bxs-user'></i> Utilisateurs</a>
            </div>
        </div>
    </div>
@endsection

@include('Educational_Service.home')