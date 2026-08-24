<?php

namespace App\Http\Controllers;

use App\Models\Bencana;
use App\Models\LaporanBencana;
use App\Models\Formulir;
use App\Models\Kajian;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Services\FormulirService;
use Log;

class KajianController extends Controller
{
    protected FormulirService $formulirService;

    public function __construct(FormulirService $formulirService)
    {
        $this->formulirService = $formulirService;
    }

    public function index(Request $request)
    {
        $jenis_bencana = config('bencana');

        $bencanaQuery = Bencana::with('laporan.kajian')->latest('id');

        if ($request->filled('jenis_bencana')) {
            $bencanaQuery->where(
                'jenis_bencana',
                $request->jenis_bencana
            );
        }

        $bencana = $bencanaQuery
            ->paginate($request->input('limit', 5))
            ->appends($request->except('page'));

        // Resolve nama desa
        $bencana->getCollection()->transform(function ($item) {

            $codes = is_array($item->village_codes)
                ? $item->village_codes
                : json_decode($item->village_codes, true);

            $item->villages = collect($codes)->map(function ($code) {

                $code = trim($code);

                return Cache::remember(
                    "village_name_{$code}",
                    86400,
                    function () use ($code) {

                        $parts = explode('.', $code);
                        $districtCode = implode('.', array_slice($parts, 0, 3));

                        $response = Http::get(
                            "https://wilayah.id/api/villages/{$districtCode}.json"
                        );

                        if (!$response->ok()) {
                            return [
                                'code' => $code,
                                'name' => null,
                            ];
                        }

                        $village = collect($response->json('data'))
                            ->firstWhere('code', $code);

                        return [
                            'code' => $code,
                            'name' => $village['name'] ?? null,
                        ];
                    }
                );
            })->toArray();

            return $item;
        });

        return view('kajian.index', compact(
            'bencana',
            'jenis_bencana'
        ));
    }

    public function show(Request $request)
    {
        $laporan = LaporanBencana::where('bencana_id', $request->bencana_id)
            ->firstOrFail();

        $kajian = Kajian::where('laporan_id', $laporan->id)
            ->firstOrFail();

        $summaries = $this->formulirService->getSummaries($laporan->bencana);

        return view('kajian.show', compact(
            'laporan',
            'kajian',
            'summaries'
        ));
    }

    public function create(LaporanBencana $laporan)
    {
        $summaries = app(FormulirService::class)
            ->getSummaries($laporan->bencana);

        return view('kajian.create', [
            'laporan'   => $laporan,
            'summaries' => $summaries,
        ]);
    }

    public function edit(Kajian $kajian)
    {
        $kajian->load('laporanBencana.bencana');

        $summaries = $this->formulirService
            ->getSummaries($kajian->laporan->bencana);

        return view('kajian.edit', [
            'kajian' => $kajian,
            'laporan' => $kajian->laporan,
            'summaries' => $summaries,
        ]);
    }

    public function update(Request $request, Kajian $kajian)
    {
        $validated = $request->validate([
            'kehilangan_akses' => 'required|string',
            'gangguan_fungsi' => 'required|string',
            'peningkatan_resiko' => 'required|string',
        ]);

        $kajian->update($validated);

        return redirect()
            ->route('kajian.index')
            ->with('success', 'Kajian berhasil diperbarui.');
    }

    public function previewPdf(Kajian $kajian)
    {
        $laporan = $kajian->laporan;

        $summaries = $this->formulirService
            ->getSummaries($laporan->bencana);

        $pdf = Pdf::loadView('kajian.pdf', [
            'kajian' => $kajian,
            'laporan' => $laporan,
            'summaries' => $summaries,
        ]);

        return $pdf->stream('kajian.pdf');
    }

    public function generatePdf(Kajian $kajian)
    {
        $laporan = $kajian->laporan;
        $kajian->load('laporanBencana.bencana');

        $summaries = $this->formulirService
            ->getSummaries($kajian->laporan->bencana);

        $pdf = Pdf::loadView('kajian.pdf', [
            'kajian' => $kajian,
            'laporan' => $laporan,
            'summaries' => $summaries,
        ]);

        return $pdf->download(
            'Kajian-' . $kajian->laporan->bencana->jenis_bencana . '.pdf'
        );
    }

    public function store(Request $request, LaporanBencana $laporan)
    {
        $validated = $request->validate([
            'kehilangan_akses'   => ['required', 'string'],
            'gangguan_fungsi'  => ['required', 'string'],
            'peningkatan_resiko' => ['required', 'string'],
        ]);

        Kajian::create([
            'laporan_id' => $laporan->id,
            'kehilangan_akses' => $validated['kehilangan_akses'],
            'gangguan_fungsi' => $validated['gangguan_fungsi'],
            'peningkatan_resiko' => $validated['peningkatan_resiko'],
        ]);

        return redirect()
            ->route('kajian.index', $laporan)
            ->with('success', 'Kajian berhasil disimpan.');
    }

    // public function list(Request $request)
    // {
    //     $jenis_bencana = config('bencana');
    //     $bencanaQuery = Bencana::query()->latest('id');
    //     if ($request->filled('jenis_bencana')) {
    //         $bencanaQuery->where('jenis_bencana', '=', $request->input('jenis_bencana'));
    //     }

    //     $bencana = $bencanaQuery->paginate($request->input('limit', 5))->appends($request->except('page'));

    //     // Transform: resolve village codes → names
    //     $bencana->getCollection()->transform(function ($item) {
    //         $codes = is_array($item->village_codes)
    //             ? $item->village_codes
    //             : json_decode($item->village_codes, true);

    //         $item->villages = collect($codes)->map(function ($code) {
    //             $code = trim($code);

    //             return Cache::remember("village_name_{$code}", 86400, function () use ($code) {
    //                 $parts = explode('.', $code);
    //                 $districtCode = implode('.', array_slice($parts, 0, 3));

    //                 $response = Http::get("https://wilayah.id/api/villages/{$districtCode}.json");

    //                 if (!$response->ok()) return ['code' => $code, 'name' => null];

    //                 $village = collect($response->json('data'))->firstWhere('code', $code);

    //                 return [
    //                     'code' => $code,
    //                     'name' => $village['name'] ?? null,
    //                 ];
    //             });
    //         })->toArray();

    //         return $item; 
    //     });

    //     return view('kajian.list', [
    //         'bencana' => $bencana,
    //         'jenis_bencana' => $jenis_bencana,
    //     ]);
    // }
}
