<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Tarif;
use Illuminate\Http\Request;

class TarifController extends Controller
{
    // Get all tarifs
    public function index()
    {
        $tarifs = Tarif::all();
        return response()->json($tarifs);
    }

    // Get a single tarif
    public function show($id)
    {
        $tarif = Tarif::findOrFail($id);
        return response()->json($tarif);
    }

    // Create a new tarif
    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|in:standard,flex,premium',
            'description' => 'required|string',
        ]);

        $tarif = Tarif::create($validated);
        return response()->json($tarif, 201);
    }

    // Update an existing tarif
    public function update(Request $request, $id)
    {
        $tarif = Tarif::findOrFail($id);

        $validated = $request->validate([
            'type' => 'sometimes|in:standard,flex,premium',
            'description' => 'string',
        ]);

        $tarif->update($validated);
        return response()->json($tarif);
    }

    // Delete a tarif
    public function destroy($id)
    {
        $tarif = Tarif::findOrFail($id);
        $tarif->delete();

        return response()->json(['message' => 'Tarif deleted']);
    }
}
