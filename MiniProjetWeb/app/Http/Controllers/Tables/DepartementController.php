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
        $professeurs = Professeur::whereDoesntHave('departement')->whereDoesntHave('filiere')->get();
    
        return view('educational_service.departement', compact('departements', 'professeurs'));
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nom_departement' => 'required',
            'id_prof' => 'required|exists:professeurs,id'
        ]);
    
        // Create the department
        $departement = Departement::create($validatedData);
    
        // Update the role of the department head
        $chef = Professeur::find($validatedData['id_prof']);
        if ($chef && $chef->user) {
            $chef->user->update(['role' => 4]); // Set role to 4 for the department head
        }
    
        return redirect()->route('departements.index')->with('success', 'New Departement created successfully');
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
    
        // Update role for department head before deletion
        if ($departement->professeur && $departement->professeur->user) {
            $departement->professeur->user->update(['role' => 2]); // Change role to 2
        }
    
        // Delete department
        $departement->delete();
    
        return redirect()->route('departements.index')->with('success', 'Departement deleted successfully');
    }
    

}
