<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class CustomUsersSeeder extends Seeder
{
    public function run()
    {
        DB::table('custom_users')->insert([
            [
                'nom' => 'admin',
                'prenom' => 'root',
                'email' => 'admin@hotel.com',
                'telephone' => '0600000000',
                'password' => Hash::make('password'), // login: admin@hotel.com / password
                'typeUser' => 'employe',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => 'client',
                'prenom' => 'test',
                'email' => 'client@hotel.com',
                'telephone' => '0600111122',
                'password' => Hash::make('password'), // login: client@hotel.com / password
                'typeUser' => 'client',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => 'manager',
                'prenom' => 'super',
                'email' => 'manager@hotel.com',
                'telephone' => '0600222233',
                'password' => Hash::make('password'), // login: manager@hotel.com / password
                'typeUser' => 'client',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => 'guest',
                'prenom' => 'visitor',
                'email' => 'guest@hotel.com',
                'telephone' => '0600333344',
                'password' => Hash::make('password'), // login: guest@hotel.com / password
                'typeUser' => 'employe',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => 'receptionist',
                'prenom' => 'john',
                'email' => 'receptionist@hotel.com',
                'telephone' => '0600444455',
                'password' => Hash::make('password'), // login: receptionist@hotel.com / password
                'typeUser' => 'client',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
