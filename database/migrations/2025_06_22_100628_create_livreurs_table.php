<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB; // N'oublie pas ce use !

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('livreurs', function (Blueprint $table) {
            $table->id();
            $table->string('nom_livreur');
            $table->string('telephone')->nullable();
            $table->string('zone_recouvrement')->nullable();
            $table->timestamps();
        });

        // Ajout d'un livreur par défaut
        DB::table('livreurs')->insert([
            'nom_livreur' => 'Aucun',
            'telephone' => '',
            'zone_recouvrement' => '',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('livreurs');
    }
};
