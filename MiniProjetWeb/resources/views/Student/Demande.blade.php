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
                </div>
            @endforeach
        </div>

        <!-- Creation Form -->
        <div id="createDemandeForm" class="modal" style="display:none;">
            <div class="modal-content">
                <span class="close" onclick="editModal.style.display='none'">&times;</span>
                <form action="{{ route('student.store') }}" method="POST">
                    @csrf
                    <select id="creationTypeDemande" name="type_demande">
                        <option value="Demande de rendez-vous">Demande de rendez-vous</option>
                        <option value="Demande de lettre de recommandation">Demande de lettre de recommandation</option>
                        <option value="Justification d'une absence">Justification d'une absence</option>
                        <option value="Demande de changement de groupe de TP">Demande de changement de groupe de TP</option>
                        @if(auth()->user()->etudiant->delegue)
                        <option value="Signalement Matériel">Signalement Matériel</option>
                        @endif
                    </select>
                    <!-- Professor Selection -->
                    <select name="id_prof">
                        <option value="">Choose a professor</option>
                        @foreach($professeurs as $prof)
                            <option value="{{ $prof->id }}">{{ $prof->nom }} {{ $prof->prenom }}</option>
                        @endforeach
                    </select>

                    <textarea name="contenu_demande" placeholder="Content" required></textarea>

                    <input type="hidden" name="id_user" value="{{ auth()->user()->id }}">

                    <button type="submit">Create</button>
                </form>
            </div>
        </div>
    </div>
</div>

@include('Student.home')
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
</script>

@endsection
