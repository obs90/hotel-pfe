<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('employes')->insert([
            [
                'CIN' => '009-88-2842',
                'adresse' => 'Rabat',
                'date_embauche' => '2025-06-01',
                'date_naissance' => '1995-05-01',
                'fonction' => 'employe',
                'id_service' => 1,
                'id_user' => 1,
                'salaire' => 4200,
            ],
            [
                'CIN' => '009-88-2843',
                'adresse' => 'Casa',
                'date_embauche' => '2025-06-01',
                'date_naissance' => '1990-03-12',
                'fonction' => 'admin',
                'id_service' => 2,
                'id_user' => 4,
                'salaire' => 3500,
            ],
        ]);
    }
    

}
