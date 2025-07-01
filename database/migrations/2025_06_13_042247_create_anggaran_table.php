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
        Schema::create('anggaran', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bencana_id');
            $table->string('sektor');
            $table->string('komponen_kebutuhan');
            $table->string('kegiatan');
            $table->string('lokasi');
            $table->integer('volume');
            $table->string('satuan');
            $table->decimal('harga_satuan', 15, 2);
            $table->decimal('jumlah', 15, 2);
            $table->text('keterangan')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anggaran');
    }
};
