<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PersonnesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
{
    DB::table('personnes')->insert([
        [
            'nom' => 'mounir',
            'prenom' => 'mouhssine',
            'CIN' => '981-77-8632',
        ],
        [
            'nom' => 'mouhssine',
            'prenom' => 'mounir',
            'CIN' => '981-77-8633',
        ],
        [
            'nom' => 'mouhssine',
            'prenom' => 'mounir',
            'CIN' => '981-77-8634',
        ],
        [
            'nom' => 'mouhssine',
            'prenom' => 'mounir',
            'CIN' => '981-77-8635',
        ],
        [
            'nom' => 'mouhssine',
            'prenom' => 'mounir',
            'CIN' => '981-77-8636',
        ],
        
    ]);
}

}
