<?php

namespace App\Http\Controllers;

use App\Models\MaterielInformatique;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MaterielInformatiqueController extends Controller
{
    public function index($id)
    {
        return view('MaterialInformatique.material_form',  ['id' => $id]);
    }
    public function addMateriel(Request $request, $id)
    {
        $validatedData = $request->validate([
            'num_inv' => 'required|string',
            'type' => 'required|string',
            'marque' => 'required|string',
            'date_dacquisition' => 'required|date',
            'ef' => 'required|date',
            'etat' => 'required|string',
        ]);
        // Create a new instance of the MaterielInformatique model
        $materiel = new MaterielInformatique([
            'Num_Inv' => $validatedData['num_inv'],
            'type' => $validatedData['type'],
            'marque' => $validatedData['marque'],
            'dateDacquisition' => $validatedData['date_dacquisition'],
            'EF' => $validatedData['ef'],
            'etat' => $validatedData['etat'],
            'codeGresa' => $id, // Assigning the codeGresa based on the $id parameter
        ]);
        // Save the new MaterielInformatique record to the database
        $materiel->save();

        // Redirect or return a response as needed
        return redirect()->route('admin.dashboard');
    }
    public function deleteMateriel($id)
    {
        // Assuming you have a model for MaterielInformatique
        $materiel = MaterielInformatique::find($id);

        if (!$materiel) {
            // Handle not found, maybe redirect or show an error message
            return redirect()->back()->with('error', 'Materiel not found');
        }

        // Delete the materiel
        $materiel->delete();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Materiel deleted successfully');
    }
    public function editMateriel($id)
    {
        // Assuming you have a model for MaterielInformatique
        $materiel = MaterielInformatique::find($id);

        if (!$materiel) {
            // Handle not found, maybe redirect or show an error message
            return redirect()->back()->with('error', 'Materiel not found');
        }

        // You might want to load a form for editing here
        // For simplicity, let's redirect to a generic edit view
        return view('MaterialInformatique.edit_material', compact('materiel'));
    }

    public function updateMateriel(Request $request, $id)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'num_inv' => 'required|string',
            'type' => 'required|string',
            'marque' => 'required|string',
            'date_dacquisition' => 'required|date',
            'ef' => 'required|date',
            'etat' => 'required|string',
            // Add more validation rules as needed
        ]);

        // Find the MaterielInformatique model instance by ID
        $materiel = MaterielInformatique::find($id);

        // Check if the MaterielInformatique record exists
        if (!$materiel) {
            return redirect()->back()->with('error', 'Materiel not found');
        }

        // Update the MaterielInformatique record with the validated data
        $materiel->update([
            'Num_Inv' => $validatedData['num_inv'],
            'type' => $validatedData['type'],
            'marque' => $validatedData['marque'],
            'dateDacquisition' => $validatedData['date_dacquisition'],
            'EF' => $validatedData['ef'],
            'etat' => $validatedData['etat'],
            // Update more fields as needed
        ]);

        // Redirect or return a response as needed
        return redirect()->route('admin.dashboard')->with('success', 'Materiel updated successfully');
    }

    // this is for letting the etablissement to add a new materiel Informatique
    public function showMaterialForm()
    {
        return view('materialInformatique.admin.add_material_form');
    }

    public function addMaterial(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'num_inv' => 'required|string',
            'type' => 'required|string',
            'marque' => 'required|string',
            'date_dacquisition' => 'required|date',
            'ef' => 'required|date',
            'etat' => 'required|string',
            // Add more validation rules as needed
        ]);

        // Retrieve the currently authenticated Etablissement
        $etablissement = Auth::guard('etablissement')->user();

        // Create a new material belonging to the authenticated Etablissement
        $materiel = new MaterielInformatique([
            'Num_Inv' => $validatedData['num_inv'],
            'type' => $validatedData['type'],
            'marque' => $validatedData['marque'],
            'dateDacquisition' => $validatedData['date_dacquisition'],
            'EF' => $validatedData['ef'],
            'etat' => $validatedData['etat'],
            'codeGresa' => $etablissement->id,
        ]);
        $materiel->save();
        // Save the new MaterielInformatique record to the database
        $etablissementWithMateriel = Auth::guard('etablissement')->user()->load('materielInformatiques');
        // Redirect or return a response as needed
        return view('etablissement.index', compact('etablissementWithMateriel'))->with('success', 'Material added successfully');
    }
}
