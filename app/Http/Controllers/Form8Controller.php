<?php

namespace App\Http\Controllers;

use App\Models\Form8;
use App\Models\Form8Row;
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
        
        $rows = [];
        for ($i = 1; $i <= 15; $i++) {
            $row = [
                'sektor_sub_sektor' => $request->input("sektor/subsektor_$i"),
                'komponen_kerusakan' => $request->input("komponen_kerusakan_dan_kerugian_$i"),
                'lokasi' => $request->input("lokasi_$i"),
                'data_kerusakan_rb' => $request->input("data_kerusakan_rb_$i"),
                'data_kerusakan_rs' => $request->input("data_kerusakan_rs_$i"),
                'data_kerusakan_rr' => $request->input("data_kerusakan_rr_$i"),
                'harga_satuan_rb' => $request->input("harga_satuan_rb_$i"),
                'harga_satuan_rs' => $request->input("harga_satuan_rs_$i"),
                'harga_satuan_rr' => $request->input("harga_satuan_rr_$i"),
                'nilai_kerusakan_rb' => $request->input("nilai_kerusakan_rb_$i"),
                'nilai_kerusakan_rs' => $request->input("nilai_kerusakan_rs_$i"),
                'nilai_kerusakan_rr' => $request->input("nilai_kerusakan_rr_$i"),
                'perkiraan_kerugian' => $request->input("perkiraan_kerugian_$i"),
                'jumlah_kerusakan_kerugian' => $request->input("jumlah_kerusakan_kerugian_$i"),
                'kebutuhan' => $request->input("kebutuhan_$i"),
            ];
            if (array_filter($row)) {
                $validator = Validator::make($row, [
                    'sektor_sub_sektor' => 'required|string|max:255',
                    'komponen_kerusakan' => 'required|string|max:255',
                    'lokasi' => 'required|string|max:255',
                    // ... validasi field lain ...
                ]);
                if ($validator->fails()) {
                    return back()->withErrors($validator)->withInput();
                }
                $rows[] = $row;
            }
        }

        // Jika validasi lolos, baru simpan data utama dan detail
        $form = Form8::create([
            'bencana_id' => $request->bencana_id,
            'tanggal' => $request->tanggal,
            'keterangan' => $request->keterangan,
        ]);
        foreach ($rows as $row) {
            $row['form8_id'] = $form->id;
            Form8Row::create($row);
        }


        return redirect()->route('forms.form8.show', $form->id)->with('success', 'Data berhasil disimpan!');    
    }
           
    
    /**
     * Display a specific form entry     */    
    public function show($id)
    {
        $form = Form8::with(['bencana', 'rows'])->findOrFail($id);
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
        $form = Form8::where('bencana_id', $bencana_id)->latest()->get();
        return view('forms.form8.list', compact('bencana', 'form'));
    }

    /**
     * Generate PDF for form data
     */    
public function generatePdf($id)
    {
        $form = Form8::with('rows')->findOrFail($id);

        $rows = $form->rows->map(function($row) {
            return [
                'sektor' => $row->sektor_sub_sektor,
                'komponen' => $row->komponen_kerusakan,
                'lokasi' => $row->lokasi,
                'rb_kerusakan' => $row->data_kerusakan_rb,
                'rs_kerusakan' => $row->data_kerusakan_rs,
                'rr_kerusakan' => $row->data_kerusakan_rr,
                'rb_harga' => $row->harga_satuan_rb,
                'rs_harga' => $row->harga_satuan_rs,
                'rr_harga' => $row->harga_satuan_rr,
                'rb_nilai' => $row->nilai_kerusakan_rb,
                'rs_nilai' => $row->nilai_kerusakan_rs,
                'rr_nilai' => $row->nilai_kerusakan_rr,
                'kerugian' => $row->perkiraan_kerugian,
                'total' => $row->jumlah_kerusakan_kerugian,
                'kebutuhan' => $row->kebutuhan,
            ];
        })->toArray();

        // kirim kedua variabel, gunakan nama jelas
        $pdf = Pdf::loadView('forms.form8.pdf', [
            'formModel' => $form,
            'rows' => $rows,
        ]);

        return $pdf->download('Formulir_08_PDNA_' . $form->id . '.pdf');
    }


    /**
     * Preview PDF without downloading
     */    
    public function previewPdf($id)
    {
        $form = Form8::with('rows')->findOrFail($id);

        $rows = $form->rows->map(function($row) {
            return [
                'sektor' => $row->sektor_sub_sektor,
                'komponen' => $row->komponen_kerusakan,
                'lokasi' => $row->lokasi,
                'rb_kerusakan' => $row->data_kerusakan_rb,
                'rs_kerusakan' => $row->data_kerusakan_rs,
                'rr_kerusakan' => $row->data_kerusakan_rr,
                'rb_harga' => $row->harga_satuan_rb,
                'rs_harga' => $row->harga_satuan_rs,
                'rr_harga' => $row->harga_satuan_rr,
                'rb_nilai' => $row->nilai_kerusakan_rb,
                'rs_nilai' => $row->nilai_kerusakan_rs,
                'rr_nilai' => $row->nilai_kerusakan_rr,
                'kerugian' => $row->perkiraan_kerugian,
                'total' => $row->jumlah_kerusakan_kerugian,
                'kebutuhan' => $row->kebutuhan,
            ];
        })->toArray();

        // kirim kedua variabel, gunakan nama jelas
        $pdf = Pdf::loadView('forms.form8.pdf', [
            'formModel' => $form,
            'rows' => $rows,
        ]);

        return $pdf->stream('Formulir_08_PDNA_' . $form->id . '.pdf');
    }
    
    /**
     * Show the form for editing the specified form.
     */
    public function edit($id)
    {
        
    }
    
    /**
     * Update the specified form in database.
     */
    public function update(Request $request, $id)
    {
        
    }
    public function destroy($id)
    {
        
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
    }

    /**
     * Show format menu
     */
    public function formatMenu()
    {
        // Get summary data for display
        $totalForms = Form8::count();
        $totalRows = Form8Row::count();
        $totalKebutuhan = Form8Row::sum('kebutuhan');
        $totalKerusakan = Form8Row::sum('jumlah_kerusakan_kerugian');
        
        return view('forms.form8.format_menu', compact('totalForms', 'totalRows', 'totalKebutuhan', 'totalKerusakan'));
    }

    /**
     * Generate Table Ringkas PDF
     */
    public function tableRingkas()
    {
        // Get all Form8 data with rows
        $forms = Form8::with(['rows', 'bencana'])->get();
        $allRows = Form8Row::with('form8.bencana')->get();
        
        // Calculate totals
        $totalRB = $allRows->sum('data_kerusakan_rb');
        $totalRS = $allRows->sum('data_kerusakan_rs');
        $totalRR = $allRows->sum('data_kerusakan_rr');
        $totalNilaiKerusakan = $allRows->sum('nilai_kerusakan_rb') + $allRows->sum('nilai_kerusakan_rs') + $allRows->sum('nilai_kerusakan_rr');
        $totalKerugian = $allRows->sum('perkiraan_kerugian');
        $totalKeruskanKerugian = $allRows->sum('jumlah_kerusakan_kerugian');
        $totalKebutuhan = $allRows->sum('kebutuhan');
        
        $pdf = Pdf::loadView('forms.form8.form8_table_ringkas', compact(
            'allRows', 'totalRB', 'totalRS', 'totalRR', 'totalNilaiKerusakan', 
            'totalKerugian', 'totalKeruskanKerugian', 'totalKebutuhan'
        ));
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream('Form8_Table_Ringkas.pdf');
    }

    /**
     * Generate Per Baris PDF  
     */
    public function perBaris()
    {
        // Get all Form8 data with related models
        $allRows = Form8Row::with('form8.bencana')->get();
        
        // Calculate summary
        $totalKebutuhan = $allRows->sum('kebutuhan');
        $totalKerusakan = $allRows->sum('jumlah_kerusakan_kerugian');
        $totalItems = $allRows->count();
        
        $pdf = Pdf::loadView('forms.form8.form8_per_baris', compact('allRows', 'totalKebutuhan', 'totalKerusakan', 'totalItems'));
        $pdf->setPaper('A4', 'portrait');
        return $pdf->stream('Form8_Per_Baris.pdf');
    }

    /**
     * Generate Analisis Komprehensif PDF
     */
    public function analisisKomprehensif()
    {
        // Get all Form8 data grouped by sector
        $allRows = Form8Row::with('form8.bencana')->get();
        
        // Group by sector
        $groupedBySector = $allRows->groupBy('sektor_sub_sektor');
        
        // Calculate totals
        $totalRB = $allRows->sum('data_kerusakan_rb');
        $totalRS = $allRows->sum('data_kerusakan_rs');
        $totalRR = $allRows->sum('data_kerusakan_rr');
        $totalNilaiKerusakan = $allRows->sum('nilai_kerusakan_rb') + $allRows->sum('nilai_kerusakan_rs') + $allRows->sum('nilai_kerusakan_rr');
        $totalKerugian = $allRows->sum('perkiraan_kerugian');
        $totalKeruskanKerugian = $allRows->sum('jumlah_kerusakan_kerugian');
        $totalKebutuhan = $allRows->sum('kebutuhan');
        
        $pdf = Pdf::loadView('forms.form8.form8_analisis_komprehensif', compact(
            'allRows', 'groupedBySector', 'totalRB', 'totalRS', 'totalRR', 
            'totalNilaiKerusakan', 'totalKerugian', 'totalKeruskanKerugian', 'totalKebutuhan'
        ));
        $pdf->setPaper('A4', 'portrait');
        return $pdf->stream('Form8_Analisis_Komprehensif.pdf');
    }
}
