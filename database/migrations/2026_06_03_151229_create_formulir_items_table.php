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
            $table->foreignId('format_id');
            $table->foreignId('kriteria_id');
            $table->string('kategori');
            $table->string('sub_kategori');
            $table->string('dimensi_1');
            $table->string('dimensi_2');
            $table->enum('tingkat_kerusakan',[
                'ringan',
                'sedang',
                'berat'
            ]);
            $table->integer('jumlah');
            $table->integer('harga_satuan');
            $table->enum('satuan',['unit','m2','m3','m','km','ha','pohon','ekor','kk','jiwa','paket','buah','set','ruang','titik']);        
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
