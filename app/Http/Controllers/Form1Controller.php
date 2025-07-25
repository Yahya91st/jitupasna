<?php

namespace App\Http\Controllers;

use App\Models\Bencana;
use App\Models\Form1;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade\Pdf;

class Form1Controller extends Controller
{
    /**
     * Display the form
     */    public function index(Request $request)
    {
        $bencana_id = $request->input('bencana_id');
        
        // Redirect to bencana selection if no bencana_id is provided
        if (!$bencana_id) {
            return redirect()->route('bencana.index', ['source' => 'forms']);
        }
          // Get bencana details
        $bencana = Bencana::findOrFail($bencana_id);
        
        return view('forms.form1.form1', compact('bencana'));
    }

    /**
     * Store a new form submission
     */
    public function store(Request $request)
    {        $validator = Validator::make($request->all(), [
            'bencana_id' => 'required|exists:bencana,id',
            'nomor_surat' => 'required|string|max:255',
            'sifat' => 'required|in:Segera,Biasa,Rahasia',
            'lampiran' => 'nullable|string|max:255',
            'perihal' => 'required|string|max:255',
            'kepada_jabatan' => 'required|string',
            'lokasi_pdna' => 'required|string|max:255',
            'hari_tanggal' => 'required|date',
            'waktu' => 'required',
            'tempat' => 'required|string|max:255',
            'agenda' => 'required|string|max:255',
            'nama_penandatangan' => 'required|string|max:255',
            'jabatan_penandatangan' => 'required|string|max:255',
            'tembusan' => 'nullable|string',
            'tanggal_surat' => 'required|date',
            'instansi_pengirim' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $form = Form1::create($request->all());

        return redirect()->route('forms.form1.show', $form->id)
            ->with('success', 'Formulir berhasil disimpan.');
    }

    /**
     * Display a specific form entry     */    public function show($id)
    {
        $form = Form1::with(['bencana'])->findOrFail($id);
        return view('forms.form1.show', compact('form'));
    }

    /**
     * List all form entries for a specific bencana
     */
    public function listForm1(Request $request)
    {
        $bencana_id = $request->input('bencana_id');
        
        if (!$bencana_id) {
            return redirect()->route('bencana.index', ['source' => 'forms']);
        }
        
        $bencana = Bencana::findOrFail($bencana_id);
        $formData = Form1::where('bencana_id', $bencana_id)->latest()->get();
        
        return view('forms.form1.list', compact('bencana', 'formData'));
    }

    /**
     * Generate PDF for form data
     */    public function generatePdf($id)
    {
        $form = Form1::with(['bencana'])->findOrFail($id);
        
        $pdf = Pdf::loadView('forms.form1.pdf', compact('form'));
        return $pdf->download('Formulir_01_PDNA_' . $form->id . '.pdf');
    }    /**
     * Preview PDF without downloading
     */    
    public function previewPdf($id)
    {
        $form = Form1::with(['bencana'])->findOrFail($id);
        
        // Ensure date fields are Carbon instances
        if (!empty($form->tanggal_surat) && !$form->tanggal_surat instanceof \Carbon\Carbon) {
            $form->tanggal_surat = \Carbon\Carbon::parse($form->tanggal_surat);
        }
        
        if (!empty($form->hari_tanggal) && !$form->hari_tanggal instanceof \Carbon\Carbon) {
            $form->hari_tanggal = \Carbon\Carbon::parse($form->hari_tanggal);
        }
        
        if (!empty($form->bencana->tanggal) && !$form->bencana->tanggal instanceof \Carbon\Carbon) {
            $form->bencana->tanggal = \Carbon\Carbon::parse($form->bencana->tanggal);
        }
        
        $pdf = Pdf::loadView('forms.form1.pdf', compact('form'));
        return $pdf->stream('Formulir_01_PDNA_' . $form->id . '.pdf');
    }
    
    /**
     * Show the form for editing the specified form.
     */
    public function edit($id)
    {
        try {
            $form = Form1::findOrFail($id);
            $bencana = Bencana::find($form->bencana_id);
            
            return view('forms.form1.edit', compact('form', 'bencana'));
        } catch (\Exception $e) {
            return back()->with('error', 'Data formulir tidak ditemukan.');
        }
    }
    
    /**
     * Update the specified form in database.
     */
    public function update(Request $request, $id)
    {
        try {
            $form = Form1::findOrFail($id);
            
            $validator = Validator::make($request->all(), [
                'nomor_surat' => 'required|string|max:255',
                'sifat' => 'required|in:Segera,Biasa,Rahasia',
                'lampiran' => 'nullable|string|max:255',
                'perihal' => 'required|string|max:255',
                'kepada' => 'required|string|max:255',
                'lokasi_pdna' => 'required|string|max:255',
                'hari_tanggal' => 'required|date',
                'waktu' => 'required',
                'tempat' => 'required|string|max:255',
                'agenda' => 'required|string|max:255',
                'nama_penandatangan' => 'required|string|max:255',
                'jabatan_penandatangan' => 'required|string|max:255',
                'tembusan' => 'nullable|string',
                'tanggal_surat' => 'required|date',
                'instansi_pengirim' => 'nullable|string|max:255',
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
            
            $form->update($request->all());
            
            return redirect()->route('forms.form1.show', $form->id)
                ->with('success', 'Formulir berhasil diperbarui.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }    }
}