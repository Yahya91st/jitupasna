<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('format10_form4s', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bencana_id')->index();
            $table->string('nama_kampung')->nullable();
            $table->string('nama_distrik')->nullable();
            // Kerusakan Lahan Pertanian
            $table->decimal('padi_luas', 12, 2)->nullable();
            $table->string('padi_lama_tanam')->nullable();
            $table->decimal('padi_harga', 20, 2)->nullable();
            $table->decimal('padi_total', 20, 2)->nullable();
            $table->decimal('palawija_luas', 12, 2)->nullable();
            $table->string('palawija_lama_tanam')->nullable();
            $table->decimal('palawija_harga', 20, 2)->nullable();
            $table->decimal('palawija_total', 20, 2)->nullable();
            $table->decimal('holtikultura_luas', 12, 2)->nullable();
            $table->string('holtikultura_lama_tanam')->nullable();
            $table->decimal('holtikultura_harga', 20, 2)->nullable();
            $table->decimal('holtikultura_total', 20, 2)->nullable();
            $table->decimal('perkebunan1_luas', 12, 2)->nullable();
            $table->string('perkebunan1_lama_tanam')->nullable();
            $table->decimal('perkebunan1_harga', 20, 2)->nullable();
            $table->decimal('perkebunan1_total', 20, 2)->nullable();
            $table->decimal('perkebunan2_luas', 12, 2)->nullable();
            $table->string('perkebunan2_lama_tanam')->nullable();
            $table->decimal('perkebunan2_harga', 20, 2)->nullable();
            $table->decimal('perkebunan2_total', 20, 2)->nullable();
            $table->decimal('perkebunan3_luas', 12, 2)->nullable();
            $table->string('perkebunan3_lama_tanam')->nullable();
            $table->decimal('perkebunan3_harga', 20, 2)->nullable();
            $table->decimal('perkebunan3_total', 20, 2)->nullable();
            // Total
            $table->decimal('total_kerusakan', 20, 2)->nullable()->default(0);
            $table->decimal('total_kerugian', 20, 2)->nullable()->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('format10_form4s');
    }
};
