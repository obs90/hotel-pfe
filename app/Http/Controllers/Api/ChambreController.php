<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Chambre;
use Illuminate\Http\Request;

class ChambreController extends Controller
{
    // Get all chambres with tarif and images
    public function index()
    {
        $chambres = Chambre::with(['tarif', 'images', 'chambreTarifs.tarif'])->get();
        return response()->json($chambres);
    }

    // Get a single chambre
    public function show($id)
    {
        $chambre = Chambre::with(['tarif', 'images', 'chambreTarifs.tarif'])->findOrFail($id);
        return response()->json($chambre);
    }

    // Create a new chambre
    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|string|max:100',
            'description' => 'required|string',
            'base_price' => 'nullable|numeric|min:0',
            'capacite' => 'required|integer|min:1',
            'disponibilite' => 'required|boolean',
        ]);

        $chambre = Chambre::create($validated);
        return response()->json($chambre, 201);
    }

    // Update an existing chambre
    public function update(Request $request, $id)
    {
        $chambre = Chambre::findOrFail($id);

        $validated = $request->validate([
            'type' => 'string|max:100',
            'description' => 'string',
            'base_price' => 'nullable|numeric|min:0',
            'capacite' => 'integer|min:1',
            'disponibilite' => 'boolean',
        ]);

        $chambre->update($validated);
        return response()->json($chambre);
    }

    // Delete a chambre
    public function destroy($id)
    {
        $chambre = Chambre::findOrFail($id);
        $chambre->delete();

        return response()->json(['message' => 'Chambre deleted']);
    }
}
