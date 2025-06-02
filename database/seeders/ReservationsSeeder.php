<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Reservation;
use Carbon\Carbon;

class ReservationsSeeder extends Seeder
{
    public function run(): void
    {
        Reservation::insert([
            [
                'date_depart' => '2025-06-01',
                'date_fin' => '2025-06-05',
                'montant_total' => 800.00,
                'statut' => 'confirmée',
                'mode_paiement' => 'especes',
                'id_client' => 1,
                'id_chambre_tarif' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'date_depart' => '2025-06-10',
                'date_fin' => '2025-06-15',
                'montant_total' => 1200.00,
                'statut' => 'en attente',
                'mode_paiement' => 'especes',
                'id_client' => 2,
                'id_chambre_tarif' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
