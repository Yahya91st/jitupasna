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
        \App\Models\Format1Form4::chunk(100, function ($rows) {
        foreach ($rows as $row) {
            $row->total_kerusakan =
                ($row->rumah_hancur_total_permanen ?? 0) * ($row->harga_satuan_hancur_total_permanen ?? 0) +
                ($row->rumah_hancur_total_non_permanen ?? 0) * ($row->harga_satuan_hancur_total_non_permanen ?? 0) +
                ($row->rumah_rusak_berat_permanen ?? 0) * ($row->harga_satuan_rusak_berat_permanen ?? 0) +
                ($row->rumah_rusak_berat_non_permanen ?? 0) * ($row->harga_satuan_rusak_berat_non_permanen ?? 0) +
                ($row->rumah_rusak_sedang_permanen ?? 0) * ($row->harga_satuan_rusak_sedang_permanen ?? 0) +
                ($row->rumah_rusak_sedang_non_permanen ?? 0) * ($row->harga_satuan_rusak_sedang_non_permanen ?? 0) +
                ($row->rumah_rusak_ringan_permanen ?? 0) * ($row->harga_satuan_rusak_ringan_permanen ?? 0) +
                ($row->rumah_rusak_ringan_non_permanen ?? 0) * ($row->harga_satuan_rusak_ringan_non_permanen ?? 0) +
                (($row->jalan_rusak_berat ?? 0) + ($row->jalan_rusak_sedang ?? 0) + ($row->jalan_rusak_ringan ?? 0)) * ($row->harga_satuan_jalan ?? 0) +
                (($row->saluran_rusak_berat ?? 0) + ($row->saluran_rusak_sedang ?? 0) + ($row->saluran_rusak_ringan ?? 0)) * ($row->harga_satuan_saluran ?? 0) +
                (($row->balai_rusak_berat ?? 0) + ($row->balai_rusak_sedang ?? 0) + ($row->balai_rusak_ringan ?? 0)) * ($row->harga_satuan_balai ?? 0);
            $row->save();
        }
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
