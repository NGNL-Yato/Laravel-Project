@extends('layouts.sidebar')

@section('content')
<div class="container">
    <div class="modules_div">
        <!-- Table for Showing Modules -->
        <table>
            <thead>
                <tr>
                    <th>Nom Module</th>
                    <th>Type Module</th>
                    <th>Nom Departement</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($modules as $module)
                <tr>
                    <td>{{ $module->nom_module }}</td>
                    <td>{{ $module->type_module }}</td>
                    <td>{{ $module->departement->nom_departement }}</td>
                    <td>
                        <button class="editModuleButton" 
                        data-id="{{ $module->id }}"
                        data-nom-module="{{ $module->nom_module }}"
                        data-type-module="{{ $module->type_module }}"
                        data-id-departement="{{ $module->id_departement }}">Edit</button>
                        <form action="{{ route('modules.destroy', $module->id) }}" method="POST">
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
        <div id="editModuleForm" style="display:none;">
            <form id="editModuleFormContent" action="" method="POST">
                @csrf
                @method('PUT')
                <input type="text" id="editNomModule" name="nom_module">
                <select id="editTypeModule" name="type_module">
                    <option value="Module">Module</option>
                    <option value="Semi-Module">Semi-Module</option>
                </select>                <select id="editIdDepartement" name="id_departement">
                    @foreach($departements as $departement)
                        <option value="{{ $departement->id }}">{{ $departement->nom_departement }}</option>
                    @endforeach
                </select>
                <button type="submit">Update</button>
            </form>            
        </div>

            <!-- Creation Form for Modules -->
            <div id="createModuleForm" class="modal" style="display:none;">
                <div class="modal-content">
                    <form id="createModuleFormContent" action="{{ route('modules.store') }}" method="POST">
                    @csrf
                    <div class="formBx">
                        <label for="nom_module">Nom du Module</label>
                        <div class="inputBx">
                            <input type="text" name="nom_module" placeholder="Nom du Module">
                        </div>
                    </div>
                    <div class="formBx">
                        <label for="type_module">Type de Module</label>
                        <div class="inputBx">
                            <select name="type_module">
                                <option value="Module">Module</option>
                                <option value="Semi-Module">Semi-Module</option>
                            </select>
                        </div>
                    </div>
                    <div class="formBx">
                        <label for="id_departement">Département</label>
                        <div class="inputBx">
                            <select name="id_departement">
                                @foreach($departements as $departement)
                                    <option value="{{ $departement->id }}">{{ $departement->nom_departement }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <button type="submit">Create</button>
                    <button type="button" class="cancel-btn">Cancel</button>
                </form>
            </div>
        </div>

        <!-- Button to Show/Hide Creation Form -->
        <button id="showCreateModuleForm">Add New Module</button>
    </div>
</div>

@include('Educational_Service.home')

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Edit module button functionality
        var editModuleButtons = document.querySelectorAll('.editModuleButton');
        editModuleButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                var moduleId = this.getAttribute('data-id');
                var nomModule = this.getAttribute('data-nom-module');
                var typeModule = this.getAttribute('data-type-module');
                var idDepartement = this.getAttribute('data-id-departement');

                // Populate the edit module form
                var editModuleFormAction = '/Educational_Service/module/' + moduleId; // Adjust the URL
                document.getElementById('editModuleFormContent').action = editModuleFormAction;
                document.getElementById('editNomModule').value = nomModule;
                document.getElementById('editTypeModule').value = typeModule;
                document.getElementById('editIdDepartement').value = idDepartement;

                // Show the edit module form
                document.getElementById('editModuleForm').style.display = 'block';

                // Optionally hide the create module form
                document.getElementById('createModuleForm').style.display = 'none';
            });
        });

        // Show/hide create module form functionality
        var showCreateModuleFormButton = document.getElementById('showCreateModuleForm');
        var createModuleForm = document.getElementById('createModuleForm');
        showCreateModuleFormButton.addEventListener('click', function() {
            createModuleForm.style.display = createModuleForm.style.display === 'none' ? 'block' : 'none';

            // Optionally hide the edit module form
            if (createModuleForm.style.display === 'block') {
                document.getElementById('editModuleForm').style.display = 'none';
            }
        });

        // Cancel button functionality for module forms
        var cancelModuleButtons = document.querySelectorAll('.cancel-btn');
        cancelModuleButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                document.getElementById('editModuleForm').style.display = 'none';
                document.getElementById('createModuleForm').style.display = 'none';
            });
        });
        var modal = document.getElementsByClassName('modal')[0];

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    });
</script>
@endsection
