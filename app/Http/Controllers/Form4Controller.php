<?php

/**
 * IMPORTANT: THIS CONTROLLER IS BEING PHASED OUT
 * 
 * This controller is being replaced by individual controllers for each format:
 * - \App\Http\Controllers\Form4\Format1Controller.php (Housing)
 * - \App\Http\Controllers\Form4\Format2Controller.php (Education)
 * - \App\Http\Controllers\Form4\Format3Controller.php (Health)
 * - \App\Http\Controllers\Form4\Format4Controller.php (Social Protection)
 * - \App\Http\Controllers\Form4\Format5Controller.php (Religious)
 * - \App\Http\Controllers\Form4\Format6Controller.php (Clean Water and Sanitation)
 * - \App\Http\Controllers\Form4\Format7Controller.php (Transportation)
 * - \App\Http\Controllers\Form4\Format8Controller.php (Electricity)
 * - \App\Http\Controllers\Form4\Format9Controller.php (Telecommunications)
 * - \App\Http\Controllers\Form4\Format10Controller.php (Agriculture)
 * - \App\Http\Controllers\Form4\Format11Controller.php (Livestock)
 * - \App\Http\Controllers\Form4\Format12Controller.php (Fishery)
 * - \App\Http\Controllers\Form4\Format13Controller.php (Industry)
 * - \App\Http\Controllers\Form4\Format14Controller.php (Commerce)
 * - \App\Http\Controllers\Form4\Format15Controller.php (Tourism)
 * - \App\Http\Controllers\Form4\Format16Controller.php (Government)
 * - \App\Http\Controllers\Form4\Format17Controller.php (Environment)
 * 
 * Please use the new controllers for all new development.
 * This controller is maintained temporarily for backwards compatibility.
 */

namespace App\Http\Controllers;

use App\Models\Format1Form4;
use Illuminate\Http\Request;
use App\Models\Bencana;
use App\Models\FormPerumahan;
use App\Models\EnvironmentalReport;
use App\Models\GovernmentReport;
use App\Models\form;
use App\Models\Format10Form4;
use App\Models\Format11Form4;
use App\Models\Format12Form4;
use App\Models\Format13Form4;
use App\Models\Format14Form4;
use App\Models\Format15Form4;
use App\Models\Format16Form4;
use App\Models\Format17Form4;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Barryvdh\DomPDF\PDF as DomPdf;

class Form4Controller extends Controller
{
    public function index(Request $request)
    {
        $bencana_id = $request->input('bencana_id');
        
        // Redirect to bencana selection if no bencana_id is provided
        if (!$bencana_id) {
            return redirect()->route('bencana.index', ['source' => 'forms']);
        }
        
        // Get bencana details
        $bencana = Bencana::findOrFail($bencana_id);
        
        return view('forms.form4', compact('bencana'));
    }

    public function generatePdf($id)
    {
        $formPerumahan = Format1Form4::with('bencana.kategori_bencana', 'bencana.desa')->findOrFail($id);
        $bencana = $formPerumahan->bencana;
        
        // Calculate totals
        $totalRumahPermanen = (int)$formPerumahan->rumah_hancur_total_permanen + 
                             (int)$formPerumahan->rumah_rusak_berat_permanen + 
                             (int)$formPerumahan->rumah_rusak_sedang_permanen + 
                             (int)$formPerumahan->rumah_rusak_ringan_permanen;
        
        $totalRumahNonPermanen = (int)$formPerumahan->rumah_hancur_total_non_permanen + 
                                (int)$formPerumahan->rumah_rusak_berat_non_permanen + 
                                (int)$formPerumahan->rumah_rusak_sedang_non_permanen + 
                                (int)$formPerumahan->rumah_rusak_ringan_non_permanen;
        
        $totalJalanRusak = (float)$formPerumahan->jalan_rusak_berat + 
                          (float)$formPerumahan->jalan_rusak_sedang + 
                          (float)$formPerumahan->jalan_rusak_ringan;
        
        $totalSaluranRusak = (float)$formPerumahan->saluran_rusak_berat + 
                            (float)$formPerumahan->saluran_rusak_sedang + 
                            (float)$formPerumahan->saluran_rusak_ringan;
        
        $totalBalaiRusak = (int)$formPerumahan->balai_rusak_berat + 
                          (int)$formPerumahan->balai_rusak_sedang;
        
        // Calculate estimated costs
        $biayaRumahPermanen = $totalRumahPermanen * (float)$formPerumahan->harga_satuan_permanen;
        $biayaRumahNonPermanen = $totalRumahNonPermanen * (float)$formPerumahan->harga_satuan_non_permanen;
        $biayaJalan = $totalJalanRusak * (float)$formPerumahan->harga_satuan_jalan;
        $biayaSaluran = $totalSaluranRusak * (float)$formPerumahan->harga_satuan_saluran;
        $biayaBalai = $totalBalaiRusak * (float)$formPerumahan->harga_satuan_balai;
        
        $biayaHOK = (int)$formPerumahan->tenaga_kerja_hok * (float)$formPerumahan->upah_harian;
        $biayaAlatBerat = (int)$formPerumahan->alat_berat_hari * (float)$formPerumahan->biaya_per_hari;
        $biayaTenda = (int)$formPerumahan->jumlah_tenda * (float)$formPerumahan->harga_tenda;
        $biayaBarak = (int)$formPerumahan->jumlah_barak * (float)$formPerumahan->harga_barak;
        $biayaRumahSementara = (int)$formPerumahan->jumlah_rumah_sementara * (float)$formPerumahan->harga_rumah_sementara;
        
        $totalBiayaKerusakan = $biayaRumahPermanen + $biayaRumahNonPermanen + $biayaJalan + $biayaSaluran + $biayaBalai;
        $totalBiayaKerugian = $biayaHOK + $biayaAlatBerat + (float)$formPerumahan->harga_sewa_per_bulan + $biayaTenda + $biayaBarak + $biayaRumahSementara;
        $totalKeseluruhanBiaya = $totalBiayaKerusakan + $totalBiayaKerugian;
        
        $data = [
            'formPerumahan' => $formPerumahan,
            'bencana' => $bencana,
            'totalRumahPermanen' => $totalRumahPermanen,
            'totalRumahNonPermanen' => $totalRumahNonPermanen,
            'totalJalanRusak' => $totalJalanRusak,
            'totalSaluranRusak' => $totalSaluranRusak,
            'totalBalaiRusak' => $totalBalaiRusak,
            'biayaRumahPermanen' => $biayaRumahPermanen,
            'biayaRumahNonPermanen' => $biayaRumahNonPermanen,
            'biayaJalan' => $biayaJalan,
            'biayaSaluran' => $biayaSaluran,
            'biayaBalai' => $biayaBalai,
            'biayaHOK' => $biayaHOK,
            'biayaAlatBerat' => $biayaAlatBerat,
            'biayaTenda' => $biayaTenda,
            'biayaBarak' => $biayaBarak,
            'biayaRumahSementara' => $biayaRumahSementara,
            'totalBiayaKerusakan' => $totalBiayaKerusakan,
            'totalBiayaKerugian' => $totalBiayaKerugian,
            'totalKeseluruhanBiaya' => $totalKeseluruhanBiaya,
            'tanggal' => date('d-m-Y'),
        ];
        
        // Load view dengan DomPdf dan atur landscape
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('forms.form4.format1.pdf', $data)
            ->setPaper('a4', 'landscape');
        return $pdf->download('FormPerumahan_' . $formPerumahan->id . '.pdf');
    }

    public function previewPdf($id)
    {
        $formPerumahan = FormPerumahan::with('bencana.kategori_bencana', 'bencana.desa')->findOrFail($id);
        $bencana = $formPerumahan->bencana;
        
        // Calculate totals
        $totalRumahPermanen = (int)$formPerumahan->rumah_hancur_total_permanen + 
                             (int)$formPerumahan->rumah_rusak_berat_permanen + 
                             (int)$formPerumahan->rumah_rusak_sedang_permanen + 
                             (int)$formPerumahan->rumah_rusak_ringan_permanen;
        
        $totalRumahNonPermanen = (int)$formPerumahan->rumah_hancur_total_non_permanen + 
                                (int)$formPerumahan->rumah_rusak_berat_non_permanen + 
                                (int)$formPerumahan->rumah_rusak_sedang_non_permanen + 
                                (int)$formPerumahan->rumah_rusak_ringan_non_permanen;
        
        $totalJalanRusak = (float)$formPerumahan->jalan_rusak_berat + 
                          (float)$formPerumahan->jalan_rusak_sedang + 
                          (float)$formPerumahan->jalan_rusak_ringan;
        
        $totalSaluranRusak = (float)$formPerumahan->saluran_rusak_berat + 
                            (float)$formPerumahan->saluran_rusak_sedang + 
                            (float)$formPerumahan->saluran_rusak_ringan;
        
        $totalBalaiRusak = (int)$formPerumahan->balai_rusak_berat + 
                          (int)$formPerumahan->balai_rusak_sedang;
        
        // Calculate estimated costs
        $biayaRumahPermanen = $totalRumahPermanen * (float)$formPerumahan->harga_satuan_permanen;
        $biayaRumahNonPermanen = $totalRumahNonPermanen * (float)$formPerumahan->harga_satuan_non_permanen;
        $biayaJalan = $totalJalanRusak * (float)$formPerumahan->harga_satuan_jalan;
        $biayaSaluran = $totalSaluranRusak * (float)$formPerumahan->harga_satuan_saluran;
        $biayaBalai = $totalBalaiRusak * (float)$formPerumahan->harga_satuan_balai;
        
        $biayaHOK = (int)$formPerumahan->tenaga_kerja_hok * (float)$formPerumahan->upah_harian;
        $biayaAlatBerat = (int)$formPerumahan->alat_berat_hari * (float)$formPerumahan->biaya_per_hari;
        $biayaTenda = (int)$formPerumahan->jumlah_tenda * (float)$formPerumahan->harga_tenda;
        $biayaBarak = (int)$formPerumahan->jumlah_barak * (float)$formPerumahan->harga_barak;
        $biayaRumahSementara = (int)$formPerumahan->jumlah_rumah_sementara * (float)$formPerumahan->harga_rumah_sementara;
        
        $totalBiayaKerusakan = $biayaRumahPermanen + $biayaRumahNonPermanen + $biayaJalan + $biayaSaluran + $biayaBalai;
        $totalBiayaKerugian = $biayaHOK + $biayaAlatBerat + (float)$formPerumahan->harga_sewa_per_bulan + $biayaTenda + $biayaBarak + $biayaRumahSementara;
        $totalKeseluruhanBiaya = $totalBiayaKerusakan + $totalBiayaKerugian;
        
        $data = [
            'formPerumahan' => $formPerumahan,
            'bencana' => $bencana,
            'totalRumahPermanen' => $totalRumahPermanen,
            'totalRumahNonPermanen' => $totalRumahNonPermanen,
            'totalJalanRusak' => $totalJalanRusak,
            'totalSaluranRusak' => $totalSaluranRusak,
            'totalBalaiRusak' => $totalBalaiRusak,
            'biayaRumahPermanen' => $biayaRumahPermanen,
            'biayaRumahNonPermanen' => $biayaRumahNonPermanen,
            'biayaJalan' => $biayaJalan,
            'biayaSaluran' => $biayaSaluran,
            'biayaBalai' => $biayaBalai,
            'biayaHOK' => $biayaHOK,
            'biayaAlatBerat' => $biayaAlatBerat,
            'biayaTenda' => $biayaTenda,
            'biayaBarak' => $biayaBarak,
            'biayaRumahSementara' => $biayaRumahSementara,
            'totalBiayaKerusakan' => $totalBiayaKerusakan,
            'totalBiayaKerugian' => $totalBiayaKerugian,
            'totalKeseluruhanBiaya' => $totalKeseluruhanBiaya,
            'tanggal' => date('d-m-Y'),
        ];
        
        // Load view dengan DomPdf dan atur landscape
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('forms.form4.format1.pdf', $data)
            ->setPaper('a4', 'landscape');
        return $pdf->stream('FormPerumahan_' . $formPerumahan->id . '.pdf');
    }

    public function generateFormat10Pdf($bencana_id)
    {
        $report = Format10Form4::with('bencana')->where('bencana_id', $bencana_id)->latest()->first();
        
        if (!$report) {
            return redirect()->back()->with('error', 'Data laporan tidak ditemukan.');
        }
        
        $data = [
            'report' => $report,
            'bencana' => $report->bencana,
            'tanggal' => date('d-m-Y'),
        ];
        
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('forms.form4.format10.pdf', $data)
            ->setPaper('a4', 'landscape');
        return $pdf->download('Laporan_Sektor_Pertanian_' . $report->id . '.pdf');
    }

    public function previewFormat10Pdf($bencana_id)
    {
        $report = Format10Form4::with('bencana')->where('bencana_id', $bencana_id)->latest()->first();
        
        if (!$report) {
            return redirect()->back()->with('error', 'Data laporan tidak ditemukan.');
        }
        
        $data = [
            'report' => $report,
            'bencana' => $report->bencana,
            'tanggal' => date('d-m-Y'),
        ];
        
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('forms.form4.format10.pdf', $data)
            ->setPaper('a4', 'landscape');
        return $pdf->stream('Laporan_Sektor_Pertanian_' . $report->id . '.pdf');
    }

    public function generateFormat11Pdf($bencana_id)
    {
        $report = Format11Form4::with('bencana')->where('bencana_id', $bencana_id)->latest()->first();
        
        if (!$report) {
            return redirect()->back()->with('error', 'Data laporan tidak ditemukan.');
        }
        
        $data = [
            'report' => $report,
            'bencana' => $report->bencana,
            'tanggal' => date('d-m-Y'),
        ];
        
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('forms.form4.format11.pdf', $data)
            ->setPaper('a4', 'landscape');
        return $pdf->download('Laporan_Sektor_Peternakan_' . $report->id . '.pdf');
    }
 
    public function previewFormat11Pdf($bencana_id)
    {
        $report = Format11Form4::with('bencana')->where('bencana_id', $bencana_id)->latest()->first();
        
        if (!$report) {
            return redirect()->back()->with('error', 'Data laporan tidak ditemukan.');
        }
        
        $data = [
            'report' => $report,
            'bencana' => $report->bencana,
            'tanggal' => date('d-m-Y'),
        ];
        
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('forms.form4.format11.pdf', $data)
            ->setPaper('a4', 'landscape');
        return $pdf->stream('Laporan_Sektor_Peternakan_' . $report->id . '.pdf');
    }

    public function generateFormat12Pdf($bencana_id)
    {
        $report = Format12Form4::with('bencana')->where('bencana_id', $bencana_id)->latest()->first();
        
        if (!$report) {
            return redirect()->back()->with('error', 'Data laporan tidak ditemukan.');
        }
        
        $data = [
            'report' => $report,
            'bencana' => $report->bencana,
            'tanggal' => date('d-m-Y'),
        ];
        
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('forms.form4.format12.pdf', $data)
            ->setPaper('a4', 'landscape');
        return $pdf->download('Laporan_Sektor_Perikanan_' . $report->id . '.pdf');
    }

    public function previewFormat12Pdf($bencana_id)
    {
        $report = Format12Form4::with('bencana')->where('bencana_id', $bencana_id)->latest()->first();
        
        if (!$report) {
            return redirect()->back()->with('error', 'Data laporan tidak ditemukan.');
        }
        
        $data = [
            'report' => $report,
            'bencana' => $report->bencana,
            'tanggal' => date('d-m-Y'),
        ];
        
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('forms.form4.format12.pdf', $data)
            ->setPaper('a4', 'landscape');
        return $pdf->stream('Laporan_Sektor_Perikanan_' . $report->id . '.pdf');
    }
    
    public function generateFormat13Pdf($bencana_id)
    {
        $report = Format13Form4::with('bencana')->where('bencana_id', $bencana_id)->latest()->first();
        
        if (!$report) {
            return redirect()->back()->with('error', 'Data laporan tidak ditemukan.');
        }
        
        $data = [
            'report' => $report,
            'bencana' => $report->bencana,
            'tanggal' => date('d-m-Y'),
        ];
        
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('forms.form4.format13.pdf', $data)
            ->setPaper('a4', 'landscape');
        return $pdf->download('Laporan_Sektor_UMKM_' . $report->id . '.pdf');
    }

    public function previewFormat13Pdf($bencana_id)
    {
        $report = Format13Form4::with('bencana')->where('bencana_id', $bencana_id)->latest()->first();
        
        if (!$report) {
            return redirect()->back()->with('error', 'Data laporan tidak ditemukan.');
        }
        
        $data = [
            'report' => $report,
            'bencana' => $report->bencana,
            'tanggal' => date('d-m-Y'),
        ];
        
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('forms.form4.format13.pdf', $data)
            ->setPaper('a4', 'landscape');
        return $pdf->stream('Laporan_Sektor_UMKM_' . $report->id . '.pdf');
    }

    public function generateFormat14Pdf($bencana_id)
    {
        $report = Format14Form4::with('bencana')->where('bencana_id', $bencana_id)->latest()->first();
        
        if (!$report) {
            return redirect()->back()->with('error', 'Data laporan tidak ditemukan.');
        }
        
        $data = [
            'report' => $report,
            'bencana' => $report->bencana,
            'tanggal' => date('d-m-Y'),
        ];
        
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('forms.form4.format14.pdf', $data)
            ->setPaper('a4', 'landscape');
        return $pdf->download('Laporan_Sektor_Pariwisata_' . $report->id . '.pdf');
    }
    
    public function previewFormat14Pdf($bencana_id)
    {
        $report = Format14Form4::with('bencana')->where('bencana_id', $bencana_id)->latest()->first();
        
        if (!$report) {
            return redirect()->back()->with('error', 'Data laporan tidak ditemukan.');
        }
        
        $data = [
            'report' => $report,
            'bencana' => $report->bencana,
            'tanggal' => date('d-m-Y'),
        ];
        
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('forms.form4.format14.pdf', $data)
            ->setPaper('a4', 'landscape');
        return $pdf->stream('Laporan_Sektor_Pariwisata_' . $report->id . '.pdf');
    }

    public function generateFormat15Pdf($bencana_id)
    {
        $report = Format15Form4::with('bencana')->where('bencana_id', $bencana_id)->latest()->first();
        
        if (!$report) {
            return redirect()->back()->with('error', 'Data laporan tidak ditemukan.');
        }
        
        $data = [
            'report' => $report,
            'bencana' => $report->bencana,
            'tanggal' => date('d-m-Y'),
        ];
        
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('forms.form4.format15.pdf', $data)
            ->setPaper('a4', 'landscape');
        return $pdf->download('Laporan_Sektor_Industri_' . $report->id . '.pdf');
    }

    public function previewFormat15Pdf($bencana_id)
    {
        $report = Format15Form4::with('bencana')->where('bencana_id', $bencana_id)->latest()->first();
        
        if (!$report) {
            return redirect()->back()->with('error', 'Data laporan tidak ditemukan.');
        }
        
        $data = [
            'report' => $report,
            'bencana' => $report->bencana,
            'tanggal' => date('d-m-Y'),
        ];
        
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('forms.form4.format15.pdf', $data)
            ->setPaper('a4', 'landscape');
        return $pdf->stream('Laporan_Sektor_Industri_' . $report->id . '.pdf');
    }

    public function generateFormat16Pdf($bencana_id)
    {
        $report = Format16Form4::with('bencana')->where('bencana_id', $bencana_id)->latest()->first();
        
        if (!$report) {
            return redirect()->back()->with('error', 'Data laporan tidak ditemukan.');
        }
        
        $data = [
            'report' => $report,
            'bencana' => $report->bencana,
            'tanggal' => date('d-m-Y'),
        ];
        
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('forms.form4.format16.pdf', $data)
            ->setPaper('a4', 'landscape');
        return $pdf->download('Laporan_Sektor_Pemerintahan_' . $report->id . '.pdf');
    }

    public function previewFormat16Pdf($bencana_id)
    {
        $report = Format16Form4::with('bencana')->where('bencana_id', $bencana_id)->latest()->first();
        
        if (!$report) {
            return redirect()->back()->with('error', 'Data laporan tidak ditemukan.');
        }
        
        $data = [
            'report' => $report,
            'bencana' => $report->bencana,
            'tanggal' => date('d-m-Y'),
        ];
        
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('forms.form4.format16.pdf', $data)
            ->setPaper('a4', 'landscape');
        return $pdf->stream('Laporan_Sektor_Pemerintahan_' . $report->id . '.pdf');
    }

    public function generateFormat17Pdf($bencana_id)
    {
        $report = Format17Form4::with('bencana')->where('bencana_id', $bencana_id)->latest()->first();
        
        if (!$report) {
            return redirect()->back()->with('error', 'Data laporan tidak ditemukan.');
        }
        
        $data = [
            'report' => $report,
            'bencana' => $report->bencana,
            'tanggal' => date('d-m-Y'),
        ];
        
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('forms.form4.format17.pdf', $data)
            ->setPaper('a4', 'landscape');
        return $pdf->download('Laporan_Sektor_Lingkungan_' . $report->id . '.pdf');
    }

    public function previewFormat17Pdf($bencana_id)
    {
        $report = Format17Form4::with('bencana')->where('bencana_id', $bencana_id)->latest()->first();
        
        if (!$report) {
            return redirect()->back()->with('error', 'Data laporan tidak ditemukan.');
        }
        
        $data = [
            'report' => $report,
            'bencana' => $report->bencana,
            'tanggal' => date('d-m-Y'),
        ];
        
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('forms.form4.format17.pdf', $data)
            ->setPaper('a4', 'landscape');
        return $pdf->stream('Laporan_Sektor_Lingkungan_' . $report->id . '.pdf');
    }
}
