<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('reservations', function (Blueprint $table) {
        $table->id('id_reservation');
        $table->date('date_depart');
        $table->date('date_fin');
        $table->float('montant_total');
        $table->enum('statut', ['confirmee', 'annulee', 'en attente']);
        $table->enum('mode_paiement', ['especes']);
        $table->foreignId('id_client')->constrained('clients')->onDelete('cascade');
        $table->foreignId('id_chambre_tarif')->nullable()->constrained('chambre_tarif')->onDelete('cascade');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
