<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Personne;
use Illuminate\Http\Request;

class PersonneController extends Controller
{
    public function index()
    {
        return response()->json(Personne::all());
    }

    public function show($id)
    {
        $personne = Personne::findOrFail($id);
        return response()->json($personne);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string',
            'prenom' => 'required|string',
            'CIN' => 'nullable|string|unique:personnes,CIN',
        ]);

        $personne = Personne::create($validated);
        return response()->json($personne, 201);
    }

    public function update(Request $request, $id)
    {
        $personne = Personne::findOrFail($id);

        $validated = $request->validate([
            'nom' => 'sometimes|required|string',
            'prenom' => 'sometimes|required|string',
            'CIN' => 'nullable|string|unique:personnes,CIN,' . $personne->id_personne . ',id_personne',
        ]);

        $personne->update($validated);
        return response()->json($personne);
    }

    public function destroy($id)
    {
        Personne::destroy($id);
        return response()->json(['message' => 'Personne deleted']);
    }

    public function reservations($id)
    {
        $personne = Personne::with('reservations')->findOrFail($id);
        return response()->json($personne->reservations);
    }

    // Attach a reservation to a personne
    public function attachReservation(Request $request)
    {
        $request->validate([
            'id_personne' => 'required|exists:personnes,id_personne',
            'id_reservation' => 'required|exists:reservations,id_reservation',
        ]);

        $personne = Personne::findOrFail($request->id_personne);
        $personne->reservations()->syncWithoutDetaching([$request->id_reservation]);

        return response()->json(['message' => 'Reservation attached successfully']);
    }

    // Detach a reservation from a personne
    public function detachReservation(Request $request, $id)
    {
        $request->validate([
            'id_personne' => 'required|exists:personnes,id_personne',
            'id_reservation' => 'required|exists:reservations,id_reservation',
        ]);

        $personne = Personne::findOrFail($request->id_personne);
        $personne->reservations()->detach($request->id_reservation);

        return response()->json(['message' => 'Reservation detached successfully']);
    }
}
