@extends('layouts.sidebar')

<div class="container">
    <div class="users_educational_service_div educational_service-center">
                <!-- Button to Show/Hide Creation Form -->

        <button id="showCreateForm">Add New Formation</button>
                <table class="table">
                  <thead class="table__thead">
                    <tr>
                      <th class="table__th">Nom</th>
                      <th class="table__th">Abreviation</th>
                      <th class="table__th">Actions</th>
  
                    </tr>
                  </thead>
                  <tbody class="table__tbody">
                      @foreach($formations as $formation)
                    <tr class="table-row table-row--chris">
                      <td class="table-row__td">{{ $formation->nom_formation }}</td>
                      <td data-column="Policy" class="table-row__td">{{ $formation->abreviation_formation }}</td>
                      <td class="table-row__td action-td">
                          <button class="editButton" 
                                  data-id="{{ $formation->id }}"
                                  data-nom-formation="{{ $formation->nom_formation }}"
                                  data-abreviation-formation="{{ $formation->abreviation_formation }}">
                                  <svg  version="1.1" class="table-row__edit" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512.001 512.001" style="enable-background:new 0 0 512.001 512.001;" xml:space="preserve" data-toggle="tooltip" data-placement="bottom" title="Edit"><g>	<g>		<path d="M496.063,62.299l-46.396-46.4c-21.2-21.199-55.69-21.198-76.888,0l-18.16,18.161l123.284,123.294l18.16-18.161    C517.311,117.944,517.314,83.55,496.063,62.299z" style="fill: rgb(1, 185, 209);"></path>	</g></g><g>	<g>
                                      <path d="M22.012,376.747L0.251,494.268c-0.899,4.857,0.649,9.846,4.142,13.339c3.497,3.497,8.487,5.042,13.338,4.143    l117.512-21.763L22.012,376.747z" style="fill: rgb(1, 185, 209);"></path>	</g></g><g>	<g>		<polygon points="333.407,55.274 38.198,350.506 161.482,473.799 456.691,178.568   " style="fill: rgb(1, 185, 209);"></polygon>	</g></g><g></g><g></g><g></g>
                              <g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>
                              </button>
                          <form action="{{ route('formations.destroy', $formation->id) }}" method="POST">
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
        <div id="editForm" class="modal" style="display:none;margin:.5rem 0;">
            <div class="modal-content">
                @if($formations->count() > 0)
                <form id="editFormContent" action="{{ route('formations.update', $formation->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="text" id="editNomFormation" name="nom_formation">
                    <input type="text" id="editAbreviationFormation" name="abreviation_formation">
                    <button type="submit">Update</button>
                    <button type="button" class="cancel-btn">Cancel</button>
                </form>            
                </div>
                @endif
            </div>
        </div>

        <!-- Creation Form -->
        <div id="createForm" class="modal" style="margin:.5rem 0;display:none;">
            <div class="modal-content">
            <form id="createFormContent" action="{{ route('formations.store') }}" method="POST">
                @csrf
                <input type="text" name="nom_formation" placeholder="Nom Formation">
                <input type="text" name="abreviation_formation" placeholder="Abreviation Formation">
                <button type="submit">Create</button>
                <button type="button" class="cancel-btn">Cancel</button>
            </form>
        </div>
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
            console.log("test print ")
            // Toggle the display of the creation form
            createForm.style.display = createForm.style.display === 'none' ? 'block' : 'none';
            console.log(createForm.style.display)
            // Optionally hide the edit form when showing the create form
            if (createForm.style.display === 'block') {
                console.log(createForm)
                document.getElementById('editForm').style.display = 'none';
            }
        });

        var cancelButtons = document.querySelectorAll('.cancel-btn');

        cancelButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                // Hide both edit and create forms
                document.getElementById('editForm').style.display = 'none';
                document.getElementById('createForm').style.display = 'none';
                createForm.style.display = 'none';
            });
        });
    });
</script>

@include('Educational_Service.home')