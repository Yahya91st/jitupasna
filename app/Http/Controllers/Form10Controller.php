<?php

namespace App\Http\Controllers;

use App\Models\Analisa;
use App\Models\Bencana;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade\Pdf;

class Form10Controller extends Controller
{
    /**
     * Display the form for creating a new Analisa
     */
    public function index(Request $request)
    {
        $bencana_id = $request->query('bencana_id');
        $bencana = null;
        
        if ($bencana_id) {
            $bencana = Bencana::find($bencana_id);
        } else {
            $bencanas = Bencana::all();
            return view('forms.form10.form10', compact('bencanas'));
        }
        
        return view('forms.form10.form10', compact('bencana'));
    }
    
    /**
     * Store a newly created Analisa in database
     */
    public function store(Request $request)
    {
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
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $analisa = new Analisa();
        $analisa->bencana_id = $request->bencana_id;
        $analisa->sektor = $request->sektor;
        $analisa->sub_sektor = $request->sub_sektor;
        $analisa->lokasi = $request->lokasi;
        $analisa->hasil_survey = $request->hasil_survey;
        $analisa->hasil_wawancara = $request->hasil_wawancara;
        $analisa->hasil_pendataan_skpd = $request->hasil_pendataan_skpd;
        $analisa->kebutuhan_pemulihan = $request->kebutuhan_pemulihan;
        $analisa->created_by = Auth::id();
        $analisa->save();

        return redirect()->route('forms.form10.show', ['id' => $analisa->id])->with('success', 'Data analisa berhasil disimpan.');
    }
    
    /**
     * Display the specified Analisa
     */
    public function show($id)
    {
        $analisa = Analisa::with('bencana')->findOrFail($id);
        return view('forms.form10.show', compact('analisa'));
    }
    
    /**
     * Show the form for editing the specified Analisa
     */
    public function edit($id)
    {
        $analisa = Analisa::findOrFail($id);
        $bencanas = Bencana::all();
        return view('forms.form10.edit', compact('analisa', 'bencanas'));
    }
    
    /**
     * Update the specified Analisa in database
     */
    public function update(Request $request, $id)
    {
        $analisa = Analisa::findOrFail($id);
        
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
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $analisa->bencana_id = $request->bencana_id;
        $analisa->sektor = $request->sektor;
        $analisa->sub_sektor = $request->sub_sektor;
        $analisa->lokasi = $request->lokasi;
        $analisa->hasil_survey = $request->hasil_survey;
        $analisa->hasil_wawancara = $request->hasil_wawancara;
        $analisa->hasil_pendataan_skpd = $request->hasil_pendataan_skpd;
        $analisa->kebutuhan_pemulihan = $request->kebutuhan_pemulihan;
        $analisa->updated_by = Auth::id();
        $analisa->save();

        return redirect()->route('forms.form10.show', $analisa->id)->with('success', 'Data analisa berhasil diperbarui.');
    }
    
    /**
     * Display a listing of Analisa
     */
    public function listForm10(Request $request)
    {
        $bencana_id = $request->query('bencana_id');
        $query = Analisa::with('bencana');
        
        if ($bencana_id) {
            $bencana = Bencana::findOrFail($bencana_id);
            $query->where('bencana_id', $bencana_id);
            $analisaList = $query->orderBy('created_at', 'desc')->get();
            return view('forms.form10.list', compact('analisaList', 'bencana'));
        }
        
        $analisaList = $query->orderBy('created_at', 'desc')->paginate(10);
        return view('forms.form10.list', compact('analisaList'));
    }
    
    /**
     * Generate PDF document from Analisa
     */
    public function generatePdf($id)
    {
        $analisa = Analisa::with('bencana')->findOrFail($id);
        $pdf = PDF::loadView('forms.form10.pdf', compact('analisa'));
        $pdf->setPaper('a4', 'landscape');
        return $pdf->download('formulir-10-analisa-' . $analisa->id . '.pdf');
    }
    
    /**
     * Preview PDF document from Analisa
     */
    public function previewPdf($id)
    {
        $analisa = Analisa::with('bencana')->findOrFail($id);
        $pdf = PDF::loadView('forms.form10.pdf', compact('analisa'));
        $pdf->setPaper('a4', 'landscape');
        return $pdf->stream('formulir-10-analisa-' . $analisa->id . '.pdf');
    }
}
