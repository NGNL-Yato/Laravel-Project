@extends('layouts.sidebar')

@section('content')
<div class="container">
    <div class="classe_div">
        <select id="filiereFilter">
            <option value="">Select Filiere</option>
            @foreach($filieres as $filiere)
                <option value="{{ $filiere->id }}">{{ $filiere->nom_filiere }}</option>
            @endforeach
        </select>
        <!-- Table for Showing Classes -->
        <table>
            <thead>
                <tr>
                    <th>Numero_groupe</th>
                    <th>Nom Filiere</th>
                    <th>Actions</th>
                    <th>Emploi du temps</th>
                </tr>
            </thead>
            <tbody>
                @foreach($classes as $classe)
                <tr>
                    <td>{{ $classe->Numero_groupe }}</td>
                    <td>{{ $classe->filiere->nom_filiere }}</td>
                    <td>
                        <!-- Edit Button -->
                        <button class="editClasseButton" 
                        data-id="{{ $classe->id }}"
                        data-numero-groupe="{{ $classe->Numero_groupe }}"
                        data-filiere-id="{{ $classe->filiere_id }}">Edit</button>
                

                        <!-- Delete Button -->
                        <form action="{{ route('classe.destroy', $classe->id) }}" method="POST">
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
        <div id="editClasseForm" style="display:none;">
            <form id="editClasseFormContent" action="" method="POST">
                @csrf
                @method('PUT')
                <input type="text" id="editObjectifText" name="Numero_groupe" placeholder="Numero Groupe">
                <select id="editFiliereId" name="id_filiere">
                    @foreach($filieres as $filiere)
                        <option value="{{ $filiere->id }}">{{ $filiere->nom_filiere }}</option>
                    @endforeach
                </select>
                <button type="submit">Update</button>
            </form>            
        </div>

        <!-- Creation Form -->
        <div id="createClasseForm" style="display:none;">
            <form id="createClasseFormContent" action="{{ route('classe.store') }}" method="POST">
                @csrf
                <input type="text" name="Numero_groupe" placeholder="Numero Groupe">
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
        <button id="showCreateClasseForm">Add New Classe</button>
    </div>
</div>

@include('Educational_Service.home')

<script>

document.addEventListener('DOMContentLoaded', function() {
    // Show/Hide Create Classe Form
    document.getElementById('showCreateClasseForm').addEventListener('click', function() {
        var form = document.getElementById('createClasseForm');
        form.style.display = form.style.display === 'none' ? 'block' : 'none';
    });

    // Cancel Button in Create Form
    document.querySelectorAll('.cancel-btn').forEach(function(button) {
        button.addEventListener('click', function() {
            document.getElementById('createClasseForm').style.display = 'none';
        });
    });

    document.getElementById('filiereFilter').addEventListener('change', function() {
        var selectedFiliere = this.value;
        window.location.href = '{{ url("/Educational_Service/class") }}?filiere=' + selectedFiliere;
    });
    
    // Edit Classe Functionality
    document.querySelectorAll('.editClasseButton').forEach(function(button) {
        button.addEventListener('click', function() {
            var id = button.getAttribute('data-id');
            var numeroGroupe = button.getAttribute('data-numero-groupe');
            var filiereId = button.getAttribute('data-filiere-id');

            // Populate form with existing data
            document.getElementById('editObjectifText').value = numeroGroupe;
            document.getElementById('editFiliereId').value = filiereId;

            // Set form action URL
            var form = document.getElementById('editClasseFormContent');
            form.action = '/Educational_Service/class/'+id; // Update with the correct URL

            // Show the form
            document.getElementById('editClasseForm').style.display = 'block';
        });
    });
});
</script>
@endsection
