<?php

namespace App\Http\Controllers\Professor;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Models\Demande;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    // public function show() {
    //     $demandes = Demande::all();
    //     return view('Professor.indexDemande', ['demandes' => $demandes]);
    // }
        public function home()
        {
            return view ('Professor.home');
        }        
        
}

