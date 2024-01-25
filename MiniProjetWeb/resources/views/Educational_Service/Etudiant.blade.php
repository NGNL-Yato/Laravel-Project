@extends('layouts.sidebar')

@section('content')
<div class="container">
    <div class="etudiant_div educational_service-center">
                <!-- Button to Show/Hide Creation Form -->
        <button id="showCreateEtudiantForm">Add New Etudiant</button>
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
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th class="table__th">CNE</th>
                    <th class="table__th">Nom</th>
                    <th class="table__th">Prénom</th>
                    <th class="table__th">User email</th>
                    <th class="table__th">Delegue</th>
                    <th class="table__th">Class</th>
                    <th class="table__th">Actions</th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                @foreach($etudiants as $etudiant)
                    {{-- <td> Debug purpose line
                        {{ dd($etudiant) }}
                    </td> --}}
                    <tr class="table-row ">
                        <td class="table-row__td">{{ $etudiant->CNE }}</td>
                        <td class="table-row__td">{{ $etudiant->Nom }}</td>
                        <td class="table-row__td">{{ $etudiant->prenom }}</td>
                        <td class="table-row__td">{{ $etudiant->user->email }}</td>
                        <td class="table-row__td">{{ $etudiant->delegue ? 'Yes' : 'No' }}</td>
                        <td class="table-row__td">{{ $etudiant->classe->Numero_groupe }} - {{ $etudiant->classe->filiere->nom_filiere }}</td>
                        <td class="table-row__td action-td">
                            <!-- Edit Button -->
                            <button class="editEtudiantButton" 
                                    data-id="{{ $etudiant->id }}"
                                    data-cne="{{ $etudiant->CNE }}"
                                    data-nom="{{ $etudiant->Nom }}"
                                    data-prenom="{{ $etudiant->prenom }}"
                                    data-delegue="{{ $etudiant->delegue }}"
                                    data-id-user="{{ $etudiant->id_user }}"
                                    data-class-id="{{ $etudiant->id_class }}">
                                <svg  version="1.1" class="table-row__edit" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512.001 512.001" style="enable-background:new 0 0 512.001 512.001;" xml:space="preserve" data-toggle="tooltip" data-placement="bottom" title="Edit">
                                    <g>	<g>		<path d="M496.063,62.299l-46.396-46.4c-21.2-21.199-55.69-21.198-76.888,0l-18.16,18.161l123.284,123.294l18.16-18.161    C517.311,117.944,517.314,83.55,496.063,62.299z" style="fill: rgb(1, 185, 209);"></path>	</g></g><g>	<g>
                                        <path d="M22.012,376.747L0.251,494.268c-0.899,4.857,0.649,9.846,4.142,13.339c3.497,3.497,8.487,5.042,13.338,4.143    l117.512-21.763L22.012,376.747z" style="fill: rgb(1, 185, 209);"></path>	</g></g><g>	<g>		<polygon points="333.407,55.274 38.198,350.506 161.482,473.799 456.691,178.568   " style="fill: rgb(1, 185, 209);"></polygon>	</g></g><g></g><g></g><g></g>
                                <g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>
                                Edit
                            </button>
        
                            <!-- Delete Button -->
                            <form action="{{ route('etudiant.destroy', $etudiant->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit">
                                    <svg data-toggle="tooltip" data-placement="bottom" title="Delete" version="1.1" class="table-row__bin" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                                        <g>	<g>		<path d="M436,60h-90V45c0-24.813-20.187-45-45-45h-90c-24.813,0-45,20.187-45,45v15H76c-24.813,0-45,20.187-45,45v30    c0,8.284,6.716,15,15,15h16.183L88.57,470.945c0.003,0.043,0.007,0.086,0.011,0.129C90.703,494.406,109.97,512,133.396,512    h245.207c23.427,0,42.693-17.594,44.815-40.926c0.004-0.043,0.008-0.086,0.011-0.129L449.817,150H466c8.284,0,15-6.716,15-15v-30    C481,80.187,460.813,60,436,60z M196,45c0-8.271,6.729-15,15-15h90c8.271,0,15,6.729,15,15v15H196V45z M393.537,468.408    c-0.729,7.753-7.142,13.592-14.934,13.592H133.396c-7.792,0-14.204-5.839-14.934-13.592L92.284,150h327.432L393.537,468.408z     M451,120h-15H76H61v-15c0-8.271,6.729-15,15-15h105h150h105c8.271,0,15,6.729,15,15V120z" style="fill: rgb(158, 171, 180);"></path>	</g></g><g>	<g>		<path d="M256,180c-8.284,0-15,6.716-15,15v212c0,8.284,6.716,15,15,15s15-6.716,15-15V195C271,186.716,264.284,180,256,180z" style="fill: rgb(158, 171, 180);"></path>	</g></g><g>	<g>		<path d="M346,180c-8.284,0-15,6.716-15,15v212c0,8.284,6.716,15,15,15s15-6.716,15-15V195C361,186.716,354.284,180,346,180z" style="fill: rgb(158, 171, 180);"></path>	</g></g><g>	<g>		<path d="M166,180c-8.284,0-15,6.716-15,15v212c0,8.284,6.716,15,15,15s15-6.716,15-15V195C181,186.716,174.284,180,166,180z" style="fill: rgb(158, 171, 180);"></path>	</g></g><g></g><g></g><g></g><g></g><g></g><g></g>
                                                <g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g>
                                                                </svg> 
                                    Delete
                                </button>
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
