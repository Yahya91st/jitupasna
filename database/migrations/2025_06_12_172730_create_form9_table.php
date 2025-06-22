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
        Schema::create('form9', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bencana_id')->constrained('bencana')->onDelete('cascade');
            $table->string('nomor_kuesioner');
            $table->string('jenis_kelamin');
            $table->string('umur');
            $table->string('desa_kelurahan');
            $table->string('kecamatan');
            $table->date('tanggal');
            // Add JSON columns for multi-select fields
            $table->json('dukungan_pangan_air')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form9');
    }
};
