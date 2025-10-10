<?php

namespace App\Http\Controllers;

use App\Models\Form10;
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

        $form10 = new Form10();
        $form10->bencana_id = $request->bencana_id;
        $form10->sektor = $request->sektor;
        $form10->sub_sektor = $request->sub_sektor;
        $form10->lokasi = $request->lokasi;
        $form10->hasil_survey = $request->hasil_survey;
        $form10->hasil_wawancara = $request->hasil_wawancara;
        $form10->hasil_pendataan_skpd = $request->hasil_pendataan_skpd;
        $form10->kebutuhan_pemulihan = $request->kebutuhan_pemulihan;
        $form10->created_by = Auth::id();
        $form10->save();

        return redirect()->route('forms.form10.show', ['id' => $form10->id])->with('success', 'Data analisa berhasil disimpan.');
    }
    
    /**
     * Display the specified Analisa
     */
    public function show($id)
    {
        $form10 = Form10::with('bencana')->findOrFail($id);
        return view('forms.form10.show', compact('form10'));
    }
    
    /**
     * Show the form for editing the specified Analisa
     */
    public function edit($id)
    {
        $form10 = Form10::findOrFail($id);
        $bencanas = Bencana::all();
        return view('forms.form10.edit', compact('form10', 'bencanas'));
    }
    
    /**
     * Update the specified Analisa in database
     */
    public function update(Request $request, $id)
    {
        $form10 = Form10::findOrFail($id);
        
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

        $form10->bencana_id = $request->bencana_id;
        $form10->sektor = $request->sektor;
        $form10->sub_sektor = $request->sub_sektor;
        $form10->lokasi = $request->lokasi;
        $form10->hasil_survey = $request->hasil_survey;
        $form10->hasil_wawancara = $request->hasil_wawancara;
        $form10->hasil_pendataan_skpd = $request->hasil_pendataan_skpd;
        $form10->kebutuhan_pemulihan = $request->kebutuhan_pemulihan;
        $form10->updated_by = Auth::id();
        $form10->save();

        return redirect()->route('forms.form10.show', $form10->id)->with('success', 'Data analisa berhasil diperbarui.');
    }
    
    /**
     * Display a listing of Analisa
     */
    public function list(Request $request)
    {
        $bencana_id = $request->query('bencana_id');
        $query = Form10::with('bencana');
        
        if ($bencana_id) {
            $bencana = Bencana::findOrFail($bencana_id);
            $query->where('bencana_id', $bencana_id);
            $form10List = $query->orderBy('created_at', 'desc')->get();
            return view('forms.form10.list', compact('form10List', 'bencana'));
        }
        
        $form10List = $query->orderBy('created_at', 'desc')->paginate(10);
        return view('forms.form10.list', compact('form10List'));
    }
    
    /**
     * Generate PDF document from Form10
     */
    public function generatePdf($id)
    {
        $form10 = Form10::with('bencana')->findOrFail($id);
        $pdf = PDF::loadView('forms.form10.pdf', compact('form10'));
        $pdf->setPaper('a4', 'landscape');
        return $pdf->download('formulir-10-analisa-' . $form10->id . '.pdf');
    }
    
    /**
     * Preview PDF document from Form10
     */
    public function previewPdf($id)
    {
        $form10 = Form10::with('bencana')->findOrFail($id);
        $pdf = PDF::loadView('forms.form10.pdf', compact('form10'));
        $pdf->setPaper('a4', 'landscape');
        return $pdf->stream('formulir-10-analisa-' . $form10->id . '.pdf');
    }
}
