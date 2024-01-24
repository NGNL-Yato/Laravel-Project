<?php
namespace App\Http\Controllers\Other;

use App\Models\Jour;
use App\Models\Horaire;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 

class EmploidutempsController extends Controller
{
    public function index()
    {
        $jours = Jour::all();
        $horaires = Horaire::all();

        return view('educational_service.emploidutemps', compact('jours', 'horaires'));
    }
}
