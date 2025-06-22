<?php

namespace App\Http\Controllers;

use App\Models\Penilaian;
use App\Models\Bencana;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade\Pdf;

class Form8Controller extends Controller
{
    /**
     * Display the form
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
        
        return view('forms.form8.form8', compact('bencana'));
    }

    /**
     * Store a new form submission
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'bencana_id' => 'required|exists:bencana,id',
            'sektor' => 'required|string|max:255',
            'sub_sektor' => 'required|string|max:255',
            'komponen_kerusakan' => 'required|string',
            'lokasi' => 'required|string|max:255',
            'perkiraan_kerugian' => 'required|numeric|min:0',
            'total_kerusakan_kerugian' => 'required|numeric|min:0',
            'kebutuhan_rb' => 'required|numeric|min:0',
            'kebutuhan_rs' => 'required|numeric|min:0',
            'kebutuhan_rr' => 'required|numeric|min:0',
            'harga_satuan' => 'required|numeric|min:0',
            'nilai_kerusakan' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $penilaian = Penilaian::create($request->all());

        return redirect()->route('forms.form8.show', $penilaian->id)
            ->with('success', 'Data penilaian berhasil disimpan.');
    }

    /**
     * Display a specific form entry
     */
    public function show($id)
    {
        $penilaian = Penilaian::with(['bencana'])->findOrFail($id);
        return view('forms.form8.show', compact('penilaian'));
    }

    /**
     * List all form entries for a specific bencana
     */
    public function listPenilaian(Request $request)
    {
        $bencana_id = $request->input('bencana_id');
        
        if (!$bencana_id) {
            return redirect()->route('bencana.index', ['source' => 'forms']);
        }
        
        $bencana = Bencana::findOrFail($bencana_id);
        $formData = Penilaian::where('bencana_id', $bencana_id)->latest()->get();
        
        return view('forms.form8.list', compact('bencana', 'formData'));
    }

    /**
     * Generate PDF for form data
     */    
    public function generatePdf($id)
    {
        $penilaian = Penilaian::with(['bencana'])->findOrFail($id);
        
        $pdf = Pdf::loadView('forms.form8.pdf', compact('penilaian'));
        return $pdf->download('Formulir_08_Penilaian_' . $penilaian->id . '.pdf');
    }

    /**
     * Preview PDF without downloading
     */      public function previewPdf($id)
    {
        $penilaian = Penilaian::with(['bencana'])->findOrFail($id);
        
        // Ensure date fields are Carbon instances
        if (!empty($penilaian->bencana->tanggal) && !$penilaian->bencana->tanggal instanceof \Carbon\Carbon) {
            $penilaian->bencana->tanggal = \Carbon\Carbon::parse($penilaian->bencana->tanggal);
        }
        
        $pdf = Pdf::loadView('forms.form8.pdf', compact('penilaian'));
        return $pdf->stream('Formulir_08_Penilaian_' . $penilaian->id . '.pdf');
    }
    
    /**
     * Show the form for editing the specified penilaian.
     */
    public function edit($id)
    {
        try {
            $penilaian = Penilaian::findOrFail($id);
            $bencana = Bencana::find($penilaian->bencana_id);
            
            return view('forms.form8.edit', compact('penilaian', 'bencana'));
        } catch (\Exception $e) {
            return back()->with('error', 'Data penilaian tidak ditemukan.');
        }
    }
    
    /**
     * Update the specified penilaian in database.
     */
    public function update(Request $request, $id)
    {
        try {
            $penilaian = Penilaian::findOrFail($id);
            
            $validator = Validator::make($request->all(), [
                'nomor_dokumen' => 'required|string|max:255',
                'tanggal' => 'required|date',
                'tim_penilai' => 'required|string',
                'metodologi' => 'required|string',
                'sektor_terkena_dampak' => 'required|string',
                'dampak_ekonomi' => 'required|string',
                'dampak_sosial' => 'required|string',
                'kebutuhan_pemulihan' => 'required|string',
                'kesimpulan' => 'required|string',
                'rekomendasi' => 'required|string',
                'nama_penandatangan' => 'required|string|max:255',
                'jabatan_penandatangan' => 'required|string|max:255',
            ]);
            
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
            
            $penilaian->update($request->all());
            
            return redirect()->route('forms.form8.show', $penilaian->id)
                ->with('success', 'Data penilaian berhasil diperbarui.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
