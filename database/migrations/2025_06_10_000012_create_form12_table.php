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
        Schema::create('form12', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bencana_id');

            $table->string('sektor')->nullable();
            $table->string('komponen_kebutuhan')->nullable();
            $table->string('kegiatan')->nullable();
            $table->string('lokasi')->nullable();
            $table->integer('volume')->nullable()->default(0);
            $table->string('satuan')->nullable();
            $table->decimal('harga_satuan', 15, 2)->nullable()->default(0);
            $table->decimal('jumlah', 15, 2)->nullable()->default(0);
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form12');
    }
};
