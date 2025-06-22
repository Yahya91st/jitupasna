<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEducationReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('education_reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bencana_id')->nullable();
            $table->string('jenis_fasilitas')->nullable();
            $table->string('nama_fasilitas')->nullable();
            $table->integer('rusak_berat')->default(0);
            $table->integer('rusak_sedang')->default(0);
            $table->integer('rusak_ringan')->default(0);
            $table->decimal('biaya_rb', 15, 2)->default(0.00);
            $table->decimal('biaya_rs', 15, 2)->default(0.00);
            $table->decimal('biaya_rr', 15, 2)->default(0.00);
            $table->decimal('total_biaya', 15, 2)->default(0.00);
            $table->text('keterangan')->nullable();
            $table->timestamps();
            
            $table->foreign('bencana_id')->references('id')->on('bencana')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('education_reports');
    }
}
