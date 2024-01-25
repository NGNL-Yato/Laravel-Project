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
        $validatedData = $request->validate([
            'nom_filiere' => 'required',
            'abreviation_nomfiliere' => 'required',
            'id_departement' => 'required|exists:departements,id',
            'id_formation' => 'required|exists:formations,id',
            'id_prof' => 'required|exists:professeurs,id'
        ]);

        $filiere = Filiere::create($validatedData);

        // Update the user's role to 3 (chef de filiere)
        $filiere->professeur->user->update(['role' => 3]);

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

        // Update the new chef de filiere's role to 3
        $filiere->professeur->user->update(['role' => 3]);

        // If the old chef de filiere is not a chef de filiere anymore, update their role to 2
        if ($filiere->getOriginal('id_prof') != $filiere->id_prof) {
            $oldProfesseur = Professeur::find($filiere->getOriginal('id_prof'));
            if ($oldProfesseur && !$oldProfesseur->filiere) {
                $oldProfesseur->user->update(['role' => 2]);
            }
        }

        return redirect()->route('filieres.index')->with('success', 'Filiere updated successfully');
    }

    public function destroy($id)
    {
        $filiere = Filiere::findOrFail($id);

        // If the chef de filiere is not a chef de filiere anymore, update their role to 2
        if ($filiere->professeur && !$filiere->professeur->filiere) {
            $filiere->professeur->user->update(['role' => 2]);
        }

        $filiere->delete();

        return redirect()->route('filieres.index')->with('success', 'Filiere deleted successfully');
    }
}
