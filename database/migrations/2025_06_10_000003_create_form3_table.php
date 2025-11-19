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
        Schema::create('form3', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bencana_id');
            $table->string('wilayah_bencana');
            $table->string('nama_opd_1');
            $table->string('tanggal_opd_1');
            $table->string('nama_opd_2');
            $table->string('tanggal_opd_2');
            $table->string('nama_opd_3');
            $table->string('tanggal_opd_3');
            $table->string('nama_opd_4');
            $table->string('tanggal_opd_4');
            $table->string('nama_opd_5');
            $table->string('tanggal_opd_5');
            $table->string('nama_opd_6');
            $table->string('tanggal_opd_6');
            $table->date('tanggal')->nullable();
            $table->string('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form3');
    }
};
