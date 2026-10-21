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
        Schema::table('sales', function (Blueprint $table) {
            // ON AJOUTE SEULEMENT CETTE LIGNE
            $table->string('client_name')->nullable()->after('drink_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sales', function (Blueprint $table) {
            // ON SUPPRIME LA COLONNE SI ON FAIT UN ROLLBACK
            $table->dropColumn('client_name');
        });
    }
};
