@extends('layouts.sidebar')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="link-container col-md-4">
                <a href="{{URL('Educational_Service/professeur')}}" class="link-block">Mes Annonces</a>
            </div>
            <div class="link-container col-md-4">
                <a href="{{URL('Educational_Service/etudiant')}}" class="link-block">Annonces Publiées</a>
            </div>
        </div>
    </div>
@endsection

@include('Professor.home')