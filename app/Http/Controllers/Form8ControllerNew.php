<?php

namespace App\Http\Controllers;

use App\Models\Form8;
use App\Models\Bencana;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class Form8ControllerNew extends Controller
{
    /**
     * Display the form for creating a new Form8.
     */
    public function index(Request $request)
    {
        $bencana_id = $request->input('bencana_id');
        
        if (!$bencana_id) {
            return redirect()->route('bencana.index', ['source' => 'forms']);
        }
          
        $bencana = Bencana::findOrFail($bencana_id);
        
        return view('forms.form8.form8', compact('bencana'));
    }

    /**
     * Store a newly created Form8 in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'bencana_id' => 'required|exists:bencana,id'
        ]);

        try {
            DB::beginTransaction();
            
            $form8 = Form8::create($request->all());
            DB::commit();

            return redirect()->route('forms.form8.show', $form8->id)
                ->with('success', 'Data Form 8 berhasil disimpan');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Display the specified Form8.
     */
    public function show($id)
    {
        $form8 = Form8::with('bencana.desa', 'bencana.kategori_bencana')->findOrFail($id);
        return view('forms.form8.show', compact('form8'));
    }

    /**
     * Display a listing of Form8 for a specific bencana.
     */
    public function list()
    {
        $bencana = null;
        $form8List = collect();
        
        if (request()->has('bencana_id')) {
            $bencana_id = request()->get('bencana_id');
            $bencana = Bencana::with('desa', 'kategori_bencana')->find($bencana_id);
            
            if ($bencana) {
                $form8List = Form8::where('bencana_id', $bencana_id)->get();
            }
        }
        
        return view('forms.form8.list', compact('bencana', 'form8List'));
    }

    /**
     * Generate PDF for a Form8.
     */
    public function pdf($id)
    {
        $form8 = Form8::with('bencana.desa', 'bencana.kategori_bencana')->findOrFail($id);
        
        $pdf = Pdf::loadView('forms.form8.pdf', compact('form8'));
        return $pdf->download('Form8_' . $form8->id . '.pdf');
    }

    /**
     * Preview PDF for a Form8.
     */
    public function pdfPreview($id)
    {
        $form8 = Form8::with('bencana.desa', 'bencana.kategori_bencana')->findOrFail($id);
        
        $pdf = Pdf::loadView('forms.form8.pdf', compact('form8'));
        return $pdf->stream('Form8_' . $form8->id . '.pdf');
    }

    /**
     * Show the form for editing a Form8.
     */
    public function edit($id)
    {
        try {
            $form8 = Form8::findOrFail($id);
            $bencana = Bencana::with('desa', 'kategori_bencana')->find($form8->bencana_id);
            
            return view('forms.form8.form8', compact('form8', 'bencana'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }
    }

    /**
     * Update the specified Form8 in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $form8 = Form8::findOrFail($id);
            $form8->update($request->all());
            
            return redirect()->route('forms.form8.show', $form8->id)
                ->with('success', 'Data Form 8 berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified Form8 from storage.
     */
    public function destroy($id)
    {
        try {
            $form8 = Form8::findOrFail($id);
            $bencana_id = $form8->bencana_id;
            $form8->delete();
            
            return redirect()->route('forms.form8.list', ['bencana_id' => $bencana_id])
                ->with('success', 'Data Form 8 berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
