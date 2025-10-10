<?php

namespace App\Http\Controllers;

use App\Models\Form2;
use App\Models\Bencana;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class Form2Controller extends Controller
{    /**
     * Display the form for creating a new Surat Keputusan.
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
        
        return view('forms.form2.form2', compact('bencana'));
    }
    
    /**
     * Store a newly created Surat Keputusan in database.
     */
            public function store(Request $request)
        {
            $validator = Validator::make($request->all(), [
                'bencana_id' => 'required|exists:bencana,id',
                'nomor_surat' => 'required|string|max:255|unique:form2,nomor_surat',
                'lokasi_menimbang' => 'required|string|max:255',
                'pejabat_keputusan' => 'required|string|max:255',
                'tempat_ditetapkan' => 'required|string|max:255',
                'tanggal_ditetapkan' => 'required|string|max:255',
                'nama_penandatangan' => 'required|string|max:255',
                'tembusan' => 'required|string',
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $validated = $validator->validated();

            // Generate default values for required database fields
            $tentang = "PEMBENTUKAN TIM KERJA PENGKAJIAN KEBUTUHAN PASCA BENCANA (PDNA) DI " . strtoupper($validated['lokasi_menimbang']);
            
            // Create new form2 record
            $form = new Form2();
            $form->nomor_surat = $validated['nomor_surat'];
            $form->tentang = $tentang;
            $form->lokasi = $validated['lokasi_menimbang'];
            $form->tanggal_ditetapkan = $validated['tanggal_ditetapkan'];
            $form->tempat_ditetapkan = $validated['tempat_ditetapkan'];
            $form->pejabat_penandatangan = $validated['pejabat_keputusan'];
            $form->nama_penandatangan = $validated['nama_penandatangan'];
            $form->tim_kerja = "Tim akan ditentukan kemudian";
            $form->tugas_tim = "Sesuai dengan diktum KEDUA";
            $form->penanggung_jawab = $validated['pejabat_keputusan'];
            $form->tembusan = $validated['tembusan'];
            $form->bencana_id = $validated['bencana_id'];
            // $form->created_by = Auth::id();
            $form->save();

            return redirect()->route('forms.form2.show', $form->id)
                ->with('success', 'Surat Keputusan berhasil dibuat.');
        }
            
    
      /**
     * Display the specified Surat Keputusan.
     */
    public function show($id)
    {
        $form = Form2::with(['bencana'])->findOrFail($id);
        return view('forms.form2.show', compact('form'));
        
    }

    /**
     * Display a listing of Surat Keputusan.
     */    
    public function list(Request $request)
    {
        $bencana_id = $request->input('bencana_id');
        
        if (!$bencana_id) {
            return redirect()->route('bencana.index', ['source' => 'forms']);
        }
        
        $bencana = Bencana::findOrFail($bencana_id);
        $form = Form2::where('bencana_id', $bencana_id)->latest()->get();
        
        return view('forms.form2.list', compact('bencana', 'form'));
    }

    public function generatePdf($id)
    {
        $form = Form2::with(['bencana'])->findOrFail($id);
        $pdf = Pdf::loadView('forms.form2.pdf', compact('form'));
        return $pdf->download('Formulir_02_PDNA_' . $form->id . '.pdf');

    }
    
    /**
     * Preview PDF document from Surat Keputusan.
     */
    public function previewPdf($id)
    {
        // $keputusan=;
        $form = Form2::with(['bencana'])->findOrFail($id);
        $pdf = Pdf::loadView('forms.form2.pdf', compact('form'));
        return $pdf->stream('Formulir_02_PDNA_' . $form->id . '.pdf');
    }
    
    /**
     * Show the form for editing the specified Surat Keputusan.
     */
    public function edit($id)
    {
        try {
            $form = Form2::findOrFail($id);
                        
            return view('forms.form2.edit', compact('form2', 'menimbang', 'mengingat'));
        } catch (\Exception $e) {
            return back()->with('error', 'Surat Keputusan tidak ditemukan.');
        }
    }
    
    /**
     * Update the specified Surat Keputusan in database.
     */
    public function update(Request $request, $id)
    {
        try {
            $form = Form2::findOrFail($id);
            
            $validated = $request->validate([
                'nomor_surat' => 'required|string|max:255|unique:form2,nomor_surat,' . $id,
                'tentang' => 'required|string|max:255',
                'lokasi' => 'required|string|max:255',
                'tanggal_ditetapkan' => 'required|date',
                'pejabat_penandatangan' => 'required|string|max:255',
                'menimbang' => 'required|string',
                'mengingat' => 'required|string',
                'tim_kerja' => 'required|string',
                'tugas_tim' => 'required|string',
                'penanggung_jawab' => 'required|string|max:255',
                'tembusan' => 'required|string',
            ]);
            
            // Update form2 record
            $form->update([
                'nomor_surat' => $validated['nomor_surat'],
                'tentang' => $validated['tentang'],
                'lokasi' => $validated['lokasi'],
                'tanggal_ditetapkan' => $validated['tanggal_ditetapkan'],
                'pejabat_penandatangan' => $validated['pejabat_penandatangan'],
                'tim_kerja' => $validated['tim_kerja'],
                'tugas_tim' => $validated['tugas_tim'],
                'penanggung_jawab' => $validated['penanggung_jawab'],
                'tembusan' => $validated['tembusan'],
                'updated_by' => Auth::id()
            ]);
            
            return redirect()->route('forms.form2.show', $form2->id)
                ->with('success', 'Surat Keputusan berhasil diperbarui.');
        } catch (\Exception $e) {
            Log::error('Error updating keputusan: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
    
    
    /**
     * Generate PDF document from Surat Keputusan.
     */
    
}