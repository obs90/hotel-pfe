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
    Schema::create('paiements', function (Blueprint $table) {
        $table->id('id_salaire');
        $table->integer('mois');
        $table->integer('annee');
        $table->date('date_paiement');
        $table->double('primes');
        $table->double('salaire_net');
        $table->enum('statut', ['En attente', 'Paye']);
        $table->foreignId('id_employe')->constrained('employes')->onDelete('cascade');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paiements');
    }
};
