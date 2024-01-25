<?php

namespace App\Http\Controllers;

use App\Models\Professeur;
use App\Models\Etudiant;
use Illuminate\Http\Request;
use App\Models\Departement;
use App\Models\Filiere;
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
    public function showDepartmentChiefInformations()
    {
        // Assuming the user ID is linked to the Professor ID
        $userId = Auth::id();
        $professeur = Professeur::where('id_user', $userId)->with(['cours.module', 'cours.classe'])->first();
        $departmentChief = Departement::where('id_prof', $professeur->id)->first();

        return view('Department_chief.informations', compact('departmentChief', 'professeur'));
    }

    public function showSectorResponsibleInformations()
    {
        // Assuming the user ID is linked to the Professor ID
        $userId = Auth::id();
        $professeur = Professeur::where('id_user', $userId)->with(['cours.module', 'cours.classe'])->first();
        $sectorResponsible = Filiere::where('id_prof', $professeur->id)->first();

        return view('Sector_responsible.informations', compact('sectorResponsible', 'professeur'));
    }
}
