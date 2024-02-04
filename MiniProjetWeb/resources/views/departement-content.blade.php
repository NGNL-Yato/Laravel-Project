@extends('layouts.app')

@section('content')
        <!-- Affichage des informations du département -->
        <div class="departement-info p-8 rounded-md shadow-md">
            <h2 class="text-2xl font-bold mb-4">{{ $departement->nom_departement }}</h2>
            <table class="table">
                <tbody>
                    @foreach($departement->getAttributes() as $key => $value)
                        <tr>
                            <th>{{ $key }}</th>
                            <td>{{ $value }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <section class="formations">       
        </section>
        </div>
    </div>
</div>
@endsection
