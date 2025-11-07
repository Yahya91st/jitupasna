<?php
namespace App\Http\Controllers;

use App\Models\Form11;
use App\Models\Form11Row;
use App\Models\Bencana;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class Form11Controller extends Controller
{
    public function index(Request $request)
    {
        $bencana_id = $request->query('bencana_id');
        $bencana = Bencana::find($bencana_id);

        return view('forms.form11.form11', compact('bencana'));
    }

    public function store(Request $request)
    {
        // detect repeating reference rows first (inputs like {slug}_{key}_{field}_{idx})
        $groups = [];
        foreach ($request->all() as $name => $value) {
            if (preg_match('/^([a-z0-9]+)_([a-z0-9]+)_(kegiatan|lokasi|volume|harga|jumlah|keterangan)_([0-9]+)$/i', $name, $m)) {
                $slug = $m[1]; $key = $m[2]; $field = $m[3]; $idx = (int)$m[4];
                $k = "{$slug}|{$key}|{$idx}";
                $groups[$k][$field] = $value;
            }
        }
        $hasRows = !empty($groups);

        // build validation rules (if rows submitted, allow main fields nullable)
        $rules = [
            'bencana_id' => 'required|exists:bencana,id',
            'tanggal' => 'nullable|date',
            'keterangan' => 'nullable|string',
        ];

        if ($hasRows) {
            $rules = array_merge($rules, [
                'lokasi' => 'nullable|string|max:255',
                'jenis_kebutuhan' => 'nullable|string',
                'rincian_kebutuhan' => 'nullable|string',
                'jumlah_unit' => 'nullable|numeric|min:0',
                'satuan' => 'nullable|string|max:100',
                'harga_satuan' => 'nullable|numeric|min:0',
                'prioritas' => 'nullable|string',
                'durasi_penyelesaian' => 'nullable|string|max:255',
                'penanggung_jawab' => 'nullable|string|max:255',
            ]);
        } else {
            $rules = array_merge($rules, [
                'lokasi' => 'required|string|max:255',
                'jenis_kebutuhan' => 'required|string',
                'rincian_kebutuhan' => 'required|string',
                'jumlah_unit' => 'required|numeric|min:0',
                'satuan' => 'required|string|max:100',
                'harga_satuan' => 'required|numeric|min:0',
                'prioritas' => 'required|string',
                'durasi_penyelesaian' => 'required|string|max:255',
                'penanggung_jawab' => 'required|string|max:255',
            ]);
        }

        $validated = $request->validate($rules);

        DB::transaction(function () use ($request, $groups, &$form, $hasRows) {
            // create master record (Form11)
            $form = Form11::create([
                'bencana_id' => $request->input('bencana_id'),
                'tanggal' => $request->input('tanggal') ?? null,
                'keterangan' => $request->input('keterangan') ?? null,
            ]);

            $now = \Carbon\Carbon::now();
            $insertRows = [];

            // compute total_kebutuhan if main fields present
            $total_kebutuhan = null;
            if ($request->filled('jumlah_unit') && $request->filled('harga_satuan')) {
                $total_kebutuhan = (float)$request->input('jumlah_unit') * (float)$request->input('harga_satuan');
            }

            if (empty($groups)) {
                // create single detail row containing main fields (no reference rows)
                $insertRows[] = [
                    'form11_id' => $form->id,
                    'sector_slug' => null,
                    'component_key' => null,
                    'row_index' => null,
                    'kegiatan' => null,
                    'lokasi' => null,
                    'volume' => null,
                    'harga' => null,
                    'jumlah' => null,
                    'keterangan' => $request->input('keterangan') ?? null,
                    'main_lokasi' => $request->input('lokasi') ?? null,
                    'jenis_kebutuhan' => $request->input('jenis_kebutuhan') ?? null,
                    'rincian_kebutuhan' => $request->input('rincian_kebutuhan') ?? null,
                    'jumlah_unit' => $request->filled('jumlah_unit') ? (float)$request->input('jumlah_unit') : null,
                    'satuan' => $request->input('satuan') ?? null,
                    'harga_satuan' => $request->filled('harga_satuan') ? (float)$request->input('harga_satuan') : null,
                    'total_kebutuhan' => $total_kebutuhan,
                    'prioritas' => $request->input('prioritas') ?? null,
                    'durasi_penyelesaian' => $request->input('durasi_penyelesaian') ?? null,
                    'penanggung_jawab' => $request->input('penanggung_jawab') ?? null,
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            } else {
                // build rows from groups, calculate jumlah if missing (volume * harga)
                foreach ($groups as $k => $r) {
                    [$slug, $key, $idx] = explode('|', $k);

                    // skip fully empty rows
                    $hasData = false;
                    foreach (['kegiatan','lokasi','volume','harga','jumlah','keterangan'] as $f) {
                        if (isset($r[$f]) && $r[$f] !== '') { $hasData = true; break; }
                    }
                    if (! $hasData) continue;

                    $volume = isset($r['volume']) && $r['volume'] !== '' ? (float) str_replace(',', '.', $r['volume']) : null;
                    $harga = isset($r['harga']) && $r['harga'] !== '' ? (float) str_replace(',', '.', $r['harga']) : null;

                    if (isset($r['jumlah']) && $r['jumlah'] !== '') {
                        $jumlah_val = (float) str_replace(',', '.', $r['jumlah']);
                    } elseif ($volume !== null && $harga !== null) {
                        $jumlah_val = $volume * $harga;
                    } else {
                        $jumlah_val = null;
                    }

                    $insertRows[] = [
                        'form11_id' => $form->id,
                        'sector_slug' => $slug,
                        'component_key' => $key,
                        'row_index' => (int)$idx,
                        'kegiatan' => $r['kegiatan'] ?? null,
                        'lokasi' => $r['lokasi'] ?? null,
                        'volume' => $volume,
                        'harga' => $harga,
                        'jumlah' => $jumlah_val,
                        'keterangan' => $r['keterangan'] ?? null,
                        'main_lokasi' => $request->input('lokasi') ?? null,
                        'jenis_kebutuhan' => $request->input('jenis_kebutuhan') ?? null,
                        'rincian_kebutuhan' => $request->input('rincian_kebutuhan') ?? null,
                        'jumlah_unit' => $request->filled('jumlah_unit') ? (float)$request->input('jumlah_unit') : null,
                        'satuan' => $request->input('satuan') ?? null,
                        'harga_satuan' => $request->filled('harga_satuan') ? (float)$request->input('harga_satuan') : null,
                        'total_kebutuhan' => $total_kebutuhan,
                        'prioritas' => $request->input('prioritas') ?? null,
                        'durasi_penyelesaian' => $request->input('durasi_penyelesaian') ?? null,
                        'penanggung_jawab' => $request->input('penanggung_jawab') ?? null,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ];
                }
            }

            if (!empty($insertRows)) {
                DB::table('form11_rows')->insert($insertRows);
            }
        });

        return redirect()->route('forms.form11.list', ['bencana_id' => $request->input('bencana_id')])
            ->with('success', 'Data Form 11 berhasil disimpan (master + rows).');
    }

    public function show($id)
    {
        $form11 =  Form11::with('rows')->findOrFail($id);
        return view('forms.form11.show', compact('form11'));
    }

    public function edit($id)
    {
        $form11 =  Form11::with('rows')->findOrFail($id);
        $bencanas = Bencana::all();
        return view('forms.form11.edit', compact('form11', 'bencanas'));
    }

    public function update(Request $request, $id)
    {
        $formTable =  Form11::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'bencana_id' => 'required|exists:bencana,id',
            'lokasi' => 'required|string|max:255',
            'jenis_kebutuhan' => 'required|string',
            'rincian_kebutuhan' => 'required|string',
            'jumlah_unit' => 'required|numeric|min:0',
            'satuan' => 'required|string|max:100',
            'harga_satuan' => 'required|numeric|min:0',
            'prioritas' => 'required|string|in:Tinggi,Sedang,Rendah',
            'durasi_penyelesaian' => 'required|string|max:255',
            'penanggung_jawab' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::transaction(function () use ($request, $formTable) {
            // update header
            $formTable->bencana_id = $request->bencana_id;
            $formTable->save();

            // remove existing rows and re-insert from request
            Form11Row::where('form11table_id', $formTable->id)->delete();

            $groups = [];
            foreach ($request->all() as $name => $value) {
                if (preg_match('/^([a-z0-9]+)_([a-z0-9]+)_(kegiatan|lokasi|volume|harga|jumlah|keterangan)_([0-9]+)$/i', $name, $m)) {
                    $slug = $m[1];
                    $key  = $m[2];
                    $field = $m[3];
                    $idx = (int)$m[4];
                    $k = "{$slug}|{$key}|{$idx}";
                    $groups[$k][$field] = $value;
                }
            }

            if (empty($groups)) {
                Form11Row::create([
                    'form11table_id' => $formTable->id,
                    'main_lokasi' => $request->lokasi,
                    'jenis_kebutuhan' => $request->jenis_kebutuhan,
                    'rincian_kebutuhan' => $request->rincian_kebutuhan,
                    'jumlah_unit' => $request->jumlah_unit,
                    'satuan' => $request->satuan,
                    'harga_satuan' => $request->harga_satuan,
                    'total_kebutuhan' => $request->jumlah_unit * $request->harga_satuan,
                    'prioritas' => $request->prioritas,
                    'durasi_penyelesaian' => $request->durasi_penyelesaian,
                    'penanggung_jawab' => $request->penanggung_jawab,
                    'keterangan' => $request->keterangan,
                ]);
            } else {
                foreach ($groups as $k => $r) {
                    [$slug, $key, $idx] = explode('|', $k);
                    $hasData = false;
                    foreach (['kegiatan','lokasi','volume','harga','jumlah','keterangan'] as $f) {
                        if (isset($r[$f]) && $r[$f] !== '') { $hasData = true; break; }
                    }
                    if (! $hasData) continue;

                    Form11Row::create([
                        'form11table_id' => $formTable->id,
                        'sector_slug' => $slug,
                        'component_key' => $key,
                        'row_index' => (int)$idx,
                        'kegiatan' => $r['kegiatan'] ?? null,
                        'lokasi' => $r['lokasi'] ?? null,
                        'volume' => isset($r['volume']) ? (float) str_replace(',', '.', $r['volume']) : null,
                        'harga' => isset($r['harga']) ? (float) str_replace(',', '.', $r['harga']) : null,
                        'jumlah' => isset($r['jumlah']) ? (float) str_replace(',', '.', $r['jumlah']) : null,
                        'keterangan' => $r['keterangan'] ?? null,
                        'main_lokasi' => $request->lokasi,
                        'jenis_kebutuhan' => $request->jenis_kebutuhan,
                        'rincian_kebutuhan' => $request->rincian_kebutuhan,
                        'jumlah_unit' => $request->jumlah_unit,
                        'satuan' => $request->satuan,
                        'harga_satuan' => $request->harga_satuan,
                        'total_kebutuhan' => $request->jumlah_unit * $request->harga_satuan,
                        'prioritas' => $request->prioritas,
                        'durasi_penyelesaian' => $request->durasi_penyelesaian,
                        'penanggung_jawab' => $request->penanggung_jawab,
                    ]);
                }
            }
        });

        return redirect()->route('forms.form11.show', $formTable->id)->with('success', 'Data rekapitulasi kebutuhan berhasil diperbarui.');
    }

    public function list(Request $request)
    {
        $bencana_id = $request->query('bencana_id');
        $bencana = Bencana::find($bencana_id);

        // load Form11 masters with their rows
        $query = Form11::with(['rows' => function ($q) {
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
                'sektor' => $first->sector_slug ?? '-',
                'sub_sektor' => $first->component_key ?? '-',
                'jenis_kebutuhan' => $first->jenis_kebutuhan ?? ($form->keterangan ?? '-'),
                'jumlah_unit' => $first->jumlah_unit ?? 0,
                'satuan' => $first->satuan ?? '',
                'total_kebutuhan' => $first->total_kebutuhan ?? 0,
                'prioritas' => $first->prioritas ?? null,
            ];
        });

        // If you expect pagination, replace get() above with paginate() and adjust view accordingly.
        return view('forms.form11.list', compact('rekapitulasiList', 'bencana'));
    }

    public function generatePdf($id)
    {
        $form11 =  Form11::with('rows')->findOrFail($id);
        $pdf = PDF::loadView('forms.form11.pdf', compact('form11'));
        return $pdf->download('formulir-11-rekapitulasi-' . $form11->id . '.pdf');
    }

    public function previewPdf($id)
    {
        $form11 =  Form11::with('rows')->findOrFail($id);
        return view('forms.form11.pdf', compact('form11'));
    }

    public function destroy($id)
    {
        try {
            $form11 =  Form11::findOrFail($id);
            $bencana_id = $form11->bencana_id;
            $form11->delete();

            return redirect()->route('forms.form11.list', ['bencana_id' => $bencana_id])
                ->with('success', 'Data Form 11 berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function contohPdf()
    {
        $pdf = Pdf::loadView('forms.form11.contoh_form11_pdf', []);
        return $pdf->stream('Contoh_Formulir_11_PDNA.pdf');
    }
}