@extends('layouts.sidebar')

@section('content')
<div class="container">
    <div class="departements_div educational_service-center">
        <!-- Table for Showing Departements -->
        <button id="showCreateDepForm">Add New Departement</button>

        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th class="table__th" >Nom Departement</th>
                    <th class="table__th">Nom du Chef du département</th>
                    <th class="table__th">Actions</th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                @foreach($departements as $departement)
                <tr class="table-row ">
                        <td  class="table-row__td">{{ $departement->nom_departement }}</td>
                        <td  class="table-row__td">{{ $departement->chef->nom }} {{ $departement->chef->prenom }}</td>
                        <td  class="table-row__td action-td">
                            <button class="editDepButton" 
                            data-id="{{ $departement->id }}"
                            data-nom-departement="{{ $departement->nom_departement }}"
                            data-id-prof="{{ $departement->id_prof }}">
                            <svg  version="1.1" class="table-row__edit" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512.001 512.001" style="enable-background:new 0 0 512.001 512.001;" xml:space="preserve" data-toggle="tooltip" data-placement="bottom" title="Edit"><g>	<g>		<path d="M496.063,62.299l-46.396-46.4c-21.2-21.199-55.69-21.198-76.888,0l-18.16,18.161l123.284,123.294l18.16-18.161    C517.311,117.944,517.314,83.55,496.063,62.299z" style="fill: rgb(1, 185, 209);"></path>	</g></g><g>	<g>
                                <path d="M22.012,376.747L0.251,494.268c-0.899,4.857,0.649,9.846,4.142,13.339c3.497,3.497,8.487,5.042,13.338,4.143    l117.512-21.763L22.012,376.747z" style="fill: rgb(1, 185, 209);"></path>	</g></g><g>	<g>		<polygon points="333.407,55.274 38.198,350.506 161.482,473.799 456.691,178.568   " style="fill: rgb(1, 185, 209);"></polygon>	</g></g><g></g><g></g><g></g>
                        <g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>

                        
                        </button>
                    <form action="{{ route('departements.destroy', $departement->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">
                            
                            <svg data-toggle="tooltip" data-placement="bottom" title="Delete" version="1.1" class="table-row__bin" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve"><g>	<g>		<path d="M436,60h-90V45c0-24.813-20.187-45-45-45h-90c-24.813,0-45,20.187-45,45v15H76c-24.813,0-45,20.187-45,45v30    c0,8.284,6.716,15,15,15h16.183L88.57,470.945c0.003,0.043,0.007,0.086,0.011,0.129C90.703,494.406,109.97,512,133.396,512    h245.207c23.427,0,42.693-17.594,44.815-40.926c0.004-0.043,0.008-0.086,0.011-0.129L449.817,150H466c8.284,0,15-6.716,15-15v-30    C481,80.187,460.813,60,436,60z M196,45c0-8.271,6.729-15,15-15h90c8.271,0,15,6.729,15,15v15H196V45z M393.537,468.408    c-0.729,7.753-7.142,13.592-14.934,13.592H133.396c-7.792,0-14.204-5.839-14.934-13.592L92.284,150h327.432L393.537,468.408z     M451,120h-15H76H61v-15c0-8.271,6.729-15,15-15h105h150h105c8.271,0,15,6.729,15,15V120z" style="fill: rgb(158, 171, 180);"></path>	</g></g><g>	<g>		<path d="M256,180c-8.284,0-15,6.716-15,15v212c0,8.284,6.716,15,15,15s15-6.716,15-15V195C271,186.716,264.284,180,256,180z" style="fill: rgb(158, 171, 180);"></path>	</g></g><g>	<g>		<path d="M346,180c-8.284,0-15,6.716-15,15v212c0,8.284,6.716,15,15,15s15-6.716,15-15V195C361,186.716,354.284,180,346,180z" style="fill: rgb(158, 171, 180);"></path>	</g></g><g>	<g>		<path d="M166,180c-8.284,0-15,6.716-15,15v212c0,8.284,6.716,15,15,15s15-6.716,15-15V195C181,186.716,174.284,180,166,180z" style="fill: rgb(158, 171, 180);"></path>	</g></g><g></g><g></g><g></g><g></g><g></g><g></g>
                                <g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g>
                                                </svg>   
                        </button>
                    </form>                            
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <!-- Edit Form (Hidden Initially) -->
        <div id="editDepForm" class="modal" style="display:none;">
            <div class="modal-content">
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
                <button type="button" class="cancel-btn">Cancel</button>
            </form>            
        </div>
        </div>

        <!-- Creation Form -->
        <div id="createDepForm" class="modal" style="display:none;">
            <div class="modal-content">
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
        </div>

        <!-- Button to Show/Hide Creation Form -->
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
