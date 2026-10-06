<?php

namespace App\Http\Controllers\Form4;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFormat5Request;
use App\Models\Bencana;
use App\Models\Formulir;
use App\Models\FormulirItem;
use App\Models\LaporanBencana;
use App\Services\FormulirService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class Format5Controller extends Controller
{
    protected FormulirService $formulirService;

    public function __construct(FormulirService $formulirService)
    {
        $this->formulirService = $formulirService;
    }

    private function saveItem($formulirId, $kategori, $subKategori = null, $jumlah = null, $jumlah2 = null, $hargaSatuan = null, $dimensi = null, $satuan = null, $kriteriaId = null, $tingkatKerusakan = null, $durasi = null, $durasiSatuan = null)
    {
        FormulirItem::create([
            'formulir_id' => $formulirId,
            'kriteria_id' => $kriteriaId,
            'kategori' => $kategori,
            'sub_kategori' => $subKategori,
            'dimensi' => $dimensi,
            'tingkat_kerusakan' => $tingkatKerusakan,
            'jumlah' => $jumlah,
            'jumlah2' => $jumlah2,
            'harga_satuan' => $hargaSatuan,
            'satuan' => $satuan,
            'durasi' => $durasi,
            'durasi_satuan' => $durasiSatuan,
        ]);
    }

    private function updateItem($formulirId, $kategori, $subKategori = null, $jumlah = null, $jumlah2 = null, $hargaSatuan = null, $dimensi = null, $satuan = null, $kriteriaId = null, $tingkatKerusakan = null, $durasi = null, $durasiSatuan = null)
    {
        FormulirItem::updateOrCreate(
            [
                'formulir_id' => $formulirId,
                'kategori' => $kategori,
                'sub_kategori' => $subKategori,
                'tingkat_kerusakan' => $tingkatKerusakan,
            ],
            [
                'kriteria_id' => $kriteriaId,
                'dimensi' => $dimensi,
                'jumlah' => $jumlah,
                'jumlah2' => $jumlah2,
                'harga_satuan' => $hargaSatuan,
                'satuan' => $satuan,
                'durasi' => $durasi,
                'durasi_satuan' => $durasiSatuan,
            ]
        );
    }

    public function index(Request $request)
    {
        $bencana_id = $request->input('bencana_id');

        // Redirect to bencana selection if no bencana_id is provided
        if (!$bencana_id) {
            return redirect()->route('bencana.index', ['source' => 'forms']);
        }

        // Get bencana details
        $bencana = Bencana::findOrFail($bencana_id);

        return view('forms.form4.format5.create', compact('bencana'));
    }

    public function store(StoreFormat5Request $request)
    {
        try {
            DB::beginTransaction();
            $laporan = LaporanBencana::firstOrCreate(['bencana_id' => $request->bencana_id], [
                'user_id' => $request->user()->id,
                'tanggal_lapor' => now()->toDateString(),
                'status' => 'draft',
                'total_kerusakan' => 0,
                'total_kerugian' => 0,
            ]);
            $formulir = Formulir::create([
                'laporan_id' => $laporan->id,
                'format_id' => 5,
                'nama_kampung' => $request->nama_kampung,
                'nama_distrik' => $request->nama_distrik,
                'status' => 'draft',
            ]);
            $validated = $request->validated();
            $details = $validated['details'] ?? [];
            $dimensi = $request->input('dimensi', []);
            $hargaBangunan = $request->input('harga_bangunan', []);
            $hargaPeralatan = $request->input('harga_peralatan', []);
            foreach ($details as $detail) {
                $kategori = $detail['kategori'];
                $hargaSatuan = ($hargaBangunan[$kategori] ?? 0) + ($hargaPeralatan[$kategori] ?? 0);

                $this->saveItem(
                    $formulir->id,
                    $kategori,
                    $detail['sub_kategori'] ?? null,
                    $detail['jumlah'] ?? null,
                    $detail['jumlah2'] ?? null,
                    $hargaSatuan,
                    $dimensi[$kategori] ?? null,
                    $detail['satuan'] ?? null,
                    $detail['kriteria_id'] ?? null,
                    $detail['tingkat_kerusakan'] ?? null,
                    $detail['durasi'] ?? null,
                    $detail['durasi_satuan'] ?? null
                );
            }
            $this->saveItem(
                $formulir->id,
                'tenaga_kerja',
                null,
                $request->input('tenaga_kerja_jumlah'),
                null,
                $request->input('tenaga_kerja_harga'),
                null,
                'hok',
                null,
                null,
                null,
                null
            );

            $this->saveItem(
                $formulir->id,
                'alat_berat',
                null,
                $request->input('alat_berat_jumlah'),
                null,
                $request->input('alat_berat_harga'),
                null,
                'hari',
                null,
                null,
                null,
                null
            );

            DB::commit();
            if ($request->ajax()) return response()->json(['success' => true, 'message' => 'Data berhasil disimpan', 'data' => $formulir]);
            return redirect()->route('forms.form4.format5.list', ['bencana_id' => $request->bencana_id])->with('success', 'Data berhasil disimpan');
        } catch (\Throwable $e) {
            DB::rollBack();
            if ($request->ajax()) return response()->json(['success' => false, 'message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
            return back()->withInput()->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data. ' . $e->getMessage()]);
        }
    }

    public function show($id)
    {
        $formulir = $this->formulirService->loadFormulir($id);
        $bencana = $formulir->laporan->bencana;
        $this->formulirService->loadVillages($bencana);
        return view('forms.form4.format5.show', ['formulir' => $formulir, 'bencana' => $bencana, 'totals' => $this->formulirService->computeTotals($formulir)]);
    }

    public function list(Request $request)
    {
        $bencana = Bencana::findOrFail($request->bencana_id);

        $reports = Formulir::with(['laporan.bencana', 'items'])
            ->where('format_id', 5)
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

        return view('forms.form4.format5.list', compact('bencana', 'reports'));
    }

    private function pdfResponse($id)
    {
        $formulir = $this->formulirService->loadFormulir($id);
        $bencana = $formulir->laporan->bencana;
        $this->formulirService->loadVillages($bencana);
        return Pdf::loadView('forms.form4.format5.pdf', ['formulir' => $formulir, 'bencana' => $bencana, 'totals' => $this->formulirService->computeTotals($formulir)]);
    }

    public function previewPdf($id)
    {
        return $this->pdfResponse($id)->setPaper('A4', 'landscape')->stream('Format5.pdf');
    }
    public function generatePdf($id)
    {
        return $this->pdfResponse($id)->download("Format5_{$id}.pdf");
    }

    public function edit($id)
    {
        $formulir = $this->formulirService->loadFormulir($id);
        $summary = $this->formulirService->getSummary($formulir);
        return view('forms.form4.format5.edit', ['formulir' => $formulir, 'bencana' => $formulir->laporan->bencana, 'rows' => $summary['rows'], 'totals' => $summary['totals']]);
    }

    public function update(StoreFormat5Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $laporan = LaporanBencana::where('bencana_id', $request->bencana_id)->firstOrFail();
            $formulir = Formulir::where('laporan_id', $laporan->id)->where('format_id', 5)->firstOrFail();
            $formulir->update(['nama_kampung' => $request->nama_kampung, 'nama_distrik' => $request->nama_distrik]);
            $validated = $request->validated();
            $details = $validated['details'] ?? [];
            $dimensi = $request->input('dimensi', []);
            $hargaBangunan = $request->input('harga_bangunan', []);
            $hargaPeralatan = $request->input('harga_peralatan', []);
            foreach ($details as $detail) {
                $kategori = $detail['kategori'];
                $hargaSatuan = ($hargaBangunan[$kategori] ?? 0) + ($hargaPeralatan[$kategori] ?? 0);
                $this->updateItem($formulir->id, $kategori, $detail['sub_kategori'] ?? null, $detail['jumlah'] ?? null, $detail['jumlah2'] ?? null, $hargaSatuan, $dimensi[$kategori] ?? null, $detail['satuan'] ?? null, $detail['kriteria_id'] ?? null, $detail['tingkat_kerusakan'] ?? null, $detail['durasi'] ?? null, $detail['durasi_satuan'] ?? null);
            }
            $this->updateItem($formulir->id, 'tenaga_kerja', null, $request->input('tenaga_kerja_jumlah'), null, $request->input('tenaga_kerja_harga'), null, 'hok', null, null, null, null);
            $this->updateItem($formulir->id, 'alat_berat', null, $request->input('alat_berat_jumlah'), null, $request->input('alat_berat_harga'), null, 'hari', null, null, null, null);
            DB::commit();
            if ($request->ajax()) return response()->json(['success' => true, 'message' => 'Data berhasil diperbarui', 'data' => $formulir]);
            return redirect()->route('forms.form4.format5.list', ['bencana_id' => $request->bencana_id])->with('success', 'Data berhasil diperbarui');
        } catch (\Throwable $e) {
            DB::rollBack();
            if ($request->ajax()) return response()->json(['success' => false, 'message' => 'Data gagal diperbarui', 'error' => $e->getMessage()], 500);
            return back()->withInput()->with('error', 'Data gagal diperbarui: ' . $e->getMessage());
        }
    }

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
