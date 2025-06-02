<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('services')->insert([
            ['nom' => 'Réception'],
            ['nom' => 'Cuisine'],
            ['nom' => 'Ménage'],
            ['nom' => 'Sécurité'],
        ]);
    }
    }
