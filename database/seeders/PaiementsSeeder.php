<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Paiement;

class PaiementsSeeder extends Seeder
{
    public function run(): void
    {
        Paiement::insert([
            [
                'mois' => 5,
                'annee' => 2024,
                'date_paiement' => '2025-05-31',
                'primes' => 288.73,
                'statut' => 'En attente',
                'id_employe' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'mois' => 5,
                'annee' => 2023,
                'date_paiement' => '2025-05-31',
                'primes' => 407.03,
                'statut' => 'Paye',
                'id_employe' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
