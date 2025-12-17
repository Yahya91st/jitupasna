<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormat4Form4sTable extends Migration
{
    public function up()
    {
        Schema::create('format4_form4s', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bencana_id')->nullable(false);
            $table->string('nama_kampung')->nullable(false);
            $table->string('nama_distrik')->nullable(false);

            // four building groups: panti_asuhan, panti_wredha, panti_tuna_grahita, lainnya
            $groups = ['panti_asuhan', 'panti_wredha', 'panti_tuna_grahita', 'lainnya'];
            foreach ($groups as $g) {
                $table->integer("{$g}_rb_negeri")->nullable()->default(0);
                $table->integer("{$g}_rb_swasta")->nullable()->default(0);
                $table->integer("{$g}_rs_negeri")->nullable()->default(0);
                $table->integer("{$g}_rs_swasta")->nullable()->default(0);
                $table->integer("{$g}_rr_negeri")->nullable()->default(0);
                $table->integer("{$g}_rr_swasta")->nullable()->default(0);
                $table->decimal("{$g}_luas", 10, 2)->nullable()->default(0);
                $table->decimal("{$g}_harga_bangunan", 15, 2)->nullable()->default(0);
                $table->decimal("{$g}_harga_obat", 15, 2)->nullable()->default(0);
                $table->decimal("{$g}_harga_meubelair", 15, 2)->nullable()->default(0);
                $table->decimal("{$g}_harga_peralatan", 15, 2)->nullable()->default(0);
            }

            // Perkiraan kerugian / tambahan fields from the form
            $table->integer('biaya_tenaga_kerja_hok')->nullable()->default(0);
            $table->decimal('biaya_tenaga_kerja_upah', 15, 2)->nullable()->default(0);
            $table->integer('biaya_alat_berat_hari')->nullable()->default(0);
            $table->decimal('biaya_alat_berat_harga', 15, 2)->nullable()->default(0);

            $table->integer('jumlah_penerima')->nullable()->default(0);
            $table->decimal('bantuan_per_orang', 15, 2)->nullable()->default(0);

            $table->decimal('biaya_pelayanan_kesehatan', 15, 2)->nullable()->default(0);
            $table->decimal('biaya_pelayanan_pendidikan', 15, 2)->nullable()->default(0);
            $table->decimal('biaya_pendampingan_psikososial', 15, 2)->nullable()->default(0);
            $table->decimal('biaya_pelatihan_darurat', 15, 2)->nullable()->default(0);

            // totals
            $table->decimal('total_kerusakan', 18, 2)->nullable()->default(0);
            $table->decimal('total_kerugian', 18, 2)->nullable()->default(0);

            $table->timestamps();

            // foreign key
            $table->foreign('bencana_id')->references('id')->on('bencana')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('format4_form4s');
    }
}
