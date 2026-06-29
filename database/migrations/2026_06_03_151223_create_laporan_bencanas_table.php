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
        Schema::create('laporan_bencanas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('bencana_id');
            $table->unique('bencana_id');
            $table->date('tanggal_lapor');
            $table->enum('status_laporan',['draft', 'diproses', 'selesai', 'ditolak']);
            $table->integer('total_kerusakan');
            $table->integer('total_kerugian');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_bencanas');
    }
};
