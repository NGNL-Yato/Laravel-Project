@extends('layouts.sidebar')

@section('content')
    <div class="container index-formation">
        <div class="row justify-content-center">
            <div class="link-container col-md-4">
                <a href="{{URL('Educational_Service/formation')}}" class="link-block"><i class='bx bxs-graduation'></i>                    Formations Disponibles</a>
            </div>
            <div class="link-container col-md-4">
                <a href="{{URL('Educational_Service/filiere')}}" class="link-block"><i class='bx bxs-book-open'></i> Filières</a>
            </div>
            <div class="link-container col-md-4">
                <a href="{{URL('Educational_Service/departement')}}" class="link-block"><i class='bx bxs-building'></i> Départements</a>
            </div>
            <div class="link-container col-md-4">
                <a href="{{URL('Educational_Service/info_filiere')}}" class="link-block"><i class='bx bxs-detail'></i> Informations Relatives aux filières</a>
            </div>
            <div class="link-container col-md-4">
                <a href="{{URL('Educational_Service/module')}}" class="link-block"><i class='bx bx-pencil'></i> Modules</a>
            </div>
            <div class="link-container col-md-4">
                <a href="{{URL('Educational_Service/cours')}}" class="link-block"><i class='bx bxs-edit'></i>Affectations Modules</a>
            </div>
        </div>
    </div>
@endsection

@include('Educational_Service.home')