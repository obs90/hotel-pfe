<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('taches', function (Blueprint $table) {
            $table->id('id_tache');
            $table->unsignedBigInteger('id_employe');
            $table->text('description');
            $table->date('date_assignment');
            $table->enum('status', ['Not Started', 'In Progress', 'Completed']);
            $table->timestamps();

            $table->foreign('id_employe')->references('id_employe')->on('employes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('taches');
    }
};
