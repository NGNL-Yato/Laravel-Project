<?php

namespace App\Http\Controllers\Tables;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Demande;


class DemandeController extends Controller
{
    public function listDemande()
    {
        $demandes = Demande::all();
        return view('Professor.indexDemande', compact('demandes'));
    }

    public function showDemande($id) {
        $demande = Demande::find($id);

        if ($demande) {
            return view('Professor.demande', compact('demande'));
        } else {
            // Handle the case where no demande with the given $id is found
            return abort(404);
        }
    }

    public function update(Request $request, Demande $demande)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'etat' => 'required|string|max:255',
        ]);
    
        // Update the 'etat' attribute of the demande
        $demande->update(['etat' => $validatedData['etat']]);
    
        // Redirect or return a response as needed
        return redirect()->route('Professor.demande', ['id' => $demande->id])->with('success', 'Demande updated successfully');

    }
    
    

    
}
