<?php

namespace App\Http\Controllers;

use App\Models\Form12;
use App\Models\Bencana;
use App\Models\IndeksBiaya;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade\Pdf;

class Form12Controller extends Controller
{
    /**
     * Display the form for creating a new Anggaran
     */
    public function index(Request $request)
    {
        $bencana_id = $request->query('bencana_id');
        $bencana = null;
        
        if ($bencana_id) {
            $bencana = Bencana::find($bencana_id);
        } else {
            $bencanas = Bencana::all();
            return view('forms.form12.form12', compact('bencanas'));
        }
        
        return view('forms.form12.form12', compact('bencana'));
    }
    
    /**
     * Store a newly created Anggaran in database
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'bencana_id' => 'required|exists:bencana,id',
            'sektor' => 'required|string|max:255',
            'komponen_kebutuhan' => 'required|string|max:255',
            'kegiatan' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'volume' => 'required|integer|min:1',
            'satuan' => 'required|string|max:50',
            'harga_satuan' => 'required|numeric|min:0',
            'keterangan' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Calculate jumlah
        $jumlah = $request->volume * $request->harga_satuan;

        $form12 = new Form12();
        $form12->bencana_id = $request->bencana_id;
        $form12->sektor = $request->sektor;
        $form12->komponen_kebutuhan = $request->komponen_kebutuhan;
        $form12->kegiatan = $request->kegiatan;
        $form12->lokasi = $request->lokasi;
        $form12->volume = $request->volume;
        $form12->satuan = $request->satuan;
        $form12->harga_satuan = $request->harga_satuan;
        $form12->jumlah = $jumlah;
        $form12->keterangan = $request->keterangan;
        $form12->created_by = Auth::id();
        $form12->save();

        return redirect()->route('forms.form12.show', $form12->id)->with('success', 'Data anggaran berhasil disimpan.');
    }
    
    /**
     * Display the specified Anggaran
     */
    public function show($id)
    {
        $form12 = Form12::with('bencana')->findOrFail($id);
        return view('forms.form12.show', compact('form12'));
    }
    
    /**
     * Show the form for editing the specified Anggaran
     */
    public function edit($id)
    {
        $form12 = Form12::findOrFail($id);
        $bencanas = Bencana::all();
        return view('forms.form12.edit', compact('form12', 'bencanas'));
    }
    
    /**
     * Update the specified Anggaran in database
     */
    public function update(Request $request, $id)
    {
        $form12 = Form12::findOrFail($id);
        
        $validator = Validator::make($request->all(), [
            'bencana_id' => 'required|exists:bencana,id',
            'sektor' => 'required|string|max:255',
            'komponen_kebutuhan' => 'required|string|max:255',
            'kegiatan' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'volume' => 'required|integer|min:1',
            'satuan' => 'required|string|max:50',
            'harga_satuan' => 'required|numeric|min:0',
            'keterangan' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        // Calculate total jumlah
        $jumlah = $request->volume * $request->harga_satuan;
        
        $form12->bencana_id = $request->bencana_id;
        $form12->sektor = $request->sektor;
        $form12->komponen_kebutuhan = $request->komponen_kebutuhan;
        $form12->kegiatan = $request->kegiatan;
        $form12->lokasi = $request->lokasi;
        $form12->volume = $request->volume;
        $form12->satuan = $request->satuan;
        $form12->harga_satuan = $request->harga_satuan;
        $form12->jumlah = $jumlah;
        $form12->keterangan = $request->keterangan;
        $form12->updated_by = Auth::id();
        $form12->save();

        return redirect()->route('forms.form12.show', $form12->id)->with('success', 'Data anggaran berhasil diperbarui.');
    }
    
    /**
     * Display a listing of Anggaran
     */
    public function list(Request $request)
    {
        $bencana_id = $request->query('bencana_id');
        $query = Form12::with('bencana');
        
        if ($bencana_id) {
            $bencana = Bencana::findOrFail($bencana_id);
            $query->where('bencana_id', $bencana_id);
            $form12List = $query->orderBy('created_at', 'desc')->get();
            return view('forms.form12.list', compact('form12List', 'bencana'));
        }
        
        $form12List = $query->orderBy('created_at', 'desc')->paginate(10);
        return view('forms.form12.list', compact('form12List'));
    }
    
    /**
     * Generate PDF document from Form12
     */
    public function generatePdf($id)
    {
        $form12 = Form12::with('bencana')->findOrFail($id);
        $pdf = PDF::loadView('forms.form12.pdf', compact('form12'));
        return $pdf->download('formulir-12-anggaran-' . $form12->id . '.pdf');
    }
    
    /**
     * Preview PDF document from Form12
     */
    public function previewPdf($id)
    {
        $form12 = Form12::with('bencana')->findOrFail($id);
        return view('forms.form12.pdf', compact('form12'));
    }
    
    /**
     * Display the form for creating a new IndeksBiaya
     */
    public function indexIndeks()
    {
        $indeksBiaya = IndeksBiaya::orderBy('provinsi')->get();
        return view('forms.form12.indeks', compact('indeksBiaya'));
    }
    
    /**
     * Store a newly created IndeksBiaya in database
     */
    public function storeIndeks(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'provinsi' => 'required|string|max:255',
            'kota' => 'required|string|max:255',
            'indeks_umum' => 'required|numeric|min:0',
            'indeks_perumahan' => 'required|numeric|min:0',
            'indeks_kesehatan' => 'required|numeric|min:0',
            'indeks_pendidikan' => 'required|numeric|min:0',
            'indeks_sosial' => 'nullable|numeric|min:0',
            'indeks_ekonomi' => 'nullable|numeric|min:0',
            'indeks_infrastruktur' => 'nullable|numeric|min:0',
            'indeks_pemerintahan' => 'nullable|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $indeksBiaya = new IndeksBiaya();
        $indeksBiaya->provinsi = $request->provinsi;
        $indeksBiaya->kota = $request->kota;
        $indeksBiaya->indeks_umum = $request->indeks_umum;
        $indeksBiaya->indeks_perumahan = $request->indeks_perumahan;
        $indeksBiaya->indeks_kesehatan = $request->indeks_kesehatan;
        $indeksBiaya->indeks_pendidikan = $request->indeks_pendidikan;
        $indeksBiaya->indeks_sosial = $request->indeks_sosial;
        $indeksBiaya->indeks_ekonomi = $request->indeks_ekonomi;
        $indeksBiaya->indeks_infrastruktur = $request->indeks_infrastruktur;
        $indeksBiaya->indeks_pemerintahan = $request->indeks_pemerintahan;
        $indeksBiaya->created_by = Auth::id();
        $indeksBiaya->save();

        return redirect()->route('forms.form12.indeks')->with('success', 'Data indeks biaya berhasil disimpan.');
    }
    
    /**
     * Show the form for editing the specified IndeksBiaya
     */
    public function editIndeks($id)
    {
        $indeksBiaya = IndeksBiaya::findOrFail($id);
        return view('forms.form12.edit-indeks', compact('indeksBiaya'));
    }
    
    /**
     * Update the specified IndeksBiaya in database
     */
    public function updateIndeks(Request $request, $id)
    {
        $indeksBiaya = IndeksBiaya::findOrFail($id);
        
        $validator = Validator::make($request->all(), [
            'provinsi' => 'required|string|max:255',
            'kota' => 'required|string|max:255',
            'indeks_umum' => 'required|numeric|min:0',
            'indeks_perumahan' => 'required|numeric|min:0',
            'indeks_kesehatan' => 'required|numeric|min:0',
            'indeks_pendidikan' => 'required|numeric|min:0',
            'indeks_sosial' => 'nullable|numeric|min:0',
            'indeks_ekonomi' => 'nullable|numeric|min:0',
            'indeks_infrastruktur' => 'nullable|numeric|min:0',
            'indeks_pemerintahan' => 'nullable|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $indeksBiaya->provinsi = $request->provinsi;
        $indeksBiaya->kota = $request->kota;
        $indeksBiaya->indeks_umum = $request->indeks_umum;
        $indeksBiaya->indeks_perumahan = $request->indeks_perumahan;
        $indeksBiaya->indeks_kesehatan = $request->indeks_kesehatan;
        $indeksBiaya->indeks_pendidikan = $request->indeks_pendidikan;
        $indeksBiaya->indeks_sosial = $request->indeks_sosial;
        $indeksBiaya->indeks_ekonomi = $request->indeks_ekonomi;
        $indeksBiaya->indeks_infrastruktur = $request->indeks_infrastruktur;
        $indeksBiaya->indeks_pemerintahan = $request->indeks_pemerintahan;
        $indeksBiaya->updated_by = Auth::id();
        $indeksBiaya->save();

        return redirect()->route('forms.form12.indeks')->with('success', 'Data indeks biaya berhasil diperbarui.');
    }
    
    /**
     * Delete the specified IndeksBiaya from database
     */
    public function destroy($id)
    {
        try {
            $form12 = Form12::findOrFail($id);
            $bencana_id = $form12->bencana_id;
            $form12->delete();
            
            return redirect()->route('forms.form12.list', ['bencana_id' => $bencana_id])
                ->with('success', 'Data Form 12 berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
