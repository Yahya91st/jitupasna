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
        Schema::table('environmental_reports', function (Blueprint $table) {
            // Check if columns already exist before adding them
            if (!Schema::hasColumn('environmental_reports', 'report_type')) {
                $table->enum('report_type', ['damage', 'loss'])->after('bencana_id');
            }
            
            // Kolom untuk laporan kerusakan (damage)
            if (!Schema::hasColumn('environmental_reports', 'ekosistem')) {
                $table->enum('ekosistem', ['darat', 'laut', 'udara'])->nullable()->after('report_type');
            }
            
            if (!Schema::hasColumn('environmental_reports', 'jenis_kerusakan')) {
                $table->string('jenis_kerusakan')->nullable()->after('ekosistem');
            }
            
            // Kolom untuk laporan kerugian (loss)
            if (!Schema::hasColumn('environmental_reports', 'jenis_kerugian')) {
                $table->enum('jenis_kerugian', [
                    'kehilangan_jasa_lingkungan',
                    'pencemaran_air',
                    'pencemaran_udara'
                ])->nullable()->after('jenis_kerusakan');
            }
            
            if (!Schema::hasColumn('environmental_reports', 'jenis')) {
                $table->string('jenis')->nullable()->after('jenis_kerugian');
            }
            
            if (!Schema::hasColumn('environmental_reports', 'dasar_perhitungan')) {
                $table->text('dasar_perhitungan')->nullable()->after('jenis');
            }
            
            // Catatan field if it doesn't exist
            if (!Schema::hasColumn('environmental_reports', 'catatan')) {
                $table->text('catatan')->nullable()->after('harga_rr');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('environmental_reports', function (Blueprint $table) {
            // Only drop columns that we added in this migration
            $columnsToCheck = [
                'report_type', 'ekosistem', 'jenis_kerusakan', 
                'jenis_kerugian', 'jenis', 'dasar_perhitungan', 'catatan'
            ];
            
            foreach ($columnsToCheck as $column) {
                if (Schema::hasColumn('environmental_reports', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
