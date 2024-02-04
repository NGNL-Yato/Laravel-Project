<?php

namespace App\Http\Controllers\Tables;

use App\Models\Sceance;
use App\Models\Etudiant;
use App\Models\Professeur;
use App\Models\Departement;
use App\Models\Filiere;
use App\Models\Classe;
use App\Models\Cours;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Salle;

class SceanceController extends Controller
{
    public function index()
    {
        $sceances = Sceance::all();
        return view('sceances.index', compact('sceances'));
    }
    public function showAvailableSalles()
    {
        $salles = Salle::whereNull('id_departement')->get();
        $sceances = Sceance::all();
        $cours = Cours::all();
        return view('educational_service.emploidutemps', compact('salles', 'sceances','cours'));
    }
    public function getTimetableForSalle($salleId)
    {
        $sceances = Sceance::with('cours.module')->where('id_salle', $salleId)->get();
        $salles = Salle::whereNull('id_departement')->get();
        $cours = Cours::with('classe', 'classe.filiere', 'module')->get();
        $currentsalle = Salle::find($salleId);

        return view('educational_service.emploidutemps', compact('currentsalle','sceances', 'salles', 'cours'));
    }
    public function store(Request $request)
    {   
        $sceance = Sceance::create($request->all());
        return back()->with('success', 'Sceance created successfully');
    }

    public function update(Request $request, Sceance $sceance)
    {
        $sceance->update($request->all());
        return back()->with('success', 'Sceance updated successfully');
    }
    public function destroyChef($id)
    {
        $sceance = Sceance::find($id);

        if ($sceance) {
            $sceance->delete();
            return back()->with('success', 'Sceance updated successfully');
        }

        return redirect()->route('sceance.index')->with('error', 'Sceance not found');
    }
    public function destroy($id)
    {
        $sceance = Sceance::find($id);

        if ($sceance) {
            $sceance->delete();
            return back()->with('success', 'Sceance updated successfully');
        }

        return redirect()->route('sceance.index')->with('error', 'Sceance not found');
    }
    public function storeByChief(Request $request)
    {
        $sceance = Sceance::create($request->all());
        return back()->with('success', 'Sceance created successfully by chief_department');
    }

    public function updateByChief(Request $request, Sceance $sceance)
    {
        $sceance->update($request->all());
        return back()->with('success', 'Sceance updated successfully by chief_department');
    }

    public function destroyByChief(Sceance $sceance)
    {
        $sceance->delete();
        return back()->with('success', 'Sceance deleted successfully by chief_department');
    }
    public function showForStudent(Request $request)
    {
        $studentId = Auth::id(); // Get the current user's ID
        $student = Etudiant::where('id_user', $studentId)->first(); // Find the student with this user ID
        $sceances = Sceance::with('cours.module')->where('id_class', $student->id_class)->get();
        $cours = Cours::with('classe', 'classe.filiere', 'module')->where('id_class', $student->id_class)->get();
        return view('student.emploidutemps', compact('sceances','student','cours'));
    }
    public function showAvailableSallesChef()
    {
        $user = Auth::user();
        $professor = Professeur::where('id_user', $user->id)->first();

        if ($professor) {
            $departement = Departement::where('id_prof', $professor->id)->first();
            if ($departement) {
                $salles = Salle::where('id_departement', $departement->id)->get();
            } else {
                $salles = collect(); // empty collection
            }
        } else {
            $salles = collect(); // empty collection
        }

        $sceances = Sceance::all();
        $cours = Cours::all();

        return view('Department_chief.emploi', compact('salles', 'sceances','cours'));
    }
    public function showForChief($salleId)
    {
        $sceances = Sceance::with('cours.module')->where('id_salle', $salleId)->get();
        $salles = Salle::wherenotNull('id_departement')->get();
        $cours = Cours::with('classe', 'classe.filiere', 'module')->get();
        $currentsalle = Salle::find($salleId);
    
        return view('Department_chief.emploi', compact('currentsalle','sceances', 'salles', 'cours'));
    }
    public function showForFiliereProf(Request $request)
    {
        $profId = Auth::id();
        $prof = Professeur::where('id_user', $profId)->first();
        $cours = Cours::with('classe', 'classe.filiere', 'module')->where('id_prof', $prof->id)->get();
        $sceances = Sceance::with('cours.classe','cours.module')->whereIn('id_cours', $cours->pluck('id'))->get();
        return view('sector_responsible.emploidutemps', compact('cours', 'sceances'));
    }
    public function showCoursesForProf(Request $request)
    {
        $profId = Auth::id();
        $prof = Professeur::where('id_user', $profId)->first();
        $cours = Cours::with('classe', 'classe.filiere', 'module')->where('id_prof', $prof->id)->get();
        $sceances = Sceance::with('cours.classe','cours.module')->whereIn('id_cours', $cours->pluck('id'))->get();
        return view('professor.emploidutemps', compact('cours', 'sceances'));
    }
}