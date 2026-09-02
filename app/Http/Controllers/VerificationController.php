<?php

namespace App\Http\Controllers;

use App\Models\Bencana;
use App\Models\LaporanBencana;
use App\Models\Formulir;
use App\Models\FormatFormulir;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class VerificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $jenis_bencana = config('bencana');

        $laporanQuery = LaporanBencana::query()->latest('id');

        if ($request->filled('jenis_bencana')) {
            $laporanQuery->where('jenis_bencana', '=', $request->input('jenis_bencana'));
        }

        $laporan = $laporanQuery->paginate($request->input('limit', 5))->appends($request->except('page'));

        // Transform: resolve village codes → names
        $laporan->getCollection()->transform(function ($item) {
            $codes = is_array($item->village_codes)
                ? $item->village_codes
                : json_decode($item->village_codes, true);

            $item->villages = collect($codes)->map(function ($code) {
                $code = trim($code);

                return Cache::remember("village_name_{$code}", 86400, function () use ($code) {
                    $parts = explode('.', $code);
                    $districtCode = implode('.', array_slice($parts, 0, 3));

                    $response = Http::get("https://wilayah.id/api/villages/{$districtCode}.json");

                    if (!$response->ok()) return ['code' => $code, 'name' => null];

                    $village = collect($response->json('data'))->firstWhere('code', $code);

                    return [
                        'code' => $code,
                        'name' => $village['name'] ?? null,
                    ];
                });
            })->toArray();

            return $item;
        });

        return view('verifikasi.index', compact(
            [
                'laporan',
                'jenis_bencana'
            ]
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $bencanas = Bencana::all();

        return view('verifikasi.create', compact('bencanas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'bencana_id' => 'required|exists:bencanas,id',
            'tanggal_lapor' => 'required|date',
            'total_kerusakan' => 'required|integer',
            'total_kerugian' => 'required|integer',
        ]);

        LaporanBencana::create([
            'user_id' => auth()->id(),
            'bencana_id' => $validated['bencana_id'],
            'tanggal_lapor' => $validated['tanggal_lapor'],
            'status_laporan' => 'draft',
            'total_kerusakan' => $validated['total_kerusakan'],
            'total_kerugian' => $validated['total_kerugian'],
        ]);

        return redirect()->route('laporan-bencana.index')
            ->with('success', 'Laporan berhasil dibuat');
    }

    /**
     * Display the specified resource.
     */
    public function show(LaporanBencana $laporan)
    {
        $bencana = $laporan->bencana;

        // Nama jenis bencana
        $jenisBencana = config('bencana')[$bencana->jenis_bencana] ?? $bencana->jenis_bencana;

        // Nama desa
        $codes = is_array($bencana->village_codes)
            ? $bencana->village_codes
            : json_decode($bencana->village_codes, true);

        $villages = collect($codes)->implode(', ');

        $formats = FormatFormulir::all();

        return view(
            'verifikasi.show',
            compact(
                'laporan',
                'jenisBencana',
                'villages',
                'formats'
            )
        );
    }

    public function verifyBencana(LaporanBencana $laporan)
    {
        $laporan->update([
            'status_laporan' => 'verified',
        ]);

        return redirect()
            ->route('verifikasi.index')
            ->with('success', 'Laporan berhasil diverifikasi.');
    }

    public function revisionBencana(Request $request, LaporanBencana $laporan)
    {
        $validated = $request->validate([
            'catatan_revisi' => ['required', 'string', 'max:1000'],
        ]);

        // dd($validated);

        $laporan->update([
            'status_laporan' => 'revision',
            'catatan_revisi' => $validated['catatan_revisi'],
        ]);

        return redirect()
            ->route('verifikasi.index')
            ->with('success', 'Laporan berhasil diverifikasi.');
    }

    public function verifyFormulir(Formulir $formulir)
    {
        $formulir->update([
            'status' => 'verified',
            'verified_by' => auth()->id(),
            'verified_at' => now(),
            'catatan_revisi' => null,
        ]);
        return redirect()
            ->route('verifikasi.index')
            ->with('success', 'Formulir berhasil diverifikasi.');
    }

    public function revisionFormulir(Request $request, Formulir $formulir)
    {
        $validated = $request->validate([
            'catatan_revisi' => ['required', 'string', 'max:1000'],
        ]);

        // dd($validated);

        $formulir->update([
            'status' => 'revision',
            'verified_by' => auth()->id(),
            'verified_at' => now(),
            'catatan_revisi' => $request->catatan_revisi,
        ]);

        return redirect()
            ->route('verifikasi.index')
            ->with('success', 'Formulir berhasil dikembalikan untuk direvisi.');
    }

    public function format(LaporanBencana $laporan, FormatFormulir $format)
    {
        $formulirs = Formulir::where('laporan_id', $laporan->id)
            ->where('format_id', $format->id)
            ->latest()
            ->get();
        // dd(
        //     $laporan->id,
        //     $format->id
        // );
        // dd(Formulir::all());
        // dd($formulirs);
        return view(
            'verifikasi.format',
            compact('laporan', 'format', 'formulirs')
        );
    }

    public function formulir(
        LaporanBencana $laporan,
        FormatFormulir $format,
        Formulir $formulir
    ) {
        $items = $formulir->items;

        return view(
            'verifikasi.formulir',
            compact(
                'laporan',
                'format',
                'formulir',
                'items'
            )
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LaporanBencana $laporanBencana)
    {
        $bencanas = \App\Models\Bencana::all();

        return view('verifikasi.edit', compact('laporanBencana', 'bencanas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LaporanBencana $laporanBencana)
    {
        $validated = $request->validate([
            'status_laporan' => 'required|in:draft,diproses,selesai,ditolak',
            'total_kerusakan' => 'required|integer',
            'total_kerugian' => 'required|integer',
        ]);

        $laporanBencana->update($validated);

        return redirect()->route('laporan-bencana.index')
            ->with('success', 'Laporan berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LaporanBencana $laporanBencana)
    {
        $laporanBencana->delete();

        return redirect()->route('laporan-bencana.index')
            ->with('success', 'Laporan berhasil dihapus');
    }
}
