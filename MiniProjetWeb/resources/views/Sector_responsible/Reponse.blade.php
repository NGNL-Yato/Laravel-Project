@extends('layouts.sidebar')

@section('content')
<div class="container">
    <div class="demande_div">
        <!-- Table for Showing Responses -->
        <div class="demande-container">
            @foreach($responses as $response)
                <div class="demande-card {{ $response->demande->etat_demande == 'traité' ? 'blue' : 'light-grey' }}">
                    <div class="demande-card {{ $response->demande->etat_demande == 'traité' ? 'blue' : 'light-grey' }}">
                        <h3>{{ $response->demande->type_demande }}</h3>
                        <p class="demande-text">{{ $response->content }}</p>
                        <p><strong>Response to:</strong> {{ $response->demande->contenu_demande }}</p>
                        <p><strong>From:</strong> {{ $response->user->email}}</p>
                        <p><strong>Demande sent by:</strong> {{ $response->demande->user->email }}</p>
                        <p><strong>Status:</strong> {{ $response->demande->etat_demande }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

@include('Sector_responsible.home')
@endsection