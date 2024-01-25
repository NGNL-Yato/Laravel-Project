@extends('layouts.sidebar')

<div class="container">
    <div class="users_educational_service_div">
        <!-- Table for Showing Formations -->
        <table>
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Abreviation</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($formations as $formation)
                    <tr>
                        <td>{{ $formation->nom_formation }}</td>
                        <td>{{ $formation->abreviation_formation }}</td>
                        <td>
                            <button class="editButton" 
                                    data-id="{{ $formation->id }}"
                                    data-nom-formation="{{ $formation->nom_formation }}"
                                    data-abreviation-formation="{{ $formation->abreviation_formation }}">Edit</button>
                            <form action="{{ route('formations.destroy', $formation->id) }}" method="POST">
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
        <div id="editForm" style="display:none;">
            <form id="editFormContent" action="{{ route('formations.update', $formation->id) }}" method="POST">
                @csrf
                @method('PUT')
                <input type="text" id="editNomFormation" name="nom_formation">
                <input type="text" id="editAbreviationFormation" name="abreviation_formation">
                <button type="submit">Update</button>
            </form>            
        </div>

        <!-- Creation Form -->
        <div id="createForm" style="display:none;">
            <form id="createFormContent" action="{{ route('formations.store') }}" method="POST">
                @csrf
                <input type="text" name="nom_formation" placeholder="Nom Formation">
                <input type="text" name="abreviation_formation" placeholder="Abreviation Formation">
                <button type="submit">Create</button>
                <button type="button" class="cancel-btn">Cancel</button>
            </form>
        </div>

        <!-- Button to Show/Hide Creation Form -->
        <button id="showCreateForm">Add New Formation</button>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var editButtons = document.querySelectorAll('.editButton');

        editButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                var formationId = this.getAttribute('data-id');
                var nomFormation = this.getAttribute('data-nom-formation');
                var abreviationFormation = this.getAttribute('data-abreviation-formation');

                // Populate the edit form
                var editFormAction = '/formation/' + formationId; // Corrected the action URL
                document.getElementById('editFormContent').action = editFormAction;
                document.getElementById('editNomFormation').value = nomFormation;
                document.getElementById('editAbreviationFormation').value = abreviationFormation;

                // Show the edit form
                document.getElementById('editForm').style.display = 'block';
            });
        });

        var showCreateFormButton = document.getElementById('showCreateForm');
        var createForm = document.getElementById('createForm');

        showCreateFormButton.addEventListener('click', function() {
            // Toggle the display of the creation form
            createForm.style.display = createForm.style.display === 'none' ? 'block' : 'none';

            // Optionally hide the edit form when showing the create form
            if (createForm.style.display === 'block') {
                document.getElementById('editForm').style.display = 'none';
            }
        });

        var cancelButtons = document.querySelectorAll('.cancel-btn');

        cancelButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                // Hide both edit and create forms
                document.getElementById('editForm').style.display = 'none';
                createForm.style.display = 'none';
            });
        });
    });
</script>

@include('Educational_Service.home')