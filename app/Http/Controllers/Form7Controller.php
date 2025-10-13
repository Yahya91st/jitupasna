<?php

namespace App\Http\Controllers;

use App\Models\Bencana;
use App\Models\Form7;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade\Pdf;

class Form7Controller extends Controller
{
    /**
     * Display the form for creating a new Form7.
     */
    public function index(Request $request)
    {
        $bencana_id = $request->query('bencana_id');
        $bencana = null;
        
        if ($bencana_id) {
            $bencana = Bencana::find($bencana_id);
        } else {
            $bencana = Bencana::all();
        }
        
        return view('forms.form7.form7', compact('bencana'));
    }
    
    /**
     * Store a newly created Form7 in database.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'bencana_id' => 'required|exists:bencana,id',
            'desa_kelurahan' => 'required|string|max:255',
            'kecamatan' => 'required|string|max:255',
            'kabupaten' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'jarak_bencana' => 'required|integer|min:0',
            'tempat_sesi' => 'required|string|max:255',
            'jumlah_peserta' => 'required|integer|min:1',
            'jumlah_perempuan' => 'required|integer|min:0',
            'jumlah_laki_laki' => 'required|integer|min:0',
            'komposisi_peserta' => 'required|string',
            'fasilitator' => 'required|string|max:255',
            'pencatat' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        // Process akses_hak details
        $aksesHak = '';
        if ($request->has('pertanyaan') && isset($request->pertanyaan['akses_hak'])) {
            $aksesHakPoints = [];
            if (isset($request->pertanyaan['akses_hak']['bekerja']) && !empty($request->pertanyaan['akses_hak']['bekerja'])) {
                $aksesHakPoints[] = "Bekerja: " . $request->pertanyaan['akses_hak']['bekerja'];
            }
            if (isset($request->pertanyaan['akses_hak']['jaminan_sosial']) && !empty($request->pertanyaan['akses_hak']['jaminan_sosial'])) {
                $aksesHakPoints[] = "Jaminan Sosial: " . $request->pertanyaan['akses_hak']['jaminan_sosial'];
            }
            if (isset($request->pertanyaan['akses_hak']['perlindungan_keluarga']) && !empty($request->pertanyaan['akses_hak']['perlindungan_keluarga'])) {
                $aksesHakPoints[] = "Perlindungan Keluarga: " . $request->pertanyaan['akses_hak']['perlindungan_keluarga'];
            }
            if (isset($request->pertanyaan['akses_hak']['pelayanan_kesehatan']) && !empty($request->pertanyaan['akses_hak']['pelayanan_kesehatan'])) {
                $aksesHakPoints[] = "Pelayanan Kesehatan: " . $request->pertanyaan['akses_hak']['pelayanan_kesehatan'];
            }
            if (isset($request->pertanyaan['akses_hak']['pendidikan']) && !empty($request->pertanyaan['akses_hak']['pendidikan'])) {
                $aksesHakPoints[] = "Pendidikan: " . $request->pertanyaan['akses_hak']['pendidikan'];
            }
            $aksesHak = implode("\n\n", $aksesHakPoints);
        }
        
        // Process fungsi_pranata details
        $fungsiPranata = '';
        if ($request->has('pertanyaan') && isset($request->pertanyaan['fungsi_pranata'])) {
            $fungsiPranataPoints = [];
            if (isset($request->pertanyaan['fungsi_pranata']['sosial']) && !empty($request->pertanyaan['fungsi_pranata']['sosial'])) {
                $fungsiPranataPoints[] = "Pranata Sosial: " . $request->pertanyaan['fungsi_pranata']['sosial'];
            }
            if (isset($request->pertanyaan['fungsi_pranata']['ekonomi']) && !empty($request->pertanyaan['fungsi_pranata']['ekonomi'])) {
                $fungsiPranataPoints[] = "Pranata Ekonomi: " . $request->pertanyaan['fungsi_pranata']['ekonomi'];
            }
            if (isset($request->pertanyaan['fungsi_pranata']['agama']) && !empty($request->pertanyaan['fungsi_pranata']['agama'])) {
                $fungsiPranataPoints[] = "Pranata Agama: " . $request->pertanyaan['fungsi_pranata']['agama'];
            }
            if (isset($request->pertanyaan['fungsi_pranata']['pemerintahan']) && !empty($request->pertanyaan['fungsi_pranata']['pemerintahan'])) {
                $fungsiPranataPoints[] = "Pranata Pemerintahan: " . $request->pertanyaan['fungsi_pranata']['pemerintahan'];
            }
            $fungsiPranata = implode("\n\n", $fungsiPranataPoints);
        }
        
        // Process resiko_kerentanan details
        $resikoKerentanan = '';
        if ($request->has('pertanyaan') && isset($request->pertanyaan['resiko_kerentanan'])) {
            $resikoKerentananPoints = [];
            if (isset($request->pertanyaan['resiko_kerentanan']['sosial']) && !empty($request->pertanyaan['resiko_kerentanan']['sosial'])) {
                $resikoKerentananPoints[] = "Kerentanan Sosial: " . $request->pertanyaan['resiko_kerentanan']['sosial'];
            }
            if (isset($request->pertanyaan['resiko_kerentanan']['ekonomi']) && !empty($request->pertanyaan['resiko_kerentanan']['ekonomi'])) {
                $resikoKerentananPoints[] = "Kerentanan Ekonomi: " . $request->pertanyaan['resiko_kerentanan']['ekonomi'];
            }
            if (isset($request->pertanyaan['resiko_kerentanan']['geografis']) && !empty($request->pertanyaan['resiko_kerentanan']['geografis'])) {
                $resikoKerentananPoints[] = "Kerentanan Geografis: " . $request->pertanyaan['resiko_kerentanan']['geografis'];
            }
            $resikoKerentanan = implode("\n\n", $resikoKerentananPoints);
        }
        
        $Form7 = new Form7();
        $Form7->bencana_id = $request->bencana_id;
        $Form7->desa_kelurahan = $request->desa_kelurahan;
        $Form7->kecamatan = $request->kecamatan;
        $Form7->kabupaten = $request->kabupaten;
        $Form7->tanggal = $request->tanggal;
        $Form7->jarak_bencana = $request->jarak_bencana;
        $Form7->tempat_sesi = $request->tempat_sesi;
        $Form7->jumlah_peserta = $request->jumlah_peserta;
        $Form7->jumlah_perempuan = $request->jumlah_perempuan;
        $Form7->jumlah_laki_laki = $request->jumlah_laki_laki;
        $Form7->komposisi_peserta = $request->komposisi_peserta;
        $Form7->fasilitator = $request->fasilitator;
        $Form7->pencatat = $request->pencatat;
        $Form7->akses_hak = $aksesHak;
        $Form7->fungsi_pranata = $fungsiPranata;
        $Form7->resiko_kerentanan = $resikoKerentanan;
        $Form7->created_by = Auth::id();
        $Form7->save();

        return redirect()->route('forms.form7.show', $Form7->id)->with('success', 'Data Form7 berhasil disimpan.');
    }
    
    /**
     * Display the specified Form7.
     */
    public function show($id)
    {
        $Form7 = Form7::with('bencana')->findOrFail($id);
        return view('forms.form7.show', compact('Form7'));
    }
    
    /**
     * Show the form for editing the specified Form7.
     */
    public function edit($id)
    {
        $Form7 = Form7::findOrFail($id);
        $bencana = Bencana::all();
        return view('forms.form7.edit', compact('Form7', 'bencana'));
    }
    
    /**
     * Update the specified Form7 in database.
     */
    public function update(Request $request, $id)
    {
        $Form7 = Form7::findOrFail($id);
        
        $validator = Validator::make($request->all(), [
            'bencana_id' => 'required|exists:bencana,id',
            'desa_kelurahan' => 'required|string|max:255',
            'kecamatan' => 'required|string|max:255',
            'kabupaten' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'jarak_bencana' => 'required|integer|min:0',
            'tempat_sesi' => 'required|string|max:255',
            'jumlah_peserta' => 'required|integer|min:1',
            'jumlah_perempuan' => 'required|integer|min:0',
            'jumlah_laki_laki' => 'required|integer|min:0',
            'komposisi_peserta' => 'required|string',
            'fasilitator' => 'required|string|max:255',
            'pencatat' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        // Process akses_hak details
        $aksesHak = '';
        if ($request->has('pertanyaan') && isset($request->pertanyaan['akses_hak'])) {
            $aksesHakPoints = [];
            if (isset($request->pertanyaan['akses_hak']['bekerja']) && !empty($request->pertanyaan['akses_hak']['bekerja'])) {
                $aksesHakPoints[] = "Bekerja: " . $request->pertanyaan['akses_hak']['bekerja'];
            }
            if (isset($request->pertanyaan['akses_hak']['jaminan_sosial']) && !empty($request->pertanyaan['akses_hak']['jaminan_sosial'])) {
                $aksesHakPoints[] = "Jaminan Sosial: " . $request->pertanyaan['akses_hak']['jaminan_sosial'];
            }
            if (isset($request->pertanyaan['akses_hak']['perlindungan_keluarga']) && !empty($request->pertanyaan['akses_hak']['perlindungan_keluarga'])) {
                $aksesHakPoints[] = "Perlindungan Keluarga: " . $request->pertanyaan['akses_hak']['perlindungan_keluarga'];
            }
            if (isset($request->pertanyaan['akses_hak']['pelayanan_kesehatan']) && !empty($request->pertanyaan['akses_hak']['pelayanan_kesehatan'])) {
                $aksesHakPoints[] = "Pelayanan Kesehatan: " . $request->pertanyaan['akses_hak']['pelayanan_kesehatan'];
            }
            if (isset($request->pertanyaan['akses_hak']['pendidikan']) && !empty($request->pertanyaan['akses_hak']['pendidikan'])) {
                $aksesHakPoints[] = "Pendidikan: " . $request->pertanyaan['akses_hak']['pendidikan'];
            }
            $aksesHak = implode("\n\n", $aksesHakPoints);
        }
        
        // Process fungsi_pranata details
        $fungsiPranata = '';
        if ($request->has('pertanyaan') && isset($request->pertanyaan['fungsi_pranata'])) {
            $fungsiPranataPoints = [];
            if (isset($request->pertanyaan['fungsi_pranata']['sosial']) && !empty($request->pertanyaan['fungsi_pranata']['sosial'])) {
                $fungsiPranataPoints[] = "Pranata Sosial: " . $request->pertanyaan['fungsi_pranata']['sosial'];
            }
            if (isset($request->pertanyaan['fungsi_pranata']['ekonomi']) && !empty($request->pertanyaan['fungsi_pranata']['ekonomi'])) {
                $fungsiPranataPoints[] = "Pranata Ekonomi: " . $request->pertanyaan['fungsi_pranata']['ekonomi'];
            }
            if (isset($request->pertanyaan['fungsi_pranata']['agama']) && !empty($request->pertanyaan['fungsi_pranata']['agama'])) {
                $fungsiPranataPoints[] = "Pranata Agama: " . $request->pertanyaan['fungsi_pranata']['agama'];
            }
            if (isset($request->pertanyaan['fungsi_pranata']['pemerintahan']) && !empty($request->pertanyaan['fungsi_pranata']['pemerintahan'])) {
                $fungsiPranataPoints[] = "Pranata Pemerintahan: " . $request->pertanyaan['fungsi_pranata']['pemerintahan'];
            }
            $fungsiPranata = implode("\n\n", $fungsiPranataPoints);
        }
        
        // Process resiko_kerentanan details
        $resikoKerentanan = '';
        if ($request->has('pertanyaan') && isset($request->pertanyaan['resiko_kerentanan'])) {
            $resikoKerentananPoints = [];
            if (isset($request->pertanyaan['resiko_kerentanan']['sosial']) && !empty($request->pertanyaan['resiko_kerentanan']['sosial'])) {
                $resikoKerentananPoints[] = "Kerentanan Sosial: " . $request->pertanyaan['resiko_kerentanan']['sosial'];
            }
            if (isset($request->pertanyaan['resiko_kerentanan']['ekonomi']) && !empty($request->pertanyaan['resiko_kerentanan']['ekonomi'])) {
                $resikoKerentananPoints[] = "Kerentanan Ekonomi: " . $request->pertanyaan['resiko_kerentanan']['ekonomi'];
            }
            if (isset($request->pertanyaan['resiko_kerentanan']['geografis']) && !empty($request->pertanyaan['resiko_kerentanan']['geografis'])) {
                $resikoKerentananPoints[] = "Kerentanan Geografis: " . $request->pertanyaan['resiko_kerentanan']['geografis'];
            }
            $resikoKerentanan = implode("\n\n", $resikoKerentananPoints);
        }

        $Form7->bencana_id = $request->bencana_id;
        $Form7->desa_kelurahan = $request->desa_kelurahan;
        $Form7->kecamatan = $request->kecamatan;
        $Form7->kabupaten = $request->kabupaten;
        $Form7->tanggal = $request->tanggal;
        $Form7->jarak_bencana = $request->jarak_bencana;
        $Form7->tempat_sesi = $request->tempat_sesi;
        $Form7->jumlah_peserta = $request->jumlah_peserta;
        $Form7->jumlah_perempuan = $request->jumlah_perempuan;
        $Form7->jumlah_laki_laki = $request->jumlah_laki_laki;
        $Form7->komposisi_peserta = $request->komposisi_peserta;
        $Form7->fasilitator = $request->fasilitator;
        $Form7->pencatat = $request->pencatat;
        $Form7->akses_hak = $aksesHak;
        $Form7->fungsi_pranata = $fungsiPranata;
        $Form7->resiko_kerentanan = $resikoKerentanan;
        $Form7->updated_by = Auth::id();
        $Form7->save();

        return redirect()->route('forms.form7.show', $Form7->id)->with('success', 'Data Form7 berhasil diperbarui.');
    }
    
    /**
     * Display a listing of Form7.
     */
    public function list(Request $request)
    {
        $bencana_id = $request->query('bencana_id');
        $query = Form7::with('bencana');
        
        if ($bencana_id) {
            $query->where('bencana_id', $bencana_id);
        }
        
        $Form7s = $query->orderBy('created_at', 'desc')->paginate(10);
        return view('forms.Form7.list', compact('Form7s'));
    }
    
    /**
     * Generate PDF document from Form7.
     */
    public function generatePdf($id)
    {
        $Form7 = Form7::with('bencana')->findOrFail($id);
        $pdf = PDF::loadView('forms.Form7.pdf', compact('Form7'));
        return $pdf->download('formulir-07-Form7-' . $Form7->id . '.pdf');
    }
    
    /**
     * Preview PDF document from Form7.
     */
    public function previewPdf($id)
    {
        $Form7 = Form7::with('bencana')->findOrFail($id);
        return view('forms.Form7.pdf', compact('Form7'));
    }
}
