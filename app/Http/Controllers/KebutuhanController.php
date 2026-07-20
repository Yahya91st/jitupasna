<?php

namespace App\Http\Controllers;

use App\Models\Bencana;
use App\Models\LaporanBencana;
use App\Models\Formulir;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\Services\FormulirService;
use Log;

class KebutuhanController extends Controller
{
    public function __construct(
        private FormulirService $formulirService
    ) {}

    public function show($id)
    {
        $formulir = $this->formulirService->loadFormulir($id);

        return view(
            'kebutuhan.show',
            $this->formulirService->getSummary($formulir)
        );
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $jenis_bencana = config('bencana');


        $query = Bencana::with([
            'laporan.keputusan',
            'laporan.kajian'
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
            'kebutuhan.index',
            compact(
                'bencana',
                'jenis_bencana'
            )
        );
    }

    /**
     * Display a summary of tables by form.
     */
    public function listFormat(Request $request)
    {
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


        return view('kebutuhan.index', compact(
            'bencana',
            'laporan',
            'summaries',
            'kajian',
            'keputusan'
        ));
    }
}
