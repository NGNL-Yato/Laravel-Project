<?php

namespace App\Http\Controllers\Tables;

use App\Models\Classe;
use App\Models\Materiel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MaterielController extends Controller
{
    public function listAllMateriels()
    {
        $materiels = Materiel::all();
        $classes = Classe::all();

        return view('educational_service.materiel', compact('materiels', 'classes'));
    }

    public function edit($id)
    {
        $materiel = Materiel::findOrFail($id);
        $classes = Classe::all();

        return view('educational_service.materiel_edit', compact('materiel', 'classes'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'type_materiel' => 'required|string',
            'etat_materiel' => 'required|string',
            'id_class' => 'required|exists:classes,id'
        ]);

        Materiel::create($validatedData);

        return redirect()->route('materiels.index')->with('success', 'Materiel added successfully');
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'type_materiel' => 'required|string',
            'etat_materiel' => 'required|string',
            'id_class' => 'required|exists:classes,id'
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
}
