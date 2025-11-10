<?php

namespace App\Http\Controllers;

use App\Models\form10;
use App\Models\Bencana;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class Form10Controller extends Controller
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
        
        return view('forms.form10.form10', compact('bencana'));
    }

    /**
     * Store a new form submission
     */
public function store(Request $request)
    {
        // detect repeating rows (inputs like {slug}_{key}_{field}_{idx})
        $groups = [];
        foreach ($request->all() as $name => $value) {
            if (preg_match('/^([a-z0-9_]+)_([a-z0-9_]+)_(sektor|subsektor|lokasi|hasil_survey|hasil_wawancara|hasil_pendataan_skpd|hasil_pendalaman|kebutuhan_pemulihan)_([0-9]+)$/i', $name, $m)) {
                $slug = $m[1]; $key = $m[2]; $field = $m[3]; $idx = (int)$m[4];
                $k = "{$slug}|{$key}|{$idx}";
                $groups[$k][$field] = $value;
            }
        }
        $hasRows = ! empty($groups);

        $rules = [
            'bencana_id' => 'required|exists:bencana,id',
            'tanggal' => 'nullable|date',
            'keterangan' => 'nullable|string',
        ];

        if ($hasRows) {
            $rules = array_merge($rules, [
                'lokasi' => 'nullable|string|max:255',
                'sektor' => 'nullable|string|max:255',
                'sub_sektor' => 'nullable|string|max:255',
                'kebutuhan_pemulihan' => 'nullable|string',
            ]);
        } else {
            // single-row (header) required fields
            $rules = array_merge($rules, [
                'lokasi' => 'required|string|max:255',
                'sektor' => 'required|string|max:255',
                'sub_sektor' => 'required|string|max:255',
                'hasil_survey' => 'required|string',
                'hasil_wawancara' => 'required|string',
                'hasil_pendataan_skpd' => 'required|string',
                'kebutuhan_pemulihan' => 'required|string',
            ]);
        }

        $validated = $request->validate($rules);

        DB::transaction(function () use ($request, $groups, &$form, $hasRows) {
            // create master
            $form = Form10::create([
                'bencana_id' => $request->input('bencana_id'),
                'tanggal' => $request->input('tanggal') ?? null,
                'keterangan' => $request->input('keterangan') ?? null,
            ]);

            $now = now();
            $insertRows = [];

            if (empty($groups)) {
                // single detail row from header inputs
                $insertRows[] = [
                    'Form10_id' => $form->id,
                    'order' => 1,
                    'sektor_sub_sektor' => trim($request->input('sektor') . ' / ' . $request->input('sub_sektor')),
                    'lokasi' => $request->input('lokasi') ?? null,
                    'hasil_pengolahan_survey' => $request->input('hasil_survey') ?? null,
                    'hasil_wawancara_fgd' => $request->input('hasil_wawancara') ?? null,
                    'hasil_pendalaman' => $request->input('hasil_pendataan_skpd') ?? $request->input('hasil_pendalaman'),
                    'kebutuhan_pemulihan' => $request->input('kebutuhan_pemulihan') ?? null,
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            } else {
                foreach ($groups as $k => $r) {
                    [$slug, $key, $idx] = explode('|', $k);
                    // determine if row has any data
                    $hasData = false;
                    foreach (['sektor','subsektor','lokasi','hasil_survey','hasil_wawancara','hasil_pendataan_skpd','hasil_pendalaman','kebutuhan_pemulihan'] as $f) {
                        if (isset($r[$f]) && $r[$f] !== '') { $hasData = true; break; }
                    }
                    if (! $hasData) continue;

                    // build sektor_sub_sektor: prefer combined sektor/subsektor, fallback to slug/key
                    $sektor = $r['sektor'] ?? null;
                    $sub = $r['subsektor'] ?? null;
                    $sektor_sub = $sektor || $sub ? trim(($sektor ?? '') . ($sub ? ' / ' . $sub : '')) : "{$slug}/{$key}";

                    $insertRows[] = [
                        'Form10_id' => $form->id,
                        'order' => (int)$idx,
                        'sektor_sub_sektor' => $sektor_sub,
                        'lokasi' => $r['lokasi'] ?? null,
                        'hasil_pengolahan_survey' => $r['hasil_survey'] ?? null,
                        'hasil_wawancara_fgd' => $r['hasil_wawancara'] ?? null,
                        'hasil_pendalaman' => $r['hasil_pendataan_skpd'] ?? $r['hasil_pendalaman'] ?? null,
                        'kebutuhan_pemulihan' => $r['kebutuhan_pemulihan'] ?? null,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ];
                }
            }

            if (! empty($insertRows)) {
                DB::table('Form10_rows')->insert($insertRows);
            }
        });

        return redirect()->route('forms.form10.list', ['bencana_id' => $request->input('bencana_id')])
            ->with('success', 'Data Form 10 berhasil disimpan (master + rows).');
    }
    /**
     * Display a specific form entry     */    
    public function show($id)
    {
        $form = form10::with(['bencana'])->findOrFail($id);
        return view('forms.form10.show', compact('form'));
    }

    /**
     * List all form entries for a specific bencana
     */
    public function list(Request $request)
    {
        $bencana_id = $request->query('bencana_id');
        $bencana = Bencana::find($bencana_id);

        // load Form10 masters with their rows
        $query = Form10::with(['rows' => function ($q) {
            $q->orderBy('id', 'asc'); // ensure stable first row
        }]);

        if ($bencana_id) {
            $query->where('bencana_id', $bencana_id);
        }

        $forms = $query->orderBy('created_at', 'desc')->get();

        // build a simple list for the view: one representative row per master
        $rekapitulasiList = $forms->map(function ($form) {
            $first = $form->rows->first();

            return (object)[
                'id' => $form->id,
                'bencana_id' => $form->bencana_id,
                'tanggal' => $form->tanggal,
                'sektor_sub_sektor' => $first->sektor_sub_sektor ?? '-',
                'lokasi' => $first->lokasi ?? ($form->keterangan ?? '-'),
                'hasil_pengolahan_survey' => $first->hasil_pengolahan_survey ?? 0,
                'hasil_wawancara_fgd' => $first->hasil_wawancara_fgd ?? '',
                'hasil_pendalaman' => $first->hasil_pendalaman ?? 0,
                'kebutuhan_pemulihan' => $first->kebutuhan_pemulihan ?? null,
            ];
        });

        // remove dd() and align variable name with view
        $analisaList = $rekapitulasiList;

        return view('forms.form10.list', compact('rekapitulasiList','analisaList', 'bencana', 'forms'));
    }

    /**
     * Generate PDF for form data
     */    
    public function generatePdf($id)
    {
        $form = form10::with(['bencana'])->findOrFail($id);
        
        $pdf = Pdf::loadView('forms.form10.pdf', compact('form'));
        return $pdf->download('Formulir_10_PDNA_' . $form->id . '.pdf');
    }   

    /**
     * Preview PDF without downloading
     */    
    public function previewPdf($id)
    {
        $form = form10::with(['bencana'])->findOrFail($id);
        
        $pdf = Pdf::loadView('forms.form10.pdf', compact('form'));
        return $pdf->stream('Formulir_10_PDNA_' . $form->id . '.pdf');
    }
    
    /**
     * Show the form for editing the specified form.
     */
    public function edit($id)
    {
        try {
            $form = form10::findOrFail($id);
            $bencana = Bencana::find($form->bencana_id);
            
            return view('forms.form10.edit', compact('form', 'bencana'));
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
            $form = form10::findOrFail($id);
            
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
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
            
            $form->update($request->all());
            
            return redirect()->route('forms.form10.show', $form->id)
                ->with('success', 'Formulir berhasil diperbarui.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }    
    }
    public function destroy($id)
    {
        try {
            $form = form10::findOrFail($id);
            $bencana_id = $form->bencana_id;
            $form->delete();
            
            return redirect()->route('forms.form10.list', ['bencana_id' => $bencana_id])
                ->with('success', 'Data Form 1 berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
    public function contohPdf()
    {

        $pdf = Pdf::loadView('forms.form10.contoh_form10_pdf', []);
        return $pdf->stream('Contoh_Formulir_10_PDNA.pdf');
    }
}
