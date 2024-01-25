<?php

namespace App\Http\Controllers;

use App\Models\Departement;
use Illuminate\Http\Request;

class TableController extends Controller
{
    public function showDepartement($name)
    {
        $departement = Departement::where('nom_departement', $name)->first();

        // Vérifiez si le département existe
        if (!$departement) {
            abort(404);
        }

        return view('departement-content', compact('departement'));
    }
}
