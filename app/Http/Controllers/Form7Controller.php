<?php

namespace App\Http\Controllers;

use App\Models\Bencana;
use App\Models\Fgd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade\Pdf;

class Form7Controller extends Controller
{
    /**
     * Display the form for creating a new FGD.
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
     * Store a newly created FGD in database.
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
        
        $fgd = new Fgd();
        $fgd->bencana_id = $request->bencana_id;
        $fgd->desa_kelurahan = $request->desa_kelurahan;
        $fgd->kecamatan = $request->kecamatan;
        $fgd->kabupaten = $request->kabupaten;
        $fgd->tanggal = $request->tanggal;
        $fgd->jarak_bencana = $request->jarak_bencana;
        $fgd->tempat_sesi = $request->tempat_sesi;
        $fgd->jumlah_peserta = $request->jumlah_peserta;
        $fgd->jumlah_perempuan = $request->jumlah_perempuan;
        $fgd->jumlah_laki_laki = $request->jumlah_laki_laki;
        $fgd->komposisi_peserta = $request->komposisi_peserta;
        $fgd->fasilitator = $request->fasilitator;
        $fgd->pencatat = $request->pencatat;
        $fgd->akses_hak = $aksesHak;
        $fgd->fungsi_pranata = $fungsiPranata;
        $fgd->resiko_kerentanan = $resikoKerentanan;
        $fgd->created_by = Auth::id();
        $fgd->save();

        return redirect()->route('forms.form7.show', $fgd->id)->with('success', 'Data FGD berhasil disimpan.');
    }
    
    /**
     * Display the specified FGD.
     */
    public function show($id)
    {
        $fgd = Fgd::with('bencana')->findOrFail($id);
        return view('forms.form7.show', compact('fgd'));
    }
    
    /**
     * Show the form for editing the specified FGD.
     */
    public function edit($id)
    {
        $fgd = Fgd::findOrFail($id);
        $bencana = Bencana::all();
        return view('forms.form7.edit', compact('fgd', 'bencana'));
    }
    
    /**
     * Update the specified FGD in database.
     */
    public function update(Request $request, $id)
    {
        $fgd = Fgd::findOrFail($id);
        
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

        $fgd->bencana_id = $request->bencana_id;
        $fgd->desa_kelurahan = $request->desa_kelurahan;
        $fgd->kecamatan = $request->kecamatan;
        $fgd->kabupaten = $request->kabupaten;
        $fgd->tanggal = $request->tanggal;
        $fgd->jarak_bencana = $request->jarak_bencana;
        $fgd->tempat_sesi = $request->tempat_sesi;
        $fgd->jumlah_peserta = $request->jumlah_peserta;
        $fgd->jumlah_perempuan = $request->jumlah_perempuan;
        $fgd->jumlah_laki_laki = $request->jumlah_laki_laki;
        $fgd->komposisi_peserta = $request->komposisi_peserta;
        $fgd->fasilitator = $request->fasilitator;
        $fgd->pencatat = $request->pencatat;
        $fgd->akses_hak = $aksesHak;
        $fgd->fungsi_pranata = $fungsiPranata;
        $fgd->resiko_kerentanan = $resikoKerentanan;
        $fgd->updated_by = Auth::id();
        $fgd->save();

        return redirect()->route('forms.form7.show', $fgd->id)->with('success', 'Data FGD berhasil diperbarui.');
    }
    
    /**
     * Display a listing of FGD.
     */
    public function listForm7(Request $request)
    {
        $bencana_id = $request->query('bencana_id');
        $query = Fgd::with('bencana');
        
        if ($bencana_id) {
            $query->where('bencana_id', $bencana_id);
        }
        
        $fgds = $query->orderBy('created_at', 'desc')->paginate(10);
        return view('forms.fgd.list', compact('fgds'));
    }
    
    /**
     * Generate PDF document from FGD.
     */
    public function generatePdf($id)
    {
        $fgd = Fgd::with('bencana')->findOrFail($id);
        $pdf = PDF::loadView('forms.fgd.pdf', compact('fgd'));
        return $pdf->download('formulir-07-fgd-' . $fgd->id . '.pdf');
    }
    
    /**
     * Preview PDF document from FGD.
     */
    public function previewPdf($id)
    {
        $fgd = Fgd::with('bencana')->findOrFail($id);
        return view('forms.fgd.pdf', compact('fgd'));
    }
}
