<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('format17_form4s', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bencana_id')->index();
            $table->string('nama_kampung')->nullable();
            $table->string('nama_distrik')->nullable();
            // Ekosistem Darat (3 baris)
            $table->string('ekosistem_darat_1_jenis')->nullable();
            $table->integer('ekosistem_darat_1_rb')->nullable()->default(0);
            $table->integer('ekosistem_darat_1_rs')->nullable()->default(0);
            $table->integer('ekosistem_darat_1_rr')->nullable()->default(0);
            $table->decimal('ekosistem_darat_1_rb_harga', 20, 2)->nullable()->default(0);
            $table->decimal('ekosistem_darat_1_rs_harga', 20, 2)->nullable()->default(0);
            $table->decimal('ekosistem_darat_1_rr_harga', 20, 2)->nullable()->default(0);
            $table->string('ekosistem_darat_2_jenis')->nullable();
            $table->integer('ekosistem_darat_2_rb')->nullable()->default(0);
            $table->integer('ekosistem_darat_2_rs')->nullable()->default(0);
            $table->integer('ekosistem_darat_2_rr')->nullable()->default(0);
            $table->decimal('ekosistem_darat_2_rb_harga', 20, 2)->nullable()->default(0);
            $table->decimal('ekosistem_darat_2_rs_harga', 20, 2)->nullable()->default(0);
            $table->decimal('ekosistem_darat_2_rr_harga', 20, 2)->nullable()->default(0);
            $table->string('ekosistem_darat_3_jenis')->nullable();
            $table->integer('ekosistem_darat_3_rb')->nullable()->default(0);
            $table->integer('ekosistem_darat_3_rs')->nullable()->default(0);
            $table->integer('ekosistem_darat_3_rr')->nullable()->default(0);
            $table->decimal('ekosistem_darat_3_rb_harga', 20, 2)->nullable()->default(0);
            $table->decimal('ekosistem_darat_3_rs_harga', 20, 2)->nullable()->default(0);
            $table->decimal('ekosistem_darat_3_rr_harga', 20, 2)->nullable()->default(0);
            // Ekosistem Laut (3 baris)
            $table->string('ekosistem_laut_1_jenis')->nullable();
            $table->integer('ekosistem_laut_1_rb')->nullable()->default(0);
            $table->integer('ekosistem_laut_1_rs')->nullable()->default(0);
            $table->integer('ekosistem_laut_1_rr')->nullable()->default(0);
            $table->decimal('ekosistem_laut_1_rb_harga', 20, 2)->nullable()->default(0);
            $table->decimal('ekosistem_laut_1_rs_harga', 20, 2)->nullable()->default(0);
            $table->decimal('ekosistem_laut_1_rr_harga', 20, 2)->nullable()->default(0);
            $table->string('ekosistem_laut_2_jenis')->nullable();
            $table->integer('ekosistem_laut_2_rb')->nullable()->default(0);
            $table->integer('ekosistem_laut_2_rs')->nullable()->default(0);
            $table->integer('ekosistem_laut_2_rr')->nullable()->default(0);
            $table->decimal('ekosistem_laut_2_rb_harga', 20, 2)->nullable()->default(0);
            $table->decimal('ekosistem_laut_2_rs_harga', 20, 2)->nullable()->default(0);
            $table->decimal('ekosistem_laut_2_rr_harga', 20, 2)->nullable()->default(0);
            $table->string('ekosistem_laut_3_jenis')->nullable();
            $table->integer('ekosistem_laut_3_rb')->nullable()->default(0);
            $table->integer('ekosistem_laut_3_rs')->nullable()->default(0);
            $table->integer('ekosistem_laut_3_rr')->nullable()->default(0);
            $table->decimal('ekosistem_laut_3_rb_harga', 20, 2)->nullable()->default(0);
            $table->decimal('ekosistem_laut_3_rs_harga', 20, 2)->nullable()->default(0);
            $table->decimal('ekosistem_laut_3_rr_harga', 20, 2)->nullable()->default(0);
            // Ekosistem Udara (3 baris)
            $table->string('ekosistem_udara_1_jenis')->nullable();
            $table->integer('ekosistem_udara_1_rb')->nullable()->default(0);
            $table->integer('ekosistem_udara_1_rs')->nullable()->default(0);
            $table->integer('ekosistem_udara_1_rr')->nullable()->default(0);
            $table->decimal('ekosistem_udara_1_rb_harga', 20, 2)->nullable()->default(0);
            $table->decimal('ekosistem_udara_1_rs_harga', 20, 2)->nullable()->default(0);
            $table->decimal('ekosistem_udara_1_rr_harga', 20, 2)->nullable()->default(0);
            $table->string('ekosistem_udara_2_jenis')->nullable();
            $table->integer('ekosistem_udara_2_rb')->nullable()->default(0);
            $table->integer('ekosistem_udara_2_rs')->nullable()->default(0);
            $table->integer('ekosistem_udara_2_rr')->nullable()->default(0);
            $table->decimal('ekosistem_udara_2_rb_harga', 20, 2)->nullable()->default(0);
            $table->decimal('ekosistem_udara_2_rs_harga', 20, 2)->nullable()->default(0);
            $table->decimal('ekosistem_udara_2_rr_harga', 20, 2)->nullable()->default(0);
            $table->string('ekosistem_udara_3_jenis')->nullable();
            $table->integer('ekosistem_udara_3_rb')->nullable()->default(0);
            $table->integer('ekosistem_udara_3_rs')->nullable()->default(0);
            $table->integer('ekosistem_udara_3_rr')->nullable()->default(0);
            $table->decimal('ekosistem_udara_3_rb_harga', 20, 2)->nullable()->default(0);
            $table->decimal('ekosistem_udara_3_rs_harga', 20, 2)->nullable()->default(0);
            $table->decimal('ekosistem_udara_3_rr_harga', 20, 2)->nullable()->default(0);
            // Kerugian Lingkungan (3 baris)
            $table->string('kerugian_1_jenis')->nullable();
            $table->integer('kerugian_1_rb')->nullable()->default(0);
            $table->integer('kerugian_1_rs')->nullable()->default(0);
            $table->integer('kerugian_1_rr')->nullable()->default(0);
            $table->decimal('kerugian_1_rb_harga', 20, 2)->nullable()->default(0);
            $table->decimal('kerugian_1_rs_harga', 20, 2)->nullable()->default(0);
            $table->decimal('kerugian_1_rr_harga', 20, 2)->nullable()->default(0);
            $table->string('kerugian_2_jenis')->nullable();
            $table->integer('kerugian_2_rb')->nullable()->default(0);
            $table->integer('kerugian_2_rs')->nullable()->default(0);
            $table->integer('kerugian_2_rr')->nullable()->default(0);
            $table->decimal('kerugian_2_rb_harga', 20, 2)->nullable()->default(0);
            $table->decimal('kerugian_2_rs_harga', 20, 2)->nullable()->default(0);
            $table->decimal('kerugian_2_rr_harga', 20, 2)->nullable()->default(0);
            $table->string('kerugian_3_jenis')->nullable();
            $table->integer('kerugian_3_rb')->nullable()->default(0);
            $table->integer('kerugian_3_rs')->nullable()->default(0);
            $table->integer('kerugian_3_rr')->nullable()->default(0);
            $table->decimal('kerugian_3_rb_harga', 20, 2)->nullable()->default(0);
            $table->decimal('kerugian_3_rs_harga', 20, 2)->nullable()->default(0);
            $table->decimal('kerugian_3_rr_harga', 20, 2)->nullable()->default(0);
            $table->decimal('total_kerusakan', 20, 2)->nullable()->default(0);
            $table->decimal('total_kerugian', 20, 2)->nullable()->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('format17_form4s');
    }
};
