@extends('layouts.sidebar')


@section('content')
<div class="container">
    <div class="salle_div educational_service-center">
        <!-- Button to Show/Hide Creation Form -->
        <button id="showCreateSalleForm">Add New Salle</button>
        <!-- Table for Showing Salles -->
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th class="table__th">Type Salle</th>
                    <th class="table__th">Nom Salle</th>
                    @if($type == 'departement' || $type == 'default')
                        <th class="table__th">Nom Departement</th>
                    @endif
                    <th class="table__th">Actions</th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                @foreach($salles as $salle)
                    <tr class="table-row">
                        <td class="table-row__td">@switch ($salle->type_salle)
                            @case(1)
                                TP
                                @break
                            @case(2)
                                Normal
                                @break
                            @case(3)
                                Amphi
                                @break
                            @case(4)
                                Autre
                                @break
                            @default
                                N/A
                            @endswitch
                        </td>
                        <td class="table-row__td">{{ $salle->nom_salle }}</td>
                        @if($type == 'departement' || $type == 'default')
                            <td class="table-row__td">{{ optional($salle->departement)->nom_departement ?? 'N/A' }}</td>
                        @endif
                        <td class="table-row__td action-td">
                            <!-- Edit Button -->
                            <button class="editSalleButton" 
                                    data-id="{{ $salle->id }}"
                                    data-type-salle="{{ $salle->type_salle }}"
                                    data-nom-salle="{{ $salle->nom_salle }}"
                                    data-id-departement="{{ $salle->id_departement }}">
                                <svg version="1.1" class="table-row__edit" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512.001 512.001" style="enable-background:new 0 0 512.001 512.001;" xml:space="preserve" data-toggle="tooltip" data-placement="bottom" title="Edit">
                                    <g>
                                        <g>
                                            <path d="M496.063,62.299l-46.396-46.4c-21.2-21.199-55.69-21.198-76.888,0l-18.16,18.161l123.284,123.294l18.16-18.161C517.311,117.944,517.314,83.55,496.063,62.299z" style="fill: rgb(1, 185, 209);"></path>
                                        </g>
                                    </g>
                                    <g>
                                        <g>
                                            <path d="M22.012,376.747L0.251,494.268c-0.899,4.857,0.649,9.846,4.142,13.339c3.497,3.497,8.487,5.042,13.338,4.143L117.512,488.048L22.012,376.747z" style="fill: rgb(1, 185, 209);"></path>
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
                            <form action="{{ route('salle.destroy', $salle->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit">
                                    <svg data-toggle="tooltip" data-placement="bottom" title="Delete" version="1.1" class="table-row__bin" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                                        <g>
                                            <g>
                                                <path d="M436,60h-90V45c0-24.813-20.187-45-45-45h-90c-24.813,0-45,20.187-45,45v15H76c-24.813,0-45,20.187-45,45v30    c0,8.284,6.716,15,15,15h16.183L88.57,470.945c0.003,0.043,0.007,0.086,0.011,0.129C90.703,494.406,109.97,512,133.396,512    h245.207c23.427,0,42.693-17.594,44.815-40.926c0.004-0.043,0.008-0.086,0.011-0.129L449.817,150H466c8.284,0,15-6.716,15-15v-30    C481,80.187,460.813,60,436,60z M196,45c0-8.271,6.729-15,15-15h90c8.271,0,15,6.729,15,15v15H196V45z M393.537,468.408    c-0.729,7.753-7.142,13.592-14.934,13.592H133.396c-7.792,0-14.204-5.839-14.934-13.592L92.284,150h327.432L393.537,468.408z     M451,120h-15H76H61v-15c0-8.271,6.729-15,15-15h105h150h105c8.271,0,15,6.729,15,15V120z" style="fill: rgb(158, 171, 180);"></path>
                                            </g>
                                        </g>
                                        <g>
                                            <g>
                                                <path d="M256,180c-8.284,0-15,6.716-15,15v212c0,8.284,6.716,15,15,15s15-6.716,15-15V195C271,186.716,264.284,180,256,180z" style="fill: rgb(158, 171, 180);"></path>
                                            </g>
                                        </g>
                                        <g>
                                            <g>
                                                <path d="M346,180c-8.284,0-15,6.716-15,15v212c0,8.284,6.716,15,15,15s15-6.716,15-15V195C361,186.716,354.284,180,346,180z" style="fill: rgb(158, 171, 180);"></path>
                                            </g>
                                        </g>
                                        <g>
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
        <div id="editSalleForm" class="modal" style="display:none;">
            <div class="modal-content">
            <form id="editSalleFormContent" action="" method="POST">
                @csrf
                @method('PUT')
                <select id="editTypeSalle" name="type_salle">
                    <option value="1">TP</option>
                    <option value="2">Normal</option>
                    <option value="3">Amphi</option>
                    <option value="4">Autre</option>
                </select>
                <input type="text" id="editNomSalle" name="nom_salle">
                @if($type == 'departement' || $type == 'default')
                    <!-- Form for Selecting a Department -->
                    <label for="editDepartement">Choose a Department:</label>
                    <select name="id_departement" id="departement" class="form-control">
                        <option value="">Select Department</option>
                        @foreach($departements as $departement)
                            <option value="{{ $departement->id }}">{{ $departement->nom_departement }}</option>
                        @endforeach
                    </select>
                @endif
                <button type="submit">Update</button>
                <button type="button" class="cancel-btn">Cancel</button>
            </form>            
            </div>
        </div>

        <!-- Creation Form -->
        <div id="createSalleForm" class="modal" style="display:none;">
            <div class="modal-content">
            <form id="createSalleFormContent" action="{{ route('salle.store') }}" method="POST">
                @csrf
                <select id="createTypeSalle" name="type_salle">
                    <option value="1">TP</option>
                    <option value="2">Normal</option>
                    <option value="3">Amphi</option>
                    <option value="4">Autre</option>
                </select>
                <input type="text" name="nom_salle" placeholder="Nom Salle">
                @if($type == 'departement' || $type == 'default')
                    <!-- Form for Selecting a Department -->
                    <label for="departement">Choose a Department:</label>
                    <select name="id_departement" id="departement" class="form-control">
                        <option value="">Select Department</option>
                        @foreach($departements as $departement)
                            <option value="{{ $departement->id }}">{{ $departement->nom_departement }}</option>
                        @endforeach
                    </select>
                @endif
                <button type="submit">Create</button>
                <button type="button" class="cancel-btn">Cancel</button>
            </form>
        </div>
        </div>
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
            if(document.getElementById('editSalleForm').style.display === 'block') {
                document.getElementById('editSalleForm').style.display = 'none';
            } else {
                document.getElementById('createSalleForm').style.display = 'none';
            }
        });
    });


    // Edit Salle Functionality
    document.querySelectorAll('.editSalleButton').forEach(function(button) {
        button.addEventListener('click', function() {
            var id = button.getAttribute('data-id');
            var typeSalle = button.getAttribute('data-type-salle');
            var nomSalle = button.getAttribute('data-nom-salle');
            var idDepartement = button.getAttribute('data-id-departement'); // Get the ID of the department
            console.log('idDepartement:', idDepartement);
            // Populate form with existing data
            document.getElementById('editTypeSalle').value = typeSalle;
            document.getElementById('editNomSalle').value = nomSalle;
            document.getElementById('departement').value = idDepartement; // Set the value to the ID of the department

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
