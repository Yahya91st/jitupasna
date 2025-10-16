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
            'jumlah_peserta' => 'required|integer|min:7',
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
        
        $form = new Form7();
        $form->bencana_id = $request->bencana_id;
        $form->desa_kelurahan = $request->desa_kelurahan;
        $form->kecamatan = $request->kecamatan;
        $form->kabupaten = $request->kabupaten;
        $form->tanggal = $request->tanggal;
        $form->jarak_bencana = $request->jarak_bencana;
        $form->tempat_sesi = $request->tempat_sesi;
        $form->jumlah_peserta = $request->jumlah_peserta;
        $form->jumlah_perempuan = $request->jumlah_perempuan;
        $form->jumlah_laki_laki = $request->jumlah_laki_laki;
        $form->komposisi_peserta = $request->komposisi_peserta;
        $form->fasilitator = $request->fasilitator;
        $form->pencatat = $request->pencatat;
        $form->akses_hak = $aksesHak;
        $form->fungsi_pranata = $fungsiPranata;
        $form->resiko_kerentanan = $resikoKerentanan;
        $form->created_by = Auth::id();
        $form->save();

        return redirect()->route('forms.form7.show', $form->id)->with('success', 'Data Form7 berhasil disimpan.');
    }
    
    /**
     * Display the specified Form7.
     */
    public function show($id)
    {
        $form = Form7::with('bencana')->findOrFail($id);
        return view('forms.form7.show', compact('form'));
    }
    
    /**
     * Display a listing of Form7.
     */
    public function list(Request $request)
    {
        $bencana_id = $request->input('bencana_id');
        
        if (!$bencana_id) {
            return redirect()->route('bencana.index', ['source' => 'forms']);
        }
        
        $bencana = Bencana::findOrFail($bencana_id);
         $form = Form7::where('bencana_id', $bencana_id)->latest()->get();
        
        return view('forms.form7.list', compact('bencana', 'form'));
    }

    /**
     * Generate PDF document from Form7.
     */
    public function generatePdf($id)
    {
        $form = Form7::with('bencana')->findOrFail($id);
        $pdf = PDF::loadView('forms.Form7.pdf', compact('Form'));
        return $pdf->download('formulir-07-Form7-' . $form->id . '.pdf');
    }
    
    /**
     * Preview PDF document from Form7.
     */
    public function previewPdf($id)
    {
        $form = Form7::with('bencana')->findOrFail($id);
        return view('forms.Form7.pdf', compact('form'));
    }
    
    /**
     * Show the form for editing the specified Form7.
     */
    public function edit($id)
    {
        $form = Form7::findOrFail($id);
        $bencana = Bencana::all();
        return view('forms.form7.edit', compact('form', 'bencana'));
    }
    
    /**
     * Update the specified Form7 in database.
     */
    public function update(Request $request, $id)
    {
        $form = Form7::findOrFail($id);
        
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

        $form->bencana_id = $request->bencana_id;
        $form->desa_kelurahan = $request->desa_kelurahan;
        $form->kecamatan = $request->kecamatan;
        $form->kabupaten = $request->kabupaten;
        $form->tanggal = $request->tanggal;
        $form->jarak_bencana = $request->jarak_bencana;
        $form->tempat_sesi = $request->tempat_sesi;
        $form->jumlah_peserta = $request->jumlah_peserta;
        $form->jumlah_perempuan = $request->jumlah_perempuan;
        $form->jumlah_laki_laki = $request->jumlah_laki_laki;
        $form->komposisi_peserta = $request->komposisi_peserta;
        $form->fasilitator = $request->fasilitator;
        $form->pencatat = $request->pencatat;
        $form->akses_hak = $aksesHak;
        $form->fungsi_pranata = $fungsiPranata;
        $form->resiko_kerentanan = $resikoKerentanan;
        $form->updated_by = Auth::id();
        $form->save();

        return redirect()->route('forms.form7.show', $form->id)->with('success', 'Data Form7 berhasil diperbarui.');
    }
    
    
    
    
    /**
     * Remove the specified Form7 from storage.
     */
    

    public function destroy($id)
    {
        try {
            $form = Form7::findOrFail($id);
            $bencana_id = $form->bencana_id;
            $form->delete();
            
            return redirect()->route('forms.form7.list', ['bencana_id' => $bencana_id])
                ->with('success', 'Data Form 7 berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
    public function contohPdf()
    {
        // Data dummy untuk contoh formulir
    $form = (object) [
        'desa_kelurahan' => 'Sukamaju',
        'kecamatan' => 'Cianjur',
        'kabupaten' => 'Cianjur',
        'tanggal' => '2025-10-16',
        'jarak_bencana' => '3 km',
        'tempat_sesi' => 'Balai Desa Sukamaju',
        'desa_sesi' => 'Sukamaju',
        'kec_sesi' => 'Cianjur',
        'jumlah_peserta' => 15,
        'jumlah_perempuan' => 7,
        'jumlah_laki_laki' => 8,
        'komposisi_peserta' => 'Petani, Ibu Rumah Tangga, Guru, Tokoh Masyarakat, Pemuda',
        'fasilitator' => 'Budi Santoso',
        'pencatat' => 'Siti Nurhaliza',
        'paraf_fasilitator' => 'BS',
        'paraf_pencatat' => 'SN',
        'persiapan_pra_fgd' => true,
        'pembagian_tugas' => true,
        'koordinasi_pengantar' => true,
        'pembahasan' => true,
        'pendalaman_tanya_jawab' => false,
        'penyimpulan_penutupan' => true,

        ];
        
        $pdf = Pdf::loadView('forms.form7.contoh_form7_pdf', compact('form'));
        return $pdf->stream('Contoh_Formulir_07_PDNA.pdf');
    }
}
