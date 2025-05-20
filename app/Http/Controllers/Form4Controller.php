<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Form4Controller extends Controller
{
    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'nama_kampung' => 'required|string',
            'nama_distrik' => 'required|string',
            'rumah_hancur_total_permanen' => 'nullable|integer',
            'rumah_hancur_total_non_permanen' => 'nullable|integer',
            'rumah_rusak_berat_permanen' => 'nullable|integer',
            'rumah_rusak_berat_non_permanen' => 'nullable|integer',
            'rumah_rusak_sedang_permanen' => 'nullable|integer',
            'rumah_rusak_sedang_non_permanen' => 'nullable|integer',
            'rumah_rusak_ringan_permanen' => 'nullable|integer',
            'rumah_rusak_ringan_non_permanen' => 'nullable|integer',
            'harga_satuan_permanen' => 'nullable|numeric',
            'harga_satuan_non_permanen' => 'nullable|numeric',
            'jalan_rusak_berat' => 'nullable|numeric',
            'jalan_rusak_sedang' => 'nullable|numeric',
            'jalan_rusak_ringan' => 'nullable|numeric',
            'harga_satuan_jalan' => 'nullable|numeric',
            'saluran_rusak_berat' => 'nullable|numeric',
            'saluran_rusak_sedang' => 'nullable|numeric',
            'saluran_rusak_ringan' => 'nullable|numeric',
            'harga_satuan_saluran' => 'nullable|numeric',
            'balai_rusak_berat' => 'nullable|integer',
            'balai_rusak_sedang' => 'nullable|integer',
            'harga_satuan_balai' => 'nullable|numeric',
            'tenaga_kerja_hok' => 'nullable|integer',
            'upah_harian' => 'nullable|numeric',
            'alat_berat_hari' => 'nullable|integer',
            'biaya_per_hari' => 'nullable|numeric',
            'harga_sewa_per_bulan' => 'nullable|numeric',
            'jumlah_tenda' => 'nullable|integer',
            'harga_tenda' => 'nullable|numeric',
            'jumlah_barak' => 'nullable|integer',
            'harga_barak' => 'nullable|numeric',
            'jumlah_rumah_sementara' => 'nullable|integer',
            'harga_rumah_sementara' => 'nullable|numeric',
        ]);

        // TODO: Save the data to database
        // For now, we'll just redirect back with success message

        return redirect()->back()->with('success', 'Data berhasil disimpan');
    }
}
