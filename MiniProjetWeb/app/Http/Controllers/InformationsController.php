<?php

namespace App\Http\Controllers;

use App\Models\Professeur;
use App\Models\Etudiant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class InformationsController extends Controller
{
    public function showProfInformations()
    {
        // Assuming the user ID is linked to the professor ID
        $userId = Auth::id();
        $professeur = Professeur::where('id_user', $userId)
            ->with(['user', 'departement', 'filiere', 'cours.module', 'cours.classe'])
            ->firstOrFail();

        return view('professor.informations', compact('professeur'));
    }
    public function showEtudiantInformations()
    {
        $userId = Auth::id();
        $etudiant = Etudiant::where('id_user', $userId)
            ->with(['user', 'classe.filiere'])
            ->firstOrFail();
    
        return view('student.informations', compact('etudiant'));
    }    
        
}
