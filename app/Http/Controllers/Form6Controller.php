<?php

namespace App\Http\Controllers;

use App\Models\Bencana;
use App\Models\Form6;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade\Pdf;

class Form6Controller extends Controller
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
        
        return view('forms.form6.form6', compact('bencana'));
    }

    /**
     * Store a new form submission
     */
    public function store(Request $request)
    {      
        $validator = Validator::make($request->all(), [
            'bencana_id' => 'required|exists:bencana,id',

            // Pengumpulan data
            'enumerator' => 'required|string|max:100',
            'tgl_wawancara' => 'required|date',
            'paraf_enum' => 'nullable|string|max:100',

            // Perekaman data
            'data_entry' => 'required|string|max:100',
            'tgl_entry' => 'required|date',
            'paraf_entry' => 'nullable|string|max:100',

            // Informasi Umum Responden
            'responden_l' => 'required|boolean',
            'responden_p' => 'required|boolean',

            // Umur responden
            'umur_20' => 'required|boolean',
            'umur_21_30' => 'required|boolean',
            'umur_31_40' => 'required|boolean',
            'umur_41_50' => 'required|boolean',
            'umur_50plus' => 'required|boolean',

            'nama' => 'required|string|max:100',
            'desa' => 'required|string|max:100',
            'kecamatan' => 'required|string|max:100',
            'kabupaten' => 'required|string|max:100',

            // Pendidikan terakhir
            'pend_sd' => 'required|boolean',
            'pend_sltp' => 'required|boolean',
            'pend_slta' => 'required|boolean',
            'pend_pt' => 'required|boolean',

            // Kepala rumah tangga perempuan
            'krt_perempuan_ya' => 'required|boolean',
            'krt_perempuan_tidak' => 'required|boolean',

            // Jumlah anggota keluarga berdasarkan umur
            'anggota_0_5' => 'required|integer|min:0',
            'anggota_6_17' => 'required|integer|min:0',
            'anggota_18_59' => 'required|integer|min:0',
            'anggota_60plus' => 'required|integer|min:0',

            // Status rumah
            'rumah_milik_sendiri' => 'required|boolean',
            'rumah_sewa' => 'required|boolean',
            'rumah_menumpang' => 'required|boolean',

            // Kondisi rumah sebelum bencana
            'kondisi_baik' => 'required|boolean',
            'kondisi_rusak_ringan' => 'required|boolean',
            'kondisi_rusak_sedang' => 'required|boolean',
            'kondisi_rusak_berat' => 'required|boolean',

            // Kerusakan akibat bencana
            'kerusakan_tidak_ada' => 'required|boolean',
            'kerusakan_ringan' => 'required|boolean',
            'kerusakan_sedang' => 'required|boolean',
            'kerusakan_berat' => 'required|boolean',
            'kerusakan_hancur' => 'required|boolean',

            // Status tempat tinggal saat ini
            'tinggal_rumah_sendiri' => 'required|boolean',
            'tinggal_rumah_saudara' => 'required|boolean',
            'tinggal_mengungsi' => 'required|boolean',
            'tinggal_tenda' => 'required|boolean',

            // Penghasilan per bulan sebelum bencana
            'penghasilan_suami' => 'nullable|integer|min:0',
            'bidang_suami' => 'nullable|string|max:100',
            'penghasilan_istri' => 'nullable|integer|min:0',
            'bidang_istri' => 'nullable|string|max:100',
            'penghasilan_lainnya' => 'nullable|integer|min:0',
            'bidang_lainnya' => 'nullable|string|max:100',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $form = Form6::create($request->all());

        return redirect()->route('forms.form6.show', $form->id)
            ->with('success', 'Formulir berhasil disimpan.');
    }

    /**
     * Display a specific form entry     */    
    public function show($id)
    {
        $form = Form6::with(['bencana'])->findOrFail($id);
        return view('forms.form6.show', compact('form'));
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
        $form = Form6::where('bencana_id', $bencana_id)->latest()->get();
        
        return view('forms.form6.list', compact('bencana', 'form'));
    }

    /**
     * Generate PDF for form data
     */    
    public function generatePdf($id)
    {
        $form = Form6::with(['bencana'])->findOrFail($id);
        
        $pdf = Pdf::loadView('forms.form6.pdf', compact('form'));
        return $pdf->download('Formulir_06_PDNA_' . $form->id . '.pdf');
    }   

    /**
     * Preview PDF without downloading
     */    
    public function previewPdf($id)
    {
        $form = Form6::with(['bencana'])->findOrFail($id);
                
        $pdf = Pdf::loadView('forms.form6.pdf', compact('form'));
        return $pdf->stream('Formulir_06_PDNA_' . $form->id . '.pdf');
    }

    /**
     * Show the form for editing the specified form.
     */
    public function edit($id)
    {
        try {
            $form = Form6::findOrFail($id);
            $bencana = Bencana::find($form->bencana_id);
            
            return view('forms.form6.edit', compact('form', 'bencana'));
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
            $form = Form6::findOrFail($id);
            
            $validator = Validator::make($request->all(), [
                'kop_surat' => 'nullable|string|max:255',
                'nomor_surat' => 'required|string|max:255',
                'nomor_surat_date' => 'required|date',
                'sifat' => 'required|in:Segera,Biasa,Rahasia',
                'lampiran' => 'nullable|integer|min:0',
                'kepada_jabatan' => 'required|string',
                'lokasi_pdna' => 'required|string|max:255',
                'hari_tanggal' => 'required|string|max:255',
                'waktu' => 'required|string|max:255',
                'tempat' => 'required|string|max:255',
                'agenda' => 'required|string',
                'nama_penandatangan' => 'required|string|max:255',
                'tembusan' => 'nullable|string',
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
            
            $form->update($request->all());
            
            return redirect()->route('forms.form6.show', $form->id)
                ->with('success', 'Formulir berhasil diperbarui.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }    
    }

    public function destroy($id)
    {
        try {
            $form = Form6::findOrFail($id);
            $bencana_id = $form->bencana_id;
            $form->delete();
            
            return redirect()->route('forms.form6.list', ['bencana_id' => $bencana_id])
                ->with('success', 'Data Form 6 berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Generate contoh PDF dengan data dummy
     */
    public function contohPdf()
    {
        // Data dummy untuk contoh formulir
        $form = (object) [
            // Pengumpulan Data
            'enumerator' => 'Budi Santoso',
            'tgl_wawancara' => '2025-10-15',
            'paraf_enum' => 'BS',
            'data_entry' => 'Siti Nurhaliza',
            'tgl_entry' => '2025-10-15',
            'paraf_entry' => 'SN',
            
            // Informasi Umum
            'responden' => 'l',
            'umur' => '41_50',
            'nama' => 'Ahmad Wijaya',
            'desa' => 'Sukamaju',
            'kecamatan' => 'Cianjur',
            'kabupaten' => 'Cianjur',
            'pendidikan' => 'slta',
            'krt_perempuan' => 'tidak',
            'jumlah_anggota' => '3_5',
            'jumlah_anak' => '2',
            'jumlah_balita' => '1',
            'tipe_hunian' => 'tumpangan',
            
            // Pertanyaan (gunakan array untuk checkbox yang bisa multiple)
            'nafkah_pre' => ['suami', 'istri'],
            'nafkah_post' => ['suami'],
            'sumber_penghasilan' => ['pertanian', 'dagang', 'jasa'],
            'penghasilan_hilang' => 'ada',
            'bantuan_pencaharian' => ['modal', 'pasar'],
            'cadangan' => ['tabungan', 'barang'],
            'dukungan_cadangan' => ['koperasi', 'pinjaman'],
            'perlindungan' => 'sama',
            'bantuan_perlindungan' => ['penyuluhan', 'polisi'],
            'masalah_rumah' => ['rusak'],
            'tindakan_rumah' => ['stimulus', 'teknis'],
            'perkiraan_tinggal' => 'rumah_asal',
            'cara_makanan' => ['bantuan', 'cadangan'],
            'dukungan_pangan' => ['langsung'],
            'masalah_air' => ['kurang'],
            'dukungan_air' => ['sedia', 'simpan'],
            'pelayanan_kesehatan' => 'tidak',
            'perbaikan_kesehatan' => ['obat', 'medis'],
            'sekolah_terganggu' => 'ya',
            'dukungan_pendidikan' => ['alat', 'biaya'],
            'agama_terganggu' => 'tidak',
            'dukungan_agama' => ['stimulus'],
            'pencegahan' => ['info', 'latih'],
            'kelompok_butuh' => ['anak', 'lansia'],
            
            // Penghasilan
            'penghasilan_suami' => 'Rp 3.000.000',
            'bidang_suami' => 'Pertanian',
            'penghasilan_istri' => 'Rp 1.500.000',
            'bidang_istri' => 'Dagang',
            'penghasilan_lainnya' => '-',
            'bidang_lainnya' => '-',
        ];
        
        $pdf = Pdf::loadView('forms.form6.contoh_form6_pdf', compact('form'));
        return $pdf->stream('Contoh_Formulir_06_PDNA.pdf');
    }
}