<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Conge;
use App\Models\Employe;
use Illuminate\Http\Request;

class CongeController extends Controller
{
    public function index()
    {
        return Conge::with('employe')->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'date_debut' => 'required|date|before_or_equal:date_fin',
            'date_fin' => 'required|date|after_or_equal:date_debut',
            'statut' => 'required|in:En attente,Approuve,Rejete',
            'id_employe' => 'required|exists:employes,id_employe',
        ]);

        $conge = Conge::create($validated);

        return response()->json([
            'message' => 'Congé créé avec succès.',
            'conge' => $conge,
        ]);
    }

    public function show($id)
    {
        $conge = Conge::with('employe')->findOrFail($id);
        return response()->json($conge);
    }

    public function update(Request $request, $id)
    {
        $conge = Conge::findOrFail($id);

        $validated = $request->validate([
            'date_debut' => 'sometimes|date|before_or_equal:date_fin',
            'date_fin' => 'sometimes|date|after_or_equal:date_debut',
            'statut' => 'sometimes|in:En attente,Approuve,Rejete',
            'id_employe' => 'sometimes|exists:employes,id_employe',
        ]);

        $conge->update($validated);

        return response()->json([
            'message' => 'Congé mis à jour avec succès.',
            'conge' => $conge,
        ]);
    }

    public function destroy($id)
    {
        $conge = Conge::findOrFail($id);
        $conge->delete();

        return response()->json([
            'message' => 'Congé supprimé avec succès.'
        ]);
    }
}

