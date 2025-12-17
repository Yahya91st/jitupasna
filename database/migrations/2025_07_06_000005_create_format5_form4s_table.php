<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('format5_form4s', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bencana_id')->index();
            $table->string('nama_kampung')->nullable();
            $table->string('nama_distrik')->nullable();

            // facility groups
            $groups = ['gereja', 'kapel', 'masjid', 'musholla', 'pura', 'vihara'];

            foreach ($groups as $g) {
                $table->integer("{$g}_rb_negeri")->nullable();
                $table->integer("{$g}_rb_swasta")->nullable();
                $table->integer("{$g}_rs_negeri")->nullable();
                $table->integer("{$g}_rs_swasta")->nullable();
                $table->integer("{$g}_rr_negeri")->nullable();
                $table->integer("{$g}_rr_swasta")->nullable();
                $table->decimal("{$g}_luas", 12, 2)->nullable();
                $table->decimal("{$g}_harga_bangunan", 18, 2)->nullable();
                $table->decimal("{$g}_harga_peralatan", 18, 2)->nullable();
            }

            // Kerugian / tambahan fields
            $table->decimal('biaya_tenaga_kerja_hok', 18, 2)->nullable();
            $table->decimal('biaya_tenaga_kerja_upah', 18, 2)->nullable();
            $table->integer('biaya_alat_berat_hari')->nullable();
            $table->decimal('biaya_alat_berat_harga', 18, 2)->nullable();

            // Totals
            $table->decimal('total_kerusakan', 20, 2)->nullable()->default(0);
            $table->decimal('total_kerugian', 20, 2)->nullable()->default(0);

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('format5_form4s');
    }
};