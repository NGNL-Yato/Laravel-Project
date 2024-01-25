<?php

namespace App\Http\Controllers\Tables;

use App\Models\Classe;
use App\Models\Filiere;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClasseController extends Controller
{
    // Display a listing of classes
    public function ListALLClass(Request $request)
    {
        $filieres = Filiere::all();
        $classesQuery = Classe::with('filiere');
    
        if ($request->has('filiere') && $request->filiere != '') {
            $classesQuery->where('id_filiere', $request->filiere);
        }
    
        $classes = $classesQuery->get();
    
        return view('Educational_Service.class', compact('classes', 'filieres'));
    }
    
    // Store a newly created class
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_filiere' => 'required|exists:filieres,id',
            'Numero_groupe' => 'required|integer'
        ]);

        Classe::create($validatedData);

        return redirect()->route('classe.index')->with('success', 'Class added successfully');
    }

    // Show the form for editing the specified class
    public function edit($id)
    {
        $class = Classe::findOrFail($id);
        $filieres = Filiere::all();
        return view('Educational_Service.class', compact('class', 'filieres'));
    }

    // Update the specified class
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'id_filiere' => 'required|exists:filieres,id',
            'Numero_groupe' => 'required|integer'
        ]);
    
        $class = Classe::findOrFail($id);
        $class->update($validatedData);
    
        return redirect()->route('classe.index')->with('success', 'Class updated successfully');
    }
    

    // Remove the specified class
    public function destroy($id)
    {
        $class = Classe::findOrFail($id);
        $class->delete();

        return redirect()->route('classe.index')->with('success', 'Class deleted successfully');
    }
}
