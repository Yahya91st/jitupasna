<?php

namespace App\Http\Controllers;

use App\Models\form10;
use App\Models\Bencana;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade\Pdf;

class Form10Controller extends Controller
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
        
        return view('forms.form10.form10', compact('bencana'));
    }

    /**
     * Store a new form submission
     */
    public function store(Request $request)
    {        $validator = Validator::make($request->all(), [
            'bencana_id' => 'required|exists:bencana,id',
            'sektor' => 'required|string|max:255',
            'sub_sektor' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'hasil_survey' => 'required|string',
            'hasil_wawancara' => 'required|string',
            'hasil_pendataan_skpd' => 'required|string',
            'kebutuhan_pemulihan' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $form = form10::create($request->all());

        return redirect()->route('forms.form10.show', $form->id)
            ->with('success', 'Formulir berhasil disimpan.');
    }

    /**
     * Display a specific form entry     */    
    public function show($id)
    {
        $form = form10::with(['bencana'])->findOrFail($id);
        return view('forms.form10.show', compact('form'));
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
         $form = form10::where('bencana_id', $bencana_id)->latest()->get();
        
        return view('forms.form10.list', compact('bencana', 'form'));
    }

    /**
     * Generate PDF for form data
     */    
    public function generatePdf($id)
    {
        $form = form10::with(['bencana'])->findOrFail($id);
        
        $pdf = Pdf::loadView('forms.form10.pdf', compact('form'));
        return $pdf->download('Formulir_10_PDNA_' . $form->id . '.pdf');
    }   

    /**
     * Preview PDF without downloading
     */    
    public function previewPdf($id)
    {
        $form = form10::with(['bencana'])->findOrFail($id);
        
        $pdf = Pdf::loadView('forms.form10.pdf', compact('form'));
        return $pdf->stream('Formulir_10_PDNA_' . $form->id . '.pdf');
    }
    
    /**
     * Show the form for editing the specified form.
     */
    public function edit($id)
    {
        try {
            $form = form10::findOrFail($id);
            $bencana = Bencana::find($form->bencana_id);
            
            return view('forms.form10.edit', compact('form', 'bencana'));
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
            $form = form10::findOrFail($id);
            
            $validator = Validator::make($request->all(), [
                'bencana_id' => 'required|exists:bencana,id',
                'sektor' => 'required|string|max:255',
                'sub_sektor' => 'required|string|max:255',
                'lokasi' => 'required|string|max:255',
                'hasil_survey' => 'required|string',
                'hasil_wawancara' => 'required|string',
                'hasil_pendataan_skpd' => 'required|string',
                'kebutuhan_pemulihan' => 'required|string',
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
            
            $form->update($request->all());
            
            return redirect()->route('forms.form10.show', $form->id)
                ->with('success', 'Formulir berhasil diperbarui.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }    
    }
    public function destroy($id)
    {
        try {
            $form = form10::findOrFail($id);
            $bencana_id = $form->bencana_id;
            $form->delete();
            
            return redirect()->route('forms.form10.list', ['bencana_id' => $bencana_id])
                ->with('success', 'Data Form 1 berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
    public function contohPdf()
    {

        $pdf = Pdf::loadView('forms.form10.contoh_form10_pdf', []);
        return $pdf->stream('Contoh_Formulir_10_PDNA.pdf');
    }
}
