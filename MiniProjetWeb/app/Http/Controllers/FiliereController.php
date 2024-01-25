<?php

// app/Http/Controllers/FiliereController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Filiere;

class FiliereController extends Controller
{
    public function index(Request $request)
    {
        // Vérifiez si une valeur de recherche est fournie dans l'URL
        $search = $request->query('search');

        // Utilisez le champ abreviation_nomfiliere pour la recherche
        $filieres = Filiere::when($search, function ($query, $search) {
            return $query->where('abreviation_nomfiliere', 'LIKE', "%$search%");
        })->get();

        return view('filieres', compact('filieres', 'search'));
    }

    // Ajoutez d'autres méthodes si nécessaire
}

