@include("Professor.home")
<div class="messages-container">
    <div class="tables-links">
        <button href="" id="faireDemande" class="btn">Faire une demande</button>
    </div>
    <div class="messages-table">
    <table >
        <thead>
            <td>ID</td>
            <td>Subject</td>
            <td>From</td>
            <td>date</td>
        </thead>
        <tr>
            <td>1</td>
            <td>Sujet de demande</td>
            <td>l'etudiant</td>
            <td>1/23/2024</td>
        </tr>
        @foreach ($demandes as $demande)
        <tr>
            <td>{{ $demande->id }}</td>
            <td>{{ $demande->type_demande }}</td>
            <td>{{ $demande->id_user }}</td>
            <td>{{ $demande->created_at }}</td>               
        </tr>
        @endforeach
    </table>
    </div>
</div>
@extends("Professor.faireDemande")

