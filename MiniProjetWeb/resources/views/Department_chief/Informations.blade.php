@extends('layouts.sidebar')

@section('content')
<div class="container">
    <div class="all-users-info">
        <h1>Profile</h1>
        <div class="info-section">
            <h3>Name</h3>
            <p>{{ $departmentChief->professeur->nom }} {{ $departmentChief->professeur->prenom }}</p>
        </div>
        
        <div class="info-section">
            <h3>Code</h3>
            <p>{{ $departmentChief->professeur->Code_prof }}</p>
        </div>
        
        <div class="info-section">
            <h3>User Name</h3>
            <p>{{ $departmentChief->professeur->user->name }}</p>
        </div>
        
        <div class="info-section">
            <h3>User Email</h3>
            <p>{{ $departmentChief->professeur->user->email }}</p>
        </div>

        <div class="info-section">
            <h3>Chef du Department</h3>
            <p>{{ $departmentChief->nom_departement }}</p>
        </div>

        @if($professeur->cours && $professeur->cours->count())
            <div class="info-section">
                <h3>Modules</h3>
                <ul>
                    @foreach($professeur->cours as $cours)
                        <li>{{ $cours->module->nom_module ?? 'Module not set' }} ({{ $cours->classe->nom_classe ?? 'Class not set' }})</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
</div>

@include('Department_chief.home')

@endsection
