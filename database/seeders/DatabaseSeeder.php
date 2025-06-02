<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Utilisateurs (admin, client, etc.)
        $this->call(CustomUsersSeeder::class);

        // 2. Services (nécessaire pour les employés)
        $this->call(ServicesSeeder::class);

        // 3. Employés
        $this->call(EmployesSeeder::class);

        // 4. Clients
        $this->call(ClientsSeeder::class);

        // 5. Personnes (participants aux réservations)
        $this->call(PersonnesSeeder::class);

        // 6. Chambres
        $this->call(ChambresSeeder::class);

        // 7. Tarifs
        $this->call(TarifsSeeder::class);

        // 8. ChambreTarif (pivot entre chambres et tarifs)
        $this->call(ChambreTarifSeeder::class);

        // 9. Images associées aux chambres
        $this->call(ImagesSeeder::class);

        // 10. Réservations
        $this->call(ReservationsSeeder::class);

        // 11. Lien personnes ↔ réservations
        $this->call(ReservationPersonneSeeder::class);

        // 12. Paiements liés aux réservations
        $this->call(PaiementsSeeder::class);

        // 13. Congés employés
        $this->call(CongesSeeder::class);

        // 14. Absences employés
        $this->call(AbsencesSeeder::class);

        // 15. Tâches (si tu en as)
        $this->call(TachesSeeder::class);
    }
}
