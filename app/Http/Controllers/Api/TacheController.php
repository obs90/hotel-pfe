<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tache;
use Illuminate\Http\Request;

class TacheController extends Controller
{
    public function index()
    {
        return response()->json(Tache::with('employe')->get());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'description' => 'required|string',
            'id_employe' => 'required|exists:employes,id_employe',
            'date_assignment' => 'required|date',
            'status' => 'required|in:Not Started,In Progress,Completed',
        ]);

        $tache = Tache::create($validated);

        return response()->json([
            'message' => 'Tâche créée avec succès.',
            'tache' => $tache
        ]);
    }

    public function show($id)
    {
        $tache = Tache::with('employe')->findOrFail($id);
        return response()->json($tache);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'description' => 'sometimes|string',
            'id_employe' => 'sometimes|exists:employes,id_employe',
            'date_assignment' => 'sometimes|date',
            'status' => 'sometimes|in:Not Started,In Progress,Completed',
        ]);

        $tache = Tache::findOrFail($id);
        $tache->update($validated);

        return response()->json([
            'message' => 'Tâche mise à jour avec succès.',
            'tache' => $tache
        ]);
    }

    public function destroy($id)
    {
        $tache = Tache::findOrFail($id);
        $tache->delete();

        return response()->json([
            'message' => 'Tâche supprimée avec succès.'
        ]);
    }
}
