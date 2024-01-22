<?php

namespace App\Http\Controllers\Tables;

use App\Models\Formation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class FormationController extends Controller
{
    public function listALLFormation()
    {
        $formations = Formation::all();
        return view('educational_service.formation', compact('formations'));
    }
    // Store a newly created resource in storage.
    public function store(Request $request)
    {
        Formation::create($request->all());
        return redirect()->route('formations.index');
    }

    // Show the form for editing the specified resource.
    public function edit(Formation $formation)
    {
        return view('formations.edit', compact('formation'));
    }

    // Update the specified resource in storage.
    public function update(Request $request, Formation $formation)
    {
        $validatedData = $request->validate([
            'nom_formation' => 'required|string|max:255',
            'abreviation_formation' => 'required|string|max:255',
        ]);

        $formation->update($validatedData);

        return redirect()->route('formations.index')->with('success', 'Formation updated successfully');
    }


    // Remove the specified resource from storage.
    public function destroy(Formation $formation)
    {
        $formation->delete();
        return redirect()->route('formations.index');
    }
}
