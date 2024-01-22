<?php

namespace App\Http\Controllers\Tables;

use App\Models\Departement;
use App\Models\Professeur;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DepartementController extends Controller
{
    public function listAllDepartements()
    {
        $departements = Departement::all();
    
        // Get all professors who are not department heads
        $professeurs = Professeur::whereDoesntHave('departement')->get();
    
        return view('educational_service.departement', compact('departements', 'professeurs'));
    }
    
    public function edit($id)
    {
        $departement = Departement::findOrFail($id);
        $currentChefId = $departement->id_prof;
    
        // Get all professors who are not department heads or are the current head of this department
        $professeurs = Professeur::whereDoesntHave('departement', function ($query) use ($id) {
            $query->where('id', '!=', $id);
        })->orWhere('id', $currentChefId)->get();
    
        return view('educational_service.departement', compact('departement', 'professeurs'));
    }
    
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nom_departement' => 'required',
            'id_prof' => 'required|exists:professeurs,id'
        ]);

        Departement::create($validatedData);
        return redirect()->route('departements.index');
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nom_departement' => 'required',
            'id_prof' => 'required|exists:professeurs,id'
        ]);

        $departement = Departement::findOrFail($id);

        // Check if the professor is already a chief of another department
        if(Departement::where('id_prof', $validatedData['id_prof'])->where('id', '!=', $id)->exists()){
            return back()->withErrors(['id_prof' => 'This professor is already a chief of another department.']);
        }

        $departement->update($validatedData);

        return redirect()->route('departements.index')->with('success', 'Departement updated successfully');
    }

    public function destroy($id)
    {
        $departement = Departement::findOrFail($id);
        $departement->delete();

        return redirect()->route('departements.index')->with('success', 'Departement deleted successfully');
    }

}
