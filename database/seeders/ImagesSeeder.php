<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ImagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('images')->insert([
            ['url' => 'chambres/chambre1.png', 'id_chambre' => 1],
            ['url' => 'chambres/chambre2.png', 'id_chambre' => 2],
        ]);
    }
    
}
