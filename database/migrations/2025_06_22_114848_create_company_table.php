<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->decimal('solde_initial', 15, 2)->default(0);
            $table->timestamps();
        });

        // Insérer une entrée par défaut
        \DB::table('companies')->insert([
            // 'solde_initial' => 1000000.00, // Solde initial par défaut
            'solde_initial' => 0, // Solde initial par défaut
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};