@extends('layouts.sidebar')

@section('content')
<div class="container">
    <div class="etudiant_div">
        <!-- Class Selection Form -->
        <form action="{{ route('etudiant.filterByClass') }}" method="POST">
            @csrf
            <label for="classSelector">Choose a Class:</label>
            <select name="class_id" id="classSelector">
                @foreach($classes as $class)
                    <option value="{{ $class->id }}">{{ $class->Numero_groupe }} - {{ $class->filiere->abreviation_nomfiliere }}</option>
                @endforeach
            </select>
            <button type="submit">Filter</button>
        </form>
        <!-- Table for Showing Etudiants -->
        <table>
            <thead>
                <tr>
                    <th>CNE</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>User email</th>
                    <th>Delegue</th>
                    <th>Class</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($etudiants as $etudiant)
                {{-- <td> Debug                 purpose line
                    {{ dd($etudiant) }}
                </td> --}}
                <tr>
                    <td>{{ $etudiant->CNE }}</td>
                    <td>{{ $etudiant->Nom }}</td>
                    <td>{{ $etudiant->prenom }}</td>
                    <td>{{ $etudiant->user->email }}</td>
                    <td>{{ $etudiant->delegue ? 'Yes' : 'No' }}</td>
                    <td>{{ $etudiant->classe->Numero_groupe }} - {{ $etudiant->classe->filiere->nom_filiere }}</td>
                    <td>
                        <!-- Edit Button -->
                        <button class="editEtudiantButton" 
                        data-id="{{ $etudiant->id }}"
                        data-cne="{{ $etudiant->CNE }}"
                        data-nom="{{ $etudiant->Nom }}"
                        data-prenom="{{ $etudiant->prenom }}"
                        data-delegue="{{ $etudiant->delegue }}"
                        data-id-user="{{ $etudiant->id_user }}"
                        data-class-id="{{ $etudiant->id_class }}">Edit</button>
                
                        <!-- Delete Button -->
                        <form action="{{ route('etudiant.destroy', $etudiant->id) }}" method="POST">
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
        <div id="editEtudiantForm" style="display:none;">
            <form id="editEtudiantFormContent" action="" method="POST">
                @csrf
                @method('PUT')
                <input type="text" id="editCNEText" name="CNE" placeholder="CNE">
                <input type="text" id="editNomText" name="Nom" placeholder="Nom">
                <input type="text" id="editPrenomText" name="prenom" placeholder="Prénom">
                <label>
                    Délégué:
                    <input type="checkbox" id="editDelegueCheckbox" name="delegue">
                </label>
                <input type="hidden" id="editUserId" name="id_user"> <!-- Hidden user ID field -->
                <select id="editClassId" name="id_class">
                    @foreach($classes as $class)
                    <option value="{{ $class->id }}">
                        {{ $class->Numero_groupe }} - {{ $class->filiere->abreviation_nomfiliere }}
                    </option>
                    @endforeach
                </select>                           
                <button type="submit">Update</button>
            </form>
        </div>



        <!-- Creation Form -->
        <div id="createEtudiantForm" style="display:none;">
            <form id="createEtudiantFormContent" action="{{ route('etudiant.store') }}" method="POST">
                @csrf
                <input type="text" name="CNE" placeholder="CNE">
                <input type="text" name="Nom" placeholder="Nom">
                <input type="text" name="prenom" placeholder="Prénom">
                <label>
                    Délégué:
                    <input type="checkbox" name="delegue">
                </label>
                <!-- Update the following select element to display user emails -->
                <select name="id_user">
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->email }}</option>
                    @endforeach
                </select>
                    <select id="editClassId" name="id_class">
                        @foreach($classes as $class)
                            <option value="{{ $class->id }}">
                                {{ $class->Numero_groupe }} - {{ $class->filiere->abreviation_nomfiliere }}
                            </option>
                        @endforeach
                </select>                    
                <button type="submit">Create</button>
                <button type="button" class="cancel-btn">Cancel</button>
            </form>
        </div>


        <!-- Button to Show/Hide Creation Form -->
        <button id="showCreateEtudiantForm">Add New Etudiant</button>
    </div>
</div>

@include('Educational_Service.home')

<script>
    document.addEventListener('DOMContentLoaded', function() {
    // Show/Hide Create Etudiant Form
    document.getElementById('showCreateEtudiantForm').addEventListener('click', function() {
        var form = document.getElementById('createEtudiantForm');
        form.style.display = form.style.display === 'none' ? 'block' : 'none';
    });

    // Cancel Button in Create Form
    document.querySelectorAll('.cancel-btn').forEach(function(button) {
        button.addEventListener('click', function() {
            document.getElementById('createEtudiantForm').style.display = 'none';
        });
    });

    // Edit Etudiant Functionality
    document.querySelectorAll('.editEtudiantButton').forEach(function(button) {
        button.addEventListener('click', function() {
            var id = button.getAttribute('data-id');
            var CNE = button.getAttribute('data-cne');
            var Nom = button.getAttribute('data-nom');
            var Prenom = button.getAttribute('data-prenom');
            var Delegue = button.getAttribute('data-delegue');
            var ClassId = button.getAttribute('data-class-id');
            var UserId = button.getAttribute('data-user-id'); // Assuming you have this attribute

            // Populate form with existing data
            document.getElementById('editCNEText').value = CNE;
            document.getElementById('editNomText').value = Nom;
            document.getElementById('editPrenomText').value = Prenom;
            document.getElementById('editDelegueCheckbox').checked = Delegue === '1';
            document.getElementById('editClassId').value = ClassId;
            document.getElementById('editUserId').value = id; // Set user ID

            // Set form action URL
            var form = document.getElementById('editEtudiantFormContent');
            form.action = '/Educational_Service/etudiant/' + id; // Update with the correct URL

            // Show the form
            document.getElementById('editEtudiantForm').style.display = 'block';
        });
    });
});

</script>
@endsection
