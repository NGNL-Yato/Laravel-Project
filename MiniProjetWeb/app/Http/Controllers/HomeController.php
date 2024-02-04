<?php

namespace App\Http\Controllers;

use App\Models\Annonce;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Filiere;
use App\Models\Departement;
use App\Models\Professeur;
use App\Models\DescriptionFormation;



class HomeController extends Controller
{
    public function indexWithAnnonces()
    {
        $departements = Departement::with('filieres')->get();
        $annonces = Annonce::where('cible_annonce', 'General')
            ->where('visibilite_annonce', 'visible')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('welcome', compact('annonces', 'departements'));
    }
    public function indexFormation($departementId, $filiereId) {
        $filiere = Filiere::where('id',$filiereId)->with('professeur.user')->get();
        $descriptionFormation = DescriptionFormation::where('id_filiere',$filiereId)->get();
        $departements = Departement::with('filieres')->get();
        return view('formation', compact('descriptionFormation', 'filiere', 'departements'));
    }
}