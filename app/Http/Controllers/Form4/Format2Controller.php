<?php

namespace App\Http\Controllers\Form4;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFormat2Request;
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


class Format2Controller extends Controller
{
    protected FormulirService $formulirService;

    public function __construct(FormulirService $formulirService)
    {
        $this->formulirService = $formulirService;
    }

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

    private function updateItem(
        $formulirId,
        $kategori,
        $subKategori = null,
        $jumlah = 0,
        $hargaSatuan = 0,
        $dimensi = null,
        $satuan = null,
        $kriteriaId = null,
        $tingkatKerusakan = null
    ) {
        FormulirItem::updateOrCreate(
            [
                'formulir_id' => $formulirId,
                'kategori' => $kategori,
                'sub_kategori' => $subKategori,
            ],
            [
                'jumlah' => $jumlah,
                'harga_satuan' => $hargaSatuan,
                'dimensi' => $dimensi,
                'satuan' => $satuan,
                'kriteria_id' => $kriteriaId,
                'tingkat_kerusakan' => $tingkatKerusakan,
            ]
        );
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
                    'user_id' => $request->user()->id,
                    'tanggal_lapor' => now()->toDateString(),
                    'status' => 'draft',
                    'total_kerusakan' => 0,
                    'total_kerugian' => 0,
                ]
            );

            $formulir = Formulir::firstOrCreate(
                [
                    'laporan_id' => $laporan->id,
                    'format_id'  => 3,
                ],
                [
                    'nama_kampung' => $request->nama_kampung,
                    'nama_distrik' => $request->nama_distrik,
                    'status'       => 'draft',
                ]
            );

            $validated = $request->validated();
            $details = $validated['details'];

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

            $request->merge([
                'details' => $details
            ]);

            $validated = $request->validated();
            $details = $validated['details'];

            foreach ($details as $detail) {
                $this->saveItem(
                    $formulir->id,
                    $detail['kategori'],
                    $detail['sub_kategori'] ?? null,
                    $detail['jumlah'],
                    $detail['harga_satuan'], // hargaSatuan
                    $detail['dimensi'] ?? null,
                    $detail['satuan'] ?? null, // satuan
                    $detail['kriteria_id'] ?? null, // kriteriaId (dari view, per-detail)
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

            DB::commit();

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Data berhasil disimpan',
                    'data' => $formulir
                ]);
            }
            return redirect()->route('forms.form4.format2.list', [
                'bencana_id' => $request->bencana_id
            ])->with('success', 'Data berhasil disimpan');
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
    public function show($id)
    {
        $formulir = $this->formulirService->loadFormulir($id);

        $bencana = $formulir->laporan->bencana;

        $this->formulirService->loadVillages($bencana);

        return view('forms.form4.format2.show-format2', [
            'formulir' => $formulir,
            'bencana'  => $formulir->laporan->bencana,
            'totals'   => $this->formulirService->computeTotals($formulir),
        ]);
    }

    /**
     * List all entries for this format (list-format2)
     */
    public function list(Request $request)
    {
        $bencana = Bencana::findOrFail($request->bencana_id);

        $reports = Formulir::with(['laporan.bencana', 'items'])
            ->where('format_id', 2)
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

        return view('forms.form4.format2.list', compact('bencana', 'reports'));
    }

    /**
     * Generate PDF for a specific form data (future)
     */
    public function previewPdf($id)
    {
        $formulir = $this->formulirService->loadFormulir($id);

        $bencana = $formulir->laporan->bencana;

        $this->formulirService->loadVillages($bencana);

        $pdf = Pdf::loadView('forms.form4.format2.pdf', [
            'formulir' => $formulir,
            'bencana'  => $formulir->laporan->bencana,
            'totals'   => $this->formulirService->computeTotals($formulir),
        ]);

        return $pdf->setPaper('A4', 'landscape')
            ->stream('Format2.pdf');
    }

    public function generatePdf($id)
    {
        $formulir = $this->formulirService->loadFormulir($id);

        $bencana = $formulir->laporan->bencana;

        $this->formulirService->loadVillages($bencana);

        $summary = $this->formulirService->getSummaries($bencana);

        $pdf = Pdf::loadView('forms.form4.format2.pdf', [
            'formulir' => $formulir,
            'bencana' => $formulir->laporan->bencana,
            'items' => $summary['rows'],
            'totals' => $summary['totals'],
        ]);

        $pdf->setPaper('A4', 'landscape');

        return $pdf->download("Format2_{$formulir->id}.pdf");
    }

    /**
     * Show the form for editing the specified resource (Format 2)
     */
    public function edit($id)
    {
        $formulir = $this->formulirService->loadFormulir($id);

        $bencana = $formulir->laporan->bencana;

        $summary = $this->formulirService->getSummaries($bencana);

        return view('forms.form4.format1.edit', [
            'formulir' => $formulir,
            'bencana' => $formulir->laporan->bencana,
            'rows' => $summary['rows'],
            'totals' => $summary['totals'],
        ]);
    }

    /**
     * Update the specified resource in storage (Format 2)
     */
    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();

            // Cari laporan berdasarkan bencana
            $laporan = LaporanBencana::where(
                'bencana_id',
                $request->bencana_id
            )->firstOrFail();

            // Cari formulir format 2
            $formulir = Formulir::where('laporan_id', $laporan->id)
                ->where('format_id', 2)
                ->firstOrFail();

            // Update data formulir
            $formulir->update([
                'nama_kampung' => $request->nama_kampung,
                'nama_distrik' => $request->nama_distrik,
            ]);

            $validated = $request->validated();
            $details = $validated['details'];

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

            $request->merge([
                'details' => $details
            ]);

            $validated = $request->validated();
            $details = $validated['details'];

            foreach ($details as $detail) {
                $this->updateItem(
                    $formulir->id,
                    $detail['kategori'],
                    $detail['sub_kategori'] ?? null,
                    $detail['jumlah'],
                    $detail['harga_satuan'],
                    $detail['dimensi'] ?? null,
                    $detail['satuan'] ?? null,
                    $detail['kriteria_id'] ?? null,
                    $detail['tingkat_kerusakan'] ?? null
                );
            }

            $this->updateItem(
                $formulir->id,
                'sekolah_pengungsian',
                'unit',
                $request->sekolah_pengungsian,
                0,
                null,
                'unit'
            );

            $this->updateItem(
                $formulir->id,
                'guru_korban',
                'orang',
                $request->guru_korban,
                0,
                null,
                'jiwa'
            );

            $this->updateItem(
                $formulir->id,
                'iuran_sekolah',
                'bulan',
                $request->iuran_sekolah,
                0,
                null,
                'rp'
            );

            DB::commit();

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Data berhasil diperbarui',
                    'data' => $formulir
                ]);
            }

            return redirect()->route('forms.form4.format2.list', [
                'bencana_id' => $request->bencana_id
            ])->with('success', 'Data berhasil diperbarui');
        } catch (\Throwable $e) {

            DB::rollBack();

            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data gagal diperbarui',
                    'error' => $e->getMessage()
                ], 500);
            }

            return back()
                ->withInput()
                ->with('error', 'Data gagal diperbarui: ' . $e->getMessage());
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
