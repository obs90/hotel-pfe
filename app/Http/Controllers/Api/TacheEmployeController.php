<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TacheEmployeController extends Controller
{
    public function assign(Request $request)
    {
        $validated = $request->validate([
            'id_tache' => 'required|exists:taches,id_tache',
            'id_employe' => 'required|exists:employes,id_employe',
            'date_assignment' => 'required|date',
            'status' => 'required|in:Not Started,In Progress,Completed',
        ]);

        $exists = DB::table('tache_employe')->where([
            'id_tache' => $validated['id_tache'],
            'id_employe' => $validated['id_employe']
        ])->exists();

        if ($exists) {
            return response()->json(['message' => 'Employé déjà assigné à cette tâche.'], 409);
        }

        DB::table('tache_employe')->insert($validated);

        return response()->json(['message' => 'Employé assigné avec succès à la tâche.']);
    }

    public function update(Request $request, $id_tache, $id_employe)
    {
        $validated = $request->validate([
            'date_assignment' => 'sometimes|date',
            'status' => 'sometimes|in:Not Started,In Progress,Completed',
        ]);
        

        DB::table('tache_employe')
            ->where('id_tache', $id_tache)
            ->where('id_employe', $id_employe)
            ->update($validated);

        return response()->json(['message' => 'Affectation mise à jour avec succès.']);
    }

    public function unassign($id_tache, $id_employe)
    {
        DB::table('tache_employe')
            ->where('id_tache', $id_tache)
            ->where('id_employe', $id_employe)
            ->delete();

        return response()->json(['message' => 'Employé désassigné de la tâche avec succès.']);
    }

    public function getAssignedEmployees($id_tache)
    {
        $employees = DB::table('tache_employe')
            ->join('employes', 'employes.id_employe', '=', 'tache_employe.id_employe')
            ->where('tache_employe.id_tache', $id_tache)
            ->select('employes.*', 'tache_employe.date_assignment', 'tache_employe.status')
            ->get();

        return response()->json($employees);
    }
}

