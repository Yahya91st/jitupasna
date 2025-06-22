<?php

namespace App\Http\Controllers;

use App\Models\Bencana;
use App\Models\Form9;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade\Pdf;

class Form9Controller extends Controller
{
    public function index(Request $request)
    {
        $bencana_id = $request->get('bencana_id');
        $bencana = Bencana::find($bencana_id);
        
        return view('forms.form9.form9', compact('bencana'));
    }    public function list(Request $request)
    {
        $bencana_id = $request->get('bencana_id');
        $bencana = Bencana::find($bencana_id);
        
        // Fetch Form9 data for this bencana
        $forms = Form9::where('bencana_id', $bencana_id)
                      ->orderBy('created_at', 'desc')
                      ->get();
        
        return view('forms.form9.list', compact('bencana', 'forms'));
    }
      /**
     * Show the details of a specific form
     */
    public function show($id)
    {
        try {
            $form = Form9::findOrFail($id);
            $bencana = Bencana::find($form->bencana_id);
            
            return view('forms.form9.show', compact('form', 'bencana'));
        } catch (\Exception $e) {
            return back()->with('error', 'Data kuesioner tidak ditemukan.');
        }
    }
    
    /**
     * Show the form for editing the specified kuesioner.
     */
    public function edit($id)
    {
        try {
            $form = Form9::findOrFail($id);
            $bencana = Bencana::find($form->bencana_id);
            
            return view('forms.form9.edit', compact('form', 'bencana'));
        } catch (\Exception $e) {
            return back()->with('error', 'Data kuesioner tidak ditemukan.');
        }
    }
    
    /**
     * Update the specified kuesioner in database.
     */
    public function update(Request $request, $id)
    {
        try {
            $form = Form9::findOrFail($id);
            
            // Validate form data
            $validated = $request->validate([
                'nomor_kuesioner' => 'required|string',
                'jenis_kelamin' => 'required|string',
                'umur' => 'required|string',
                'desa_kelurahan' => 'required|string',
                'kecamatan' => 'required|string',
                'dukungan_pangan_air' => 'nullable|array',
            ]);
            
            // Update the form record
            $form->update($validated);
            
            return redirect()->route('forms.form9.show', $form->id)
                ->with('success', 'Data kuesioner berhasil diperbarui.');
        } catch (\Exception $e) {
            Log::error('Error updating kuesioner: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
    
    /**
     * Generate PDF document from kuesioner data.
     */
    public function generatePdf($id)
    {
        try {
            $form = Form9::findOrFail($id);
            $bencana = Bencana::find($form->bencana_id);
            
            $pdf = PDF::loadView('pdf.form9-pdf', compact('form', 'bencana'));
            return $pdf->download('Kuesioner_Form9_' . $id . '.pdf');
        } catch (\Exception $e) {
            Log::error('Error generating PDF: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat mengunduh PDF: ' . $e->getMessage());
        }
    }
    
    /**
     * Preview PDF document from kuesioner data.
     */
    public function previewPdf($id)
    {
        try {
            $form = Form9::findOrFail($id);
            $bencana = Bencana::find($form->bencana_id);
            
            $pdf = PDF::loadView('pdf.form9-pdf', compact('form', 'bencana'));
            return $pdf->stream('Kuesioner_Form9_' . $id . '.pdf');
        } catch (\Exception $e) {
            Log::error('Error previewing PDF: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat menampilkan pratinjau PDF: ' . $e->getMessage());
        }
    }public function store(Request $request)
    {
        // Validate form data
        $validated = $request->validate([
            'bencana_id' => 'required|exists:bencana,id',
            'nomor_kuesioner' => 'required|string',
            'jenis_kelamin' => 'required|string',
            'umur' => 'required|string',
            'desa_kelurahan' => 'required|string',
            'kecamatan' => 'required|string',
            'dukungan_pangan_air' => 'nullable|array',
        ]);
        
        try {
            // Add current date if not provided
            if (!isset($validated['tanggal'])) {
                $validated['tanggal'] = now();
            }
            
            // Create a new Form9 record
            Form9::create($validated);
            
            return redirect()->route('forms.form9.list', ['bencana_id' => $request->bencana_id])
                ->with('success', 'Data kuesioner berhasil disimpan');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }
}
