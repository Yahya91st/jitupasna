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
        Schema::create('form8', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bencana_id');
            $table->string('sektor_sub_sektor')->nullable();
            $table->string('komponen_kerusakan')->nullable();
            $table->string('lokasi')->nullable();

            // Data Kerusakan
            $table->integer('data_kerusakan_rb')->nullable();
            $table->integer('data_kerusakan_rs')->nullable();
            $table->integer('data_kerusakan_rr')->nullable();

            // Harga Satuan
            $table->decimal('harga_satuan_rb', 16, 2)->nullable();
            $table->decimal('harga_satuan_rs', 16, 2)->nullable();
            $table->decimal('harga_satuan_rr', 16, 2)->nullable();

            // Nilai Kerusakan
            $table->decimal('nilai_kerusakan_rb', 16, 2)->nullable();
            $table->decimal('nilai_kerusakan_rs', 16, 2)->nullable();
            $table->decimal('nilai_kerusakan_rr', 16, 2)->nullable();

            // Perkiraan Kerugian dan Total
            $table->decimal('perkiraan_kerugian', 16, 2)->nullable();
            $table->decimal('total_kerusakan_kerugian', 16, 2)->nullable();
            $table->decimal('kebutuhan', 16, 2)->nullable();

            // Dynamic rows data (JSON)
            $table->json('dynamic_rows')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form8');
    }
};