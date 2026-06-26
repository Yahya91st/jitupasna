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
        Schema::create('formulir_items', function (Blueprint $table) {
        $table->id();

        $table->foreignId('formulir_id');

        $table->foreignId('kriteria_id')->nullable();

        $table->string('kategori');

        $table->string('sub_kategori')->nullable();

        $table->string('jenis')->nullable();

        $table->string('tipe')->nullable();

        $table->decimal('dimensi', 15, 2)->nullable();

        $table->enum('tingkat_kerusakan', [
            'hancur_total',
            'berat',
            'sedang',
            'ringan'
        ])->nullable();

        $table->integer('jumlah')->nullable();

        $table->integer('jumlah2')->nullable();

        $table->decimal('harga_satuan', 15, 2)->nullable();

        $table->enum('satuan', [
            'unit',
            'm2',
            'm3',
            'm',
            'km',
            'ha',
            'pohon',
            'ekor',
            'kk',
            'jiwa',
            'paket',
            'buah',
            'set',
            'ruang',
            'titik',
            'rp',
            'hok',
            'hari',
            'orang',
            'bulan',
            'kwh',
            'permintaan'
        ]);

        $table->integer('durasi')->nullable();

        $table->enum('durasi_satuan', [
            'hari',
            'bulan',
            'tahun'
        ])->nullable();

        $table->timestamps();
    });
    
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('formulir_items');
    }
};
