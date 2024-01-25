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
                    </div>
                    <div class="demande-actions">
                        @if(auth()->user()->id == $demande->id_user)
                        <button class="editDemandeButton" 
                        data-id="{{ $demande->id }}"
                        data-type-demande="{{ $demande->type_demande }}"
                        data-contenu-demande="{{ $demande->contenu_demande }}"
                        data-etat-demande="{{ $demande->etat_demande }}"
                        data-id-prof="{{ $demande->id_prof }}">
                        🖉
                        </button>
                        <form action="{{ route('student.destroy', $demande->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" id="delet-form-bt">&times;</button>
                        </form>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Edit Form (Hidden Initially) -->
        <div id="editDemandeForm" class="modal" style="display:none;">
            <div class="modal-content">
                <span class="close" onclick="editModal.style.display='none'">&times;</span>
                <form id="editDemandeFormContent" method="POST">
                    @csrf
                    @method('PUT')
                    {{-- <select id="editEtatDemande" name="etat_demande">
                        <option value="Traité">Traité</option>
                        <option value="En cours de Traitement">En cours de Traitement</option>
                        <option value="Refusé">Refusé</option>
                    </select> --}}
                    
                    <select id="editTypeDemande" name="type_demande">
                        <option value="Demande de rendez-vous">Demande de rendez-vous</option>
                        <option value="Demande de lettre de recommandation">Demande de lettre de recommandation</option>
                        <option value="Justification d'une absence">Justification d'une absence</option>
                        <option value="Demande de changement de groupe de TP">Demande de changement de groupe de TP</option>
                        @if(auth()->user()->etudiant->delegue)
                        <option value="Signalement Matériel">Signalement Matériel</option>
                        @endif
                    </select>
                    <input type="hidden" name="id_user" value="{{ auth()->user()->id }}">
                    <textarea id="editContenuDemande" name="contenu_demande" placeholder="Content"></textarea>

                    <button type="submit">Update</button>
                </form>          
            </div>  
        </div>

        <!-- Creation Form -->
        <div id="createDemandeForm" class="modal" style="display:none;">
            <div class="modal-content">
                <span class="close" onclick="editModal.style.display='none'">&times;</span>
                <form action="{{ route('student.store') }}" method="POST">
                    @csrf
                     {{--<select name="etat_demande">
                        <option value="Traité">Traité</option>
                        <option value="En cours de Traitement">En cours de Traitement</option>
                        <option value="Refusé">Refusé</option>
                    </select>
                     --}}
                    <select id="creationTypeDemande" name="type_demande">
                        <option value="Demande de rendez-vous">Demande de rendez-vous</option>
                        <option value="Demande de lettre de recommandation">Demande de lettre de recommandation</option>
                        <option value="Justification d'une absence">Justification d'une absence</option>
                        <option value="Demande de changement de groupe de TP">Demande de changement de groupe de TP</option>
                        @if(auth()->user()->etudiant->delegue)
                        <option value="Signalement Matériel">Signalement Matériel</option>
                        @endif
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
