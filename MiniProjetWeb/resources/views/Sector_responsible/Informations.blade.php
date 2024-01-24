@extends('layouts.sidebar')

@section('content')
<div class="container">
    <div class="professor-info">
        <h1>Sector_responsible Information</h1>
        <p><strong>Name:</strong> {{ $professeur->nom }} {{ $professeur->prenom }}</p>
        <p><strong>Code:</strong> {{ $professeur->Code_prof }}</p>
        <p><strong>User Name:</strong> {{ $professeur->user->name }}</p>
        <p><strong>User Email:</strong> {{ $professeur->user->email }}</p>

        @if($professeur->departement)
            <h3>Chef du Department</h3>
            <p>{{ $professeur->departement->nom_departement }}</p>
        @endif

        @if($professeur->filiere)
            <h3>Filiere</h3>
            <p>{{ $professeur->filiere->nom_filiere }}</p>
        @endif

        @if($professeur->cours && $professeur->cours->count())
            <h3>Courses Taught</h3>
            <ul>
                @foreach($professeur->cours as $cours)
                    <li>{{ $cours->module->nom_module ?? 'Module not set' }} ({{ $cours->classe->nom_classe ?? 'Class not set' }})</li>
                @endforeach
            </ul>
        @endif
    </div>
</div>

@include('Sector_responsible.home')

@endsection

