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
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'bencana_id' => 'required|exists:bencana,id',
            'jawaban' => 'required|array',
        ]);

        $bencana_id = $validated['bencana_id'];
        $jawabanData = $validated['jawaban'];

        // Delete old data for this bencana instance to prevent duplicates
        Form9::where('bencana_id', $bencana_id)->delete();

        // Pre-calculate total sums for each question to determine percentage
        $question_totals = [];
        foreach ($jawabanData as $pertanyaan_no => $jawaban_indices) {
            $question_totals[$pertanyaan_no] = 0;
            foreach ($jawaban_indices as $jawaban_index => $kuesioner_values) {
                // Ensure kuesioner_values is an array before summing
                if (is_array($kuesioner_values)) {
                    $question_totals[$pertanyaan_no] += array_sum(array_map('intval', $kuesioner_values));
                }
            }
        }

        foreach ($jawabanData as $pertanyaan_no => $jawaban_indices) {
            foreach ($jawaban_indices as $jawaban_index => $kuesioner_values) {
                if (!is_array($kuesioner_values)) {
                    continue; // Skip if there are no kuesioner values
                }

                $jumlah = array_sum(array_map('intval', $kuesioner_values));
                $total_for_question = $question_totals[$pertanyaan_no];
                $persentase = ($total_for_question > 0) ? ($jumlah / $total_for_question) * 100 : 0;

                Form9::create([
                    'bencana_id' => $bencana_id,
                    'pertanyaan_no' => $pertanyaan_no,
                    'jawaban_index' => $jawaban_index,
                    'kuesioner_1' => $kuesioner_values[1] ?? 0,
                    'kuesioner_2' => $kuesioner_values[2] ?? 0,
                    'kuesioner_3' => $kuesioner_values[3] ?? 0,
                    'kuesioner_4' => $kuesioner_values[4] ?? 0,
                    'kuesioner_5' => $kuesioner_values[5] ?? 0,
                    'kuesioner_6' => $kuesioner_values[6] ?? 0,
                    'jumlah' => $jumlah,
                    'persentase' => $persentase,
                ]);
            }
        }

        return redirect()->route('forms.form-list', ['bencana_id' => $bencana_id])
            ->with('success', 'Data Form 9 berhasil disimpan.');
    }

    public function list(Request $request)
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
    }
}
