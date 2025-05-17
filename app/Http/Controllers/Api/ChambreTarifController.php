<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ChambreTarif;
use App\Models\Chambre;
use App\Models\Tarif;
use Illuminate\Http\Request;

class ChambreTarifController extends Controller
{
    // Get all chambre-tarif associations
    public function index()
    {
        $chambreTarifs = ChambreTarif::with(['chambre', 'tarif'])->get();
        return response()->json($chambreTarifs);
    }

    // Get a specific chambre-tarif entry
    public function show($id)
    {
        $chambreTarif = ChambreTarif::with(['chambre', 'tarif'])->findOrFail($id);
        return response()->json($chambreTarif);
    }

    // Create a new chambre-tarif association
    public function store(Request $request)
{
    $validated = $request->validate([
        'id_chambre' => 'required|exists:chambres,id_chambre',
        'id_tarif' => 'required|exists:tarifs,id_tarif',
    ]);

    $chambre = Chambre::findOrFail($validated['id_chambre']);
    $tarif = Tarif::findOrFail($validated['id_tarif']);

    $basePrice = $chambre->base_price ?? 0;

    // Determine price adjustment based on tarif type
    switch ($tarif->type) {
        case 'flex':
            $finalPrice = $basePrice * 1.10;
            break;
        case 'premium':
            $finalPrice = $basePrice * 1.20;
            break;
        default: // standard
            $finalPrice = $basePrice;
            break;
    }

    $chambreTarif = ChambreTarif::create([
        'id_chambre' => $chambre->id_chambre,
        'id_tarif' => $tarif->id_tarif,
        'prix' => $finalPrice,
    ]);

    return response()->json($chambreTarif, 201);
}


    // Update a chambre-tarif entry
    public function update(Request $request, $id)
{
    $chambreTarif = ChambreTarif::findOrFail($id);

    $validated = $request->validate([
        'id_chambre' => 'sometimes|exists:chambres,id_chambre',
        'id_tarif' => 'sometimes|exists:tarifs,id_tarif',
    ]);

    // Use existing values if not provided in the request
    $chambreId = $validated['id_chambre'] ?? $chambreTarif->id_chambre;
    $tarifId = $validated['id_tarif'] ?? $chambreTarif->id_tarif;

    $chambre = Chambre::findOrFail($chambreId);
    $tarif = Tarif::findOrFail($tarifId);

    $basePrice = $chambre->base_price ?? 0;

    // Recalculate price
    switch ($tarif->type) {
        case 'flex':
            $finalPrice = $basePrice * 1.10;
            break;
        case 'premium':
            $finalPrice = $basePrice * 1.20;
            break;
        default: // standard
            $finalPrice = $basePrice;
            break;
    }

    $chambreTarif->update([
        'id_chambre' => $chambreId,
        'id_tarif' => $tarifId,
        'prix' => $finalPrice,
    ]);

    return response()->json($chambreTarif);
}


    // Delete a chambre-tarif entry
    public function destroy($id)
    {
        $chambreTarif = ChambreTarif::findOrFail($id);
        $chambreTarif->delete();

        return response()->json(['message' => 'ChambreTarif deleted']);
    }
}
