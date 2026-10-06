<?php

namespace App\Http\Controllers\Form4;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFormat7Request;
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

class Format7Controller extends Controller
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

            'tingkat_kerusakan' => $tingkatKerusakan,

            'jumlah' => $jumlah,
            'jumlah2' => $jumlah2,
            'harga_satuan' => $hargaSatuan,

            'satuan' => $satuan,
            'durasi' => $durasi,
            'durasi_satuan' => $durasiSatuan,
        ]);
    }
    /**
     * Display Format form for Health sector data collection
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

        return view('forms.form4.format7.create', compact('bencana'));
    }

    /**
     * Store format3 form data for Health sector
     */
    public function store(StoreFormat7Request $request)
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
                'format_id' => 7,
                'nama_kampung' => $request->nama_kampung,
                'nama_distrik' => $request->nama_distrik,
                'status' => 'draft',
            ]);

            $details = $request->details;

            // // dd($hargaMaster);
            // $biayaKategori = [
            //     'kehilangan_pendapatan_pdam',
            //     'biaya_pemurnian',
            //     'dasar_perhitungan_biaya_pemurnian',
            //     'biaya_pemurnian',
            //     'kehilangan_pendapatan_pdam',
            //     'biaya_pemurnian',
            // ];

            // foreach ($details as $i => $detail) {

            //     $kategori = $detail['kategori'];

            //     if (!in_array($kategori, $biayaKategori)) {
            //         $details[$i]['harga_satuan'] =
            //             $hargaMaster[$kategori] ?? 0;
            //     }
            // }

            // $request->merge([
            //     'details' => $details
            // ]);       

            $validated = $request->validated();

            foreach ($request->infrastruktur as $item) {

                foreach (['berat', 'sedang', 'ringan'] as $tingkat) {

                    if (empty($item[$tingkat])) {
                        continue;
                    }

                    $this->saveItem(
                        $formulir->id,
                        $item['kategori'],
                        $item['nama'],
                        $item[$tingkat],
                        null,
                        $item['harga_satuan'] ?? 0,
                        null,
                        $item['satuan'] ?? null,
                        null,
                        $tingkat,
                        null,
                        null
                    );
                }
            }

            foreach ($details as $detail) {

                $this->saveItem(
                    $formulir->id,
                    $detail['kategori'],
                    $detail['sub_kategori'] ?? null,
                    $detail['jumlah'] ?? 0,
                    $detail['jumlah2'] ?? null,
                    $detail['harga_satuan'] ?? null,
                    $detail['dimensi'] ?? null,
                    $detail['satuan'] ?? null,
                    $detail['kriteria_id'] ?? null,
                    $detail['tingkat_kerusakan'] ?? null,
                    $detail['durasi'] ?? null,
                    $detail['durasi_satuan'] ?? null
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
            return redirect()->route('forms.form4.format7.list')
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

        return view('forms.form4.format7.show', [
            'formulir' => $formulir,
            'bencana'  => $formulir->laporan->bencana,
            'totals'   => $this->formulirService->computeTotals($formulir),
        ]);
    }

    /**
     * List all entries for this format
     */
    public function list(Request $request)
    {
        $bencana = Bencana::findOrFail($request->bencana_id);

        $reports = Formulir::with(['laporan.bencana', 'items'])
            ->where('format_id', 7)
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

        return view('forms.form4.format7.list', compact('bencana', 'reports'));
    }

    public function previewPdf($id)
    {
        $formulir = $this->formulirService->loadFormulir($id);

        $bencana = $formulir->laporan->bencana;

        $this->formulirService->loadVillages($bencana);

        $pdf = Pdf::loadView('forms.form4.format7.pdf', [
            'formulir' => $formulir,
            'bencana'  => $formulir->laporan->bencana,
            'totals'   => $this->formulirService->computeTotals($formulir),
        ]);

        return $pdf->setPaper('A4', 'landscape')
            ->stream('Format7.pdf');
    }

    public function generatePdf($id)
    {
        $formulir = $this->formulirService->loadFormulir($id);

        $bencana = $formulir->laporan->bencana;

        $this->formulirService->loadVillages($bencana);

        $pdf = Pdf::loadView('forms.form4.format7.pdf', [
            'formulir' => $formulir,
            'bencana'  => $formulir->laporan->bencana,
            'totals'   => $this->formulirService->computeTotals($formulir),
        ]);

        return $pdf->download("Format7_{$formulir->id}.pdf");
    }

    public function edit($id)
    {
        $formulir = $this->formulirService->loadFormulir($id);

        $summary = $this->formulirService->getSummary($formulir);

        return view('forms.form4.format7.edit', [
            'formulir' => $formulir,
            'bencana' => $formulir->laporan->bencana,
            'rows' => $summary['rows'],
            'totals' => $summary['totals'],
        ]);
    }

    /**
     * Update the specified format7 data
     *
     * @param  Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(StoreFormat7Request $request, $id)
    {
        try {
            DB::beginTransaction();

            // Find the existing record
            $laporan = LaporanBencana::where('bencana_id', $request->bencana_id)->firstOrFail();
            $formulir = Formulir::where('laporan_id', $laporan->id)
                ->where('format_id', 7)
                ->firstOrFail();
            // Validate the request
            $validated = $request->validated(); /*

                'bencana_id' => 'required|exists:bencana,id',
                'nama_kampung' => 'required|string',
                'nama_distrik' => 'required|string',
                // Validasi untuk field harga yang diubah ke string

                'rs_rb_negeri' => 'nullable|integer',
                'rs_rb_swasta' => 'nullable|integer',
                'rs_rs_negeri' => 'nullable|integer',
                'rs_rs_swasta' => 'nullable|integer',
                'rs_rr_negeri' => 'nullable|integer',
                'rs_rr_swasta' => 'nullable|integer',

                'rs_luas' => 'nullable|integer',
                'rs_harga_bangunan' => 'nullable|integer',
                'rs_harga_obat' => 'nullable|integer',
                'rs_harga_meubelair' => 'nullable|integer',
                'rs_harga_peralatan' => 'nullable|integer',


                'puskesmas_rb_negeri' => 'nullable|integer',
                'puskesmas_rb_swasta' => 'nullable|integer',
                'puskesmas_rs_negeri' => 'nullable|integer',
                'puskesmas_rs_swasta' => 'nullable|integer',
                'puskesmas_rr_negeri' => 'nullable|integer',
                'puskesmas_rr_swasta' => 'nullable|integer',
                'puskesmas_luas' => 'nullable|integer',
                'puskesmas_harga_bangunan' => 'nullable|integer',
                'puskesmas_harga_obat' => 'nullable|integer',
                'puskesmas_harga_meubelair' => 'nullable|integer',
                'puskesmas_harga_peralatan' => 'nullable|integer',

                'poliklinik_rb_negeri' => 'nullable|integer',
                'poliklinik_rb_swasta' => 'nullable|integer',
                'poliklinik_rs_negeri' => 'nullable|integer',
                'poliklinik_rs_swasta' => 'nullable|integer',
                'poliklinik_rr_negeri' => 'nullable|integer',
                'poliklinik_rr_swasta' => 'nullable|integer',
                'poliklinik_luas' => 'nullable|integer',
                'poliklinik_harga_bangunan' => 'nullable|integer',
                'poliklinik_harga_obat' => 'nullable|integer',
                'poliklinik_harga_meubelair' => 'nullable|integer',
                'poliklinik_harga_peralatan' => 'nullable|integer',

                'pustu_rb_negeri' => 'nullable|integer',
                'pustu_rb_swasta' => 'nullable|integer',
                'pustu_rs_negeri' => 'nullable|integer',
                'pustu_rs_swasta' => 'nullable|integer',
                'pustu_rr_negeri' => 'nullable|integer',
                'pustu_rr_swasta' => 'nullable|integer',
                'pustu_luas' => 'nullable|integer',
                'pustu_harga_bangunan' => 'nullable|integer',
                'pustu_harga_obat' => 'nullable|integer',
                'pustu_harga_meubelair' => 'nullable|integer',
                'pustu_harga_peralatan' => 'nullable|integer',

                'polindes_rb_negeri' => 'nullable|integer',
                'polindes_rb_swasta' => 'nullable|integer',
                'polindes_rs_negeri' => 'nullable|integer',
                'polindes_rs_swasta' => 'nullable|integer',
                'polindes_rr_negeri' => 'nullable|integer',
                'polindes_rr_swasta' => 'nullable|integer',
                'polindes_luas' => 'nullable|integer',
                'polindes_harga_bangunan' => 'nullable|integer',
                'polindes_harga_obat' => 'nullable|integer',
                'polindes_harga_meubelair' => 'nullable|integer',
                'polindes_harga_peralatan' => 'nullable|integer',

                'posyandu_rb_negeri' => 'nullable|integer',
                'posyandu_rb_swasta' => 'nullable|integer',
                'posyandu_rs_negeri' => 'nullable|integer',
                'posyandu_rs_swasta' => 'nullable|integer',
                'posyandu_rr_negeri' => 'nullable|integer',
                'posyandu_rr_swasta' => 'nullable|integer',
                'posyandu_luas' => 'nullable|integer',
                'posyandu_harga_bangunan' => 'nullable|integer',
                'posyandu_harga_obat' => 'nullable|integer',
                'posyandu_harga_meubelair' => 'nullable|integer',
                'posyandu_harga_peralatan' => 'nullable|integer',
            ]); */

            // baru: hitung kerusakan untuk setiap fasilitas secara dinamis menggunakan field yang tersedia
            $faskes = ['rs', 'puskesmas', 'poliklinik', 'pustu', 'polindes', 'posyandu'];
            $weights = [
                'rb' => 1.0,   // rusak berat = 100%
                'rs' => 0.75,  // rusak sedang = 75%
                'rr' => 0.5,   // rusak ringan = 50%
            ];

            $total_kerusakan = 0;

            foreach ($faskes as $f) {
                $priceField = "{$f}_harga_bangunan";
                $price = floatval($validated[$priceField] ?? 0);

                foreach ($weights as $suffix => $weight) {
                    $negeriField = "{$f}_{$suffix}_negeri";
                    $swastaField = "{$f}_{$suffix}_swasta";
                    $count = intval($validated[$negeriField] ?? 0) + intval($validated[$swastaField] ?? 0);
                    $total_kerusakan += $count * $price * $weight;
                }
            }

            // Tambahan item yang dipindahkan dari kerugian ke kerusakan
            $total_kerusakan += (floatval($validated['biaya_tenaga_kerja_hok'] ?? 0) * floatval($validated['biaya_tenaga_kerja_upah'] ?? 0));
            $total_kerusakan += (floatval($validated['biaya_alat_berat_hari'] ?? 0) * floatval($validated['biaya_alat_berat_harga'] ?? 0));
            $total_kerusakan += (intval($validated['jumlah_jenazah'] ?? 0) * floatval($validated['biaya_per_jenazah'] ?? 0));
            $total_kerusakan += (intval($validated['jumlah_pasien'] ?? 0) * floatval($validated['biaya_per_pasien'] ?? 0));
            $total_kerusakan += (intval($validated['jumlah_faskes'] ?? 0) * floatval($validated['biaya_pengadaan_faskes'] ?? 0));
            $total_kerusakan += (intval($validated['jumlah_korban_psikologis'] ?? 0) * floatval($validated['biaya_penanganan_psikologis'] ?? 0));
            $total_kerusakan += floatval($validated['biaya_pencegahan_penyakit'] ?? 0);
            $total_kerusakan += (intval($validated['jumlah_tenaga_kesehatan'] ?? 0) * floatval($validated['honorarium_tenaga_kesehatan'] ?? 0));
            $total_kerusakan += floatval($validated['pendapatan_faskes_swasta'] ?? 0);

            // simpan total ke array validasi
            $validated['total_kerusakan'] = $total_kerusakan;
            // semua kerugian dipindah => total kerugian 0
            $validated['total_kerugian'] = 0;

            // Update the record (pastikan variabel model sama seperti yang ditemukan sebelumnya)
            $formulir = Formulir::where('laporan_id', $laporan->id)
                ->where('format_id', 7)
                ->firstOrFail();
            $formulir->update([
                'nama_kampung' => $request->nama_kampung,
                'nama_distrik' => $request->nama_distrik,
            ]);
            foreach ($validated['details'] ?? [] as $detail) {
                $this->updateItem($formulir->id, $detail['kategori'] ?? null, $detail['sub_kategori'] ?? null, $detail['jumlah'] ?? null, $detail['jumlah2'] ?? null, $detail['harga_satuan'] ?? null, $detail['dimensi'] ?? null, $detail['satuan'] ?? null, $detail['kriteria_id'] ?? null, $detail['tingkat_kerusakan'] ?? null, $detail['durasi'] ?? null, $detail['durasi_satuan'] ?? null);
            }

            DB::commit();

            return redirect()->route('forms.form4.format7.list', ['bencana_id' => $request->bencana_id])
                ->with('success', 'Data berhasil disimpan');
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Terjadi kesalahan saat memperbarui data: ' . $e->getMessage()]);
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
