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
    Schema::create('absences', function (Blueprint $table) {
        $table->id('id_absence');
        $table->date('date');
        $table->boolean('justifie');
        // $table->foreignId('id_employe')->constrained('employes')->onDelete('cascade');
        $table->unsignedBigInteger('id_employe');
$table->foreign('id_employe')->references('id_employe')->on('employes')->onDelete('cascade');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absences');
    }
};
