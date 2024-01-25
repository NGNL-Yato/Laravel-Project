<?php

// app/Http/Controllers/AnnonceController.php

namespace App\Http\Controllers;

use App\Models\Annonce;
use Illuminate\Http\Request;

class AnnonceController extends Controller
{
    public function index()
    {
        $annonces = Annonce::where('visibilite_annonce', 'public')
            ->orderBy('date_creation', 'desc')
            ->get();

            return view('annonce', ['annonces' => $annonces]);
    }
}


