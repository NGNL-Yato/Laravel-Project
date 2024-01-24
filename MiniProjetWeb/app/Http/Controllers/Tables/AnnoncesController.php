<?php

namespace App\Http\Controllers\Tables;

use App\Models\Annonce;
use App\Models\Classe;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnnoncesController extends Controller
{
    // Display a listing of annonces
    public function index(Request $request)
    {
        $classes = Classe::all();
        $annonces = Annonce::with('classe', 'user');

        if ($request->has('classe') && $request->classe != '') {
            $annonces->where('id_class', $request->classe);
        }

        $annonces = $annonces->get();

        return view('Department_chief.annonces', compact('annonces', 'classes'));
    }

    // Store a newly created annonce
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'visibilite_annonce' => 'required',
            'cible_annonce' => 'required',
            'type_annonce' => 'required',
            'titre_annonce' => 'required',
            'contenu_annonce' => 'required',
            'id_class' => 'nullable|exists:classes,id',
            'id_user' => 'required|exists:users,id',
        ]);
        if (!$request->has('id_class')) {
            $validatedData['id_class'] = null;
        }
    
        Annonce::create($validatedData);
    
        return redirect()->route('departmentChief.annonces')->with('success', 'Annonce added successfully');
    }
    // Update the specified annonce
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'visibilite_annonce' => 'required',
            'cible_annonce' => 'required',
            'type_annonce' => 'required',
            'titre_annonce' => 'required',
            'contenu_annonce' => 'required',
            'id_class' => 'nullable|exists:classes,id',
            'id_user' => 'required|exists:users,id',
        ]);

        $annonce = Annonce::findOrFail($id);
        $annonce->update($validatedData);

        return redirect()->route('departmentChief.annonces')->with('success', 'Annonce updated successfully');
    }

    // Remove the specified annonce
    public function destroy($id)
    {
        $annonce = Annonce::findOrFail($id);
        $annonce->delete();

        return redirect()->route('departmentChief.annonces')->with('success', 'Annonce deleted successfully');
    }

    //Affiche les annonces des etudiants
    public function annoncesForUserClass()
    {
        $user = Auth::user();
        if (!$user->etudiant) {
            // Handle the case where the user is not an etudiant
            return back()->with('error', 'No class associated with the user');
        }
        $classId = $user->etudiant->id_class;
        $annonces = Annonce::where('id_class', $classId)->get();

        return view('annonces.userClassAnnonces', compact('annonces'));
    }
    // Display announcements for Professeurs
    public function annoncesForProfesseurs()
    {
        $annonces = Annonce::where('cible_annonce', 'Professeurs')->get();
        return view('annonces.annoncesForProfesseurs', compact('annonces'));
    }

    // Display announcements for the Home page
    public function annoncesForGeneral()
    {
        $annonces = Annonce::where('cible_annonce', 'General')->get();
        return view('annonces.annoncesForGeneral', compact('annonces'));
    }

    // Display announcements for Etudiants
    public function annoncesForEtudiants()
    {
        $annonces = Annonce::where('cible_annonce', 'Etudiants')->get();
        return view('annonces.annoncesForEtudiants', compact('annonces'));
    }

    // Display announcements for the Education Service
    public function annoncesForEducationalService()
    {
        // Fetch annonces specific to Educational_Service
        $annonces = Annonce::whereNull('id_class')->get();
        // Return the view with the annonces data
        return view('Educational_Service.annonces', compact('annonces'));
    }
    public function updateForEducationalService(Request $request, $id)
    {
        $validatedData = $request->validate([
            'visibilite_annonce' => 'required',
            'cible_annonce' => 'required',
            'type_annonce' => 'required',
            'titre_annonce' => 'required',
            'contenu_annonce' => 'required',
            'id_class' => 'nullable|exists:classes,id',
            'id_user' => 'required|exists:users,id',
        ]);

        $annonce = Annonce::findOrFail($id);
        $annonce->update($validatedData);

        return redirect()->route('educationalService.annonces')->with('success', 'Annonce updated successfully');
    }
    public function storeForEducationalService(Request $request)
    {
        $validatedData = $request->validate([
            'visibilite_annonce' => 'required',
            'cible_annonce' => 'required',
            'type_annonce' => 'required',
            'titre_annonce' => 'required',
            'contenu_annonce' => 'required',
            'id_class' => 'nullable|exists:classes,id',
            'id_user' => 'required|exists:users,id',
        ]);
        if (!$request->has('id_class')) {
            $validatedData['id_class'] = null;
        }
    
        Annonce::create($validatedData);
        return redirect()->route('educationalService.annonces')->with('success', 'Annonce added successfully');
    }
    public function destroyForEducationalService($id)
    {
        $annonce = Annonce::findOrFail($id);
        $annonce->delete();

        return redirect()->route('educationalService.annonces')->with('success', 'Annonce deleted successfully');
    }
}
