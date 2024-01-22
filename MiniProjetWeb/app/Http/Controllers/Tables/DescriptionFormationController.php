<?php

namespace App\Http\Controllers\Tables;

use App\Models\DescriptionFormation;
use App\Models\Filiere;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DescriptionFormationController extends Controller
{
    public function ListAllDescriptionFormation()
    {
        $descriptions = DescriptionFormation::with('filiere')->get();
        $filieres = Filiere::all(); // Retrieve all filieres
    
        // Now pass both $descriptions and $filieres to the view
        return view('educational_service.info_filiere', compact('descriptions', 'filieres'));
    }
    

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'objectif_text' => 'required',
            'competence_debouche' => 'required',
            'id_filiere' => 'required|exists:filieres,id'
        ]);

        DescriptionFormation::create($validatedData);
        return back()->with('success', 'Description added successfully');
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'objectif_text' => 'required',
            'competence_debouche' => 'required',
            'id_filiere' => 'required|exists:filieres,id'
        ]);

        $description = DescriptionFormation::findOrFail($id);
        $description->update($validatedData);

        return back()->with('success', 'Description updated successfully');
    }

    public function destroy($id)
    {
        $description = DescriptionFormation::findOrFail($id);
        $description->delete();

        return back()->with('success', 'Description deleted successfully');
    }
}
