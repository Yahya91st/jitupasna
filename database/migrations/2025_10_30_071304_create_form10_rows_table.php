<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('Form10_rows', function (Blueprint $table) {
            $table->id();

            // FK to Form10tables
            $table->unsignedBigInteger('Form10_id')->index();

            $table->integer('order')->nullable(); // nomor urut baris
            $table->string('sektor_sub_sektor')->nullable();
            $table->string('lokasi')->nullable();

            // kolom-kolom hasil (sesuai gambar: 3 titik hasil + kebutuhan)
            $table->text('hasil_pengolahan_survey')->nullable();
            $table->text('hasil_wawancara_fgd')->nullable();
            $table->text('hasil_pendalaman')->nullable();

            $table->text('kebutuhan_pemulihan')->nullable();

            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Form10_rows');
    }
};
