@extends('layouts.sidebar')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="link-container col-md-4">
                <a href="{{URL('Educational_Service/formation')}}" class="link-block">Formations Disponibles</a>
            </div>
            <div class="link-container col-md-4">
                <a href="{{URL('Educational_Service/filiere')}}" class="link-block">Filières</a>
            </div>
            <div class="link-container col-md-4">
                <a href="{{URL('Educational_Service/departement')}}" class="link-block">Départements</a>
            </div>
            <div class="link-container col-md-4">
                <a href="{{URL('Educational_Service/info_filiere')}}" class="link-block">Informations Relatives aux filières</a>
            </div>
        </div>
    </div>
@endsection

@include('Educational_Service.home')