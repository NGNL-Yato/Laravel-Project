<?php

namespace App\Http\Controllers\Tables;

use App\Models\Salle;
use App\Models\Departement;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class SalleController extends Controller
{
    // Display a listing of salles
    public function ListALLSalle(Request $request)
    {
        $type = $request->query('type', 'default');

        if ($type == 'departement') {
            // Fetch salles that are related to a departement
            $salles = Salle::whereHas('departement')->with('departement')->get();
            $departements = Departement::all(); // Fetch all departments for the dropdown
        } elseif ($type == 'service_pedagogique') {
            // Fetch salles that are NOT related to any departement
            $salles = Salle::doesntHave('departement')->get();
            $departements = collect(); // Empty collection, as it's not needed for this type
        } else {
            // Default behavior, possibly fetch all salles without any condition
            $salles = Salle::all();
            $departements = Departement::all();
        }
        return view('Educational_Service.salle', compact('salles', 'type', 'departements'));
    }
    
    // Store a newly created salle
    public function store(Request $request) // Add
    {
        $validatedData = $request->validate([
            'type_salle' => 'required|string', // 1 - TP 2 - Normal 3 - Amphi 4 - Autre
            'nom_salle' => 'required|string',
            'id_departement' => 'nullable|exists:departements,id', // Updated this line
        ]);
        
        Salle::create($validatedData);
        return redirect()->route('salle.index')->with('success', 'Salle added successfully');
    }
    // Update the specified salle
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'type_salle' => 'required|string',
            'nom_salle' => 'required|string',
            'id_departement' => 'nullable|exists:departements,id', // Updated this line
        ]);
        
        $salle = Salle::findOrFail($id);
        $salle->update($validatedData);
        return redirect()->route('salle.index')->with('success', 'Salle updated successfully');
    }

    // Remove the specified salle
    public function destroy($id) //delete
    {
        $salle = Salle::findOrFail($id);
        $salle->delete();
        return redirect()->route('salle.index')->with('success', 'Salle deleted successfully');
    }
}
