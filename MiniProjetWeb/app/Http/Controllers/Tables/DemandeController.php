<?php

namespace App\Http\Controllers\Tables;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Demande;
use App\Models\User;


class DemandeController extends Controller
{
    public function listDemande()
    {
        $demandes = Demande::all();
        return view('Professor.indexDemande', compact('demandes'));
    }
    
}
