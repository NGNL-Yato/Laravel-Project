<?php

namespace App\Http\Controllers\Tables;

use App\Models\Annonce;
use App\Models\Classe;
use App\Models\Filiere;
use App\Models\Cours;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Models\Professeur;
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

    public function annoncesCombinedEtudiants()
    {
        // Fetch annonces for Etudiants
        $annoncesEtudiants = Annonce::where('cible_annonce', 'Etudiants')->get();
    
        // Fetch annonces for the user's class
        $user = Auth::user();
        $annoncesUserClass = collect([]);
        if ($user->etudiant) {
            $classId = $user->etudiant->id_class;
            $annoncesUserClass = Annonce::where('id_class', $classId)->get();
        }
    
        // Combine both collections
        $annonces = $annoncesEtudiants->merge($annoncesUserClass);
    
        return view('student.annonces', compact('annonces'));
    }
    
    // Display announcements for Professeurs
    public function annoncesForProfesseurs()
    {
        $annonces = Annonce::where('cible_annonce', 'Professeurs')->where('visibilite_annonce', 'visible')->get();
        return view('annonces.annoncesForProfesseurs', compact('annonces'));
    }

    // Display announcements for the Home page
    public function annoncesForGeneral()
    {
        $annonces = Annonce::where('cible_annonce', 'General')->where('visibilite_annonce', 'visible')->get();
        return view('annonces.annoncesForGeneral', compact('annonces'));
    }

    // Display announcements for Etudiants
    public function annoncesForEtudiants()
    {
        $annonces = Annonce::where('cible_annonce', 'Etudiants')
                            ->where('visibilite_annonce', 'visible')
                            ->get();
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
    public function classesForChefDeFiliere()
    {
        $user = auth()->user();
        $professeur = Professeur::where('id_user', $user->id)->first();
        if ($professeur) {
            $filiere = Filiere::where('id_prof', $professeur->id)->first();
            if ($filiere) {
                $classes = Classe::where('id_filiere', $filiere->id)->get();
                $annoncesForClasses = collect([]);
                foreach ($classes as $class) {
                    $annonces = Annonce::where('id_class', $class->id)->get();
                    if($annonces) {
                        $annoncesForClasses = $annoncesForClasses->concat($annonces);
                    }
                }
            }
        }
        $annoncesForStudents = Annonce::where('cible_annonce', 'Etudiants')->get();
        $annoncesForProfesseurs = Annonce::where('cible_annonce', 'Professeurs')->get();
        $annonces = ($annoncesForClasses ?? collect([]))->merge($annoncesForStudents)->merge($annoncesForProfesseurs)->unique('id');
        return view('sector_responsible.annonces', compact('annonces', 'classes','filiere'));
    }
    public function storeForChefDeFiliere(Request $request)
    {
        $validatedData = $request->validate([
            'visibilite_annonce' => 'required',
            'cible_annonce' => 'required',
            'type_annonce' => 'required',
            'titre_annonce' => 'required',
            'contenu_annonce' => 'required',
            'id_user' => 'required|exists:users,id',
        ]);
        if (is_numeric($request->cible_annonce)) {
            $class = Classe::find($request->cible_annonce);
            $validatedData['id_class'] = $class ? $class->id : null;
        } else {
            $validatedData['id_class'] = null;
        }
        Annonce::create($validatedData);
        return redirect()->route('sector_responsible.annonces')->with('success', 'Annonce added successfully');
    }
    
    public function updateForChefDeFiliere(Request $request, $id)
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
        return redirect()->route('sector_responsible.annonces')->with('success', 'Annonce added successfully');
    }
    public function destroyForChefDeFiliere($id)
    {
        $annonce = Annonce::findOrFail($id);
        $annonce->delete();
        return redirect()->route('sector_responsible.annonces')->with('success', 'Annonce deleted successfully');
    }
    public function annoncesForProfessor()
    {
        $user = Auth::user();
        $user = Auth::user();
        $classes = Classe::join('cours', 'classes.id', '=', 'cours.id_class')
        ->where('cours.id_prof', $user->id)
        ->select('classes.*') // select all columns from classes
        ->get();
        $professeur = Professeur::where('id_user', $user->id)->first();
        $ownAnnonces = Annonce::where('id_user', $user->id)->get();
        $annoncesForProfesseurs = Annonce::where('cible_annonce', 'Professeurs')->where('visibilite_annonce', 'visible')->get();
        if($ownAnnonces) {
            $annonces = $annoncesForProfesseurs->merge($ownAnnonces)->unique('id');
        } else {
            $annonces = $annoncesForProfesseurs;
        }
        if (!$annonces) {
            $annonces = null;
        }
        return view('professor.annonces', compact('annonces', 'classes'));
    }
    public function storeForProfessor(Request $request)
{
    $user = Auth::user();

    $validatedData = $request->validate([
        'visibilite_annonce' => 'required',
        'cible_annonce' => 'required',
        'type_annonce' => 'required',
        'titre_annonce' => 'required',
        'contenu_annonce' => 'required',
        'id_class' => 'nullable|exists:classes,id',
    ]);

    $validatedData['id_user'] = $user->id; // Set the user ID to the professor's user ID

    Annonce::create($validatedData);

    return redirect()->route('professor.annonces')->with('success', 'Annonce added successfully');
    }
    public function updateForProfessor(Request $request, $id)
    {
        $user = Auth::user();
        $annonce = Annonce::where('id_user', $user->id)->findOrFail($id); // Ensure the professor owns the annonce

        $validatedData = $request->validate([
            'visibilite_annonce' => 'required',
            'cible_annonce' => 'required',
            'type_annonce' => 'required',
            'titre_annonce' => 'required',
            'contenu_annonce' => 'required',
            'id_class' => 'nullable|exists:classes,id',
        ]);

        $annonce->update($validatedData);

        return redirect()->route('professor.annonces')->with('success', 'Annonce updated successfully');
    }
    public function destroyForProfessor($id)
    {
        $user = Auth::user();
        $annonce = Annonce::where('id_user', $user->id)->findOrFail($id); // Ensure the professor owns the annonce

        $annonce->delete();

        return redirect()->route('professor.annonces')->with('success', 'Annonce deleted successfully');
    }

}
