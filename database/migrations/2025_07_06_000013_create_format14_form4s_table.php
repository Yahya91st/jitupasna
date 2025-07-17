<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('format14_form4s', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bencana_id')->index();
            $table->string('kabupaten')->nullable();
            $table->string('nama_kampung')->nullable();
            $table->string('nama_distrik')->nullable();
            // Tempat Usaha
            $table->string('tempatusaha_1_jenis')->nullable();
            $table->integer('tempatusaha_1_rb_jumlah')->nullable()->default(0);
            $table->integer('tempatusaha_1_rs_jumlah')->nullable()->default(0);
            $table->integer('tempatusaha_1_rr_jumlah')->nullable()->default(0);
            $table->decimal('tempatusaha_1_rb_harga', 20, 2)->nullable()->default(0);
            $table->decimal('tempatusaha_1_rs_harga', 20, 2)->nullable()->default(0);
            $table->decimal('tempatusaha_1_rr_harga', 20, 2)->nullable()->default(0);
            $table->string('tempatusaha_2_jenis')->nullable();
            $table->integer('tempatusaha_2_rb_jumlah')->nullable()->default(0);
            $table->integer('tempatusaha_2_rs_jumlah')->nullable()->default(0);
            $table->integer('tempatusaha_2_rr_jumlah')->nullable()->default(0);
            $table->decimal('tempatusaha_2_rb_harga', 20, 2)->nullable()->default(0);
            $table->decimal('tempatusaha_2_rs_harga', 20, 2)->nullable()->default(0);
            $table->decimal('tempatusaha_2_rr_harga', 20, 2)->nullable()->default(0);
            $table->string('tempatusaha_3_jenis')->nullable();
            $table->integer('tempatusaha_3_rb_jumlah')->nullable()->default(0);
            $table->integer('tempatusaha_3_rs_jumlah')->nullable()->default(0);
            $table->integer('tempatusaha_3_rr_jumlah')->nullable()->default(0);
            $table->decimal('tempatusaha_3_rb_harga', 20, 2)->nullable()->default(0);
            $table->decimal('tempatusaha_3_rs_harga', 20, 2)->nullable()->default(0);
            $table->decimal('tempatusaha_3_rr_harga', 20, 2)->nullable()->default(0);
            // Peralatan
            $table->string('peralatan_1_jenis')->nullable();
            $table->integer('peralatan_1_rb_jumlah')->nullable()->default(0);
            $table->integer('peralatan_1_rs_jumlah')->nullable()->default(0);
            $table->integer('peralatan_1_rr_jumlah')->nullable()->default(0);
            $table->decimal('peralatan_1_rb_harga', 20, 2)->nullable()->default(0);
            $table->decimal('peralatan_1_rs_harga', 20, 2)->nullable()->default(0);
            $table->decimal('peralatan_1_rr_harga', 20, 2)->nullable()->default(0);
            $table->string('peralatan_2_jenis')->nullable();
            $table->integer('peralatan_2_rb_jumlah')->nullable()->default(0);
            $table->integer('peralatan_2_rs_jumlah')->nullable()->default(0);
            $table->integer('peralatan_2_rr_jumlah')->nullable()->default(0);
            $table->decimal('peralatan_2_rb_harga', 20, 2)->nullable()->default(0);
            $table->decimal('peralatan_2_rs_harga', 20, 2)->nullable()->default(0);
            $table->decimal('peralatan_2_rr_harga', 20, 2)->nullable()->default(0);
            $table->string('peralatan_3_jenis')->nullable();
            $table->integer('peralatan_3_rb_jumlah')->nullable()->default(0);
            $table->integer('peralatan_3_rs_jumlah')->nullable()->default(0);
            $table->integer('peralatan_3_rr_jumlah')->nullable()->default(0);
            $table->decimal('peralatan_3_rb_harga', 20, 2)->nullable()->default(0);
            $table->decimal('peralatan_3_rs_harga', 20, 2)->nullable()->default(0);
            $table->decimal('peralatan_3_rr_harga', 20, 2)->nullable()->default(0);
            // Barang Dagangan
            $table->string('barangdagangan_1_jenis')->nullable();
            $table->integer('barangdagangan_1_rb_jumlah')->nullable()->default(0);
            $table->integer('barangdagangan_1_rs_jumlah')->nullable()->default(0);
            $table->integer('barangdagangan_1_rr_jumlah')->nullable()->default(0);
            $table->decimal('barangdagangan_1_rb_harga', 20, 2)->nullable()->default(0);
            $table->decimal('barangdagangan_1_rs_harga', 20, 2)->nullable()->default(0);
            $table->decimal('barangdagangan_1_rr_harga', 20, 2)->nullable()->default(0);
            $table->string('barangdagangan_2_jenis')->nullable();
            $table->integer('barangdagangan_2_rb_jumlah')->nullable()->default(0);
            $table->integer('barangdagangan_2_rs_jumlah')->nullable()->default(0);
            $table->integer('barangdagangan_2_rr_jumlah')->nullable()->default(0);
            $table->decimal('barangdagangan_2_rb_harga', 20, 2)->nullable()->default(0);
            $table->decimal('barangdagangan_2_rs_harga', 20, 2)->nullable()->default(0);
            $table->decimal('barangdagangan_2_rr_harga', 20, 2)->nullable()->default(0);
            $table->string('barangdagangan_3_jenis')->nullable();
            $table->integer('barangdagangan_3_rb_jumlah')->nullable()->default(0);
            $table->integer('barangdagangan_3_rs_jumlah')->nullable()->default(0);
            $table->integer('barangdagangan_3_rr_jumlah')->nullable()->default(0);
            $table->decimal('barangdagangan_3_rb_harga', 20, 2)->nullable()->default(0);
            $table->decimal('barangdagangan_3_rs_harga', 20, 2)->nullable()->default(0);
            $table->decimal('barangdagangan_3_rr_harga', 20, 2)->nullable()->default(0);
            $table->decimal('total_kerusakan', 20, 2)->nullable()->default(0);
            $table->decimal('total_kerugian', 20, 2)->nullable()->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('format14_form4s');
    }
};
