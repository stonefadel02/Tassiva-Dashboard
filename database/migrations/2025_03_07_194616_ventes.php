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
        Schema::create('ventes', function (Blueprint $table) {
            $table->id();
            $table->date('date'); // Date de la vente
            $table->unsignedBigInteger('produit_id'); // Référence au produit vendu
            $table->string('nom_produit'); // Nom du produit
            $table->integer('quantite_vendue'); // Quantité vendue
            $table->decimal('prix_unitaire', 10, 2); // Prix unitaire
            $table->decimal('total_vente', 10, 2)->storedAs('quantite_vendue * prix_unitaire'); // Total calculé
            $table->string('mode_paiement'); // Mode de paiement (Espèces, Mobile Money, etc.)
            $table->text('commentaires')->nullable(); // Commentaires optionnels
            $table->timestamps();

            // Clé étrangère pour lier la vente au produit
            $table->foreign('produit_id')->references('id')->on('stocks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ventes');
    }
};
