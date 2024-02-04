<?php

namespace App\Http\Controllers\Tables;

use App\Models\Etudiant;
use App\Models\Classe;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EtudiantController extends Controller
{
    public function ListALLEtudiant()
    {
        $etudiants = Etudiant::with(['classe', 'user'])->get();
        $classes = Classe::with('filiere')->get();
        // Fetch only users with id == 1 and not already linked to an etudiant
        $etudiantUserIds = $etudiants->pluck('user.id')->toArray();
        $users = User::where('role', 1)
                    ->whereNotIn('id', $etudiantUserIds)
                    ->get();
        
        return view('educational_service.etudiant', compact('etudiants', 'classes', 'users'));
    }
    public function store(Request $request)
    {   
        $delegueValue = $request->has('delegue') ? true : false;
        $validatedData = $request->validate([
            'CNE' => 'required|string|unique:etudiants,CNE',
            'Nom' => 'required|string',
            'prenom' => 'required|string',
            // 'delegue' is handled separately
            'id_user' => 'required|exists:users,id',
            'id_class' => 'required|exists:classes,id',
        ]);
    
        // Add the 'delegue' value to the validated data
        $validatedData['delegue'] = $delegueValue;
    
        Etudiant::create($validatedData);
    
        return redirect()->route('etudiant.index')->with('success', 'Etudiant created successfully');
    }
    
    public function update(Request $request, Etudiant $etudiant)   
    {
        $delegueValue = $request->has('delegue') ? true : false;
        $validatedData = $request->validate([
            'CNE' => 'required|string|unique:etudiants,CNE,' . $etudiant->id,
            'Nom' => 'required|string',
            'prenom' => 'required|string',
            'id_user' => 'required|exists:users,id',
            'id_class' => 'required|exists:classes,id',
        ]);
        $validatedData['delegue'] = $delegueValue;
        $etudiant->update($validatedData);          
        return redirect()->route('etudiant.index')->with('success', 'Etudiant updated successfully');
    }
    
    public function destroy($id)
    {
        $etudiant = Etudiant::findOrFail($id);
        $etudiant->delete();

        return redirect()->route('etudiant.index')->with('success', 'Etudiant deleted successfully');
    }
    public function filterByClass(Request $request)
    {
        $classId = $request->input('class_id');

        $etudiants = Etudiant::with(['classe', 'user'])
            ->where('id_class', $classId)
            ->get();

        $classes = Classe::with('filiere')->get();
        $users = User::where('role', 1)->get();

        return view('educational_service.etudiant', compact('etudiants', 'classes', 'users'));
    }

}
