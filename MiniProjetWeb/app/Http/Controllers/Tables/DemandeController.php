<?php

namespace App\Http\Controllers\Tables;

use App\Models\Demande;
use App\Models\Etudiant;
use App\Models\Professeur;  
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DemandeController extends Controller
{
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
        $professor = Professeur::where('id_user',$userId)->first();
        $demandes = Demande::where('id_prof', $professor->id)->get();
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

        return redirect()->route('sector_responsible.store')->with('success', 'Demande added successfully');
    }
    public function showChefFiliereDemandes(Request $request)
    {
        $userId = Auth::id();
        $subjects = ['Justification d\'une absence', 'Demande de rendez-vous', 'Demande de lettre de recommandation'];
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
}