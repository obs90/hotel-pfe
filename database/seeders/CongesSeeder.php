<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Conge;

class CongesSeeder extends Seeder
{
    public function run(): void
    {
        Conge::insert([
            [
                
                'date_debut' => '2025-06-10',
                'date_fin' => '2025-06-15',
                'statut' => 'Approuve',
                'id_employe' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                
                'date_debut' => '2025-07-01',
                'date_fin' => '2025-07-05',
                'statut' => 'En attente',
                'id_employe' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
