<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Form9;
use App\Models\Bencana;
use App\Models\Form9Row;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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
            'tanggal' => 'nullable|date',
            'keterangan' => 'nullable|string',
        ]);

        $bencana_id = $validated['bencana_id'];
        $jawabanData = $validated['jawaban'];

        // mapping template keys same as blade (if blade still uses 'a','b', etc.)
        $templateNos = [
            'a','b','c','d','e','f','g','h','i','j','k',
            '1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25'
        ];
        $map = [];
        foreach ($templateNos as $i => $key) {
            $map[(string)$key] = $i + 1;
        }

        DB::transaction(function () use ($validated, $jawabanData, $bencana_id, $map) {
            // remove previous submission(s) for this bencana if desired
            Form9::where('bencana_id', $bencana_id)->delete();

            // create master record
            $form = Form9::create([
                'bencana_id' => $bencana_id,
                'tanggal' => $validated['tanggal'] ?? null,
                'keterangan' => $validated['keterangan'] ?? null,
            ]);

            // pre-calc totals per question (mapped to integer)
            $question_totals = [];
            foreach ($jawabanData as $pert_no_key => $jawaban_indices) {
                $pert_index = $map[(string)$pert_no_key] ?? (is_numeric($pert_no_key) ? intval($pert_no_key) : null);
                if ($pert_index === null) continue;
                $question_totals[$pert_index] = ($question_totals[$pert_index] ?? 0);
                foreach ($jawaban_indices as $jawaban_index => $kuesioner_values) {
                    if (is_array($kuesioner_values)) {
                        $question_totals[$pert_index] += array_sum(array_map('intval', $kuesioner_values));
                    }
                }
            }

            $now = Carbon::now();
            $insertRows = [];

            foreach ($jawabanData as $pert_no_key => $jawaban_indices) {
                $pert_index = $map[(string)$pert_no_key] ?? (is_numeric($pert_no_key) ? intval($pert_no_key) : null);
                if ($pert_index === null) continue;

                foreach ($jawaban_indices as $jawaban_index => $kuesioner_values) {
                    if (!is_array($kuesioner_values)) continue;

                    $k1 = intval($kuesioner_values[1] ?? 0);
                    $k2 = intval($kuesioner_values[2] ?? 0);
                    $k3 = intval($kuesioner_values[3] ?? 0);
                    $k4 = intval($kuesioner_values[4] ?? 0);
                    $k5 = intval($kuesioner_values[5] ?? 0);
                    $k6 = intval($kuesioner_values[6] ?? 0);
                    $jumlah = $k1 + $k2 + $k3 + $k4 + $k5 + $k6;
                    $total_for_question = $question_totals[$pert_index] ?? 0;
                    $persentase = ($total_for_question > 0) ? ($jumlah / $total_for_question) * 100 : 0;

                    $insertRows[] = [
                        'form9_id' => $form->id,
                        'pertanyaan_no' => $pert_index,
                        'jawaban_index' => intval($jawaban_index),
                        'kuesioner_1' => $k1,
                        'kuesioner_2' => $k2,
                        'kuesioner_3' => $k3,
                        'kuesioner_4' => $k4,
                        'kuesioner_5' => $k5,
                        'kuesioner_6' => $k6,
                        'jumlah' => $jumlah,
                        'persentase' => $persentase,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ];
                }
            }

            if (!empty($insertRows)) {
                DB::table('form9_rows')->insert($insertRows);
            }
        });

        return redirect()->route('forms.form-list', ['bencana_id' => $bencana_id])
            ->with('success', 'Data Form 9 berhasil disimpan (master + rows).');
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

    public function destroy($id)
    {
        try {
            $form9 = Form9::findOrFail($id);
            $bencana_id = $form9->bencana_id;
            $form9->delete();
            
            return redirect()->route('forms.form9.list', ['bencana_id' => $bencana_id])
                ->with('success', 'Data Form 9 berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
    public function contohPdf()
    {

        $pdf = Pdf::loadView('forms.form9.contoh_form9_pdf', []);
        return $pdf->stream('Contoh_Formulir_09_PDNA.pdf');
    }
        public function perBaris(Request $request)
    {
        $bencana_id = $request->input('bencana_id');
        $bencana = Bencana::findOrFail($bencana_id);
        $allRows = Form9Row::with('form9.bencana')->whereHas('form9', function($q) use ($bencana_id) {
            $q->where('bencana_id', $bencana_id);
        })->get();

        return view('forms.form9.form9Row', compact('allRows','bencana','bencana_id'));
    }

}