@extends('layouts.sidebar')

@section('content')
<div class="container">
    <div class="all-users-info">
        <h1>Profile</h1>
        <div class="info-section">
            <h3>Name</h3>
            <p>{{ $professeur->nom }} {{ $professeur->prenom }}</p>
        </div>
        
        <div class="info-section">
            <h3>Code</h3>
            <p>{{ $professeur->Code_prof }}</p>
        </div>
        
        <div class="info-section">
            <h3>User Name</h3>
            <p>{{ $professeur->user->name }}</p>
        </div>
        
        <div class="info-section">
            <h3>User Email</h3>
            <p>{{ $professeur->user->email }}</p>
        </div>
        @if($professeur->cours && $professeur->cours->count())
            <div class="info-section">
                <h3>Courses Taught</h3>
                <ul>
                    @foreach($professeur->cours as $cours)
                        <li>{{ $cours->module->nom_module ?? 'Module not set' }} ({{ $cours->classe->nom_classe ?? 'Class not set' }})</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
</div>

@include('Professor.home')

@endsection
