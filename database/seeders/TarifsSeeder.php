<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tarif;

class TarifsSeeder extends Seeder
{
    public function run(): void
    {
        Tarif::insert([
            [
            'type' => 'standard',
            'description' => 'Tarif standard avec conditions d\'annulation flexibles.',
            'created_at' => now(),
            'updated_at' => now(),
            ],
            [
            'type' => 'flex',
            'description' => 'Tarif flexible, modifiable sans frais supplémentaires.',
            'created_at' => now(),
            'updated_at' => now(),
            ],
            [
            'type' => 'premium',
            'description' => 'Tarif premium avec services supplémentaires inclus.',
            'created_at' => now(),
            'updated_at' => now(),
            ],
        ]);
        
    }
}
