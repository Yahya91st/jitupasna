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
        Schema::create('bencanas', function (Blueprint $table) {
            $table->id();
            $table->string('kategori_bencana');
            $table->date('tanggal');
            $table->string('province_code');
            $table->string('regency_code');
            $table->string('district_code');
            $table->string('village_code');
            $table->string('gambar')->nullable();
            $table->text('deskripsi')->nullable();
            $table->boolean('verifikasi')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bencanas');
    }
};
