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
        Schema::table('analisa', function (Blueprint $table) {
            $table->dropColumn('jumlah_kebutuhan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('analisa', function (Blueprint $table) {
            $table->decimal('jumlah_kebutuhan', 15, 2)->after('kebutuhan_pemulihan');
        });
    }
};
