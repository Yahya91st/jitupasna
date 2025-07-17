<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('format13_form4s', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bencana_id')->index();
            $table->string('nama_kampung')->nullable();
            $table->string('nama_distrik')->nullable();
            $table->string('item_rusak_1')->nullable();
            $table->integer('jumlah_rusak_1')->nullable()->default(0);
            $table->decimal('harga_satuan_1', 20, 2)->nullable()->default(0);
            $table->string('item_rusak_2')->nullable();
            $table->integer('jumlah_rusak_2')->nullable()->default(0);
            $table->decimal('harga_satuan_2', 20, 2)->nullable()->default(0);
            $table->string('item_rusak_3')->nullable();
            $table->integer('jumlah_rusak_3')->nullable()->default(0);
            $table->decimal('harga_satuan_3', 20, 2)->nullable()->default(0);
            $table->string('item_rusak_4')->nullable();
            $table->integer('jumlah_rusak_4')->nullable()->default(0);
            $table->decimal('harga_satuan_4', 20, 2)->nullable()->default(0);
            $table->string('item_rusak_5')->nullable();
            $table->integer('jumlah_rusak_5')->nullable()->default(0);
            $table->decimal('harga_satuan_5', 20, 2)->nullable()->default(0);
            $table->decimal('total_biaya', 20, 2)->nullable()->default(0);
            $table->string('keterangan')->nullable();
            $table->decimal('total_kerusakan', 20, 2)->nullable()->default(0);
            $table->decimal('total_kerugian', 20, 2)->nullable()->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('format13_form4s');
    }
};
