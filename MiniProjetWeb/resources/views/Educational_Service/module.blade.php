@extends('layouts.sidebar')

@section('content')
<div class="container">
    <div class="modules_div educational_service-center">
        <button id="showCreateModuleForm">Add New Module</button>

        <!-- Table for Showing Modules -->
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th class="table__th">Nom Module</th>
                    <th class="table__th">Type Module</th>
                    <th class="table__th">Nom Departement</th>
                    <th class="table__th">Actions</th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                @foreach($modules as $module)
                <tr class="table-row ">
                    <td class="table-row__td">{{ $module->nom_module }}</td>
                    <td class="table-row__td">{{ $module->type_module }}</td>
                    <td class="table-row__td">{{ $module->departement->nom_departement }}</td>
                    <td class="table-row__td action-td">
                        <!-- Edit Button -->
                        <button class="editModuleButton" 
                                data-id="{{ $module->id }}"
                                data-nom-module="{{ $module->nom_module }}"
                                data-type-module="{{ $module->type_module }}"
                                data-id-departement="{{ $module->id_departement }}">
                            <svg version="1.1" class="table-row__edit" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512.001 512.001" style="enable-background:new 0 0 512.001 512.001;" xml:space="preserve" data-toggle="tooltip" data-placement="bottom" title="Edit">
                                <g>
                                    <g>
                                        <path d="M496.063,62.299l-46.396-46.4c-21.2-21.199-55.69-21.198-76.888,0l-18.16,18.161l123.284,123.294l18.16-18.161C517.311,117.944,517.314,83.55,496.063,62.299z" style="fill: rgb(1, 185, 209);"></path>
                                    </g>
                                </g>
                                <g>
                                    <g>
                                        <path d="M22.012,376.747L0.251,494.268c-0.899,4.857,0.649,9.846,4.142,13.339c3.497,3.497,8.487,5.042,13.338,4.143    l117.512-21.763L22.012,376.747z" style="fill: rgb(1, 185, 209);"></path>
                                    </g>
                                </g>
                                <g>
                                    <g>
                                        <polygon points="333.407,55.274 38.198,350.506 161.482,473.799 456.691,178.568" style="fill: rgb(1, 185, 209);"></polygon>
                                    </g>
                                </g>
                            </svg>
                        </button>
        
                        <!-- Delete Button -->
                        <form action="{{ route('modules.destroy', $module->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit">
                                <svg data-toggle="tooltip" data-placement="bottom" title="Delete" version="1.1" class="table-row__bin" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                                    <g>
                                        <g>
                                            <path d="M436,60h-90V45c0-24.813-20.187-45-45-45h-90c-24.813,0-45,20.187-45,45v15H76c-24.813,0-45,20.187-45,45v30    c0,8.284,6.716,15,15,15h16.183L88.57,470.945c0.003,0.043,0.007,0.086,0.011,0.129C90.703,494.406,109.97,512,133.396,512    h245.207c23.427,0,42.693-17.594,44.815-40.926c0.004-0.043,0.008-0.086,0.011-0.129L449.817,150H466c8.284,0,15-6.716,15-15v-30    C481,80.187,460.813,60,436,60z M196,45c0-8.271,6.729-15,15-15h90c8.271,0,15,6.729,15,15v15H196V45z M393.537,468.408    c-0.729,7.753-7.142,13.592-14.934,13.592H133.396c-7.792,0-14.204-5.839-14.934-13.592L92.284,150h327.432L393.537,468.408z     M451,120h-15H76H61v-15c0-8.271,6.729-15,15-15h105h150h105c8.271,0,15,6.729,15,15V120z" style="fill: rgb(158, 171, 180);"></path>
                                        </g>
                                        <g>
                                            <path d="M256,180c-8.284,0-15,6.716-15,15v212c0,8.284,6.716,15,15,15s15-6.716,15-15V195C271,186.716,264.284,180,256,180z" style="fill: rgb(158, 171, 180);"></path>
                                        </g>
                                        <g>
                                            <path d="M346,180c-8.284,0-15,6.716-15,15v212c0,8.284,6.716,15,15,15s15-6.716,15-15V195C361,186.716,354.284,180,346,180z" style="fill: rgb(158, 171, 180);"></path>
                                        </g>
                                        <g>
                                            <path d="M166,180c-8.284,0-15,6.716-15,15v212c0,8.284,6.716,15,15,15s15-6.716,15-15V195C181,186.716,174.284,180,166,180z" style="fill: rgb(158, 171, 180);"></path>
                                        </g>
                                    </g>
                                </svg>
                            </button>
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
