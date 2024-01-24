{{-- professeurs/show.blade.php --}}
@extends('layouts.app') {{-- Use your layout --}}

@section('content')
    <div class="container">
        <h1>Professor Information</h1>
        <p><strong>Name:</strong> {{ $professeur->nom }} {{ $professeur->prenom }}</p>
        <p><strong>Code:</strong> {{ $professeur->Code_prof }}</p>

        {{-- Department Information --}}
        @if($professeur->departement)
            <h3>Department</h3>
            <p>{{ $professeur->departement->nom_departement }}</p>
        @else
            <p>No associated department.</p>
        @endif

        {{-- Filiere Information --}}
        @if($professeur->filiere)
            <h3>Filiere</h3>
            <p>{{ $professeur->filiere->nom_filiere }}</p>
        @else
            <p>No associated filiere.</p>
        @endif

        {{-- Courses Information --}}
        @if($professeur->cours->isNotEmpty())
            <h3>Courses Taught</h3>
            <ul>
                @foreach($professeur->cours as $cours)
                    <li>{{ $cours->module->nom_module }} - {{ $cours->classe->nom_classe }}</li>
                @endforeach
            </ul>
        @else
            <p>No courses taught.</p>
        @endif
    </div>
@endsection
