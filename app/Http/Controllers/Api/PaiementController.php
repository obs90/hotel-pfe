<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Paiement;
use App\Models\Employe;
use App\Models\Absence;

class PaiementController extends Controller
{
    // List all paiements
    public function index()
    {
        $paiements = Paiement::with('employe')->get();
        return response()->json($paiements);
    }

    // Store new paiement
    public function store(Request $request)
    {
        $validated = $request->validate([
            'mois' => 'required|integer|min:1|max:12',
            'annee' => 'required|integer',
            'date_paiement' => 'required|date',
            'primes' => 'required|numeric|min:0',
            'statut' => 'required|in:En attente,Paye',
            'id_employe' => 'required|exists:employes,id_employe',
        ]);

        $employe = Employe::findOrFail($validated['id_employe']);

        // ✅ Correct unjustified absence check
        $unjustifiedAbsences = Absence::where('id_employe', $employe->id_employe)
        ->where('justifie', 0)
        ->whereMonth('date', $validated['mois'])
        ->whereYear('date', $validated['annee'])
        ->count();
        
        $salaireMensuel = $employe->salaire;
        $joursMois = cal_days_in_month(CAL_GREGORIAN, $validated['mois'], $validated['annee']);
        $salaireJournalier = $salaireMensuel / $joursMois;

        $penalite = $unjustifiedAbsences * $salaireJournalier;

        $salaireNet = $salaireMensuel + $validated['primes'] - $penalite;

        $paiement = Paiement::create([
            ...$validated,
            'salaire_net' => $salaireNet,
        ]);

        return response()->json([
            'message' => 'Paiement enregistré avec succès.',
            'paiement' => $paiement,
        ]);
    }

    // Show paiement details
    public function show($id)
    {
        $paiement = Paiement::with('employe')->findOrFail($id);
        return response()->json($paiement);
    }

    // Update paiement
    public function update(Request $request, $id)
    {
        $paiement = Paiement::findOrFail($id);

        $validated = $request->validate([
            'mois' => 'sometimes|integer|min:1|max:12',
            'annee' => 'sometimes|integer',
            'date_paiement' => 'sometimes|date',
            'primes' => 'sometimes|numeric|min:0',
            'statut' => 'sometimes|in:En attente,Paye',
            'id_employe' => 'sometimes|exists:employes,id_employe',
        ]);

        // Use old values if not provided
        $mois = $validated['mois'] ?? $paiement->mois;
        $annee = $validated['annee'] ?? $paiement->annee;
        $primes = $validated['primes'] ?? $paiement->primes;
        $id_employe = $validated['id_employe'] ?? $paiement->id_employe;

        $employe = Employe::findOrFail($id_employe);

        $unjustifiedAbsences = Absence::where('id_employe', $id_employe)
            ->whereYear('date', $annee)
            ->whereMonth('date', $mois)
            ->where('justifie', false)
            ->count();

        $salaireMensuel = $employe->salaire;
        $joursMois = cal_days_in_month(CAL_GREGORIAN, $mois, $annee);
        $salaireJournalier = $salaireMensuel / $joursMois;
        $penalite = $unjustifiedAbsences * $salaireJournalier;

        $salaireNet = $salaireMensuel + $primes - $penalite;

        $paiement->update([
            ...$validated,
            'salaire_net' => $salaireNet,
        ]);

        return response()->json([
            'message' => 'Paiement mis à jour avec succès.',
            'paiement' => $paiement,
        ]);
    }

    // Delete paiement
    public function destroy($id)
    {
        $paiement = Paiement::findOrFail($id);
        $paiement->delete();

        return response()->json([
            'message' => 'Paiement supprimé avec succès.'
        ]);
    }
}

