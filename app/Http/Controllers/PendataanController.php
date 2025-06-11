<?php

namespace App\Http\Controllers;

use App\Models\Bencana;
use App\Models\Pendataan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class PendataanController extends Controller
{    /**
     * Display the form for creating a new pendataan.
     *
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        $bencana = null;
        $bencana_id = request()->get('bencana_id');
        
        if ($bencana_id) {
            $bencana = Bencana::with('desa', 'kategori_bencana')->findOrFail($bencana_id);
        } else {
            // If no bencana_id is provided, redirect to bencana selection page
            return redirect()->route('bencana.index', ['source' => 'forms']);
        }
        
        return view('forms.form3', compact('bencana'));
    }    /**
     * Store a newly created pendataan in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {        $validated = $request->validate([
            'wilayah_bencana' => 'required|string',
            'bencana_id' => 'required|exists:bencana,id'
        ]);

        try {
            DB::beginTransaction();

            // Create the pendataan record
            $pendataan = Pendataan::create($request->all());            DB::commit();

            return redirect()->route('forms.form3.show', $pendataan->id)
                ->with('success', 'Data pendataan berhasil disimpan');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }    /**
     * Display the specified pendataan.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $pendataan = Pendataan::with('bencana.desa', 'bencana.kategori_bencana')->findOrFail($id);
        return view('forms.pendataan.show', compact('pendataan'));
    }    /**
     * Display a listing of pendataan for a specific bencana.
     *
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\View\View
     */
    public function list()
    {
        $bencana = null;
        $pendataanList = collect();
        
        if (request()->has('bencana_id')) {
            $bencana_id = request()->get('bencana_id');
            $bencana = Bencana::with('desa', 'kategori_bencana')->find($bencana_id);
            
            if ($bencana) {
                $pendataanList = Pendataan::where('bencana_id', $bencana_id)->get();
            }
        }
        
        return view('forms.pendataan.list', compact('bencana', 'pendataanList'));
    }/**
     * Generate PDF for a pendataan.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function generatePdf($id)
    {
        $pendataan = Pendataan::with('bencana.desa', 'bencana.kategori_bencana')->findOrFail($id);
        
        $pdf = Pdf::loadView('forms.pendataan.pdf', compact('pendataan'));
        return $pdf->download('Form3_Pendataan_' . $pendataan->id . '.pdf');
    }    /**
     * Preview PDF for a pendataan.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function previewPdf($id)
    {
        $pendataan = Pendataan::with('bencana.desa', 'bencana.kategori_bencana')->findOrFail($id);
        
        $pdf = Pdf::loadView('forms.pendataan.pdf', compact('pendataan'));
        return $pdf->stream('Form3_Pendataan_' . $pendataan->id . '.pdf');
    }
}
