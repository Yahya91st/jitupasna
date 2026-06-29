<?php

namespace App\Http\Controllers\Form4;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFormat1Request;
use App\Models\Bencana;
use App\Models\LaporanBencana;
use App\Models\Formulir;
use App\Models\FormulirItem;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Format1Controller extends Controller
{
    public function summary($bencanaId)
    {
        $laporan = LaporanBencana::where('bencana_id', $bencanaId)
            ->first();

        if (!$laporan) {
            return collect();
        }

        $formulir = Formulir::where([
            'laporan_id' => $laporan->id,
            'format_id' => 1,
        ])->first();

        if (!$formulir) {
            return collect();
        }

        return FormulirItem::where('formulir_id', $formulir->id)
            ->get();
    }
    private function loadFormulir(int $id): Formulir
    {
        return Formulir::with(['laporan.bencana', 'items'])->findOrFail($id);
    }

    private function computeTotals(Formulir $formulir, int $nomorInput): array
    {
        $totalKerusakan = 0;
        $totalKerugian = 0;

        foreach ($formulir->items->where('nomor_input', $nomorInput) as $item) {

            $subtotal =
                (float) ($item->jumlah ?? 0) *
                (float) ($item->harga_satuan ?? 0);

            if (in_array($item->kategori, [
                'rumah',
                'jalan',
                'saluran',
                'balai'
            ], true)) {

                $totalKerusakan += $subtotal;

            } else {

                $totalKerugian += $subtotal;
            }
        }

        return [
            'total_kerusakan' => $totalKerusakan,
            'total_kerugian' => $totalKerugian,
            'total_keseluruhan' => $totalKerusakan + $totalKerugian,
        ];
    }

    private function buildItemRows(Formulir $formulir, int $nomorInput): array
    {
        return $formulir->items
            ->where('nomor_input', $nomorInput)
            ->map(function (FormulirItem $item) {

                return [
                    'id' => $item->id,

                    'kategori' => $item->kategori,

                    'sub_kategori' => $item->sub_kategori,

                    'tingkat_kerusakan' => $item->tingkat_kerusakan,

                    'jumlah' => $item->jumlah,

                    'harga_satuan' => $item->harga_satuan,

                    'satuan' => $item->satuan,

                    'subtotal' =>
                        (float) ($item->jumlah ?? 0) *
                        (float) ($item->harga_satuan ?? 0),
                ];
            })
            ->values()
            ->all();
    }

    /**
     * Display Format 1 form for Housing sector data collection
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
        
        return view('forms.form4.format1.create', compact('bencana'));
    }

    /**
     * Store format1 form data for Housing sector
     */
    public function store(StoreFormat1Request $request)
    {        

        try {
            DB::beginTransaction();

            $laporan = LaporanBencana::firstOrCreate(
                [
                    'bencana_id' => $request->bencana_id,
                ],
                [
                    'user_id' => auth()->id(),
                    'tanggal_lapor' => now()->toDateString(),
                    'status' => 'draft',
                    'total_kerusakan' => 0,
                    'total_kerugian' => 0,
                ]
            );

            $formulir = Formulir::create(
                [
                    'laporan_id' => $laporan->id,
                    'format_id' => 1,
                ],
                [
                    'status' => 'draft',
                ]
            );            

            $details = $request->details;

            $nama_kampung = $request->nama_kampung;

            $nama_distrik = $request->nama_distrik;

            $validated = $request->validated();

            foreach ($details as $detail) {

                FormulirItem::create([
                    'formulir_id' => $formulir->id,
                    'nama_kampung' => $nama_kampung,
                    'nama_distrik' => $nama_distrik,

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

            DB::commit();
            // Return success response for AJAX or redirect for regular form
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Data berhasil disimpan',
                    'data' => $format1Form4
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

    /**
     * Show a specific form data
     */
    public function show($formulirId, $nomorInput)
    {
        
        $formulir = $this->loadFormulir($formulirId);

        $bencana = $formulir->laporan?->bencana;

        $items = $this->buildItemRows($formulir, $nomorInput);

        $totals = $this->computeTotals($formulir, $nomorInput);

        $reports = Formulir::with([
                'laporan.bencana',
                'items'
            ]);

        return view(
            'forms.form4.format1.show-format1',
            compact(
                'formulir',
                'bencana',
                'items',
                'totals',
                'nomorInput'
            )
        );
    }

    /**
     * List all entries for this format
     */
    public function list(Request $request)
    {
        $bencana_id = $request->input('bencana_id');

        if (!$bencana_id) {
            return redirect()->route('bencana.index', [
                'source' => 'forms'
            ]);
        }

        $bencana = Bencana::findOrFail($bencana_id);

        $reports = Formulir::with([
                'laporan.bencana',
                'items'
            ])
            ->where('format_id', 1)
            ->whereHas('laporan', function ($q) use ($bencana_id) {
                $q->where('bencana_id', $bencana_id);
            })
            ->latest()
            ->get();            

        return view(
            'forms.form4.format1.list-format1',
            compact('bencana', 'reports')
        );
    }

    /**
     * Generate PDF for a specific form data (Format1/Perumahan)
     *
     * @param  int  $id
     * @return mixed
     */
    public function generatePdf($id)
    {
        $formulir = $this->loadFormulir($id);
        $bencana = $formulir->laporan?->bencana;
        $items = $this->buildItemRows($formulir);
        $totals = $this->computeTotals($formulir);

        $pdf = Pdf::loadView('forms.form4.format1.pdf', compact('formulir', 'bencana', 'items', 'totals'));
        $pdf->setPaper('A4', 'landscape');
        return $pdf->download('Format1_Perumahan_' . $formulir->id . '.pdf');
    }

    /**
     * Preview PDF for a specific form data
     */
    public function previewPdf($formulirId, $nomorInput)
    {
        $formulir = $this->loadFormulir($formulirId);

        $bencana = $formulir->laporan?->bencana;

        $items = $this->buildItemRows($formulir, $nomorInput);

        $totals = $this->computeTotals($formulir, $nomorInput);

        $pdf = Pdf::loadView(
            'forms.form4.format1.pdf',
            compact('formulir', 'bencana', 'items', 'totals', 'nomorInput')
        );

        $pdf->setPaper('A4', 'landscape');

        return $pdf->stream('Format1_Perumahan.pdf');
    }

    /**
     * Delete a specific form data
     */
    public function destroy($id)
    {
        try {
            $formulir = $this->loadFormulir($id);
            $bencana_id = $formulir->laporan?->bencana_id;

            DB::beginTransaction();
            $formulir->items()->delete();
            $formulir->delete();
            DB::commit();
            
            // Return success response
            return redirect()->route('forms.form4.format1.list', ['bencana_id' => $bencana_id])
                           ->with('success', 'Data berhasil dihapus');
                           
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->withErrors(['error' => 'Terjadi kesalahan saat menghapus data: ' . $e->getMessage()]);
        }
    }

    /**
     * Show the form for editing a specific format1 data
     */
    public function edit($formulirId, $nomor_input)
    {
        try {

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

            $bencana = $formulir->laporan?->bencana;

            $items = $this->buildItemRows($formulir, $nomor_input);

            $totals = $this->computeTotals($formulir, $nomor_input);

            return view(
                'forms.form4.format1.edit',
                compact(
                    'formulir',
                    'bencana',
                    'items',
                    'totals',
                    'nomor_input',
                    'detailMap'
                )
            );

        } catch (\Exception $e) {

            return redirect()->back()
                ->withErrors([
                    'error' => 'Data tidak ditemukan: ' . $e->getMessage()
                ]);
        }
    }

    /**
     * Update the specified format1 data
     *
     * @param  Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();

            $formulir = $this->loadFormulir($id);
            $validated = $request->validate([
                'bencana_id' => 'required|exists:bencanas,id',
                'items' => 'required|array|min:1',
                'items.*.id' => 'required|exists:formulir_items,id',
                'items.*.jumlah' => 'nullable|numeric|min:0',
                'items.*.harga_satuan' => 'nullable|numeric|min:0',
            ]);

            $formulir->items()
            ->where('nomor_input', $nomor_input)
            ->delete();

            foreach ($validated['items'] as $detail) {
                FormulirItem::create([
                    'formulir_id' => $formulir->id,
                    'kriteria_id' => null,
                    'kategori' => $detail['kategori'] ?? 'rumah',
                    'sub_kategori' => $detail['sub_kategori'] ?? null,
                    'dimensi' => $detail['dimensi'] ?? null,
                    'tingkat_kerusakan' => $detail['tingkat_kerusakan'] ?? null,
                    'jumlah' => $detail['jumlah'] ?? 0,
                    'harga_satuan' => $detail['harga_satuan'] ?? 0,
                    'satuan' => $detail['satuan'] ?? null,
                ]);
            }

            $totals = $this->computeTotals($formulir->fresh(['items']));
            if ($formulir->laporan) {
                $formulir->laporan->update([
                    'bencana_id' => $validated['bencana_id'],
                    'total_kerusakan' => $totals['total_kerusakan'],
                    'total_kerugian' => $totals['total_kerugian'],
                ]);
            }

            DB::commit();

            return redirect()->route('forms.form4.list-format1', ['bencana_id' => $validated['bencana_id']])
                           ->with('success', 'Data berhasil disimpan');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Terjadi kesalahan saat memperbarui data: ' . $e->getMessage()]);
        }
    }
}
