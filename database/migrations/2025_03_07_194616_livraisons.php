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
        Schema::create('livraisons', function (Blueprint $table) {
            $table->id();
            $table->date('date_commande'); // Date de la commande
            $table->date('date_livraison'); // Date de la livraison
            $table->string('id_commande'); // ID de la commande
            $table->string('id_client'); // ID du client
            $table->string('nom_client'); // Nom du client
            $table->text('adresse_livraison'); // Adresse de livraison
            $table->string('moyen_livraison'); // Moyen de livraison (Moto, Camion, etc.)
            $table->string('statut_livraison'); // Statut de la livraison (Livré, En cours, etc.)
            $table->integer('delai_livraison')->storedAs('DATEDIFF(date_livraison, date_commande)'); // Délai en jours
            $table->text('commentaires')->nullable(); // Commentaires optionnels
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('livraisons');
    }
};
