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
    Schema::create('conges', function (Blueprint $table) {
        $table->id('id_conge');
        $table->date('date_debut');
        $table->date('date_fin');
        $table->enum('statut', ['En attente', 'Approuve', 'Rejete']);
        $table->foreignId('id_employe')->constrained('employes')->onDelete('cascade');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conges');
    }
};
