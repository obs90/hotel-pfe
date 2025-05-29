<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Employe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EmployeController extends Controller
{
    public function index()
    {
        return response()->json(Employe::with(['user', 'service'])->get());
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'salaire' => 'required|numeric|min:0',
                'date_naissance' => 'required|date',
                'adresse' => 'required|string',
                'CIN' => 'required|string|unique:employes,CIN',
                'date_embauche' => 'required|date',
                'fonction' => 'required|in:admin,RH,chef,employe',
                'id_user' => 'required|exists:users,id_user',
                'id_service' => 'nullable|exists:services,id_service',
            ]);

            $employe = Employe::create($validated);
            return response()->json($employe, 201);
        } catch (\Exception $e) {
            Log::error('Error creating employee: ' . $e->getMessage());
            return response()->json([
                'message' => 'Failed to create employe',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        $employe = Employe::with(['user', 'service'])->findOrFail($id);
        return response()->json($employe);
    }

    public function update(Request $request, $id)
    {
        try {
            $employe = Employe::findOrFail($id);

            $validated = $request->validate([
                'salaire' => 'sometimes|required|numeric|min:0',
                'date_naissance' => 'sometimes|required|date',
                'adresse' => 'sometimes|required|string',
                'CIN' => 'sometimes|required|string|unique:employes,CIN,' . $id . ',id_employe',
                'date_embauche' => 'sometimes|required|date',
                'fonction' => 'sometimes|required|in:admin,RH,chef,employe',
                'id_user' => 'sometimes|required|exists:users,id_user',
                'id_service' => 'nullable|exists:services,id_service',
            ]);

            $employe->update($validated);
            return response()->json($employe);
        } catch (\Exception $e) {
            Log::error('Error updating employee: ' . $e->getMessage());
            return response()->json([
                'message' => 'Failed to update employe',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        Employe::destroy($id);
        return response()->json(['message' => 'Employé supprimé avec succès']);
    }
}

