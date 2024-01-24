@extends('layouts.sidebar')

@section('content')
<div class="container">
    <div class="annonce_div">
        <!-- Button to Show/Hide Creation Form -->
        <button id="showCreateAnnonceForm">Add New Annonce</button>

        <!-- Table for Showing Annonces -->
        <div class="annonces-container">
            @foreach($annonces as $annonce)
                <div class="annonce-card">
                    <div class="annonce-content">
                        <h3>{{ $annonce->titre_annonce }}</h3>
                        <p class="annonce-text">{{ $annonce->contenu_annonce }}</p>
                        <!-- Additional Details -->
                        <div class="annonce-details">
                            <p><strong>Visibility:</strong> {{ $annonce->visibilite_annonce }}</p>
                            <p><strong>Target:</strong> {{ $annonce->cible_annonce }}</p>
                            <p><strong>Type:</strong> {{ $annonce->type_annonce }}</p>
                            <p><strong>Posted by:</strong> {{ $annonce->user->name }}</p>
                        </div>
                    </div>
                    <div class="annonce-actions">
                        @if(auth()->user()->id == $annonce->id_user)
                        <button class="editAnnonceButton" 
                        data-id="{{ $annonce->id }}"
                        data-titre-annonce="{{ $annonce->titre_annonce }}"
                        data-contenu-annonce="{{ $annonce->contenu_annonce }}"
                        data-visibilite-annonce="{{ $annonce->visibilite_annonce }}"
                        data-cible-annonce="{{ $annonce->cible_annonce }}"
                        data-type-annonce="{{ $annonce->type_annonce }}">
                        🖉
                        </button>
                        <form action="{{ route('sector_responsible.destroyAnnonce', $annonce->id) }}" method="POST">
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
        <div id="editAnnonceForm" class="modal" style="display:none;">
            <div class="modal-content">
                <span class="close" onclick="editModal.style.display='none'">&times;</span>
                <form id="editAnnonceFormContent" method="POST">
                    @csrf
                    @method('PUT')
                    <select id="editVisibiliteAnnonce" name="visibilite_annonce">
                        <option value="visible">Visible</option>
                        <option value="invisible">Invisible</option>
                    </select>

                    <select id="editCibleAnnonce" name="cible_annonce">
                        <option value="Etudiants">All Students</option>
                        @foreach($classes as $class)
                            <option value="{{ $class->id }}">{{ $class->Numero_groupe }} - {{ $class->filiere->nom_filiere }}</option>
                        @endforeach
                    </select>

                    <select id="editTypeAnnonce" name="type_annonce">
                        <option value="Information">Information</option>
                        <option value="Report Examen">Report Examen</option>
                        <option value="Annulation d’une séance">Annulation d’une séance</option>
                        <option value="CC">CC</option>
                    </select>

                    <input type="text" id="editTitreAnnonce" name="titre_annonce" placeholder="Title">
                    <textarea id="editContenuAnnonce" name="contenu_annonce" placeholder="Content"></textarea>
                    
                    <input type="hidden" name="id_user" value="{{ auth()->user()->id }}">

                    <button type="submit">Update</button>
                </form>          
            </div>  
        </div>


        <!-- Creation Form -->
        <div id="createAnnonceForm" class="modal" style="display:none;">
            <div class="modal-content">
                <span class="close" onclick="editModal.style.display='none'">&times;</span>
                <form action="{{ route('sector_responsible.storeAnnonce') }}" method="POST">
                    @csrf
                    <select name="visibilite_annonce">
                        <option value="visible">Visible</option>
                        <option value="invisible">Invisible</option>
                    </select>

                    <select name="cible_annonce">
                        <option value="Etudiants">All Students</option>
                        @foreach($classes as $class)
                            <option value="{{ $class->id }}">{{ $class->Numero_groupe }} - {{ $class->filiere->nom_filiere }}</option>
                        @endforeach
                    </select>

                    <select name="type_annonce">
                        <option value="Information">Information</option>
                        <option value="Report Examen">Report Examen</option>
                        <option value="Annulation d’une séance">Annulation d’une séance</option>
                    </select>

                    <input type="text" name="titre_annonce" placeholder="Title" required>                    
                    <input type="hidden" name="id_user" value="{{ auth()->user()->id }}">
                    <textarea name="contenu_annonce" placeholder="Content" required></textarea>
                    
                    <button type="submit">Create</button>
                </form>
            </div>
        </div>
    </div>
</div>

@include('Sector_responsible.home')

<script>
    // Get the modal
    var createModal = document.getElementById("createAnnonceForm");
    var editModal = document.getElementById("editAnnonceForm");

    // Get the button that opens the modal
    var createBtn = document.getElementById("showCreateAnnonceForm");

    // Get the <span> element that closes the modal
    var createSpan = createModal.getElementsByClassName("close")[0];
    var editSpan = editModal.getElementsByClassName("close")[0];

    // When the user clicks the button, open the modal 
    createBtn.onclick = function() {
        createModal.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    createSpan.onclick = function() {
        createModal.style.display = "none";
    }

    editSpan.onclick = function() {
        editModal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == createModal) {
            createModal.style.display = "none";
        }
        if (event.target == editModal) {
            editModal.style.display = "none";
        }
    }

    // Populate the edit form
    var editButtons = document.getElementsByClassName("editAnnonceButton");
    for (var i = 0; i < editButtons.length; i++) {
        editButtons[i].onclick = function() {
            document.getElementById("editTitreAnnonce").value = this.dataset.titreAnnonce;
            document.getElementById("editContenuAnnonce").value = this.dataset.contenuAnnonce;
            document.getElementById("editVisibiliteAnnonce").value = this.dataset.visibiliteAnnonce;
            document.getElementById("editCibleAnnonce").value = this.dataset.cibleAnnonce;
            document.getElementById("editTypeAnnonce").value = this.dataset.typeAnnonce;
            document.getElementById("editAnnonceFormContent").action = "/filiereResponsible/annonce/" + this.dataset.id;
            editModal.style.display = "block";
        }
    }
</script>
@endsection
