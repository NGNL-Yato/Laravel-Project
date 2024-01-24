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
                            <p><strong>Class:</strong> {{ $annonce->classe->name ?? 'N/A' }}</p>
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
                        <form action="{{ route('annonce.destroy', $annonce->id) }}" method="POST">
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
                        <option value="Professeurs">Professeurs</option>
                        <option value="Etudiants">Etudiants</option>
                    </select>

                    <select id="editTypeAnnonce" name="type_annonce">
                        <option value="Annulation d’une séance">Annulation d’une séance</option>
                        <option value="CC">CC</option>
                        <option value="information">Information</option>
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
                <form action="{{ route('annonce.store') }}" method="POST">
                    @csrf
                    <select name="visibilite_annonce">
                        <option value="visible">Visible</option>
                        <option value="invisible">Invisible</option>
                    </select>

                    <select name="cible_annonce">
                        <option value="General">General</option>
                        <option value="Professeurs">Professeurs</option>
                        <option value="Etudiants">Etudiants</option>
                    </select>

                    <select name="type_annonce">
                        <option value="Annulation d’une séance">Annulation d’une séance</option>
                        <option value="CC">CC</option>
                        <option value="information">Information</option>
                    </select>

                    <input type="text" name="titre_annonce" placeholder="Title" required>
                    <textarea name="contenu_annonce" placeholder="Content" required></textarea>
                    
                    <input type="hidden" name="id_user" value="{{ auth()->user()->id }}">

                    <button type="submit">Create</button>
                </form>
            </div>
        </div>


    </div>
</div>

@include('Department_chief.home')

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Modal elements
    var editModal = document.getElementById('editAnnonceForm');
    var createModal = document.getElementById('createAnnonceForm');
    var spans = document.getElementsByClassName("close");

    // Show/Hide Create Annonce Form
    var showCreateAnnonceButton = document.getElementById('showCreateAnnonceForm');
    var createAnnonceForm = document.getElementById('createAnnonceForm');

    showCreateAnnonceButton.addEventListener('click', function() {
        createModal.style.display = 'block'; // Show the create modal
    });

    // Edit Annonce Functionality
    document.querySelectorAll('.editAnnonceButton').forEach(function(button) {
        button.addEventListener('click', function() {
        var id = button.getAttribute('data-id');
        var titreAnnonce = button.getAttribute('data-titre-annonce');
        var contenuAnnonce = button.getAttribute('data-contenu-annonce');
        var visibiliteAnnonce = button.getAttribute('data-visibilite-annonce');
        var cibleAnnonce = button.getAttribute('data-cible-annonce');
        var typeAnnonce = button.getAttribute('data-type-annonce');

        // Populate form with existing data
        document.getElementById('editTitreAnnonce').value = titreAnnonce;
        document.getElementById('editContenuAnnonce').value = contenuAnnonce;
        document.getElementById('editVisibiliteAnnonce').value = visibiliteAnnonce;
        document.getElementById('editCibleAnnonce').value = cibleAnnonce;
        document.getElementById('editTypeAnnonce').value = typeAnnonce;

        // Set form action URL
        var form = document.getElementById('editAnnonceFormContent');
        form.action = '/path-to-update-endpoint/' + id;

        // Show the edit modal
        editModal.style.display = 'block';
    });
    });

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == editModal) {
            editModal.style.display = "none";
        } else if (event.target == createModal) {
            createModal.style.display = "none";
        }
    }

    // Optional: Add functionality for cancel buttons in forms
    for (let span of spans) {
        span.onclick = function() {
            editModal.style.display = "none";
            createModal.style.display = "none";
        }
    }
});


</script>
@endsection
