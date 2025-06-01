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
        Schema::create('employes', function (Blueprint $table) {
            $table->id('id_employe');
            $table->float('salaire');
            $table->date('date_naissance');
            $table->string('adresse');
            $table->string('CIN')->unique();
            $table->date('date_embauche');
            $table->enum('fonction', ['admin', 'RH', 'chef', 'employe']);
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_service')->nullable();
            $table->foreign('id_user')->references('id_user')->on('custom_users')->onDelete('cascade');
            $table->foreign('id_service')->references('id_service')->on('services')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('employes');
    }
};
