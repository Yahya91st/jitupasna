<?php

namespace App\Http\Controllers\Form4;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFormat2Request;
use App\Models\Bencana;
use App\Models\Formulir;
use App\Models\FormulirItem;
use App\Models\KriteriaKerusakan;
use App\Models\LaporanBencana;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Format2Controller extends Controller
{
    private function saveItem(
        $formulirId,
        $kategori,
        $subKategori = null,
        $jumlah = null,
        $hargaSatuan = null,
        $dimensi = null,
        $satuan = null,
        $kriteriaId = null,
        $tingkatKerusakan = null
    ) {
        // dd([
        //     'jumlah' => $jumlah,
        //     'harga_satuan' => $hargaSatuan,
        //     'dimensi' => $dimensi,
        // ]);
        FormulirItem::create([
            'formulir_id' => $formulirId,
            'kriteria_id' => $kriteriaId,

            'kategori' => $kategori,
            'sub_kategori' => $subKategori,

            'dimensi' => $dimensi,

            'tingkat_kerusakan' => $tingkatKerusakan ?? null,

            'jumlah' => $jumlah,
            'harga_satuan' => $hargaSatuan,

            'satuan' => $satuan,
        ]);
    }

    /**
     * Display Format 2 form for Education sector data collection
     */
    public function index(Request $request)
    {
        $bencana_id = $request->input('bencana_id');
        
        // Redirect to bencana selection if no bencana_id is provided
        if (!$bencana_id) {
            return redirect()->route('bencana.index', ['source' => 'forms']);
        }
          // Get bencana details
        $bencana = Bencana::findOrFail($bencana_id);
        
        return view('forms.form4.format2.create', compact('bencana'));
    }

    /**
     * Store format2 form data for Education sector
     */
    public function store(StoreFormat2Request $request)
    {        

        try {
            DB::beginTransaction();

            $laporan = LaporanBencana::firstOrCreate(
                [
                    'bencana_id' => $request->bencana_id,
                ],
                [
                    'tanggal_lapor' => now()->toDateString(),
                    'status' => 'draft',
                ]
            );

            $formulir = Formulir::firstOrCreate(
                [
                    'laporan_id' => $laporan->id,
                    'format_id' => 2,
                ],
                [
                    'status' => 'draft',
                ]
            );

            $details = $request->details;

            $dimensi = $request->dimensi;
            $harga_bangunan = $request->harga_bangunan;
            $harga_peralatan = $request->harga_peralatan;
            $harga_meubelair = $request->harga_meubelair;

            $hargaMaster = [];
            $dimensiMaster = [];

            foreach ($details as $detail) {
                $kategori = $detail['kategori'];

                $dimensiMaster[$kategori] =
                    $dimensi[$kategori] ?? null;
                    
                $hargaMaster[$kategori] =
                    ($harga_bangunan[$kategori] ?? 0)
                    + ($harga_peralatan[$kategori] ?? 0)
                    + ($harga_meubelair[$kategori] ?? 0);
            }
            // dd($hargaMaster);
            $biayaKategori = [
                'biaya_tenaga_kerja_hok',
                'biaya_alat_berat_hari',
            ];

            foreach ($details as $i => $detail) {

                $kategori = $detail['kategori'];

                $details[$i]['dimensi'] =
                    $dimensiMaster[$kategori] ?? null;

                if (!in_array($kategori, $biayaKategori)) {
                    $details[$i]['harga_satuan'] =
                        $hargaMaster[$kategori] ?? 0;
                }
            }
            // dd([
            //     'details_before_merge' => $details[100],
            // ]);

            // dd([
            //     'details_before_merge' => $details[100],
            // ]);

            // dd($details);

            // dd([
            //     'details_before_merge' => $details[100],
            // ]);
            

            $request->merge([
                'details' => $details
            ]);       
            
            // dd([
            //     'upah' => $request->details[100]['harga_satuan'],
            //     'alat_berat' => $request->details[101]['harga_satuan'],
            // ]);

            $validated = $request->validated();
            // dd($details);            

            $kriteriaId = KriteriaKerusakan::where(
                'tingkat',
                'berat'
            )->value('id');
            
            foreach ($details as $detail) {
                // dd($detail);
                

                $this->saveItem(
                    $formulir->id,
                    $detail['kategori'],
                    $detail['sub_kategori'] ?? null,
                    $detail['jumlah'],
                    $detail['harga_satuan'], // hargaSatuan
                    $detail['dimensi'] ?? null,
                    $detail['satuan'] ?? null, // satuan
                    $kriteriaId, // kriteriaId
                    $detail['tingkat_kerusakan'] ?? null
                );

            }

            $this->saveItem(
                $formulir->id,
                'sekolah_pengungsian',
                'unit',
                $request->sekolah_pengungsian,
                0,
                null,
                'unit'
            );

            $this->saveItem(
                $formulir->id,
                'guru_korban',
                'orang',
                $request->guru_korban,
                0,
                null,
                'jiwa'
            );

            $this->saveItem(
                $formulir->id,
                'iuran_sekolah',
                'bulan',
                $request->iuran_sekolah,
                0,
                null,
                'rp'
            );
            // dd($request->validated());
            // dd([
            //     'upah' => $request->details[100]['harga_satuan'],
            //     'alat_berat' => $request->details[101]['harga_satuan'],
            // ]);

            DB::commit();
            // Return success response for AJAX or redirect for regular form
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Data berhasil disimpan',
                    'data' => $formulir
                ]);
            }            
            return redirect()->route('forms.form4.format2.list')
            ->with('success', 'Data berhasil disimpan');

        } catch (\Exception $e) {
            DB::rollBack();
            
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Terjadi kesalahan: ' . $e->getMessage()
                ], 500);
            }

            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data. ' . $e->getMessage()]);
        }
    }

    /**
     * Show a specific form data
     */
    public function show($formulirId, $nomorInput)
    {
        $formulir = $this->loadFormulir($formulirId);

        $bencana = $formulir->laporan?->bencana;

        $items = $this->buildItemRows($formulir, $nomorInput);

        $totals = $this->computeTotals($formulir, $nomorInput);

        return view('forms.form4.format2.show-format2', compact('formPendidikan', 'bencana'));
    }

    /**
     * List all entries for this format (list-format2)
     */
    public function list(Request $request)
    {
        $bencana_id = $request->input('bencana_id');
        if (!$bencana_id) {
            return redirect()->route('bencana.index', ['source' => 'forms']);
        }
        $bencana = Bencana::with(['kategori_bencana', 'desa'])->findOrFail($bencana_id);
        $reports = Formulir::with([
            'laporan.bencana',
            'items'
        ])
        ->where('format_id', 2)
        ->whereHas('laporan', function ($q) use ($bencana_id) {
            $q->where('bencana_id', $bencana_id);
        })
        ->latest()
        ->get();

        return view('forms.form4.format2.list', compact('bencana', 'educationReports'));
    }

    /**
     * Generate PDF for a specific form data (future)
     */
    public function generatePdf($id)
    {
        $formulir = $this->loadFormulir($id);

        $bencana = $formulir->laporan?->bencana;

        $items = $this->buildItemRows($formulir);

        $totals = $this->computeTotals($formulir);

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('forms.form4.format2.pdf', compact('formPendidikan', 'bencana'));
        $pdf->setPaper('A4', 'landscape');
        return $pdf->download('Format2_Pendidikan_' . $formulir->nama_kampung . '.pdf');
    }

    /**
     * Preview PDF (Not implemented yet)
     */
    public function previewPdf($id)
    {
        return redirect()->back()->with('error', 'Format 2 (Education Sector) belum diimplementasikan.');
    }

    /**
     * Show the form for editing the specified resource (Format 2)
     */
    public function edit($formulirId, $nomor_input)
    {
        $formulir = $this->loadFormulir($formulirId);
        $detailMap = $formulir->items
        ->where('nomor_input', $nomor_input)
        ->keyBy(function ($item) {
            return implode('|', [
                $item->kategori,
                $item->sub_kategori,
                $item->tingkat_kerusakan,
                $item->kriteria_id,
            ]);
        });
        $bencana = $formulir->bencana;
        return view('forms.form4.format2.edit', compact('formPendidikan', 'bencana'));
    }

    /**
     * Update the specified resource in storage (Format 2)
     */
    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $formulir = $this->loadFormulir($id);
            $validated = $request->validate([
                'bencana_id' => 'required|exists:bencana,id',
                'nama_kampung' => 'required|string',
                'nama_distrik' => 'required|string',
                // TK/RA
                'tk_berat_negeri' => 'nullable|integer', 'tk_berat_swasta' => 'nullable|integer',
                'tk_sedang_negeri' => 'nullable|integer', 'tk_sedang_swasta' => 'nullable|integer',
                'tk_ringan_negeri' => 'nullable|integer', 'tk_ringan_swasta' => 'nullable|integer',
                'tk_ukuran' => 'nullable|integer',
                'tk_harga_bangunan' => 'nullable|numeric', 'tk_harga_peralatan' => 'nullable|string', 'tk_harga_meubelair' => 'nullable|string',
                // SD/MI
                'sd_berat_negeri' => 'nullable|integer', 'sd_berat_swasta' => 'nullable|integer',
                'sd_sedang_negeri' => 'nullable|integer', 'sd_sedang_swasta' => 'nullable|integer',
                'sd_ringan_negeri' => 'nullable|integer', 'sd_ringan_swasta' => 'nullable|integer',
                'sd_ukuran' => 'nullable|integer',
                'sd_harga_bangunan' => 'nullable|numeric', 'sd_harga_peralatan' => 'nullable|string', 'sd_harga_meubelair' => 'nullable|string',
                // SMP/MTS
                'smp_berat_negeri' => 'nullable|integer', 'smp_berat_swasta' => 'nullable|integer',
                'smp_sedang_negeri' => 'nullable|integer', 'smp_sedang_swasta' => 'nullable|integer',
                'smp_ringan_negeri' => 'nullable|integer', 'smp_ringan_swasta' => 'nullable|integer',
                'smp_ukuran' => 'nullable|integer',
                'smp_harga_bangunan' => 'nullable|numeric', 'smp_harga_peralatan' => 'nullable|string', 'smp_harga_meubelair' => 'nullable|string',
                // SMA/MA
                'sma_berat_negeri' => 'nullable|integer', 'sma_berat_swasta' => 'nullable|integer',
                'sma_sedang_negeri' => 'nullable|integer', 'sma_sedang_swasta' => 'nullable|integer',
                'sma_ringan_negeri' => 'nullable|integer', 'sma_ringan_swasta' => 'nullable|integer',
                'sma_ukuran' => 'nullable|integer',
                'sma_harga_bangunan' => 'nullable|numeric', 'sma_harga_peralatan' => 'nullable|string', 'sma_harga_meubelair' => 'nullable|string',
                // SMK
                'smk_berat_negeri' => 'nullable|integer', 'smk_berat_swasta' => 'nullable|integer',
                'smk_sedang_negeri' => 'nullable|integer', 'smk_sedang_swasta' => 'nullable|integer',
                'smk_ringan_negeri' => 'nullable|integer', 'smk_ringan_swasta' => 'nullable|integer',
                'smk_ukuran' => 'nullable|integer',
                'smk_harga_bangunan' => 'nullable|numeric', 'smk_harga_peralatan' => 'nullable|string', 'smk_harga_meubelair' => 'nullable|string',
                // Perguruan Tinggi
                'pt_berat_negeri' => 'nullable|integer', 'pt_berat_swasta' => 'nullable|integer',
                'pt_sedang_negeri' => 'nullable|integer', 'pt_sedang_swasta' => 'nullable|integer',
                'pt_ringan_negeri' => 'nullable|integer', 'pt_ringan_swasta' => 'nullable|integer',
                'pt_ukuran' => 'nullable|integer',
                'pt_harga_bangunan' => 'nullable|numeric', 'pt_harga_peralatan' => 'nullable|string', 'pt_harga_meubelair' => 'nullable|string',
                // Perpustakaan
                'perpus_berat_negeri' => 'nullable|integer', 'perpus_berat_swasta' => 'nullable|integer',
                'perpus_sedang_negeri' => 'nullable|integer', 'perpus_sedang_swasta' => 'nullable|integer',
                'perpus_ringan_negeri' => 'nullable|integer', 'perpus_ringan_swasta' => 'nullable|integer',
                'perpus_ukuran' => 'nullable|integer',
                'perpus_harga_bangunan' => 'nullable|numeric', 'perpus_harga_peralatan' => 'nullable|string', 'perpus_harga_meubelair' => 'nullable|string',
                // Laboratorium
                'lab_berat_negeri' => 'nullable|integer', 'lab_berat_swasta' => 'nullable|integer',
                'lab_sedang_negeri' => 'nullable|integer', 'lab_sedang_swasta' => 'nullable|integer',
                'lab_ringan_negeri' => 'nullable|integer', 'lab_ringan_swasta' => 'nullable|integer',
                'lab_ukuran' => 'nullable|integer',
                'lab_harga_bangunan' => 'nullable|numeric', 'lab_harga_peralatan' => 'nullable|string', 'lab_harga_meubelair' => 'nullable|string',
                // Lainnya
                'lainnya_berat_negeri' => 'nullable|integer', 'lainnya_berat_swasta' => 'nullable|integer',
                'lainnya_sedang_negeri' => 'nullable|integer', 'lainnya_sedang_swasta' => 'nullable|integer',
                'lainnya_ringan_negeri' => 'nullable|integer', 'lainnya_ringan_swasta' => 'nullable|integer',
                'lainnya_ukuran' => 'nullable|integer',
                'lainnya_harga_bangunan' => 'nullable|numeric', 'lainnya_harga_peralatan' => 'nullable|string', 'lainnya_harga_meubelair' => 'nullable|string',
                // Kerugian & info sekolah
                'biaya_tenaga_kerja_hok' => 'nullable|integer',
                'biaya_tenaga_kerja_upah' => 'nullable|numeric',
                'biaya_alat_berat_hari' => 'nullable|integer',
                'biaya_alat_berat_harga' => 'nullable|numeric',
                'sekolah_pengungsian' => 'nullable|integer',
                'guru_korban' => 'nullable|integer',
                'iuran_sekolah' => 'nullable|numeric',
                'jumlah_sekolah_sementara' => 'nullable|integer',
                'harga_sekolah_sementara' => 'nullable|numeric',
            ]);

            // Hitung total kerusakan (termasuk semua item yang dipindahkan dari kerugian)
            $bangunan = ['tk','sd','smp','sma','smk','pt','perpus','lab','lainnya'];
            $totalKerusakan = 0;
            
            // 1. Kerusakan bangunan pendidikan
            foreach ($bangunan as $b) {
                $totalKerusakan += (($validated[$b.'_berat_negeri'] ?? 0) + ($validated[$b.'_berat_swasta'] ?? 0)) * ($validated[$b.'_harga_bangunan'] ?? 0);
                $totalKerusakan += (($validated[$b.'_sedang_negeri'] ?? 0) + ($validated[$b.'_sedang_swasta'] ?? 0)) * ($validated[$b.'_harga_bangunan'] ?? 0);
                $totalKerusakan += (($validated[$b.'_ringan_negeri'] ?? 0) + ($validated[$b.'_ringan_swasta'] ?? 0)) * ($validated[$b.'_harga_bangunan'] ?? 0);
            }
            
            // 2. Biaya tenaga kerja dan alat berat (dipindahkan dari kerugian ke kerusakan)
            $totalKerusakan += ($validated['biaya_tenaga_kerja_hok'] ?? 0) * ($validated['biaya_tenaga_kerja_upah'] ?? 0);
            $totalKerusakan += ($validated['biaya_alat_berat_hari'] ?? 0) * ($validated['biaya_alat_berat_harga'] ?? 0);
            
            // 3. Biaya sekolah sementara (dipindahkan dari kerugian ke kerusakan)
            $totalKerusakan += ($validated['jumlah_sekolah_sementara'] ?? 0) * ($validated['harga_sekolah_sementara'] ?? 0);
            
            $validated['total_kerusakan'] = $totalKerusakan;

            // Hitung total kerugian (sekarang 0 karena semua dipindahkan ke kerusakan)
            $totalKerugian = 0;
            $validated['total_kerugian'] = $totalKerugian;

            $formulir->update($validated);
            DB::commit();
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Data berhasil diupdate',
                    'data' => $formulir
                ]);
            }
            return redirect()->route('forms.form4.format2.list', ['bencana_id' => $validated['bencana_id']])
                ->with('success', 'Data berhasil diupdate');
        } catch (\Exception $e) {
            DB::rollBack();
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Terjadi kesalahan: ' . $e->getMessage()
                ], 500);
            }
            return redirect()->back()->withInput()->withErrors(['error' => 'Terjadi kesalahan saat update data. ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage (Format 2)
     */
    public function destroy($id)
    {
        $formulir = $this->loadFormulir($id);

        $bencana_id = $formulir->laporan?->bencana_id;

        $formulir->items()->delete();

        $formulir->delete();

        return redirect()->route('format2.list', ['bencana_id' => $bencana_id])
            ->with('success', 'Data berhasil dihapus');
    }
}
