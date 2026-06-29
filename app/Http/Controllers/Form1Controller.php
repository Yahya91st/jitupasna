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
        
        return view('forms.form1.form1', compact('bencana'));
    }

    /**
     * Store a new form submission
     */
    public function store(Request $request)
    {        $validator = Validator::make($request->all(), [
            'bencana_id' => 'required|exists:bencana,id',
            'kop_surat' => 'nullable|string|max:255',
            'nomor_surat' => 'required|string|max:255',
            'nomor_surat_date' => 'required|date',
            'sifat' => 'required|in:Segera,Biasa,Rahasia',
            'lampiran' => 'nullable|integer|min:0',
            'kepada_jabatan' => 'required|string',
            'lokasi_pdna' => 'required|string|max:255',
            'hari_tanggal' => 'required|string|max:255',
            'waktu' => 'required|string|max:255',
            'tempat' => 'required|string|max:255',
            'agenda' => 'required|string',
            'nama_penandatangan' => 'required|string|max:255',
            'tembusan' => 'nullable|string',
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
     * Display a specific form entry     */    
    public function show($id)
    {
        $form = Form1::with(['bencana'])->findOrFail($id);
        return view('forms.form1.show', compact('form'));
    }

    /**
     * List all form entries for a specific bencana
     */
    public function list(Request $request)
    {
        $bencana_id = $request->input('bencana_id');
        
        if (!$bencana_id) {
            return redirect()->route('bencana.index', ['source' => 'forms']);
        }
        
        $bencana = Bencana::findOrFail($bencana_id);
         $form = Form1::where('bencana_id', $bencana_id)->latest()->get();
        
        return view('forms.form1.list', compact('bencana', 'form'));
    }

    /**
     * Generate PDF for form data
     */    
    public function generatePdf($id)
    {
        $form = Form1::with(['bencana'])->findOrFail($id);
        
        $pdf = Pdf::loadView('forms.form1.pdf', compact('form'));
        return $pdf->download('Formulir_01_PDNA_' . $form->id . '.pdf');
    }   

    /**
     * Preview PDF without downloading
     */    
    public function previewPdf($id)
    {
        $form = Form1::with(['bencana'])->findOrFail($id);
        
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
                'kop_surat' => 'nullable|string|max:255',
                'nomor_surat' => 'required|string|max:255',
                'nomor_surat_date' => 'required|date',
                'sifat' => 'required|in:Segera,Biasa,Rahasia',
                'lampiran' => 'nullable|integer|min:0',
                'kepada_jabatan' => 'required|string',
                'lokasi_pdna' => 'required|string|max:255',
                'hari_tanggal' => 'required|string|max:255',
                'waktu' => 'required|string|max:255',
                'tempat' => 'required|string|max:255',
                'agenda' => 'required|string',
                'nama_penandatangan' => 'required|string|max:255',
                'tembusan' => 'nullable|string',
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
        }    
    }
    public function destroy($id)
    {
        try {
            $form = Form1::findOrFail($id);
            $bencana_id = $form->bencana_id;
            $form->delete();
            
            return redirect()->route('forms.form1.list', ['bencana_id' => $bencana_id])
                ->with('success', 'Data Form 1 berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}