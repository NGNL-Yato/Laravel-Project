@extends("layouts.sidebar")

@section("content")
<div class="messages-container">
    <div class="tables-links">
        <button href="" id="faireDemande" class="btn">Faire une demande</button>
    </div>
    <div class="messages-table">
    <table >
        <thead>
            <td>Sujet</td>
            <td>From</td>
            <td>date</td>
        </thead>
        @foreach ($demandes as $demande)
        <tr>
            <td>{{ $demande->type_demande }}</td>
            <td>{{ $demande->id_user }}</td>
            <td>{{ $demande->created_at }}</td>               
        </tr>
        @endforeach
    </table>
    </div>
</div>

@extends("Department_chief.faireDemande")

@endsection
