<?php

namespace App\Http\Controllers\Form4;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFormat1Request;
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

class Format1Controller extends Controller
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

    public function index(Request $request)
    {
        $bencana_id = $request->input('bencana_id');

        // Redirect to bencana selection if no bencana_id is provided
        if (!$bencana_id) {
            return redirect()->route('bencana.index', ['source' => 'forms']);
        }

        // Get bencana details
        $bencana = Bencana::findOrFail($bencana_id);

        return view('forms.form4.format1.create', compact('bencana'));
    }

    public function store(StoreFormat1Request $request)
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
                    'format_id'  => 1,
                ],
                [
                    'nama_kampung' => $request->nama_kampung,
                    'nama_distrik' => $request->nama_distrik,
                    'status'       => 'draft',
                ]
            );

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
                    $detail['kriteria_id'], // kriteriaId (dari view, per-detail)
                    $detail['tingkat_kerusakan'] ?? null
                );
            }

            DB::commit();

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Data berhasil disimpan',
                    'data' => $formulir,
                ]);
            }

            return redirect()->route('forms.form4.format1.list', [
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

    public function show($id)
    {
        $formulir = $this->formulirService->loadFormulir($id);

        $bencana = $formulir->laporan->bencana;

        $this->formulirService->loadVillages($bencana);

        return view('forms.form4.format1.show-format1', [
            'formulir' => $formulir,
            'bencana'  => $formulir->laporan->bencana,
            'totals'   => $this->formulirService->computeTotals($formulir),
        ]);
    }

    public function list(Request $request) //format1
    {
        $bencana = Bencana::findOrFail($request->bencana_id);

        $reports = Formulir::with(['laporan.bencana', 'items'])
            ->where('format_id', 1)
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

        return view('forms.form4.format1.list-format1', compact('bencana', 'reports'));
    }

    public function previewPdf($id)
    {
        $formulir = $this->formulirService->loadFormulir($id);

        $bencana = $formulir->laporan->bencana;

        $this->formulirService->loadVillages($bencana);

        $pdf = Pdf::loadView('forms.form4.format1.pdf', [
            'formulir' => $formulir,
            'bencana'  => $formulir->laporan->bencana,
            'totals'   => $this->formulirService->computeTotals($formulir),
        ]);

        return $pdf->setPaper('A4', 'landscape')
            ->stream('Format1.pdf');
    }

    public function generatePdf($id)
    {
        $formulir = $this->formulirService->loadFormulir($id);

        $bencana = $formulir->laporan->bencana;

        $this->formulirService->loadVillages($bencana);

        $summary = $this->formulirService->getSummary($formulir);

        $pdf = Pdf::loadView('forms.form4.format1.pdf', [
            'formulir' => $formulir,
            'bencana' => $formulir->laporan->bencana,
            'items' => $summary['rows'],
            'totals' => $summary['totals'],
        ]);

        $pdf->setPaper('A4', 'landscape');

        return $pdf->download("Format1_{$formulir->id}.pdf");
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

    public function edit($id)
    {
        $formulir = $this->formulirService->loadFormulir($id);

        $summary = $this->formulirService->getSummary($formulir);

        return view('forms.form4.format1.edit', [
            'formulir' => $formulir,
            'bencana' => $formulir->laporan->bencana,
            'rows' => $summary['rows'],
            'totals' => $summary['totals'],
        ]);
    }
    public function update(StoreFormat1Request $request, $id)
    {
        DB::beginTransaction();

        try {
            $formulir = $this->formulirService->loadFormulir($id);

            // Update data formulir
            $formulir->update([
                'nama_kampung' => $request->nama_kampung,
                'nama_distrik' => $request->nama_distrik,
            ]);

            foreach ($request->details as $detail) {
                FormulirItem::where('id', $detail['id'])->update([
                    'nama_kampung' => $request->nama_kampung,
                    'nama_distrik' => $request->nama_distrik,
                    'kriteria_id' => $detail['kriteria_id'],
                    'kategori' => $detail['kategori'],
                    'sub_kategori' => $detail['sub_kategori'] ?? null,
                    'dimensi' => $detail['dimensi'] ?? null,
                    'tingkat_kerusakan' => $detail['tingkat_kerusakan'],
                    'jumlah' => $detail['jumlah'],
                    'harga_satuan' => $detail['harga_satuan'],
                    'satuan' => $detail['satuan'] ?? null,
                ]);
            }

            // Hitung ulang total
            $totals = $this->formulirService->computeTotals($formulir->fresh('items'));

            // Update laporan
            $formulir->laporan->update([
                'total_kerusakan' => $totals['total_kerusakan'],
                'total_kerugian' => $totals['total_kerugian'],
            ]);

            DB::commit();

            return redirect()
                ->route('forms.form4.format1.list', [
                    'bencana_id' => $formulir->laporan->bencana_id,
                ])
                ->with('success', 'Data berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();

            return back()
                ->withInput()
                ->withErrors([
                    'error' => $e->getMessage(),
                ]);
        }
    }
}
