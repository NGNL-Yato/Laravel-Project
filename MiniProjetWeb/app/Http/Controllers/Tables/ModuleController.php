<?php

namespace App\Http\Controllers\Tables;

use App\Models\Module;
use App\Models\Departement;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ModuleController extends Controller
{
    // Display a listing of modules
    public function index()
    {
        $modules = Module::all();
        $departements = Departement::all(); // Assuming you have a Departement model
        return view('Educational_Service.module', compact('modules', 'departements'));
    }
    

    // Store a newly created module
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nom_module' => 'required|string',
            'type_module' => 'required|string',
            'id_departement' => 'required|exists:departements,id'
        ]);

        Module::create($validatedData);

        return redirect()->route('modules.index')->with('success', 'Module added successfully');
    }
    // Update the specified module
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nom_module' => 'required|string',
            'type_module' => 'required|string',
            'id_departement' => 'required|exists:departements,id'
        ]);
    
        $module = Module::findOrFail($id);
        $module->update($validatedData);
    
        return redirect()->route('modules.index')->with('success', 'Module updated successfully');
    }

    // Remove the specified module
    public function destroy($id)
    {
        $module = Module::findOrFail($id);
        $module->delete();

        return redirect()->route('modules.index')->with('success', 'Module deleted successfully');
    }
}
