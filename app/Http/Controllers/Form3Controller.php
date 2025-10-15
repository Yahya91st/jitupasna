<?php

namespace App\Http\Controllers;

use App\Models\Bencana;
use App\Models\Form3;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class Form3Controller extends Controller
{
    /**
     * Display the form for creating a new Form3.
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
        
        return view('forms.form3.form3', compact('bencana'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
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

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $validated = $validator->validated();
        $form = Form3::create($request->all());

        return redirect()->route('forms.form3.show', $form->id)
            ->with('success', 'Formulir berhasil disimpan.');
        
    }

    public function show($id)
    {
        $form = Form3::with(['bencana'])->findOrFail($id);
        return view('forms.form3.show', compact('form'));
    }

    public function list(Request $request)
    {
        $bencana_id = $request->input('bencana_id');
        
        if (!$bencana_id) {
            return redirect()->route('bencana.index', ['source' => 'forms']);
        }
        
        $bencana = Bencana::findOrFail($bencana_id);
         $form = Form3::where('bencana_id', $bencana_id)->latest()->get();
        
        return view('forms.form3.list', compact('bencana', 'form'));
    }

    public function generatePdf($id)
    {
        $form = Form3::with(['bencana'])->findOrFail($id);
        
        $pdf = Pdf::loadView('forms.form3.pdf', compact('form'));
        return $pdf->download('Formulir_03_PDNA_' . $form->id . '.pdf');
    }   

    public function previewPdf($id)
    {
        $form = Form3::with(['bencana'])->findOrFail($id);
        
        $pdf = Pdf::loadView('forms.form3.pdf', compact('form'));
        return $pdf->stream('Formulir_03_PDNA_' . $form->id . '.pdf');
    }

    public function edit($id)
    {
        try {
            $form = Form3::findOrFail($id);
            $bencana = Bencana::find($form->bencana_id);
            
            return view('forms.form3.edit', compact('form', 'bencana'));
        } catch (\Exception $e) {
            return back()->with('error', 'Data formulir tidak ditemukan.');
        }
    }
    
    public function update(Request $request, $id)
    {
        try {
            $form = Form3::findOrFail($id);
            $validator = Validator::make($request->all(), [
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

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
            $form->update($request->all());

            return redirect()->route('forms.form3.show', $form->id)
                ->with('success', 'Formulir berhasil diperbarui.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }    
    }

    public function destroy($id)
    {
        try {
            $form = Form3::findOrFail($id);
            $bencana_id = $form->bencana_id;
            $form->delete();
            
            return redirect()->route('forms.form3.list', ['bencana_id' => $bencana_id])
                ->with('success', 'Data Form 3 berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
