@extends('layouts.sidebar')

@section('content')
<div class="container">
    <div class="annonce_div">
        <!-- Table for Showing Annonces -->
        <div class="annonces-container">
            @foreach($annonces as $annonce)
                {{-- Apply background color only if id_class is null --}}
                <div class="annonce-card {{ is_null($annonce->id_class) ? '' : 'professor-background' }}">
                    <div class="annonce-content">
                        <h3>{{ $annonce->titre_annonce }}</h3>
                        <p class="annonce-text">{{ $annonce->contenu_annonce }}</p>
                        <div class="annonce-details">
                            <p><strong>Visibility:</strong> {{ $annonce->visibilite_annonce }}</p>
                            <p><strong>Target:</strong> {{ $annonce->cible_annonce }}</p>
                            <p><strong>Type:</strong> {{ $annonce->type_annonce }}</p>
                            <p><strong>Posted by:</strong> {{ $annonce->user->name }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

@include('Student.home')

@endsection
