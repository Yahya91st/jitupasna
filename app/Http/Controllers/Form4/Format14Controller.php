<?php

namespace App\Http\Controllers\Form4;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFormat14Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Bencana;
use App\Models\LaporanBencana;
use App\Models\Formulir;
use App\Models\FormulirItem;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Services\FormulirService;

class Format14Controller extends Controller
{
    protected FormulirService $formulirService;

    public function __construct(FormulirService $formulirService)
    {
        $this->formulirService = $formulirService;
    }

    private function updateItem(
        $formulirId,
        $kategori,
        $subKategori = null,
        $jumlah = null,
        $jumlah2 = null,
        $hargaSatuan = null,
        $dimensi = null,
        $satuan = null,
        $kriteriaId = null,
        $tingkatKerusakan = null,
        $durasi = null,
        $durasiSatuan = null
    ) {
        FormulirItem::updateOrCreate(
            [
                'formulir_id' => $formulirId,
                'kategori' => $kategori,
                'sub_kategori' => $subKategori,
            ],
            [
                'jumlah' => $jumlah,
                'jumlah2' => $jumlah2,
                'harga_satuan' => $hargaSatuan,
                'dimensi' => $dimensi,
                'satuan' => $satuan,
                'kriteria_id' => $kriteriaId,
                'tingkat_kerusakan' => $tingkatKerusakan,
                'durasi' => $durasi,
                'durasi_satuan' => $durasiSatuan,
            ]
        );
    }

    private function saveItem(
        $formulirId,
        $kategori,
        $subKategori = null,
        $jumlah = null,
        $jumlah2 = null,
        $hargaSatuan = null,
        $dimensi = null,
        $satuan = null,
        $kriteriaId = null,
        $tingkatKerusakan = null,
        $durasi = null,
        $durasiSatuan = null
    ) {
        FormulirItem::create([
            'formulir_id' => $formulirId,
            'kriteria_id' => $kriteriaId,

            'kategori' => $kategori,
            'sub_kategori' => $subKategori,

            'dimensi' => $dimensi,
            'tingkat_kerusakan' => $tingkatKerusakan ?? null,

            'jumlah' => $jumlah,
            'jumlah2' => $jumlah2,

            'harga_satuan' => $hargaSatuan,

            'satuan' => $satuan,

            'durasi' => $durasi,
            'durasi_satuan' => $durasiSatuan,
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

        return view('forms.form4.format14.create', compact('bencana'));
    }

    private function hitungOperasional($op, $durasi)
    {
        return ($op['jumlah2'] - $op['jumlah']) * $durasi;
    }
    private function hitungPendapatan($pp, $durasi)
    {
        return ($pp['jumlah'] - $pp['jumlah2']) * $pp['harga_satuan'] * $durasi;
    }

    /**
     * Store format14 form data for Education sector
     */
    public function store(StoreFormat14Request $request)
    {

        try {
            DB::beginTransaction();

            $laporan = LaporanBencana::firstOrCreate(
                [
                    'bencana_id' => $request->bencana_id,
                ],
                [
                    'user_id' => $request->user()->id,
                    'tanggal_lapor' => now()->toDateString(),
                    'status' => 'draft',
                    'total_kerusakan' => 0,
                    'total_kerugian' => 0,
                ]
            );

            $formulir = Formulir::create([
                'laporan_id' => $laporan->id,
                'format_id' => 14,
                'nama_kampung' => $request->nama_kampung,
                'nama_distrik' => $request->nama_distrik,
                'status' => 'draft',
            ]);

            $validated = $request->validated();

            foreach ($request->details as $item) {

                $this->saveItem(
                    $formulir->id,
                    $item['kategori'] ?? null,
                    $item['sub_kategori'] ?? null,
                    $item['jumlah'] ?? null,
                    $item['jumlah2'] ?? null,
                    $item['harga_satuan'] ?? null,
                    null,
                    $item['satuan'] ?? null,
                    null,
                    $item['tingkat_kerusakan'] ?? null,
                    $item['durasi'] ?? null,
                    $item['durasi_satuan'] ?? null,
                );
            }

            DB::commit();
            // Return success response for AJAX or redirect for regular form
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Data berhasil disimpan',
                    'data' => $formulir
                ]);
            }
            return redirect()->route('forms.form4.format14.list')
                ->with('success', 'Data berhasil disimpan');
        } catch (\Throwable $e) {
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
    public function show($id)
    {
        $formulir = $this->formulirService->loadFormulir($id);

        $bencana = $formulir->laporan->bencana;

        $this->formulirService->loadVillages($bencana);

        return view('forms.form4.format14.show', [
            'formulir' => $formulir,
            'bencana'  => $formulir->laporan->bencana,
            'totals'   => $this->formulirService->computeTotals($formulir),
        ]);
    }

    public function list(Request $request)
    {
        $bencana = Bencana::findOrFail($request->bencana_id);

        $reports = Formulir::with(['laporan.bencana', 'items'])
            ->where('format_id', 14)
            ->whereHas('laporan', function ($q) use ($bencana) {
                $q->where('bencana_id', $bencana->id);
            })
            ->latest()
            ->get();

        $reports->each(function ($report) {
            $bencana = $report->laporan->bencana;

            $codes = is_array($bencana->village_codes) ? $bencana->village_codes : json_decode($bencana->village_codes, true);

            $bencana->villages = collect($codes)
                ->map(function ($code) {
                    $code = trim($code);

                    return Cache::remember("village_name_{$code}", 86400, function () use ($code) {
                        $parts = explode('.', $code);
                        $districtCode = implode('.', array_slice($parts, 0, 3));

                        $response = Http::get("https://wilayah.id/api/villages/{$districtCode}.json");

                        if (!$response->ok()) {
                            return [
                                'code' => $code,
                                'name' => null,
                            ];
                        }

                        $village = collect($response->json('data'))->firstWhere('code', $code);

                        return [
                            'code' => $code,
                            'name' => $village['name'] ?? null,
                        ];
                    });
                })
                ->toArray();
        });

        return view('forms.form4.format14.list', compact('bencana', 'reports'));
    }

    public function previewPdf($id)
    {
        $formulir = $this->formulirService->loadFormulir($id);

        $bencana = $formulir->laporan->bencana;

        $this->formulirService->loadVillages($bencana);

        $pdf = Pdf::loadView('forms.form4.format14.pdf', [
            'formulir' => $formulir,
            'bencana'  => $formulir->laporan->bencana,
            'totals'   => $this->formulirService->computeTotals($formulir),
        ]);

        return $pdf->setPaper('A4', 'landscape')
            ->stream('Format14.pdf');
    }

    public function generatePdf($id)
    {
        $formulir = $this->formulirService->loadFormulir($id);

        $bencana = $formulir->laporan->bencana;

        $this->formulirService->loadVillages($bencana);

        $pdf = Pdf::loadView('forms.form4.format14.pdf', [
            'formulir' => $formulir,
            'bencana'  => $formulir->laporan->bencana,
            'totals'   => $this->formulirService->computeTotals($formulir),
        ]);

        return $pdf->download("Format14_{$formulir->id}.pdf");
    }

    public function edit($id)
    {
        $formulir = $this->formulirService->loadFormulir($id);

        $summary = $this->formulirService->getSummary($formulir);

        return view('forms.form4.format14.edit', [
            'formulir' => $formulir,
            'bencana' => $formulir->laporan->bencana,
            'rows' => $summary['rows'],
            'totals' => $summary['totals'],
        ]);
    }

    /**
     * Update the specified resource in storage (Format 2)
     */
    public function update(StoreFormat14Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $laporan = LaporanBencana::where('bencana_id', $request->bencana_id)->firstOrFail();
            $formPendidikan = Formulir::where('laporan_id', $laporan->id)
                ->where('format_id', 14)
                ->firstOrFail();
            $validated = $request->validated(); /*
                'bencana_id' => 'required|exists:bencana,id',
                'nama_kampung' => 'required|string',
                'nama_distrik' => 'required|string',
                // TK/RA
                'tk_berat_negeri' => 'nullable|integer',
                'tk_berat_swasta' => 'nullable|integer',
                'tk_sedang_negeri' => 'nullable|integer',
                'tk_sedang_swasta' => 'nullable|integer',
                'tk_ringan_negeri' => 'nullable|integer',
                'tk_ringan_swasta' => 'nullable|integer',
                'tk_ukuran' => 'nullable|integer',
                'tk_harga_bangunan' => 'nullable|numeric',
                'tk_harga_peralatan' => 'nullable|string',
                'tk_harga_meubelair' => 'nullable|string',
                // SD/MI
                'sd_berat_negeri' => 'nullable|integer',
                'sd_berat_swasta' => 'nullable|integer',
                'sd_sedang_negeri' => 'nullable|integer',
                'sd_sedang_swasta' => 'nullable|integer',
                'sd_ringan_negeri' => 'nullable|integer',
                'sd_ringan_swasta' => 'nullable|integer',
                'sd_ukuran' => 'nullable|integer',
                'sd_harga_bangunan' => 'nullable|numeric',
                'sd_harga_peralatan' => 'nullable|string',
                'sd_harga_meubelair' => 'nullable|string',
                // SMP/MTS
                'smp_berat_negeri' => 'nullable|integer',
                'smp_berat_swasta' => 'nullable|integer',
                'smp_sedang_negeri' => 'nullable|integer',
                'smp_sedang_swasta' => 'nullable|integer',
                'smp_ringan_negeri' => 'nullable|integer',
                'smp_ringan_swasta' => 'nullable|integer',
                'smp_ukuran' => 'nullable|integer',
                'smp_harga_bangunan' => 'nullable|numeric',
                'smp_harga_peralatan' => 'nullable|string',
                'smp_harga_meubelair' => 'nullable|string',
                // SMA/MA
                'sma_berat_negeri' => 'nullable|integer',
                'sma_berat_swasta' => 'nullable|integer',
                'sma_sedang_negeri' => 'nullable|integer',
                'sma_sedang_swasta' => 'nullable|integer',
                'sma_ringan_negeri' => 'nullable|integer',
                'sma_ringan_swasta' => 'nullable|integer',
                'sma_ukuran' => 'nullable|integer',
                'sma_harga_bangunan' => 'nullable|numeric',
                'sma_harga_peralatan' => 'nullable|string',
                'sma_harga_meubelair' => 'nullable|string',
                // SMK
                'smk_berat_negeri' => 'nullable|integer',
                'smk_berat_swasta' => 'nullable|integer',
                'smk_sedang_negeri' => 'nullable|integer',
                'smk_sedang_swasta' => 'nullable|integer',
                'smk_ringan_negeri' => 'nullable|integer',
                'smk_ringan_swasta' => 'nullable|integer',
                'smk_ukuran' => 'nullable|integer',
                'smk_harga_bangunan' => 'nullable|numeric',
                'smk_harga_peralatan' => 'nullable|string',
                'smk_harga_meubelair' => 'nullable|string',
                // Perguruan Tinggi
                'pt_berat_negeri' => 'nullable|integer',
                'pt_berat_swasta' => 'nullable|integer',
                'pt_sedang_negeri' => 'nullable|integer',
                'pt_sedang_swasta' => 'nullable|integer',
                'pt_ringan_negeri' => 'nullable|integer',
                'pt_ringan_swasta' => 'nullable|integer',
                'pt_ukuran' => 'nullable|integer',
                'pt_harga_bangunan' => 'nullable|numeric',
                'pt_harga_peralatan' => 'nullable|string',
                'pt_harga_meubelair' => 'nullable|string',
                // Perpustakaan
                'perpus_berat_negeri' => 'nullable|integer',
                'perpus_berat_swasta' => 'nullable|integer',
                'perpus_sedang_negeri' => 'nullable|integer',
                'perpus_sedang_swasta' => 'nullable|integer',
                'perpus_ringan_negeri' => 'nullable|integer',
                'perpus_ringan_swasta' => 'nullable|integer',
                'perpus_ukuran' => 'nullable|integer',
                'perpus_harga_bangunan' => 'nullable|numeric',
                'perpus_harga_peralatan' => 'nullable|string',
                'perpus_harga_meubelair' => 'nullable|string',
                // Laboratorium
                'lab_berat_negeri' => 'nullable|integer',
                'lab_berat_swasta' => 'nullable|integer',
                'lab_sedang_negeri' => 'nullable|integer',
                'lab_sedang_swasta' => 'nullable|integer',
                'lab_ringan_negeri' => 'nullable|integer',
                'lab_ringan_swasta' => 'nullable|integer',
                'lab_ukuran' => 'nullable|integer',
                'lab_harga_bangunan' => 'nullable|numeric',
                'lab_harga_peralatan' => 'nullable|string',
                'lab_harga_meubelair' => 'nullable|string',
                // Lainnya
                'lainnya_berat_negeri' => 'nullable|integer',
                'lainnya_berat_swasta' => 'nullable|integer',
                'lainnya_sedang_negeri' => 'nullable|integer',
                'lainnya_sedang_swasta' => 'nullable|integer',
                'lainnya_ringan_negeri' => 'nullable|integer',
                'lainnya_ringan_swasta' => 'nullable|integer',
                'lainnya_ukuran' => 'nullable|integer',
                'lainnya_harga_bangunan' => 'nullable|numeric',
                'lainnya_harga_peralatan' => 'nullable|string',
                'lainnya_harga_meubelair' => 'nullable|string',
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
            ]); */

            // Hitung total kerusakan (termasuk semua item yang dipindahkan dari kerugian)
            $bangunan = ['tk', 'sd', 'smp', 'sma', 'smk', 'pt', 'perpus', 'lab', 'lainnya'];
            $totalKerusakan = 0;

            // 1. Kerusakan bangunan pendidikan
            foreach ($bangunan as $b) {
                $totalKerusakan += (($validated[$b . '_berat_negeri'] ?? 0) + ($validated[$b . '_berat_swasta'] ?? 0)) * ($validated[$b . '_harga_bangunan'] ?? 0);
                $totalKerusakan += (($validated[$b . '_sedang_negeri'] ?? 0) + ($validated[$b . '_sedang_swasta'] ?? 0)) * ($validated[$b . '_harga_bangunan'] ?? 0);
                $totalKerusakan += (($validated[$b . '_ringan_negeri'] ?? 0) + ($validated[$b . '_ringan_swasta'] ?? 0)) * ($validated[$b . '_harga_bangunan'] ?? 0);
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

            $formPendidikan->update([
                'nama_kampung' => $request->nama_kampung,
                'nama_distrik' => $request->nama_distrik,
            ]);
            foreach ($validated['details'] ?? [] as $detail) {
                $this->updateItem($formPendidikan->id, $detail['kategori'] ?? null, $detail['sub_kategori'] ?? null, $detail['jumlah'] ?? null, $detail['jumlah2'] ?? null, $detail['harga_satuan'] ?? null, $detail['dimensi'] ?? null, $detail['satuan'] ?? null, $detail['kriteria_id'] ?? null, $detail['tingkat_kerusakan'] ?? null, $detail['durasi'] ?? null, $detail['durasi_satuan'] ?? null);
            }
            DB::commit();
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Data berhasil diupdate',
                    'data' => $formPendidikan
                ]);
            }
            return redirect()->route('format2.list', ['bencana_id' => $validated['bencana_id']])
                ->with('success', 'Data berhasil diupdate');
        } catch (\Throwable $e) {
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
        DB::transaction(function () use ($id) {
            $formulir = $this->formulirService->loadFormulir($id);

            $formulir->items()->delete();

            $formulir->delete();
        });

        return back()->with('success', 'Data berhasil dihapus.');
    }
}
