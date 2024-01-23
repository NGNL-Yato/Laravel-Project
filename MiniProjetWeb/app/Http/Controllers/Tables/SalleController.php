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
        $departements = Departement::all();
    
        if ($type == 'departement') {
            $salles = Salle::whereHas('departement')->with('departement')->get();
        } else {
            $salles = Salle::all();
        }
    
        return view('Educational_Service.salle', compact('salles', 'type', 'departements'));
    }
    
    // Store a newly created salle
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'type_salle' => 'required|string',
            'nom_salle' => 'required|string',
            'id_departement' => 'nullable|exists:departements,id',
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
            'id_departement' => 'nullable|exists:departements,id',
        ]);        
        $salle = Salle::findOrFail($id);
        $salle->update($validatedData);
        return redirect()->route('salle.index')->with('success', 'Salle updated successfully');
    }

    // Remove the specified salle
    public function destroy($id)
    {
        $salle = Salle::findOrFail($id);
        $salle->delete();
        return redirect()->route('salle.index')->with('success', 'Salle deleted successfully');
    }
}
