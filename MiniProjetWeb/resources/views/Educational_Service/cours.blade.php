@extends('layouts.sidebar')


{{-- Schedule.css to style --}}
@section('content')
<div class="container">
    <div class="cours_div">
        <!-- Table for Showing Cours -->
        <table>
            <thead>
                <tr>
                    <th>Numéro du Semstre</th>
                    <th>Module</th>
                    <th>Professeur</th>
                    <th>Classe</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cours as $cours)
                    <tr>
                        <td>{{ $cours->Numero_semestre }}</td>
                        <td>{{ $cours->module->nom_module }}</td>
                        <td>{{ $cours->professeur->nom }}{{ $cours->professeur->prenom }}</td> 
                        <td>{{ $cours->classe->Numero_groupe }}</td>
                        <td>
                            <button class="editCoursButton" 
                                data-id="{{ $cours->id }}"
                                data-semester="{{ $cours->Numero_semestre }}"
                                data-id-module="{{ $cours->id_module }}"
                                data-id-prof="{{ $cours->id_prof }}"
                                data-id-class="{{ $cours->id_class }}">Edit</button>
                            <form action="{{ route('cours.destroy', $cours->id) }}" method="POST">
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
        <div id="editCoursForm" style="display:none;">
            <form id="editCoursFormContent" action="" method="POST">
                @csrf
                @method('PUT')
                <input type="number" id="editSemester" name="Numero_semestre" placeholder="Semester Number" required>
                <select id="editIdModule" name="id_module">
                    @foreach($modules as $module)
                        <option value="{{ $module->id }}">{{ $module->nom_module }}</option>
                    @endforeach
                </select>
                <select id="editIdProf" name="id_prof">
                    @foreach($professeurs as $professeur)
                        <option value="{{ $professeur->id }}">{{ $professeur->nom }} {{ $professeur->prenom }}</option>
                    @endforeach
                </select>
                <select id="editIdClass" name="id_class">
                    @foreach($classes as $class)
                        <option value="{{ $class->id }}">{{ $class->Numero_groupe }} - {{ $class->filiere->abreviation_nomfiliere }}</option>
                    @endforeach
                </select>
                <button type="submit">Update</button>
            </form>            
        </div>

        <!-- Creation Form -->
            <div id="createModuleForm" class="modal" style="display:none;">
                <div class="modal-content">
                    <form action="{{ route('cours.store') }}" method="POST">
                    @csrf
                    <input type="number" name="Numero_semestre" placeholder="Semester Number" required>
                    <select name="id_module">
                        @foreach($modules as $module)
                            <option value="{{ $module->id }}">{{ $module->nom_module }}</option>
                        @endforeach
                    </select>
                    <select name="id_prof">
                        @foreach($professeurs as $professeur)
                        <option value="{{ $professeur->id }}">{{ $professeur->nom }} {{ $professeur->prenom }}</option>
                        @endforeach
                    </select>
                    <select name="id_class">
                        @foreach($classes as $class)
                        <option value="{{ $class->id }}">{{ $class->Numero_groupe }} - {{ $class->filiere->abreviation_nomfiliere }}</option>
                        @endforeach
                    </select>
                    <button type="submit">Create</button>
                    </form>
                </div>
            </div>


        <!-- Button to Show/Hide Affectation Form -->
        <button id="showCreationCoursForm">Add New Affectation</button>

    </div>
</div>

@include('Educational_Service.home')

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Edit cours button functionality
    var editCoursButtons = document.querySelectorAll('.editCoursButton');
    editCoursButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            var coursId = this.getAttribute('data-id');
            var semester = this.getAttribute('data-semester');
            var idModule = this.getAttribute('data-id-module');
            var idProf = this.getAttribute('data-id-prof');
            var idClass = this.getAttribute('data-id-class');

            // Populate the edit cours form
            var editCoursFormAction = '/Educational_Service/cours/' + coursId;
            document.getElementById('editCoursFormContent').action = editCoursFormAction;
            document.getElementById('editSemester').value = semester;
            document.getElementById('editIdModule').value = idModule;
            document.getElementById('editIdProf').value = idProf;
            document.getElementById('editIdClass').value = idClass;

            // Show the edit cours form
            document.getElementById('editCoursForm').style.display = 'block';
        });
    });

    // Show/hide create cours form functionality
    var createCoursForm = document.getElementById('createModuleForm');
    var showCreateCoursFormButton = document.getElementById('showCreationCoursForm');

    showCreateCoursFormButton.addEventListener('click', function() {
        // Toggle the display of the creation form
        createCoursForm.style.display = createCoursForm.style.display === 'none' ? 'block' : 'none';
    });

    // Event listener to hide the form when clicking outside of it
    window.addEventListener('click', function(event) {
        if (event.target === createCoursForm) {
            createCoursForm.style.display = 'none';
        }
    });
});


</script>
@endsection
