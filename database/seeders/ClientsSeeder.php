<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClientsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
{
    DB::table('clients')->insert([
        [
            'id_user' => 2,
            'CIN' => '677-65-0070',
        ],
        [
            'id_user' => 3,
            'CIN' => '677-65-0071',
        ],
        [
            'id_user' => 5,
            'CIN' => '677-65-0072',
        ]
    ]);
}

}
