<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Absence;

class AbsencesSeeder extends Seeder
{
    public function run(): void
    {
        Absence::insert([
            [
                'date' => '2025-06-01',
                'justifie' => false,
                
                'id_employe' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'date' => '2025-06-03',
                'justifie' => true,
                
                'id_employe' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
