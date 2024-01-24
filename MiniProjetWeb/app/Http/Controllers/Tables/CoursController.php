<?php

namespace App\Http\Controllers\Tables;

use App\Models\Cours;
use App\Models\Module;
use App\Models\Professeur;
use App\Models\Classe;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CoursController extends Controller
{
    // Display a listing of cours
    public function index()
    {
        $cours = Cours::with(['module', 'professeur', 'classe'])->get();
        $modules = Module::all();
        $professeurs = Professeur::all();
        $classes = Classe::all();

        return view('Educational_Service.cours', compact('cours', 'modules', 'professeurs', 'classes'));
    }

    // Store a newly created cours
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'Numero_semestre' => 'required|integer',
            'id_module' => 'required|exists:modules,id',
            'id_prof' => 'required|exists:professeurs,id',
            'id_class' => 'required|exists:classes,id',
        ]);

        Cours::create($validatedData);

        return redirect()->route('cours.index')->with('success', 'Cours added successfully');
    }

    // Update the specified cours
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'Numero_semestre' => 'required|integer',
            'id_module' => 'required|exists:modules,id',
            'id_prof' => 'required|exists:professeurs,id',
            'id_class' => 'required|exists:classes,id',
        ]);

        $cours = Cours::findOrFail($id);
        $cours->update($validatedData);

        return redirect()->route('cours.index')->with('success', 'Cours updated successfully');
    }

    // Remove the specified cours
    public function destroy($id)
    {
        $cours = Cours::findOrFail($id);
        $cours->delete();

        return redirect()->route('cours.index')->with('success', 'Cours deleted successfully');
    }
}
