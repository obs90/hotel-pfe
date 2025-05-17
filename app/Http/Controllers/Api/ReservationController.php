<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\ChambreTarif;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReservationController extends Controller
{
    // Get all reservations with personnes and client
    public function index()
    {
        $reservations = Reservation::with(['personnes', 'client', 'chambreTarif.chambre', 'chambreTarif.tarif'])->get();
        return response()->json($reservations);
    }

    // Get a single reservation
    public function show($id)
    {
        $reservation = Reservation::with(['personnes', 'client', 'chambreTarif.chambre', 'chambreTarif.tarif'])->findOrFail($id);
        return response()->json($reservation);
    }

    // Create a new reservation
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'date_depart' => 'required|date',
                'date_fin' => 'required|date|after_or_equal:date_depart',
                'statut' => 'required|in:confirmee,annulee,en_attente',
                'mode_paiement' => 'required|in:carte_bancaire,especes,virement',
                'id_client' => 'required|exists:clients,id_client',
                'id_chambre_tarif' => 'required|exists:chambre_tarif,id_chambre_tarif'
            ]);

            \Log::info('Validated data:', $validated);  // Add logging
            
            // Get chambreTarif first (fix the undefined variable error)
            $chambreTarif = ChambreTarif::findOrFail($validated['id_chambre_tarif']);
            
            // Calculate montant_total
            $start = Carbon::parse($validated['date_depart']);
            $end = Carbon::parse($validated['date_fin']);
            $days = $start->diffInDays($end) + 1;
            
            $validated['montant_total'] = $days * $chambreTarif->prix;

            $reservation = Reservation::create($validated);
            return response()->json($reservation, 201);
        } catch (\Exception $e) {
            \Log::error('Reservation creation error: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    // Update an existing reservation
    public function update(Request $request, $id)
{
    try {
        $reservation = Reservation::findOrFail($id);

        $validated = $request->validate([
            'date_depart' => 'required|date',
            'date_fin' => 'date|after_or_equal:date_depart',
            'statut' => 'in:confirmee,annulee,en_attente',
            'mode_paiement' => 'in:carte_bancaire,especes,virement',
            'id_client' => 'exists:clients,id_client',
            'id_chambre_tarif' => 'exists:chambre_tarif,id_chambre_tarif',
        ]);

        $date_depart = $validated['date_depart'] ?? $reservation->date_depart;
        $date_fin = $validated['date_fin'] ?? $reservation->date_fin;
        $id_chambre_tarif = $validated['id_chambre_tarif'] ?? $reservation->id_chambre_tarif;

        $start = Carbon::parse($date_depart);
        $end = Carbon::parse($date_fin);
        $days = $start->diffInDays($end) + 1;

        $chambreTarif = ChambreTarif::findOrFail($id_chambre_tarif);
        $validated['montant_total'] = $days * $chambreTarif->prix;

        $reservation->update($validated);

        return response()->json($reservation);

    } catch (ValidationException $e) {
        return response()->json([
            'message' => 'Validation failed',
            'errors' => $e->errors()
        ], 422);

    } catch (ModelNotFoundException $e) {
        return response()->json([
            'message' => 'Reservation or related data not found'
        ], 404);

    } catch (\Exception $e) {
        Log::error('Reservation update failed: ' . $e->getMessage());

        return response()->json([
            'message' => 'An unexpected error occurred',
            'error' => $e->getMessage()
        ], 500);
    }
}

    // Delete a reservation
    public function destroy($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->delete();

        return response()->json(['message' => 'Reservation deleted']);
    }

    // Attach a personne to a reservation
    public function attachPersonne(Request $request)
    {
        $request->validate([
            'id_reservation' => 'required|exists:reservations,id_reservation',
            'id_personne' => 'required|exists:personnes,id_personne',
        ]);
        
        $reservation = Reservation::findOrFail($request->id_reservation);
        $reservation->personnes()->attach($request->id_personne);
        
        return response()->json(['message' => 'Personne added to reservation']);
    }

    // Detach a personne from a reservation
    public function detachPersonne(Request $request)
    {
        $request->validate([
            'id_reservation' => 'required|exists:reservations,id_reservation',
            'id_personne' => 'required|exists:personnes,id_personne',
        ]);
    
        $reservation = Reservation::findOrFail($request->id_reservation);
        $reservation->personnes()->detach($request->id_personne);
    
        return response()->json(['message' => 'Personne removed from reservation']);
    }
}
