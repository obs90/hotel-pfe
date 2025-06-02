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
    Schema::create('chambre_tarif', function (Blueprint $table) {
        $table->id('id_chambre_tarif');
        $table->float('prix');
        // $table->foreignId('id_chambre')->constrained('chambres')->onDelete('cascade');
        $table->unsignedBigInteger('id_chambre');
        $table->foreign('id_chambre')->references('id_chambre')->on('chambres')->onDelete('cascade');
        // $table->foreignId('id_tarif')->constrained('tarifs')->onDelete('cascade');
        
$table->unsignedBigInteger('id_tarif');
$table->foreign('id_tarif')->references('id_tarif')->on('tarifs')->onDelete('cascade');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chambre_tarif');
    }
};
