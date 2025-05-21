<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('environmental_damages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bencana_id');
            $table->enum('ekosistem', ['darat', 'laut', 'udara']);
            $table->string('jenis_kerusakan');
            $table->integer('rb')->nullable(); // Rusak Berat
            $table->integer('rs')->nullable(); // Rusak Sedang
            $table->integer('rr')->nullable(); // Rusak Ringan
            $table->decimal('harga_rb', 15, 2)->nullable();
            $table->decimal('harga_rs', 15, 2)->nullable();
            $table->decimal('harga_rr', 15, 2)->nullable();
            $table->timestamps();

            $table->foreign('bencana_id')->references('id')->on('bencana')->onDelete('cascade');
        });

        Schema::create('environmental_losses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bencana_id');
            $table->enum('jenis_kerugian', [
                'kehilangan_jasa_lingkungan',
                'pencemaran_air',
                'pencemaran_udara'
            ]);
            $table->string('jenis');
            $table->text('dasar_perhitungan')->nullable();
            $table->integer('rb')->nullable();
            $table->integer('rs')->nullable();
            $table->integer('rr')->nullable();
            $table->decimal('harga_rb', 15, 2)->nullable();
            $table->decimal('harga_rs', 15, 2)->nullable();
            $table->decimal('harga_rr', 15, 2)->nullable();
            $table->timestamps();

            $table->foreign('bencana_id')->references('id')->on('bencana')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('environmental_damages');
        Schema::dropIfExists('environmental_losses');
    }
};