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
        Schema::create('chambres', function (Blueprint $table) {
            $table->id('id_chambre');
            $table->string('type');
            $table->text('description')->nullable();
            $table->float('base_price')->nullable();
            $table->integer('capacite');
            $table->boolean('disponibilite')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('chambres');
    }
};
