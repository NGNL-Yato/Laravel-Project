<?php

namespace App\Http\Controllers\Tables;

use App\Models\Demande;
use App\Models\Etudiant;
use App\Models\Professeur;  
use App\Models\Departement;
use App\Models\Filiere;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DemandeController extends Controller
{
    public function ViewEducational_Service()
    {
        $demandes = Demande::whereIn('type_demande', ['Signalement Matériel', 'Réservation'])->get();

        return view('educational_service.demande', compact('demandes'));
    }
    public function index(Request $request)
    {
        $userId = Auth::id();
        $etudiant = Etudiant::where('id_user', $userId)
            ->with(['user', 'classe.filiere'])
            ->first();

        $professeurs = Professeur::whereHas('cours', function ($query) use ($etudiant) {
            $query->where('id_class', $etudiant->id_class);
        })->with('user')->get();

        $demandes = Demande::where('id_user', $userId)->with('professeur.user')->get();        
        // dd($demandes, $professeurs);
        return view('Student.Demande', compact('demandes', 'professeurs'));
    }

    // Store a newly created demande
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'type_demande' => 'required|string',
            'contenu_demande' => 'required|string',
            'id_prof' => 'nullable|exists:professeurs,id',
        ]);

        $validatedData['id_user'] = auth()->id();
        $validatedData['etat_demande'] = 'En cours de Traitement';

        Demande::create($validatedData);

        return redirect()->route('Student.Demande')->with('success', 'Demande added successfully');
    }
    // Remove the specified demande
    public function destroy($id)
    {
        $demande = Demande::findOrFail($id);
        $demande->delete();

        return redirect()->route('Student.Demande')->with('success', 'Demande deleted successfully');
    }
    public function showProfessor(Request $request)
    {
        $userId = Auth::id();
        $subjects = ['Demande de changement de groupe de TP'];
        $professor = Professeur::where('id_user',$userId)->first();
        $demandes = Demande::where('id_prof', $professor->id)->whereIn('type_demande', $subjects)->get();
        return view('Professor.Demande', compact('professor', 'demandes'));
    }
    public function storeProfessor(Request $request)
    {
        $validatedData = $request->validate([
            'contenu_demande' => 'required|string',
        ]);

        $validatedData['id_user'] = auth()->id();
        $validatedData['etat_demande'] = 'En cours de Traitement';
        $validatedData['type_demande'] = 'Réservation'; // Set default value for type_demande
        $validatedData['id_etudiant'] = null; // Set default value for id_etudiant

        Demande::create($validatedData);

        return redirect()->route('Professor.Demande.store')->with('success', 'Demande added successfully');
    }
    public function showChefFiliereDemandes(Request $request)
    {
        $userId = Auth::id();
        $subjects = ['Justification d\'une absence','Justification de changement de bureau', 'Demande de rendez-vous', 'Demande de lettre de recommandation'];
        $demandesUser = Demande::where('id_user', $userId)->get();
        $professor = Professeur::where('id_user', $userId)->first();
        $demandes = Demande::whereNull('id_prof')
            ->whereIn('type_demande', $subjects)
            ->whereHas('user.etudiant.classe.filiere', function ($query) use ($professor) {
                $query->where('id_prof', $professor->id);
            })->get();
        $demandes = $demandes->merge($demandesUser);
        return view('sector_responsible.demande', compact('demandes','professor'));
    }
    public function storeChefFiliereDemande(Request $request)
    {
        $validatedData = $request->validate([
            'type_demande' => 'required|string',
            'contenu_demande' => 'required|string',
            'id_prof' => 'nullable|exists:professeurs,id',
        ]);

        $validatedData['id_user'] = auth()->id();
        $validatedData['etat_demande'] = 'En cours de Traitement';

        Demande::create($validatedData);

        return redirect()->back()->with('success', 'Demande deleted successfully.');
    }
    public function destroyChefFiliereDemande($id)
    {
        $demande = Demande::findOrFail($id);
        $demande->delete();

        return redirect()->back()->with('success', 'Demande deleted successfully.');
    }
    public function showDepartmentChief(Request $request)
    {
        $professors = Professeur::all();
        $departements = Departement::with('professeur')->get();
        $filieres = Filiere::with('professeur')->get();
        $demandes = Demande::where('id_user', Auth::id())->get();
        return view('Department_chief.Demande', compact('professors', 'departements', 'filieres', 'demandes'));
    }
    public function storeDepartmentChief(Request $request)
    {
        $validatedData = $request->validate([
            'type_demande' => 'required|string',
            'contenu_demande' => 'required|string',
            'id_prof' => 'nullable|exists:professeurs,id',
        ]);

        $validatedData['id_user'] = auth()->id();
        $validatedData['etat_demande'] = 'En cours de Traitement';

        Demande::create($validatedData);

        return redirect()->route('Department_chief.Demande')->with('success', 'Demande added successfully');
    }

    public function updateDepartmentChief(Request $request, $id)
    {
        $validatedData = $request->validate([
            'type_demande' => 'required|string',
            'contenu_demande' => 'required|string',
        ]);

        $demande = Demande::findOrFail($id);
        $demande->update($validatedData);

        return redirect()->route('Department_chief.Demande')->with('success', 'Demande updated successfully');
    }

    public function destroyDepartmentChief($id)
    {
        $demande = Demande::findOrFail($id);
        $demande->delete();

        return redirect()->route('Department_chief.Demande')->with('success', 'Demande deleted successfully');
    }
}