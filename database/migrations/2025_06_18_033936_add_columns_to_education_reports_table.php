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
        Schema::table('education_reports', function (Blueprint $table) {
            $table->string('nama_kampung')->nullable()->after('bencana_id');
            $table->string('nama_distrik')->nullable()->after('nama_kampung');
            $table->json('data')->nullable()->after('keterangan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('education_reports', function (Blueprint $table) {
            $table->dropColumn(['nama_kampung', 'nama_distrik', 'data']);
        });
    }
};
