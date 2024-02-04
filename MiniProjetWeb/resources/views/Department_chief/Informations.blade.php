@extends('layouts.sidebar')

@section('content')
<div class="container">
    <div class="all-users-info">
        <h1>Informations du Professeur</h1>
        <div class="info-section">
            <h3>Nom</h3>
            <p>{{ $professeur->nom }} {{ $professeur->prenom }}</p>
        </div>
        
        <div class="info-section">
            <h3>Code</h3>
            <p>{{ $professeur->Code_prof }}</p>
        </div>
        
        <div class="info-section">
            <h3>Nom Utilisateur</h3>
            <p>{{ $professeur->user->name }}</p>
        </div>
        
        <div class="info-section">
            <h3>Email</h3>
            <p>{{ $professeur->user->email }}</p>
        </div>

        @if($professeur->departement)
            <div class="info-section">
                <h3>Chef du Department</h3>
                <p>{{ $professeur->departement->nom_departement }}</p>
            </div>
        @endif

        @if($professeur->filiere)
            <div class="info-section">
                <h3>Filiere</h3>
                <p>{{ $professeur->filiere->nom_filiere }}</p>
            </div>
        @endif

        @if($professeur->cours && $professeur->cours->count())
            <div class="info-section">
                <h3>Cours</h3>
                <ul>
                    @foreach($professeur->cours as $cours)
                        <li>{{ $cours->module->nom_module ?? 'Module not set' }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
</div>

@include('Department_chief.home')

@endsection

