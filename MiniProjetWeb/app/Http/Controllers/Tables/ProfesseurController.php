<?php

namespace App\Http\Controllers\Tables;

use App\Models\User; 
use App\Models\Professeur;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfesseurController extends Controller
{
    public function listALLProfesseur()
    {
        $professeurs = Professeur::all();
    
        // Get IDs of users who are already professors
        $professorUserIds = Professeur::pluck('id_user')->all();
    
        // Fetch teachers excluding those who are already professors
        $teachers = User::where('role', 2)
                        ->whereNotIn('id', $professorUserIds)
                        ->get();
    
        return view('educational_service.professeur', compact('professeurs', 'teachers'));
    }
    
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'Code_prof' => 'required|unique:professeurs,Code_prof',
                'nom' => 'required',
                'prenom' => 'required',
                'teacher_id' => 'required|exists:users,id' // Assuming this is the foreign key to users table
            ]);
    
            Professeur::create([
                'Code_prof' => $validatedData['Code_prof'],
                'nom' => $validatedData['nom'],
                'prenom' => $validatedData['prenom'],
                'id_user' => $validatedData['teacher_id']
            ]);
    
            return redirect()->route('professeurs.index');
        } catch (\Exception $e) {
            return back()->withErrors('An error occurred: ' . $e->getMessage());
        }
    }    
    public function update(Request $request, Professeur $professeur)
    {
        $validatedData = $request->validate([
            'Code_prof' => 'required|unique:professeurs,Code_prof,' . $professeur->id,
            'nom' => 'required',
            'prenom' => 'required',
        ]);

        $professeur->update($validatedData);
        return redirect()->route('professeurs.index');
    }   
    public function destroy(Professeur $professeur)
    {
        $professeur->delete();
        return redirect()->route('professeurs.index');
    }
}
