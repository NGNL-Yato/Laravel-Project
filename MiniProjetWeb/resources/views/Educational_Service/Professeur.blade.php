@extends('layouts.sidebar')

<div class="container">
    <div class="professeurs_div">
        <!-- Table for Showing Professeurs -->
        <table>
            <thead>
                <tr>
                    <th>Code Prof</th>
                    <th>Nom</th>
                    <th>Prenom</th>
                    <th>User ID</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($professeurs as $professeur)
                    <tr>
                        <td>{{ $professeur->Code_prof }}</td>
                        <td>{{ $professeur->nom }}</td>
                        <td>{{ $professeur->prenom }}</td>
                        <td>{{ $professeur->id_user }}</td>
                        <td>
                            <button class="editButton" 
                                    data-id="{{ $professeur->id }}"
                                    data-code-prof="{{ $professeur->Code_prof }}"
                                    data-nom="{{ $professeur->nom }}"
                                    data-prenom="{{ $professeur->prenom }}"
                                    data-id-user="{{ $professeur->id_user }}">Edit</button>
                            <form action="{{ route('professeurs.destroy', $professeur->id) }}" method="POST">
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
            <form id="editFormContent" action="" method="POST">
                @csrf
                @method('PUT')
                <input type="text" id="editCodeProf" name="Code_prof">
                <input type="text" id="editNom" name="nom">
                <input type="text" id="editPrenom" name="prenom">
                <input type="number" id="editIdUser" name="id_user">
                <button type="submit">Update</button>
            </form>            
        </div>

        <!-- Creation Form -->
        <div id="createForm" style="display:none;">
            <form id="createFormContent" action="{{ route('professeurs.store') }}" method="POST">
                @csrf
                <input type="text" name="Code_prof" placeholder="Code Prof">
                <input type="text" name="nom" placeholder="Nom">
                @if ($errors->has('nom'))
                <span class="text-danger">{{ $errors->first('nom') }}</span>
                @endif
                <input type="text" name="prenom" placeholder="Prenom">
                <label for="teacher">Select Teacher:</label>
                <select name="teacher_id" id="teacher">
                    @foreach($teachers as $teacher)
                        <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                    @endforeach
                </select>
                <button type="submit">Create</button>
                <button type="button" class="cancel-btn">Cancel</button>
            </form>
        </div>

        <!-- Button to Show/Hide Creation Form -->
        <button id="showCreateForm">Add New Professeur</button>
    </div>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Edit button functionality
        var editButtons = document.querySelectorAll('.editButton');
        editButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                var professeurId = this.getAttribute('data-id');
                var codeProf = this.getAttribute('data-code-prof');
                var nom = this.getAttribute('data-nom');
                var prenom = this.getAttribute('data-prenom');
                var idUser = this.getAttribute('data-id-user');

                // Populate the edit form
                var editFormAction = '/professeurs/' + professeurId; // Adjust URL as per your route
                document.getElementById('editFormContent').action = editFormAction;
                document.getElementById('editCodeProf').value = codeProf;
                document.getElementById('editNom').value = nom;
                document.getElementById('editPrenom').value = prenom;
                document.getElementById('editIdUser').value = idUser;

                // Show the edit form
                document.getElementById('editForm').style.display = 'block';

                // Optionally hide the create form
                document.getElementById('createForm').style.display = 'none';
            });
        });

        // Show/hide create form functionality
        var showCreateFormButton = document.getElementById('showCreateForm');
        var createForm = document.getElementById('createForm');
        showCreateFormButton.addEventListener('click', function() {
            createForm.style.display = createForm.style.display === 'none' ? 'block' : 'none';

            // Optionally hide the edit form
            if (createForm.style.display === 'block') {
                document.getElementById('editForm').style.display = 'none';
            }
        });

        // Cancel button functionality
        var cancelButtons = document.querySelectorAll('.cancel-btn');
        cancelButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                document.getElementById('editForm').style.display = 'none';
                document.getElementById('createForm').style.display = 'none';
            });
        });
    });
    </script>
</div>



@include('Educational_Service.home')
