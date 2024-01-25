@extends('layouts.sidebar')

@section('content')
<div class="container">
    <div class="all-users-info">
        <h1>Student Information</h1>
        <div class="info-section">
            <h3>Name</h3>
            <p>{{ $etudiant->nom }} {{ $etudiant->prenom }}</p>
        </div>
        
        <div class="info-section">
            <h3>Code</h3>
            <p>{{ $etudiant->CNE }}</p>
        </div>
        
        <div class="info-section">
            <h3>User Name</h3>
            <p>{{ $etudiant->user->name }}</p>
        </div>
        
        <div class="info-section">
            <h3>User Email</h3>
            <p>{{ $etudiant->user->email }}</p>
        </div>

        <div class="info-section">
            <h3>Filiere</h3>
            <p>{{ $etudiant->classe->filiere->nom_filiere }}</p>
        </div>

        <div class="info-section">
            <h3>Groupe</h3>
            <p>{{ $etudiant->classe->Numero_groupe }}</p>
        </div>
    </div>
</div>

@include('Student.home')

@endsection