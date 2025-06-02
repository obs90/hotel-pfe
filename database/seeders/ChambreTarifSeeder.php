<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ChambreTarif;

class ChambreTarifSeeder extends Seeder
{
    public function run(): void
    {
        ChambreTarif::insert([
            ['id_chambre' => 1, 'id_tarif' => 1, 'prix' => 500],
            ['id_chambre' => 1, 'id_tarif' => 2, 'prix' => 900],
            ['id_chambre' => 2, 'id_tarif' => 2, 'prix' => 1000],
            ['id_chambre' => 2, 'id_tarif' => 3, 'prix' => 1900],
        ]);
    }
}
