@extends('layouts.sidebar')

@section('content')
<div class="container">
    <div class="description_div">
        <!-- Table for Showing Description Formations -->
        <table>
            <thead>
                <tr>
                    <th>Objectif Text</th>
                    <th>Compétence Débouché</th>
                    <th>Nom Filiere</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($descriptions as $description)
                <tr>
                    <td>{{ $description->objectif_text }}</td>
                    <td>{{ $description->competence_debouche }}</td>
                    <td>{{ $description->filiere->nom_filiere }}</td>
                    <td>
                        <!-- Edit Button -->
                        <button class="editDescriptionButton" 
                                data-id="{{ $description->id }}"
                                data-objectif-text="{{ $description->objectif_text }}"
                                data-competence-debouche="{{ $description->competence_debouche }}"
                                data-filiere-id="{{ $description->filiere_id }}">Edit</button>

                        <!-- Delete Button -->
                        <form action="{{ route('description_formation.destroy', $description->id) }}" method="POST">
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
        <div id="editDescriptionForm" style="display:none;">
            <form id="editDescriptionFormContent" action="" method="POST">
                @csrf
                @method('PUT')
                <input type="text" id="editObjectifText" name="objectif_text">
                <input type="text" id="editCompetenceDebouche" name="competence_debouche">
                <select id="editFiliereId" name="id_filiere">
                    @foreach($filieres as $filiere)
                        <option value="{{ $filiere->id }}">{{ $filiere->nom_filiere }}</option>
                    @endforeach
                </select>
                <button type="submit">Update</button>
            </form>            
        </div>

        <!-- Creation Form -->
        <div id="createDescriptionForm" style="display:none;">
            <form id="createDescriptionFormContent" action="{{ route('description_formation.store') }}" method="POST">
                @csrf
                <input type="text" name="objectif_text" placeholder="Objectif Text">
                <input type="text" name="competence_debouche" placeholder="Compétence Débouché">
                <select name="id_filiere">
                    @foreach($filieres as $filiere)
                        <option value="{{ $filiere->id }}">{{ $filiere->nom_filiere }}</option>
                    @endforeach
                </select>
                <button type="submit">Create</button>
                <button type="button" class="cancel-btn">Cancel</button>
            </form>
        </div>

        <!-- Button to Show/Hide Creation Form -->
        <button id="showCreateDescriptionForm">Add New Description</button>
    </div>
</div>

@include('Educational_Service.home')

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Show/Hide Create Description Form
    document.getElementById('showCreateDescriptionForm').addEventListener('click', function() {
        var form = document.getElementById('createDescriptionForm');
        form.style.display = form.style.display === 'none' ? 'block' : 'none';
    });

    // Cancel Button in Create Form
    document.querySelectorAll('.cancel-btn').forEach(function(button) {
        button.addEventListener('click', function() {
            document.getElementById('createDescriptionForm').style.display = 'none';
        });
    });

    // Edit Description Functionality
    document.querySelectorAll('.editDescriptionButton').forEach(function(button) {
        button.addEventListener('click', function() {
            var id = button.getAttribute('data-id');
            var objectifText = button.getAttribute('data-objectif-text');
            var competenceDebouche = button.getAttribute('data-competence-debouche');
            var filiereId = button.getAttribute('data-filiere-id');

            // Populate form with existing data
            document.getElementById('editObjectifText').value = objectifText;
            document.getElementById('editCompetenceDebouche').value = competenceDebouche;
            document.getElementById('editFiliereId').value = filiereId;

            // Set form action URL
            var form = document.getElementById('editDescriptionFormContent');
            form.action = '/Educational_Service/info_filiere/' + id;

            // Show the form
            document.getElementById('editDescriptionForm').style.display = 'block';
        });
    });
});
</script>
@endsection
