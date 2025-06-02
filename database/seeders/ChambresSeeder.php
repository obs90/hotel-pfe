<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChambresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
{
    DB::table('chambres')->insert([
        [
            'type' => 'Simple',
            'description' => 'Chambre simple avec lit simple',
            'base_price' => 500,
            'capacite' => 1,
            'disponibilite' => true,
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'type' => 'Double',
            'description' => 'Chambre double avec balcon',
            'base_price' => 800,
            'capacite' => 2,
            'disponibilite' => true,
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'type' => 'Suite',
            'description' => 'Suite luxueuse avec vue sur la mer',
            'base_price' => 1500,
            'capacite' => 4,
            'disponibilite' => true,
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'type' => 'Familiale',
            'description' => 'Chambre familiale spacieuse',
            'base_price' => 1200,
            'capacite' => 5,
            'disponibilite' => true,
            'created_at' => now(),
            'updated_at' => now()
        ]
    ]);
}

}
