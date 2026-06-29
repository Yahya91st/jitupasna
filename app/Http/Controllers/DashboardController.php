<?php

namespace App\Http\Controllers;

use App\Models\Bencana;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Mendapatkan tanggal awal dan akhir tahun ini
        $startOfYear = Carbon::now()->startOfYear();
        $endOfYear = Carbon::now()->endOfYear();

        // Mengambil data bencana dengan jenis_bencana bencana
        $bencanaData = Bencana::whereBetween('tanggal', [$startOfYear, $endOfYear])
        ->get();

        // Mengelompokkan bencana berdasarkan jenis_bencana
        $groupedByCategory = $bencanaData->groupBy(function ($item) {
            return $item->jenis_bencana;
        });

        // Menyiapkan data untuk laporan
        $reportData = $groupedByCategory->map(function ($bencanas, $jenis_bencana) {
            // Menghitung jumlah kejadian dalam setahun
            $kejadianDalamSetahun = $bencanas->count();

            // Menghitung estimasi kebutuhan total
            // $estimasiKebutuhanTotal = $bencanas->flatMap(function ($bencana) {
            //     return $bencana->kerugian->pluck('BiayaKeseluruhan')
            //         ->merge($bencana->kerusakan->pluck('BiayaKeseluruhan'));
            // })->sum();

            return [
                'jenis_bencana' => $jenis_bencana,
                'kejadian_dalam_setahun' => $kejadianDalamSetahun,
                // 'estimasi_kebutuhan_total' => $estimasiKebutuhanTotal,
            ];
        });

        return view('layouts.dashboard', compact('reportData'));
    }
}
