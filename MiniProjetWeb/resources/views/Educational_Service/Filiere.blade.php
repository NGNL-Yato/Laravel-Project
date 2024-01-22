@extends('layouts.sidebar')

@section('content')
<div class="container">
    <div class="filieres_div">
        <!-- Table for Showing Filieres -->
        <table>
            <thead>
                <tr>
                    <th>Nom Filiere</th>
                    <th>Abréviation</th>
                    <th>Nom du Département</th>
                    <th>Type de Formation</th>
                    <th>Chef de la Filiere</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($filieres as $filiere)
                <tr>
                    <td>{{ $filiere->nom_filiere }}</td>
                    <td>{{ $filiere->abreviation_nomfiliere }}</td>
                    <td>{{ $filiere->departement->nom_departement }}</td>
                    <td>{{ $filiere->formation->abreviation_formation }}</td>
                    <td>{{ $filiere->professeur->nom }} {{ $filiere->professeur->prenom }}</td>
                    <td>
                        <!-- Edit Button -->
                        <button class="editFiliereButton" 
                            data-id="{{ $filiere->id }}"
                            data-nom-filiere="{{ $filiere->nom_filiere }}"
                            data-abreviation="{{ $filiere->abreviation_nomfiliere }}"
                            data-departement-id="{{ $filiere->departement_id }}"
                            data-formation-id="{{ $filiere->formation_id }}"
                            data-chef-id="{{ $filiere->id_prof }}">Edit</button>


                        <!-- Delete Button -->
                        <form action="{{ route('filieres.destroy', $filiere->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Edit Form (Hidden Initially) -->
        <div id="editFiliereForm" style="display:none;">
            <form id="editFiliereFormContent" action="" method="POST">
                @csrf
                @method('PUT')
                <input type="text" id="editNomFiliere" name="nom_filiere">
                <input type="text" id="editAbreviation" name="abreviation_nomfiliere">
                <select id="editDepartementId" name="departement_id">
                    @foreach($departements as $departement)
                        <option value="{{ $departement->id }}">{{ $departement->nom_departement }}</option>
                    @endforeach
                </select>
                <select id="editFormationId" name="formation_id">
                    @foreach($formations as $formation)
                        <option value="{{ $formation->id }}">{{ $formation->abreviation_formation }}</option>
                    @endforeach
                </select>
                <select id="editChefId" name="id_prof">
                    @foreach($professeurs as $professeur)
                        <option value="{{ $professeur->id }}">{{ $professeur->nom }} {{ $professeur->prenom }}</option>
                    @endforeach
                </select>
                <button type="submit">Update</button>
            </form>            
        </div>

        <!-- Creation Form -->
        <div id="createFiliereForm" style="display:none;">
            <form id="createFiliereFormContent" action="{{ route('filieres.store') }}" method="POST">
                @csrf
                <input type="text" name="nom_filiere" placeholder="Nom Filiere">
                <input type="text" name="abreviation_nomfiliere" placeholder="Abréviation">
                <select name="id_departement">
                    @foreach($departements as $departement)
                        <option value="{{ $departement->id }}">{{ $departement->nom_departement }}</option>
                    @endforeach
                </select>
                <select name="id_formation">
                    @foreach($formations as $formation)
                        <option value="{{ $formation->id }}">{{ $formation->abreviation_formation }}</option>
                    @endforeach
                </select>                
                <select name="id_prof">
                    @foreach($professeurs as $professeur)
                    <option value="{{ $professeur->id }}">{{ $professeur->nom }}{{ $professeur->prenom }}</option>
                    @endforeach
                </select>
                <button type="submit">Create</button>
                <button type="button" class="cancel-btn">Cancel</button>
            </form>
        </div>

        <!-- Button to Show/Hide Creation Form -->
        <button id="showCreateFiliereForm">Add New Filiere</button>
    </div>
</div>

@include('Educational_Service.home')

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Edit Filiere button functionality
    var editFiliereButtons = document.querySelectorAll('.editFiliereButton');
    editFiliereButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            var filiereId = this.getAttribute('data-id');
            var nomFiliere = this.getAttribute('data-nom-filiere');
            var abreviation = this.getAttribute('data-abreviation');
            var departementId = this.getAttribute('data-departement-id');
            var formationId = this.getAttribute('data-formation-id');
            var chefId = this.getAttribute('data-chef-id');

            // Populate the edit Filiere form
            var editFiliereFormAction = '/Educational_Service/filiere/' + filiereId;
            document.getElementById('editFiliereFormContent').action = editFiliereFormAction;
            document.getElementById('editNomFiliere').value = nomFiliere;
            document.getElementById('editAbreviation').value = abreviation;
            document.getElementById('editDepartementId').value = departementId;
            document.getElementById('editFormationId').value = formationId;
            document.getElementById('editChefId').value = chefId;

            // Show the edit form
            document.getElementById('editFiliereForm').style.display = 'block';
        });
    });

    // Show/Hide Create Filiere Form
    document.getElementById('showCreateFiliereForm').addEventListener('click', function() {
        var form = document.getElementById('createFiliereForm');
        form.style.display = form.style.display === 'none' ? 'block' : 'none';
    });
});

</script>
@endsection
