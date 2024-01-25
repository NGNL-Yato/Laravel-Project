@extends('layouts.sidebar')

@section('content')
<div class="container">
    <div class="demande_div">
        <!-- Button to Show Creation Form -->
        <button id="showCreateDemandeForm">Add New Demande</button>
        <!-- Table for Showing Demandes -->
        <div class="demandes-container">
            @foreach($demandes as $demande)
                <div class="demande-card">
                    <div class="demande-content">
                        <h3>{{  $demande->type_demande }}</h3>
                        <p class="demande-text">{{ $demande->contenu_demande }}</p>
                        <p><strong>Status:</strong> {{ $demande->etat_demande }}</p>
                        <p><strong>Envoyé par:</strong> {{ $demande->user->email}}</p>
                    </div>
                    @if($demande->etat_demande == 'En cours de Traitement'&& $demande->id_user != auth()->user()->id)
                    <button class="Submit-Button" onclick="openModal('response-form-{{ $demande->id }}')">Répondre</button>
                    @endif
                </div>
                <div id="response-form-{{ $demande->id }}" class="modal">
                    <div class="modal-content">
                        <span class="close" onclick="closeModal('response-form-{{ $demande->id }}')">&times;</span>
                        <form action="{{ route('department_chief.Demande.store') }}" method="POST">
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
        <!-- Creation Form -->
        <div id="createDemandeForm" class="modal" style="display:none;">
            <div class="modal-content">
                <span class="close" onclick="editModal.style.display='none'">&times;</span>
                <form action="{{ route('sector_responsible.store') }}" method="POST">
                    @csrf
                    <select id="creationTypeDemande" name="type_demande">
                        <option value="Demande de réunion">Demande de réunion</option>
                        <option value="Demande de ravitaillement">Demande de ravitaillement</option>
                        <option value="Justification de changement de bureau">Justification de changement de bureau</option>
                    </select>
                    <textarea name="contenu_demande" placeholder="Content" required></textarea>
                    <input type="hidden" name="id_user" value="{{ auth()->user()->id }}">
                    <button type="submit">Create</button>
                </form>
            </div>
        </div>
    </div>
</div>
@include('Sector_responsible.home')
<script>
    // Get the button that opens the modal
    var createBtn = document.getElementById("showCreateDemandeForm");

    // Get the <span> element that closes the modal
    var spans = document.getElementsByClassName("close");

    // When the user clicks the button, open the modal 
    createBtn.onclick = function() {
        createModal.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    for (let span of spans) {
        span.onclick = function() {
            createModal.style.display = "none";
            editModal.style.display = "none";
        }
    }

    // Close the modal if the user clicks anywhere outside of it
    window.onclick = function(event) {
        if (event.target == createModal) {
            createModal.style.display = "none";
        }
        if (event.target == editModal) {
            editModal.style.display = "none";
        }
    }

    // Event delegation for edit buttons
    document.addEventListener('click', function (event) {
        if (event.target.classList.contains('editDemandeButton')) {
            var demandeId = event.target.dataset.id;
        }
    });

    // Event delegation for edit buttons
    document.addEventListener('click', function (event) {
        if (event.target.classList.contains('editDemandeButton')) {
            var demandeId = event.target.dataset.id;
            var typeDemande = event.target.dataset.typeDemande;
            var contenuDemande = event.target.dataset.contenuDemande;

            // Set the form action
            document.getElementById('editDemandeFormContent').action = '/demande/' + demandeId;

            // Set the form values
            document.getElementById('editTypeDemande').value = typeDemande;
            document.getElementById('editContenuDemande').value = contenuDemande;
            document.getElementById('editEtatDemande').value = etatDemande;

            // Open the modal
            editModal.style.display = 'block';
        }
    }, false);

    // Close the modal when the user clicks outside of the modal content
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
    function openModal(id) {
    var modal = document.getElementById(id);
    modal.style.display = "block";
}
    function closeModal(id) {
        var modal = document.getElementById(id);
        modal.style.display = "none";
    }
</script>

@endsection