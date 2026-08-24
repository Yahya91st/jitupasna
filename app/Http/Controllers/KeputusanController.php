<?php

namespace App\Http\Controllers;

use App\Models\Bencana;
use App\Models\Keputusan;
use App\Models\LaporanBencana;
use App\Models\Formulir;
use App\Services\FormulirService;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class KeputusanController extends Controller
{
    public function __construct(
        private FormulirService $formulirService
    ) {}


    public function index(Request $request)
    {
        $jenis_bencana = config('bencana');


        $query = Bencana::with([
            'laporan.keputusan'
        ])
            ->latest('id');


        if ($request->filled('jenis_bencana')) {
            $query->where(
                'jenis_bencana',
                $request->jenis_bencana
            );
        }


        $bencana = $query
            ->paginate(
                $request->input('limit', 5)
            )
            ->appends(
                $request->except('page')
            );


        return view(
            'keputusan.index',
            compact(
                'bencana',
                'jenis_bencana'
            )
        );
    }

    public function create(LaporanBencana $laporan)
    {
        $laporan->load([
            'bencana',
            'kajian',
            'keputusan',
        ]);

        $bencana = $laporan->bencana;

        $jenis_bencana = config('bencana');

        $summaries = $this->formulirService
            ->getSummaries($bencana);

        $kajian = $laporan->kajian;
        $keputusan = $laporan->keputusan;

        return view('keputusan.create', compact(
            'laporan',
            'bencana',
            'kajian',
            'keputusan',
            'summaries',
            'jenis_bencana'
        ));
    }

    /**
     * Simpan keputusan pimpinan
     */
    public function store(
        Request $request,
        LaporanBencana $laporan
    ) {

        $validated = $request->validate([

            'prioritas' => [
                'required',
                'in:rendah,sedang,tinggi'
            ],

            'keputusan' => [
                'required'
            ]

        ]);


        Keputusan::create([

            'laporan_id' => $laporan->id,

            'prioritas' => $validated['prioritas'],

            'keputusan' => $validated['keputusan']

        ]);


        return redirect()
            ->route('keputusan.index')
            ->with(
                'success',
                'Keputusan berhasil dibuat.'
            );
    }

    public function edit(Keputusan $keputusan)
    {
        $keputusan->load([
            'laporan.bencana',
            'laporan.kajian',
        ]);

        $laporan = $keputusan->laporan;
        $bencana = $laporan->bencana;
        $kajian = $laporan->kajian;

        $summaries = $this->formulirService
            ->getSummaries($bencana);

        $jenis_bencana = config('bencana');

        return view('keputusan.create', compact(
            'keputusan',
            'laporan',
            'bencana',
            'kajian',
            'summaries',
            'jenis_bencana'
        ));
    }

    /**
     * Update keputusan
     */
    public function update(
        Request $request,
        Keputusan $keputusan
    ) {

        $validated = $request->validate([
            'prioritas' => 'required|in:rendah,sedang,tinggi',
            'keputusan' => 'required',
        ]);

        $keputusan->update($validated);

        return redirect()
            ->route('keputusan.index')
            ->with('success', 'Keputusan berhasil diperbarui.');
    }

    public function listFormat(LaporanBencana $laporan)
    {
        $bencana = $laporan->bencana;

        $formulirs = Formulir::where('laporan_id', $laporan->id)
            ->latest()
            ->paginate(10);

        return view('keputusan.list', compact(
            'laporan',
            'bencana',
            'formulirs'
        ));
    }

    public function preview(Keputusan $keputusan)
    {
        $keputusan->load([
            'laporan.bencana'
        ]);


        $laporan = $keputusan->laporan;

        if (!$laporan) {
            abort(404, 'Data laporan tidak ditemukan');
        }


        $bencana = $laporan->bencana;


        $pdf = Pdf::loadView(
            'keputusan.pdf',
            compact(
                'keputusan',
                'laporan',
                'bencana'
            )
        );


        return $pdf->stream(
            'keputusan-pimpinan.pdf'
        );
    }
}
