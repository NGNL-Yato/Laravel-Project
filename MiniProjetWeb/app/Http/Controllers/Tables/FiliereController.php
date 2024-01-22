<?php

namespace App\Http\Controllers\Tables;

use App\Models\Filiere;
use App\Models\Departement;
use App\Models\Professeur;
use App\Models\Formation;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FiliereController extends Controller
{
    public function ListALLFiliere()
    {
        $filieres = Filiere::with(['departement', 'formation', 'professeur'])->get();
        $departements = Departement::all();
        $formations = Formation::all();
        // Get all professors who are not already assigned to a filiere
        $professeurs = Professeur::whereDoesntHave('departement')
                                 ->whereDoesntHave('filiere')
                                 ->get();    
        return view('educational_service.filiere', compact('filieres', 'departements', 'formations', 'professeurs'));
    }
    public function store(Request $request)
    {
        logger($request->all());
        $validatedData = $request->validate([
            'nom_filiere' => 'required',
            'abreviation_nomfiliere' => 'required',
            'id_departement' => 'required|exists:departements,id',
            'id_formation' => 'required|exists:formations,id',
            'id_prof' => 'required|exists:professeurs,id'
        ]);

        Filiere::create($validatedData);
        return redirect()->route('filieres.index')->with('success', 'Filiere created successfully');
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nom_filiere' => 'required',
            'abreviation_nomfiliere' => 'required',
            'id_departement' => 'required|exists:departements,id',
            'id_formation' => 'required|exists:formations,id',
            'id_prof' => 'required|exists:professeurs,id'
        ]);

        $filiere = Filiere::findOrFail($id);
        $filiere->update($validatedData);

        return redirect()->route('filieres.index')->with('success', 'Filiere updated successfully');
    }

    public function destroy($id)
    {
        $filiere = Filiere::findOrFail($id);
        $filiere->delete();

        return redirect()->route('filieres.index')->with('success', 'Filiere deleted successfully');
    }
}
