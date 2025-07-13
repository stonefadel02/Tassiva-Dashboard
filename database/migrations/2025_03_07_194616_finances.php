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
        Schema::create('finances', function (Blueprint $table) {
            $table->id();
            $table->date('date'); // Date de la transaction
            $table->string('type_transaction'); // Type (Vente, Dépense, etc.)
            $table->string('categorie'); // Catégorie (Produits alimentaires, Transport, etc.)
            $table->text('description'); // Description de la transaction
            $table->decimal('montant', 10, 2); // Montant de la transaction
            $table->enum('entree_sortie', ['Entrée', 'Sortie']); // Entrée ou sortie d'argent
            $table->decimal('solde', 10, 2)->default(0); // Solde après la transaction
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('finances');
    }
};
$table->decimal('solde', 10, 2)->default(0);