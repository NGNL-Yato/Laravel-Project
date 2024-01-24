<?php

namespace App\Http\Controllers\Tables;

use App\Models\Jour;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class JourController extends Controller
{
    public function index()
    {
        $jours = Jour::all();
        return view('jours.index', compact('jours'));
    }
}
