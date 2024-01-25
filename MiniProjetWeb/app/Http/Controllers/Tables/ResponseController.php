<?php

namespace App\Http\Controllers\Tables;

use App\Models\Response;
use Illuminate\Http\Request;
use App\Models\Professeur;
use App\Models\Demande;
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
}
