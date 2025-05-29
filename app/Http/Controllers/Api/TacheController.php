<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tache;
use Illuminate\Http\Request;

class TacheController extends Controller
{
    public function index()
    {
        return response()->json(Tache::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'description' => 'required|string',
        ]);

        $tache = Tache::create($validated);

        return response()->json([
            'message' => 'Tâche créée avec succès.',
            'tache' => $tache
        ]);
    }

    public function show($id)
    {
        $tache = Tache::findOrFail($id);

        return response()->json($tache);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'description' => 'required|string',
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