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
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->string('nom_produit');
            $table->integer('stock_initial')->default(0);
            $table->integer('entrees')->default(0);
            $table->integer('sorties')->default(0);
            $table->integer('stock_actuel')->storedAs('stock_initial + entrees - sorties');
            $table->integer('stock_minimum')->default(0);
            $table->boolean('rupture')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stocks');
    }
};
