<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('format15_form4s', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bencana_id')->index();
            $table->string('kabupaten')->nullable();
            $table->string('nama_kampung')->nullable();
            $table->string('nama_distrik')->nullable();
            // Fasilitas
            $table->string('fasilitas_1_jenis')->nullable();
            $table->integer('fasilitas_1_rb_tingkat')->nullable()->default(0);
            $table->integer('fasilitas_1_rs_tingkat')->nullable()->default(0);
            $table->integer('fasilitas_1_rr_tingkat')->nullable()->default(0);
            $table->decimal('fasilitas_1_rb_harga', 20, 2)->nullable()->default(0);
            $table->decimal('fasilitas_1_rs_harga', 20, 2)->nullable()->default(0);
            $table->decimal('fasilitas_1_rr_harga', 20, 2)->nullable()->default(0);
            $table->string('fasilitas_2_jenis')->nullable();
            $table->integer('fasilitas_2_rb_tingkat')->nullable()->default(0);
            $table->integer('fasilitas_2_rs_tingkat')->nullable()->default(0);
            $table->integer('fasilitas_2_rr_tingkat')->nullable()->default(0);
            $table->decimal('fasilitas_2_rb_harga', 20, 2)->nullable()->default(0);
            $table->decimal('fasilitas_2_rs_harga', 20, 2)->nullable()->default(0);
            $table->decimal('fasilitas_2_rr_harga', 20, 2)->nullable()->default(0);
            $table->string('fasilitas_3_jenis')->nullable();
            $table->integer('fasilitas_3_rb_tingkat')->nullable()->default(0);
            $table->integer('fasilitas_3_rs_tingkat')->nullable()->default(0);
            $table->integer('fasilitas_3_rr_tingkat')->nullable()->default(0);
            $table->decimal('fasilitas_3_rb_harga', 20, 2)->nullable()->default(0);
            $table->decimal('fasilitas_3_rs_harga', 20, 2)->nullable()->default(0);
            $table->decimal('fasilitas_3_rr_harga', 20, 2)->nullable()->default(0);
            // Kerugian
            $table->string('kerugian_1_jenis')->nullable();
            $table->decimal('kerugian_1_rb_nilai', 20, 2)->nullable()->default(0);
            $table->decimal('kerugian_1_rs_nilai', 20, 2)->nullable()->default(0);
            $table->string('kerugian_2_jenis')->nullable();
            $table->decimal('kerugian_2_rb_nilai', 20, 2)->nullable()->default(0);
            $table->decimal('kerugian_2_rs_nilai', 20, 2)->nullable()->default(0);
            $table->string('kerugian_3_jenis')->nullable();
            $table->decimal('kerugian_3_rb_nilai', 20, 2)->nullable()->default(0);
            $table->decimal('kerugian_3_rs_nilai', 20, 2)->nullable()->default(0);
            $table->string('kerugian_4_jenis')->nullable();
            $table->decimal('kerugian_4_rb_nilai', 20, 2)->nullable()->default(0);
            $table->decimal('kerugian_4_rs_nilai', 20, 2)->nullable()->default(0);
            $table->decimal('total_kerusakan', 20, 2)->nullable()->default(0);
            $table->decimal('total_kerugian', 20, 2)->nullable()->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('format15_form4s');
    }
};
