<?php

namespace App\Http\Controllers;

use App\Models\Bencana;
use App\Models\Form3;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class Form3Controller extends Controller
{
    /**
     * Display the form for creating a new Form3.
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
        
        return view('forms.form3.form3', compact('bencana'));
    }

    /**
     * Store a newly created pendataan in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'bencana_id' => 'required|exists:bencana,id',
            'program_kesehatan_masal' => 'nullable|string',
            'permasalahan_kesehatan' => 'nullable|string',
            'kegiatan_permasalahan_kesehatan' => 'nullable|string',
            'program_makanan_tambahan' => 'nullable|string',
            'jumlah_balita_terdampak' => 'nullable|integer|min:0',
            'dampak_balita' => 'nullable|string',
            'kegiatan_balita' => 'nullable|string',
            'jumlah_ibu_hamil_terdampak' => 'nullable|integer|min:0',
            'dampak_ibu_hamil' => 'nullable|string',
            'kegiatan_ibu_hamil' => 'nullable|string',
            'jumlah_lansia_terdampak' => 'nullable|integer|min:0',
            'dampak_lansia' => 'nullable|string',
            'kegiatan_lansia' => 'nullable|string',
            'dampak_kesehatan_menengah' => 'nullable|string',
            'kegiatan_dampak_kesehatan' => 'nullable|string',
            'rencana_kontingensi_kesehatan' => 'nullable|string',
        ]);

        try {
            DB::beginTransaction();

            // Create the form3 record
            $form3 = Form3::create($request->all());
            DB::commit();

            return redirect()->route('forms.form3.show', $form3->id)
                ->with('success', 'Data Form 3 berhasil disimpan');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Display the specified pendataan.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $form3 = Form3::with('bencana.desa', 'bencana.kategori_bencana')->findOrFail($id);
        return view('forms.form3.show', compact('form3'));
    }

    /**
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
                $form3List = Form3::where('bencana_id', $bencana_id)->get();
            }
        }
        
        return view('forms.form3.list', compact('bencana', 'form3List'));
    }

    /**
     * Generate PDF for a pendataan.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function generatePdf($id)
    {
        $form3 = Form3::with('bencana.desa', 'bencana.kategori_bencana')->findOrFail($id);
        
        $pdf = Pdf::loadView('forms.form3.pdf', compact('form3'));
        return $pdf->download('Form3_' . $form3->id . '.pdf');
    }

    /**
     * Preview PDF for a pendataan.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */    public function previewPdf($id)
    {
        $form3 = Form3::with('bencana.desa', 'bencana.kategori_bencana')->findOrFail($id);
        
        $pdf = Pdf::loadView('forms.form3.pdf', compact('form3'));
        return $pdf->stream('Form3_' . $form3->id . '.pdf');
    }
    
    /**
     * Show the form for editing a pendataan.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $form3 = Form3::findOrFail($id);
            $bencana = Bencana::with('desa', 'kategori_bencana')->find($form3->bencana_id);
            
            return view('forms.form3.form3', compact('form3', 'bencana'));
        } catch (\Exception $e) {
            return back()->with('error', 'Data pendataan tidak ditemukan.');
        }
    }
    
    /**
     * Update the specified pendataan in database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $form3 = Form3::findOrFail($id);
            $form3->update($request->all());
            
            return redirect()->route('forms.form3.show', $form3->id)
                ->with('success', 'Data Form 3 berhasil diperbarui.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
