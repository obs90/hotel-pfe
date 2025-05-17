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
    Schema::create('tache_employe', function (Blueprint $table) {
        $table->foreignId('id_tache')->constrained('tache')->onDelete('cascade');
        $table->foreignId('id_employe')->constrained('employes')->onDelete('cascade');
        $table->date('date_assignment');
        $table->enum('status', ['Not Started', 'In Progress', 'Completed']);
        $table->primary(['id_tache', 'id_employe']);
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tache_employe');
    }
};
