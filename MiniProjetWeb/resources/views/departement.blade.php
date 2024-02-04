<ul class="departements-list">
    @foreach($departements as $departement)
    <li class="dropdown">
        <p>{{ $departement->nom_departement }}</p>
        <div class="dropdown-content">
            @foreach($departement->filieres as $filiere)
            <a href="{{ route('departements.filieres.show', [$departement->id, $filiere->id]) }}">{{ $filiere->abreviation_nomfiliere }}</a>
            @endforeach
        </div>
    </li>
    @endforeach
</ul>