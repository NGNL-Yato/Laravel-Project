@extends('layouts.sidebar')

@section('content')
<div class="container">
    <div class="demande_div">
        <!-- Table for Showing Demandes -->
        <div class="demandes-container">
            @foreach($demandes as $demande)
                    <div class="demande-card">
                        <div class="demande-content">
                            <h3>{{  $demande->type_demande }}</h3>
                            <p class="demande-text">{{ $demande->contenu_demande }}</p>
                            <p><strong>Status:</strong> {{ $demande->etat_demande }}</p>
                            <p><strong>Envoyé par:</strong> {{ $demande->user->email}}</p>
                            <p><strong>Envoyé à:</strong> {{ $demande->professeur ? $demande->professeur->user->email : 'No professor selected' }}</p>                    
                        </div>
                        @if($demande->etat_demande == 'En cours de Traitement' && $demande->id_user != auth()->user()->id)
                        <button class="Submit-Button" onclick="openModal('response-form-{{ $demande->id }}')">Répondre</button>
                        @endif
                    </div>
                <div id="response-form-{{ $demande->id }}" class="modal">
                    <div class="modal-content">
                        <span class="close" onclick="closeModal('response-form-{{ $demande->id }}')">&times;</span>
                        <form action="{{ route('responses.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="demande_id" value="{{ $demande->id }}">
                            <textarea name="content" required></textarea>
                            <select name="etat_demande">
                                <option value="Traité">Traité</option>
                                <option value="Refusé">Refusé</option>
                            </select>
                            <button type="submit">Envoyer la réponse</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@include('Professor.home')
<script>
function openModal(id) {
    var modal = document.getElementById(id);
    modal.style.display = "block";

    // Close the modal when the user clicks outside of the modal content
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
}

function closeModal(id) {
    document.getElementById(id).style.display = "none";
}
</script>

@endsection