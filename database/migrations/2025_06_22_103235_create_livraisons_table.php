<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('livraisons', function (Blueprint $table) {
            $table->id();
            $table->string('id_commande')->unique();
            $table->dateTime('date_commande');
            $table->dateTime('date_livraison');
            $table->string('id_client');
            $table->string('nom_client');
            $table->string('adresse_livraison');
            $table->string('moyen_livraison');
            $table->string('statut_livraison');
            $table->string('delai_livraison')->nullable();
            $table->text('commentaires')->nullable();
            $table->unsignedBigInteger('livreur_id')->nullable();
            $table->timestamps();

            $table->foreign('id_client')->references('id_client')->on('clients')->onDelete('cascade');
            $table->foreign('livreur_id')->references('id')->on('livreurs')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('livraisons');
    }
};