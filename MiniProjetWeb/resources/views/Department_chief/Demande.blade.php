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
                        <h3>{{ $demande->type_demande }}</h3>
                        <p class="demande-text">{{ $demande->contenu_demande }}</p>
                        <p><strong>Status:</strong> {{ $demande->etat_demande }}</p>
                        <p><strong>Envoyé par:</strong> {{ $demande->user->email}}</p>
                        <p><strong>Envoyé à:</strong> {{ $demande->professeur ? $demande->professeur->user->email : 'No professor selected' }}</p>                    
                    </div>
                    @if($demande->etat_demande == 'En cours de Traitement' && auth()->user()->id != $demande->id_user)
                <button class="Submit-Button" onclick="openModal('response-form-{{ $demande->id }}')">Répondre</button>
                @endif
                </div>
                <div id="response-form-{{ $demande->id }}" class="modal">
                    <div class="modal-inner">
                        <div class="modal-content">
                    <span class="close" onclick="closeModal('response-form-{{ $demande->id }}')">&times;</span>
                    <form action="{{ route('Department_chief.Demande.store') }}" method="POST">
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

                </div>
            @endforeach
        </div>

        <!-- Creation Form -->
        <div id="createDemandeForm" class="modal" style="display:none;">
            <div class="modal-content">
                <span class="close" onclick="editModal.style.display='none'">&times;</span>
                <form action="{{ route('Department_chief.Demande.store') }}" method="POST">
                    @csrf
                    <select id="creationTypeDemande" name="type_demande">
                        <option value="Demande de rendez-vous">Demande de rendez-vous</option>
                        <option value="Demande de lettre de recommandation">Demande de lettre de recommandation</option>
                        <option value="Convocation">Convocation</option>
                    </select>                    
                    <textarea name="contenu_demande" placeholder="Content" required></textarea>
                    <select id="professorInput" name="id_prof">
                        <option value="">Select a professor (optional)</option>
                        @foreach($professors as $professor)
                            <option value="{{ $professor->id }}">
                                {{ $professor->nom }} {{ $professor->prenom }}
                                @foreach($departements as $departement)
                                    @if($departement->professeur->id == $professor->id) - {{ $departement->nom_departement }}
                                    @endif
                                @endforeach
                                @foreach($filieres as $filiere)
                                    @if($filiere->professeur->id == $professor->id) - {{ $filiere->nom_filiere }}
                                    @endif
                                @endforeach
                            </option>
                        @endforeach
                    </select>

                    <button type="submit">Create</button>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>

@include('Department_chief.home')
<script>
    // Get the modal
    var createModal = document.getElementById("createDemandeForm");
    var editModal = document.getElementById("editDemandeForm");

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
    function openModal(id) {
        var modal = document.getElementById(id);
        modal.style.display = "block";
    }

    function closeModal(id) {
        var modal = document.getElementById(id);
        modal.style.display = "none";
    }
    // Get all modals
    var modals = document.getElementsByClassName('modal');

    // Function to close modal
    function closeModalOnOutsideClick(event) {
    for (var i = 0; i < modals.length; i++) {
        var modal = modals[i];
        var modalInner = modal.getElementsByClassName('modal-inner')[0];
        if (event.target == modal && event.target != modalInner) {
            modal.style.display = "none";
        }
    }
}
function closeModal(id) {
    document.getElementById(id).style.display = "none";
}    window.onclick = closeModalOnOutsideClick;
</script>

@endsection



