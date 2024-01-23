<?php

namespace App\Http\Controllers\Tables;

use App\Models\Salle;
use App\Models\Materiel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MaterielController extends Controller
{
    public function listAllMateriels()
    {
        $materiels = Materiel::all();
        $salles = Salle::all();
        $typeOptions = ['Table', 'Imprimante', 'Projecteur', 'Ordinateur', 'Point d’accès Wifi', 'Chaise', 'Tableau', 'Prise internet', 'Lampe', 'Routeur', 'Prise electrique', 'Autre'];
        $etatOptions = ['en panne', 'operationnel', 'reparable'];
        return view('educational_service.materiel', compact('materiels', 'salles', 'typeOptions', 'etatOptions'));
    }

    public function edit($id)
    {
        $materiel = Materiel::findOrFail($id);
        $salles = salle::all();

        return view('educational_service.materiel_edit', compact('materiel', 'salles'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'type_materiel' => 'required|string',
            'etat_materiel' => 'required|string',
            'id_salle' => 'required|exists:salles,id'
        ]);

        Materiel::create($validatedData);

        return redirect()->route('materiels.index')->with('success', 'Materiel added successfully');
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'type_materiel' => 'required|string',
            'etat_materiel' => 'required|string',
            'id_salle' => 'required|exists:salles,id'
        ]);

        $materiel = Materiel::findOrFail($id);
        $materiel->update($validatedData);

        return redirect()->route('materiels.index')->with('success', 'Materiel updated successfully');
    }

    public function destroy($id)
    {
        $materiel = Materiel::findOrFail($id);
        $materiel->delete();

        return redirect()->route('materiels.index')->with('success', 'Materiel deleted successfully');
    }
    // Add this method to your MaterielController

    public function filterBySalle($salleId)
    {
        $salles = Salle::all();
        $selectedSalle = Salle::findOrFail($salleId);
        $materiels = Materiel::where('id_salle', $salleId)->get();
    
        // Include these variables as well
        $typeOptions = ['Table', 'Imprimante', 'Projecteur', 'Ordinateur', 'Point d’accès Wifi', 'Chaise', 'Tableau', 'Prise internet', 'Lampe', 'Routeur', 'Prise electrique', 'Autre'];
        $etatOptions = ['en panne', 'operationnel', 'reparable'];
    
        return view('educational_service.materiel', compact('materiels', 'salles', 'selectedSalle', 'typeOptions', 'etatOptions'));
    }
    
    
}
