<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReservationPersonneSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('reservation_personne')->insert([
            [
                'id_reservation' => 1,
                'id_personne' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_reservation' => 2,
                'id_personne' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
