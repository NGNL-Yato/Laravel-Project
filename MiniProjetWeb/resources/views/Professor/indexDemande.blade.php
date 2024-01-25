@include("Professor.home")
<div class="messages-container">
    <div class="tables-links">
        <button href="" id="faireDemande" class="btn">Faire une demande</button>
    </div>
    <div class="messages-table">
    <table class="table">
        <thead >
            <td>ID</td>
            <td>Subject</td>
            <td>From</td>
            <td>date</td>
            <td>etat</td>
        </thead>

        @foreach ($demandes as $demande)
        <tr>
            <td>{{ $demande->id }}</td>
            <td><a href="{{ route('Professor.demande', ['id' => $demande->id]) }}">{{ $demande->type_demande }}</a></td>
            <td>{{ $demande->id_user }}</td>
            <td>{{ $demande->created_at }}</td>               
            <td>{{ $demande->etat_demande }}</td>
            <td>

            </td>               
        </tr>
        @endforeach
    </table>
    </div>
</div>
@extends("Professor.faireDemande")

