<?php

namespace App\Http\Controllers;

use App\Models\Bencana;
use App\Models\Keputusan;
use App\Models\LaporanBencana;
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

    /**
     * Update keputusan
     */
    public function update(
        Request $request,
        Keputusan $keputusan
    ) {

        $validated = $request->validate([

            'prioritas' => [
                'required',
                'in:rendah,sedang,tinggi'
            ],

            'hasil_keputusan' => [
                'required'
            ]

        ]);


        $keputusan->update(
            $validated
        );


        return redirect()
            ->route('keputusan.index')
            ->with(
                'success',
                'Keputusan berhasil diperbarui.'
            );
    }

    public function create(Request $request)
    {
        $jenis_bencana = config('bencana');
        $bencana = Bencana::findOrFail(
            $request->bencana
        );

        $laporan = LaporanBencana::firstOrCreate(
            [
                'bencana_id' => $bencana->id
            ],
            [
                'tanggal_lapor' => now(),
                'status' => 'draft'
            ]
        );

        $summaries = $this->formulirService
            ->getSummaries($bencana);

        $kajian = $laporan->kajian;

        $keputusan = $laporan->keputusan;


        return view('keputusan.create', compact(
            'bencana',
            'laporan',
            'summaries',
            'kajian',
            'keputusan',
            'jenis_bencana'
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
