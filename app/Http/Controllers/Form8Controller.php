<?php

namespace App\Http\Controllers;

use App\Models\Form8;
use App\Models\Bencana;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Validator;

class form8Controller extends Controller
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
            'sektor_sub_sektor' => 'required|string|max:255',
            'komponen_kerusakan' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',

            // Data Kerusakan
            'data_kerusakan_rb' => 'nullable|integer|min:0',
            'data_kerusakan_rs' => 'nullable|integer|min:0',
            'data_kerusakan_rr' => 'nullable|integer|min:0',

            // Harga Satuan
            'harga_satuan_rb' => 'nullable|numeric|min:0',
            'harga_satuan_rs' => 'nullable|numeric|min:0',
            'harga_satuan_rr' => 'nullable|numeric|min:0',

            // Nilai Kerusakan
            'nilai_kerusakan_rb' => 'nullable|numeric|min:0',
            'nilai_kerusakan_rs' => 'nullable|numeric|min:0',
            'nilai_kerusakan_rr' => 'nullable|numeric|min:0',

            // Perkiraan Kerugian dan Total
            'perkiraan_kerugian' => 'nullable|numeric|min:0',
            'total_kerusakan_kerugian' => 'nullable|numeric|min:0',
            'kebutuhan' => 'nullable|numeric|min:0',

            // Dynamic rows data
            'dynamic_rows' => 'nullable|array',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $form = form8::create($request->all());

        return redirect()->route('forms.form8.show', $form->id)
            ->with('success', 'Formulir berhasil disimpan.');
    }

    /**
     * Display a specific form entry     */    
    public function show($id)
    {
        $form = form8::with(['bencana'])->findOrFail($id);
        return view('forms.form8.show', compact('form'));
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
         $form = form8::where('bencana_id', $bencana_id)->latest()->get();
        
        return view('forms.form8.list', compact('bencana', 'form'));
    }

    /**
     * Generate PDF for form data
     */    
    public function generatePdf($id)
    {
        $form = form8::with(['bencana'])->findOrFail($id);
        
        $pdf = Pdf::loadView('forms.form8.pdf', compact('form'));
        return $pdf->download('Formulir_01_PDNA_' . $form->id . '.pdf');
    }   

    /**
     * Preview PDF without downloading
     */    
    public function previewPdf($id)
    {
        $form = form8::with(['bencana'])->findOrFail($id);
        
        $pdf = Pdf::loadView('forms.form8.pdf', compact('form'));
        return $pdf->stream('Formulir_01_PDNA_' . $form->id . '.pdf');
    }
    
    /**
     * Show the form for editing the specified form.
     */
    public function edit($id)
    {
        try {
            $form = form8::findOrFail($id);
            $bencana = Bencana::find($form->bencana_id);
            
            return view('forms.form8.edit', compact('form', 'bencana'));
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
            $form = form8::findOrFail($id);
            
            $validator = Validator::make($request->all(), [
            'bencana_id' => 'required|exists:bencana,id',
            'sektor_sub_sektor' => 'required|string|max:255',
            'komponen_kerusakan' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',

            // Data Kerusakan
            'data_kerusakan_rb' => 'nullable|integer|min:0',
            'data_kerusakan_rs' => 'nullable|integer|min:0',
            'data_kerusakan_rr' => 'nullable|integer|min:0',

            // Harga Satuan
            'harga_satuan_rb' => 'nullable|numeric|min:0',
            'harga_satuan_rs' => 'nullable|numeric|min:0',
            'harga_satuan_rr' => 'nullable|numeric|min:0',

            // Nilai Kerusakan
            'nilai_kerusakan_rb' => 'nullable|numeric|min:0',
            'nilai_kerusakan_rs' => 'nullable|numeric|min:0',
            'nilai_kerusakan_rr' => 'nullable|numeric|min:0',

            // Perkiraan Kerugian dan Total
            'perkiraan_kerugian' => 'nullable|numeric|min:0',
            'total_kerusakan_kerugian' => 'nullable|numeric|min:0',
            'kebutuhan' => 'nullable|numeric|min:0',

            // Dynamic rows data
            'dynamic_rows' => 'nullable|array',
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
            
            $form->update($request->all());
            
            return redirect()->route('forms.form8.show', $form->id)
                ->with('success', 'Formulir berhasil diperbarui.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }    
    }
    public function destroy($id)
    {
        try {
            $form = form8::findOrFail($id);
            $bencana_id = $form->bencana_id;
            $form->delete();
            
            return redirect()->route('forms.form8.list', ['bencana_id' => $bencana_id])
                ->with('success', 'Data Form 1 berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
public function contohPdf()
{
    $form = [
        [
            'sektor' => 'Pendidikan',
            'komponen' => 'Gedung SD',
            'lokasi' => 'Desa Sukamaju',
            'rb_kerusakan' => 2,
            'rs_kerusakan' => 1,
            'rr_kerusakan' => 0,
            'rb_harga' => 50000000,
            'rs_harga' => 30000000,
            'rr_harga' => 0,
            'rb_nilai' => 100000000,
            'rs_nilai' => 30000000,
            'rr_nilai' => 0,
            'kerugian' => 20000000,
            'total' => 150000000,
            'kebutuhan' => 160000000,
        ],
        [
            'sektor' => 'Kesehatan',
            'komponen' => 'Puskesmas',
            'lokasi' => 'Desa Sukamaju',
            'rb_kerusakan' => 1,
            'rs_kerusakan' => 0,
            'rr_kerusakan' => 1,
            'rb_harga' => 80000000,
            'rs_harga' => 0,
            'rr_harga' => 40000000,
            'rb_nilai' => 80000000,
            'rs_nilai' => 0,
            'rr_nilai' => 40000000,
            'kerugian' => 10000000,
            'total' => 130000000,
            'kebutuhan' => 140000000,
        ],
        // Tambah data lain sesuai kebutuhan
    ];
        $pdf = Pdf::loadView('forms.form8.contoh_form8_pdf', compact('form'));
        return $pdf->stream('Contoh_Formulir_08_PDNA.pdf');
}}
