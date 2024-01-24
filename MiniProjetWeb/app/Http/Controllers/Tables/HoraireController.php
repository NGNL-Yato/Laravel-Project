<?php

namespace App\Http\Controllers\Tables;

use App\Models\Horaire;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class HoraireController extends Controller
{
    public function index()
    {
        $horaires = Horaire::all();
        return view('horaires.index', compact('horaires'));
    }
}
