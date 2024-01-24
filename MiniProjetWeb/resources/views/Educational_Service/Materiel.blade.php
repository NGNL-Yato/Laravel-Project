@extends('layouts.sidebar')

@section('content')
<div salle="container">
    <div salle="materiel_div">
        <!-- Add this form to your Blade view -->
        <form action="{{ route('materiels.filterBySalle', ['salleId' => 'default']) }}" method="GET" id="filterBySalleForm">
            <select name="id_salle" id="id_salle">
                @foreach($salles as $salle)
                    <option value="{{ $salle->id }}">{{ $salle->nom_salle }}</option>
                @endforeach
            </select>
            <button type="submit">Search</button>
        </form>
        

        <!-- Table for Showing Materiels -->
        <table>
            <thead>
                <tr>    
                    <th>Type Materiel</th>
                    <th>État Materiel</th>
                    <th>salle</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($materiels as $materiel)
                <tr>
                    <td>{{ $materiel->type_materiel }}</td>
                    <td>{{ $materiel->etat_materiel }}</td>
                    <td>{{ $materiel->salle->nom_salle }}</td>
                    <td>
                        <!-- Edit Button -->
                        <button class="editMaterielButton"
                        data-id="{{ $materiel->id }}"
                        data-type-materiel="{{ $materiel->type_materiel }}"
                        data-etat-materiel="{{ $materiel->etat_materiel }}"
                        data-salle-id="{{ $materiel->id_salle }}">Edit</button>
                

                        <!-- Delete Button -->
                        <form action="{{ route('materiel.destroy', $materiel->id) }}" method="POST">
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
        <div id="editMaterielForm" style="display:none;">
            <form id="editMaterielFormContent" action="" method="POST">
                @csrf
                @method('PUT')
                <select id="editTypeMateriel" name="type_materiel">
                    @foreach($typeOptions as $option)
                        <option value="{{ $option }}" {{ (isset($materiel) && $materiel->type_materiel == $option) ? 'selected' : '' }}>
                            {{ $option }}
                        </option>
                    @endforeach
                </select>
                <select id="editEtatMateriel" name="etat_materiel">
                    @foreach($etatOptions as $option)
                        <option value="{{ $option }}" {{ (isset($materiel) && $materiel->etat_materiel == $option) ? 'selected' : '' }}>
                            {{ $option }}
                        </option>
                    @endforeach
                </select>
                <select id="editSalleId" name="id_salle">
                        @foreach($salles as $salle)
                            <option value="{{ $salle->id }}">{{ $salle->nom_salle }}</option>
                        @endforeach
                    </select>
                <button type="submit">Update</button>
            </form>
        </div>

        <!-- Creation Form -->
        <div id="createMaterielForm" style="display:none;">
            <form id="createMaterielFormContent" action="{{ route('materiel.store') }}" method="POST">
                @csrf
                <select id="editTypeMateriel" name="type_materiel">
                    @foreach($typeOptions as $option)
                        <option value="{{ $option }}" {{ (isset($materiel) && $materiel->type_materiel == $option) ? 'selected' : '' }}>
                            {{ $option }}
                        </option>
                    @endforeach
                </select>
                <select id="editEtatMateriel" name="etat_materiel">
                    @foreach($etatOptions as $option)
                        <option value="{{ $option }}" {{ (isset($materiel) && $materiel->etat_materiel == $option) ? 'selected' : '' }}>
                            {{ $option }}
                        </option>
                    @endforeach
                </select>
                
                <select name="id_salle">
                    @foreach($salles as $salle)
                        <option value="{{ $salle->id }}">{{ $salle->nom_salle }}</option>
                    @endforeach
                </select>
                <button type="submit">Create</button>
                <button type="button" salle="cancel-btn">Cancel</button>
            </form>
        </div>

        <!-- Button to Show/Hide Creation Form -->
        <button id="showCreateMaterielForm">Add New Materiel</button>
    </div>
</div>

@include('Educational_Service.home')

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Show/Hide Create Materiel Form
    document.getElementById('showCreateMaterielForm').addEventListener('click', function() {
        var form = document.getElementById('createMaterielForm');
        form.style.display = form.style.display === 'none' ? 'block' : 'none';
    });

    // Cancel Button in Create Form
    document.querySelectorAll('.cancel-btn').forEach(function(button) {
        button.addEventListener('click', function() {
            document.getElementById('createMaterielForm').style.display = 'none';
        });
    });

    // Edit Materiel Functionality
    document.querySelectorAll('.editMaterielButton').forEach(function(button) {
        button.addEventListener('click', function() {
            var id = button.getAttribute('data-id');
            var typeMateriel = button.getAttribute('data-type-materiel');
            var etatMateriel = button.getAttribute('data-etat-materiel');
            var salleId = button.getAttribute('data-salle-id');

            // Populate form with existing data
            document.getElementById('editTypeMateriel').value = typeMateriel;
            document.getElementById('editEtatMateriel').value = etatMateriel;
            document.getElementById('editSalleId').value = salleId;

            // Set form action URL
            var form = document.getElementById('editMaterielFormContent');
            form.action = '/Educational_Service/Materiel/' + id; // Adjust the path as needed

            // Show the form
            document.getElementById('editMaterielForm').style.display = 'block';
        });
    });
    document.getElementById('filterBySalleForm').addEventListener('submit', function(e) {
    var salleId = document.getElementById('id_salle').value;
    this.action = this.action.replace('default', salleId);
    });
});
</script>
@endsection
