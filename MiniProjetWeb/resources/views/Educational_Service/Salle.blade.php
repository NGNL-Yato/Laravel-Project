@extends('layouts.sidebar')

@section('content')
<div class="container">
    <div class="salle_div">
        <!-- Table for Showing Salles -->
        <table>
            <thead>
                <tr>
                    <th>Type Salle</th>
                    <th>Nom Salle</th>
                    @if($type == 'departement')
                        <th>Nom Departement</th>
                    @endif
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($salles as $salle)
                <tr>
                    <td>{{ $salle->type_salle }}</td>
                    <td>{{ $salle->nom_salle }}</td>
                    @if($type == 'departement' && isset($salle->departement))
                        <td>{{ $salle->departement->nom_departement }}</td>
                    @elseif($type == 'departement')
                        <td>N/A</td>
                    @endif
                    <td>
                        <!-- Edit Button -->
                        <button class="editSalleButton" 
                                data-id="{{ $salle->id }}"
                                data-type-salle="{{ $salle->type_salle }}"
                                data-nom-salle="{{ $salle->nom_salle }}">Edit</button>

                        <!-- Delete Button -->
                        <form action="{{ route('salle.destroy', $salle->id) }}" method="POST">
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
        <div id="editSalleForm" style="display:none;">
            <form id="editSalleFormContent" action="" method="POST">
                @csrf
                @method('PUT')
                <input type="text" id="editTypeSalle" name="type_salle">
                <input type="text" id="editNomSalle" name="nom_salle">
                @if($type == 'departement')
                    <!-- Form for Selecting a Department -->
                    <label for="editDepartement">Choose a Department:</label>
                    <select name="edit_departement_id" id="editDepartement" class="form-control">
                        @foreach($departements as $departement)
                            <option value="{{ $departement->id }}">{{ $departement->nom_departement }}</option>
                        @endforeach
                    </select>
                @endif
                <button type="submit">Update</button>
            </form>            
        </div>

        <!-- Creation Form -->
        <div id="createSalleForm" style="display:none;">
            <form id="createSalleFormContent" action="{{ route('salle.store') }}" method="POST">
                @csrf
                <input type="text" name="type_salle" placeholder="Type Salle">
                <input type="text" name="nom_salle" placeholder="Nom Salle">
                @if($type == 'departement')
                    <!-- Form for Selecting a Department -->
                    <label for="departement">Choose a Department:</label>
                    <select name="departement_id" id="departement" class="form-control">
                        @foreach($departements as $departement)
                            <option value="{{ $departement->id }}">{{ $departement->nom_departement }}</option>
                        @endforeach
                    </select>
                @endif
                <button type="submit">Create</button>
                <button type="button" class="cancel-btn">Cancel</button>
            </form>
            
        </div>

        <!-- Button to Show/Hide Creation Form -->
        <button id="showCreateSalleForm">Add New Salle</button>
    </div>
</div>

@include('Educational_Service.home')

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Show/Hide Create Salle Form
    document.getElementById('showCreateSalleForm').addEventListener('click', function() {
        var form = document.getElementById('createSalleForm');
        form.style.display = form.style.display === 'none' ? 'block' : 'none';
    });

    // Cancel Button in Create Form
    document.querySelectorAll('.cancel-btn').forEach(function(button) {
        button.addEventListener('click', function() {
            document.getElementById('createSalleForm').style.display = 'none';
        });
    });

    // Edit Salle Functionality
    document.querySelectorAll('.editSalleButton').forEach(function(button) {
        button.addEventListener('click', function() {
            var id = button.getAttribute('data-id');
            var typeSalle = button.getAttribute('data-type-salle');
            var nomSalle = button.getAttribute('data-nom-salle');

            // Populate form with existing data
            document.getElementById('editTypeSalle').value = typeSalle;
            document.getElementById('editNomSalle').value = nomSalle;

            // Set form action URL
            var form = document.getElementById('editSalleFormContent');
            form.action = '/Educational_Service/Salle/' + id;

            // Show the form
            document.getElementById('editSalleForm').style.display = 'block';
        });
    });
});
</script>
@endsection
