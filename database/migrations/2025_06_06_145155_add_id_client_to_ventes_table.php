<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('ventes', function (Blueprint $table) {
            $table->string('id_client')->nullable()->after('produit_id');
            $table->foreign('id_client')->references('id_client')->on('clients')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('ventes', function (Blueprint $table) {
            $table->dropForeign(['id_client']);
            $table->dropColumn('id_client');
        });
    }
};