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
    Schema::create('reservation_personne', function (Blueprint $table) {
        $table->id('id_reservation_personne');
        $table->foreignId('id_reservation')->constrained('reservation')->onDelete('cascade');
        $table->foreignId('id_personne')->constrained('personnes')->onDelete('cascade');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservation_personne');
    }
};
