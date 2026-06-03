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
        Schema::create('keputusans', function (Blueprint $table) {
            $table->id();
            $table->unique('laporan_id');
            $table->text('hasil_keputusan');
            $table->text('tindak_lanjut');
            $table->enum('status_keputusan',['pending', 'disetujui', 'ditolak']);
            $table->string('catatan_pimpinan');
            $table->timestamps();        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keputusans');
    }
};
