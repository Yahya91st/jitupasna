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
        Schema::create('fgd', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bencana_id');
            $table->string('desa_kelurahan');
            $table->string('kecamatan');
            $table->string('kabupaten');
            $table->date('tanggal');
            $table->integer('jarak_bencana');
            $table->string('tempat_sesi');
            $table->integer('jumlah_peserta');
            $table->integer('jumlah_perempuan');
            $table->integer('jumlah_laki_laki');
            $table->text('komposisi_peserta');
            $table->string('fasilitator');
            $table->string('pencatat');
            $table->text('akses_hak')->nullable();
            $table->text('fungsi_pranata')->nullable();
            $table->text('resiko_kerentanan')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users');
            $table->foreignId('updated_by')->nullable()->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fgd');
    }
};
