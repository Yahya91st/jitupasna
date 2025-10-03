<?php

namespace App\Http\Controllers;

use App\Models\Bencana;
use App\Models\Form6;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class Form6Controller extends Controller
{
    /**
     * Display the form for creating a new Form6.
     */
    public function index()
    {
        $bencana = null;
        $bencana_id = request()->get('bencana_id');
        
        if ($bencana_id) {
            $bencana = Bencana::with('desa', 'kategori_bencana')->findOrFail($bencana_id);
        } else {
            return redirect()->route('bencana.index', ['source' => 'forms']);
        }
        
        return view('forms.form6.form6', compact('bencana'));
    }

    /**
     * Store a newly created Form6 in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'bencana_id' => 'required|exists:bencana,id'
        ]);

        try {
            DB::beginTransaction();
            
            $form6 = Form6::create($request->all());
            DB::commit();

            return redirect()->route('forms.form6.show', $form6->id)
                ->with('success', 'Data Form 6 berhasil disimpan');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Display the specified Form6.
     */
    public function show($id)
    {
        $form6 = Form6::with('bencana.desa', 'bencana.kategori_bencana')->findOrFail($id);
        return view('forms.form6.show', compact('form6'));
    }

    /**
     * Display a listing of Form6 for a specific bencana.
     */
    public function list()
    {
        $bencana = null;
        $form6List = collect();
        
        if (request()->has('bencana_id')) {
            $bencana_id = request()->get('bencana_id');
            $bencana = Bencana::with('desa', 'kategori_bencana')->find($bencana_id);
            
            if ($bencana) {
                $form6List = Form6::where('bencana_id', $bencana_id)->get();
            }
        }
        
        return view('forms.form6.list', compact('bencana', 'form6List'));
    }

    /**
     * Generate PDF for a Form6.
     */
    public function pdf($id)
    {
        $form6 = Form6::with('bencana.desa', 'bencana.kategori_bencana')->findOrFail($id);
        
        $pdf = Pdf::loadView('forms.form6.pdf', compact('form6'));
        return $pdf->download('Form6_' . $form6->id . '.pdf');
    }

    /**
     * Preview PDF for a Form6.
     */
    public function pdfPreview($id)
    {
        $form6 = Form6::with('bencana.desa', 'bencana.kategori_bencana')->findOrFail($id);
        
        $pdf = Pdf::loadView('forms.form6.pdf', compact('form6'));
        return $pdf->stream('Form6_' . $form6->id . '.pdf');
    }

    /**
     * Show the form for editing a Form6.
     */
    public function edit($id)
    {
        try {
            $form6 = Form6::findOrFail($id);
            $bencana = Bencana::with('desa', 'kategori_bencana')->find($form6->bencana_id);
            
            return view('forms.form6.form6', compact('form6', 'bencana'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }
    }

    /**
     * Update the specified Form6 in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $form6 = Form6::findOrFail($id);
            $form6->update($request->all());
            
            return redirect()->route('forms.form6.show', $form6->id)
                ->with('success', 'Data Form 6 berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified Form6 from storage.
     */
    public function destroy($id)
    {
        try {
            $form6 = Form6::findOrFail($id);
            $bencana_id = $form6->bencana_id;
            $form6->delete();
            
            return redirect()->route('forms.form6.list', ['bencana_id' => $bencana_id])
                ->with('success', 'Data Form 6 berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
