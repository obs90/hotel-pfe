<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Absence;
use Illuminate\Http\Request;

class AbsenceController extends Controller
{
    // List all absences
    public function index()
    {
        $absences = Absence::with('employe')->get();
        return response()->json($absences);
    }

    // Show one absence by ID
    public function show($id)
    {
        $absence = Absence::with('employe')->findOrFail($id);
        return response()->json($absence);
    }

    // Store a new absence
    public function store(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'justifie' => 'required|boolean',
            'id_employe' => 'required|exists:employes,id_employe',
        ]);

        $absence = Absence::create($validated);

        return response()->json([
            'message' => 'Absence created successfully.',
            'absence' => $absence
        ], 201);
    }

    // Update an existing absence
    public function update(Request $request, $id)
    {
        $absence = Absence::findOrFail($id);

        $validated = $request->validate([
            'date' => 'sometimes|date',
            'justifie' => 'sometimes|boolean',
            'id_employe' => 'sometimes|exists:employes,id_employe',
        ]);

        $absence->update($validated);

        return response()->json([
            'message' => 'Absence updated successfully.',
            'absence' => $absence
        ]);
    }

    // Delete an absence
    public function destroy($id)
    {
        $absence = Absence::findOrFail($id);
        $absence->delete();

        return response()->json(['message' => 'Absence deleted successfully.']);
    }
}

