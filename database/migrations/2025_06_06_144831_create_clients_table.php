<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('id_client')->unique(); // Identifiant unique pour le client
            $table->string('nom_client');
            $table->string('categorie')->nullable(); // Catégorie du client (ex. : VIP, Régulier)
            $table->string('telephone')->nullable();
            $table->string('adresse')->nullable();
            $table->date('date_ajout')->default(now());
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};