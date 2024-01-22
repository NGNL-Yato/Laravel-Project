@extends('layouts.sidebar')

@section('content')
<div class="container">
    <div class="departements_div">
        <!-- Table for Showing Departements -->
        <table>
            <thead>
                <tr>
                    <th>Nom Departement</th>
                    <th>Nom du Chef du département</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($departements as $departement)
                <tr>
                        <td>{{ $departement->nom_departement }}</td>
                        <td>{{ $departement->chef->nom }} {{ $departement->chef->prenom }}</td>
                        <td>
                            <button class="editDepButton" 
                            data-id="{{ $departement->id }}"
                            data-nom-departement="{{ $departement->nom_departement }}"
                            data-id-prof="{{ $departement->id_prof }}">Edit</button>
                    <form action="{{ route('departements.destroy', $departement->id) }}" method="POST">
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
        <div id="editDepForm" style="display:none;">
            <form id="editDepFormContent" action="" method="POST">
                @csrf
                @method('PUT')
                <input type="text" id="editNomDepartement" name="nom_departement">
                <select id="editIdProf" name="id_prof">
                    @foreach($professeurs as $professeur)
                        <option value="{{ $professeur->id }}">{{ $professeur->nom }}</option>
                    @endforeach
                </select>
                <button type="submit">Update</button>
            </form>            
        </div>

        <!-- Creation Form -->
        <div id="createDepForm" style="display:none;">
            <form id="createDepFormContent" action="{{ route('departements.store') }}" method="POST">
                @csrf
                <input type="text" name="nom_departement" placeholder="Nom Departement">
                <select name="id_prof">
                    @foreach($professeurs as $professeur)
                        <option value="{{ $professeur->id }}">{{ $professeur->nom }}</option>
                    @endforeach
                </select>
                <button type="submit">Create</button>
                <button type="button" class="cancel-btn">Cancel</button>
            </form>
        </div>

        <!-- Button to Show/Hide Creation Form -->
        <button id="showCreateDepForm">Add New Departement</button>
    </div>
</div>

@include('Educational_Service.home')

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Edit departement button functionality
        var editDepButtons = document.querySelectorAll('.editDepButton');
        editDepButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                var departementId = this.getAttribute('data-id');
                var nomDepartement = this.getAttribute('data-nom-departement');
                var idProf = this.getAttribute('data-id-prof');

                // Populate the edit departement form
                var editDepFormAction = '/Educational_Service/departement/' + departementId;
                document.getElementById('editDepFormContent').action = editDepFormAction;
                document.getElementById('editNomDepartement').value = nomDepartement;
                document.getElementById('editIdProf').value = idProf;

                // Show the edit departement form
                document.getElementById('editDepForm').style.display = 'block';

                // Optionally hide the create departement form
                document.getElementById('createDepForm').style.display = 'none';
            });
        });

        // Show/hide create departement form functionality
        var showCreateDepFormButton = document.getElementById('showCreateDepForm');
        var createDepForm = document.getElementById('createDepForm');
        showCreateDepFormButton.addEventListener('click', function() {
            createDepForm.style.display = createDepForm.style.display === 'none' ? 'block' : 'none';

            // Optionally hide the edit departement form
            if (createDepForm.style.display === 'block') {
                document.getElementById('editDepForm').style.display = 'none';
            }
        });

        // Cancel button functionality for departement forms
        var cancelDepButtons = document.querySelectorAll('.cancel-btn');
        cancelDepButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                document.getElementById('editDepForm').style.display = 'none';
                document.getElementById('createDepForm').style.display = 'none';
            });
        });
    });

    </script>
@endsection
