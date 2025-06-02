<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tache;

class TachesSeeder extends Seeder
{
    public function run(): void
    {
        Tache::insert([
            [
                
                'description' => 'Nettoyer toutes les chambres du deuxième étage',
                
                'status' => 'Completed',
                'date_assignment' => '2025-06-10',
                'id_employe' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                
                'description' => 'Réparer la douche dans la chambre 105',
                
                'status' => 'Not Started',
                'date_assignment' => '2025-06-05',
                'id_employe' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
