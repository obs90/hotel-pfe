<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->foreign('id_chef')
                ->references('id_employe')
                ->on('employes')
                ->onDelete('cascade');
        });

        Schema::table('employes', function (Blueprint $table) {
            $table->foreign('id_service')
                ->references('id_service')
                ->on('services')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->dropForeign(['id_chef']);
        });

        Schema::table('employes', function (Blueprint $table) {
            $table->dropForeign(['id_service']);
        });
    }
};
