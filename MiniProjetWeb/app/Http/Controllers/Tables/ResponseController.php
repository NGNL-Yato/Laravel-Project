<?php

namespace App\Http\Controllers\Tables;

use App\Models\Response;
use Illuminate\Http\Request;
use App\Models\Professeur;
use App\Models\Demande;
use App\Models\Etudiant;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ResponseController extends Controller
{
    public function showProfessorDemandes(Request $request)
    {
        $userId = Auth::id();
        $professor = Professeur::where('id_user', $userId)->first();

        if (!$professor) {
            return redirect()->back()->with('error', 'Professor not found');
        }

        $demandes = Demande::where('id_prof', $professor->id)->get();

        return view('Professor.Reponse', compact('professor', 'demandes'));
    }
    public function store(Request $request)
    {
        $userId = Auth::id();
        $demande = Demande::find($request->demande_id);

        if (!$demande) {
            return back()->with('error', 'Demande not found');
        }

        $response = new Response;
        $response->content = $request->content;
        $response->demande_id = $demande->id;
        $response->user_id = $userId;
        $response->save();

        $demande->etat_demande = $request->etat_demande;
        $demande->save();

        return back()->with('success', 'Response sent successfully');
    }
    public function showStudentResponses(Request $request)
    {
        $userId = Auth::id();
        $responsesofDemande = Response::whereHas('demande', function ($query) use ($userId) {
            $query->where('id_user', $userId);
        })->get();
        $responses = Response::where('user_id', $userId)->get();
        $responses = $responsesofDemande->merge($responses);

        return view('student.reponse', compact('responses'));
    }
    public function showProfessorResponses(Request $request)
    {
        $userId = Auth::id();
        $responsesofDemande = Response::whereHas('demande', function ($query) use ($userId) {
            $query->where('id_user', $userId);
        })->get();
        $responses = Response::where('user_id', $userId)->get();
        $reponses = $responsesofDemande->merge($responses);

        return view('professor.reponse', compact('responses'));
    }
    public function storeChefDepartement(Request $request)
    {
        $userId = Auth::id();
        $demande = Demande::find($request->demande_id);

        if (!$demande) {
            return back()->with('error', 'Demande not found');
        }

        $response = new Response;
        $response->content = $request->content;
        $response->demande_id = $demande->id;
        $response->user_id = $userId;
        $response->save();

        $demande->etat_demande = $request->etat_demande;
        $demande->save();

        return back()->with('success', 'Response sent successfully');
    }
    public function storeChefFiliere(Request $request)
    {
        $userId = Auth::id();
        $demande = Demande::find($request->demande_id);

        if (!$demande) {
            return back()->with('error', 'Demande not found');
        }

        $response = new Response;
        $response->content = $request->content;
        $response->demande_id = $demande->id;
        $response->user_id = $userId;
        $response->save();

        $demande->etat_demande = $request->etat_demande;
        $demande->save();

        return back()->with('success', 'Response sent successfully');
    }
    public function storeServiceEducationel(Request $request)
    {
        $userId = Auth::id();
        $demande = Demande::find($request->demande_id);

        if (!$demande) {
            return back()->with('error', 'Demande not found');
        }

        $response = new Response;
        $response->content = $request->content;
        $response->demande_id = $demande->id;
        $response->user_id = $userId;
        $response->save();

        $demande->etat_demande = $request->etat_demande;
        $demande->save();

        return back()->with('success', 'Response sent successfully');
    }
    public function showChefDepartmentResponses(Request $request)
    {
        $userId = Auth::id();
        $responses = Response::whereHas('demande', function ($query) use ($userId) {
            $query->where('id_user', $userId);
        })->get();

        return view('chief_department.reponse', compact('responses'));
    }
    public function showChefFiliereResponses(Request $request)
    {
        $userId = Auth::id();
        $responses = Response::whereHas('demande', function ($query) use ($userId) {
            $query->where('id_user', $userId);
        })->get();

        return view('sector_responsible.reponse', compact('responses'));
    }
    public function showServiceEducationnel(Request $request)
    {
        $userId = Auth::id();
        $responses = Response::whereHas('demande', function ($query) use ($userId) {
            $query->where('id_user', $userId);
        })->get();

        return view('educational_service.reponse', compact('responses'));
    }
}
