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
        Schema::create('rumahtangga', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bencana_id')->constrained('bencana');
            $table->string('provinsi');
            $table->string('kabupaten');
            $table->string('kecamatan');
            $table->string('desa');
            $table->string('dusun');
            $table->string('rt', 10);
            $table->string('rw', 10);
            $table->string('nama_kk');
            $table->string('nik_kk', 25);
            $table->integer('jumlah_anggota');
            $table->string('status_rumah', 50);
            $table->text('kebutuhan_material')->nullable();
            $table->text('kebutuhan_sdm')->nullable();
            $table->decimal('kebutuhan_dana', 15, 2)->default(0);
            $table->string('kategori_kerusakan', 50);
            $table->text('keterangan_tambahan')->nullable();
            $table->string('foto_rumah');
            $table->string('foto_ktp');
            $table->string('foto_kk');
            $table->string('nomor_hp', 20);
            $table->string('status_hunian', 50);
            $table->string('status_bantuan', 10);
            $table->string('jenis_bantuan')->nullable();
            $table->decimal('nominal_bantuan', 15, 2)->default(0);
            $table->string('pemberi_bantuan')->nullable();
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
        Schema::dropIfExists('rumahtangga');
    }
};
