<?php

namespace App\Http\Controllers;

use App\Models\Bencana;
use App\Models\DetailKerusakan;
use App\Models\EnvironmentalReport;
use App\Models\FormPerumahan;
use App\Models\Format1Form4;
use App\Models\Format2Form4;
use App\Models\GovernmentReport;
use App\Models\Kerugian;
use App\Models\Kerusakan;
use App\Models\Pendataan;
use App\Models\TransportationReport;
use App\Models\Fgd;
use App\Models\Rekap;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class KebutuhanController extends Controller
{
    /**
     * Display a listing of the resource.
     */    public function index()
    {
        // Redirect to the bencana listing with source=kebutuhan
        return redirect()->route('bencana.index', ['source' => 'kebutuhan']);
    }

    /**
     * Display a summary of tables by form.
     */    public function listTables()
    {
        // Get table information from the database with related data
        $tables = [
            'form1' => [
                'name' => 'Form 1',
                'description' => 'Tidak ada tabel khusus kerusakan/kerugian (hanya informasi dasar bencana)',
                'tables' => []
            ],
            'form3' => [
                'name' => 'Form 3',
                'description' => 'Tabel dengan deskripsi umum kerusakan/kerugian',
                'tables' => [
                    ['name' => 'pendataan', 'description' => 'Deskripsi umum kerusakan/kerugian', 'count' => Pendataan::count(), 'model' => 'Pendataan']
                ]
            ],
            'form4' => [
                'name' => 'Form 4',
                'description' => 'Kerusakan dan kerugian berbagai sektor',
                'tables' => [
                    ['name' => 'form_perumahan', 'description' => 'Kerusakan dan kerugian perumahan', 'count' => FormPerumahan::count(), 'model' => 'FormPerumahan'],
                    ['name' => 'government_reports', 'description' => 'Kerusakan dan kerugian fasilitas pemerintah', 'count' => GovernmentReport::count(), 'model' => 'GovernmentReport'],
                    ['name' => 'environmental_reports', 'description' => 'Kerusakan dan kerugian lingkungan hidup', 'count' => EnvironmentalReport::count(), 'model' => 'EnvironmentalReport'],
                    ['name' => 'transportation_reports', 'description' => 'Kerusakan dan kerugian transportasi', 'count' => TransportationReport::count(), 'model' => 'TransportationReport']
                ]
            ],
            'form7' => [
                'name' => 'Form 7',
                'description' => 'Tabel dengan penilaian kualitatif kerusakan/kerugian',
                'tables' => [
                    ['name' => 'fgd', 'description' => 'Penilaian kualitatif kerusakan/kerugian', 'count' => Fgd::count(), 'model' => 'Fgd']
                ]
            ],
            'general' => [
                'name' => 'Tabel Umum',
                'description' => 'Digunakan di berbagai form',
                'tables' => [
                    ['name' => 'kerusakan', 'description' => 'Pencatatan kerusakan fisik', 'count' => Kerusakan::count(), 'model' => 'Kerusakan'],
                    ['name' => 'detail_kerusakan', 'description' => 'Detail pencatatan kerusakan fisik', 'count' => DetailKerusakan::count(), 'model' => 'DetailKerusakan'],
                    ['name' => 'kerugian', 'description' => 'Pencatatan kerugian ekonomi', 'count' => Kerugian::count(), 'model' => 'Kerugian']
                ]
            ]
        ];// Get additional tables information
        $databaseTables = DB::select("
            SELECT table_name AS name
            FROM information_schema.tables 
            WHERE table_schema = '" . env('DB_DATABASE') . "'
            AND (table_name LIKE '%kerusak%' OR table_name LIKE '%kerugian%')
            AND table_name NOT IN ('kerusakan', 'detail_kerusakan', 'kerugian')
        ");        $additionalTables = [];
        foreach ($databaseTables as $table) {
            // Use the aliased name property
            $tableName = $table->name;
            
            $additionalTables[] = [
                'name' => $tableName,
                'description' => 'Tabel terkait kerusakan/kerugian',
                'count' => DB::table($tableName)->count()
            ];
        }

        if (!empty($additionalTables)) {
            $tables['additional'] = [
                'name' => 'Tabel Tambahan',
                'description' => 'Tabel terkait kerusakan/kerugian lainnya',
                'tables' => $additionalTables
            ];
        }        // Get schema information for all tables and sample data
        $columns = [];
        $sampleData = [];
        $relationshipData = [];
        $numericColumns = [];
        
        foreach ($tables as $formKey =>  $form) {
            foreach ( $form['tables'] as $tableInfo) {
                $tableName = $tableInfo['name'];
                if (Schema::hasTable($tableName)) {
                    $tableColumns = Schema::getColumnListing($tableName);
                    $relevantColumns = array_filter($tableColumns, function($column) {
                        return strpos(strtolower($column), 'rusak') !== false || 
                               strpos(strtolower($column), 'kerusakan') !== false ||
                               strpos(strtolower($column), 'kerugian') !== false ||
                               strpos(strtolower($column), 'biaya') !== false ||
                               strpos(strtolower($column), 'harga') !== false ||
                               strpos(strtolower($column), 'nilai') !== false ||
                               strpos(strtolower($column), 'jumlah') !== false ||
                               strpos(strtolower($column), 'kuantitas') !== false;
                    });
                    
                    if (!empty($relevantColumns)) {
                        $columns[$tableName] = $relevantColumns;
                        
                        // Identify which columns are numeric for special formatting
                        $numericColumns[$tableName] = [];
                          // Get numeric columns from database schema
                        foreach ($relevantColumns as $column) {
                            try {
                                $columnType = DB::connection()->getDoctrineColumn($tableName, $column)->getType()->getName();
                                if (in_array($columnType, ['integer', 'float', 'decimal', 'bigint', 'smallint', 'double'])) {
                                    $numericColumns[$tableName][] = $column;
                                }
                            } catch (\Exception $e) {
                                // If we can't determine the type, check if the column name suggests it's numeric
                                if (preg_match('/(biaya|harga|nilai|jumlah|kuantitas)/i', $column)) {
                                    $numericColumns[$tableName][] = $column;
                                }
                            }
                        }
                        
                        // Get sample data (limit to 5 rows)
                        if (isset($tableInfo['model']) && class_exists('App\\Models\\' . $tableInfo['model'])) {
                            $modelClass = 'App\\Models\\' . $tableInfo['model'];
                            
                            // Get the model's relationships
                            $modelInstance = new $modelClass();
                            $relations = [];
                            
                            // Common relationship method names to check
                            $relationMethods = ['bencana', 'detail', 'kategori_bangunan', 'satuan', 'hsd'];
                            
                            foreach ($relationMethods as $method) {
                                if (method_exists($modelInstance, $method)) {
                                    $relations[] = $method;
                                }
                            }
                              // Get sample data with relationships
                            try {
                                if (!empty($relations)) {
                                    $sampleData[$tableName] = $modelClass::with($relations)->limit(5)->get();
                                    $relationshipData[$tableName] = $relations;
                                } else {
                                    $sampleData[$tableName] = $modelClass::limit(5)->get();
                                }
                            } catch (\Exception $e) {
                                // Handle exceptions gracefully
                                $sampleData[$tableName] = collect([]);
                                \Log::error('Error retrieving data for ' . $tableName . ': ' . $e->getMessage());
                            }                        } else {
                            // Fallback to raw query if model doesn't exist
                            try {
                                $sampleData[$tableName] = DB::table($tableName)->limit(5)->get();
                            } catch (\Exception $e) {
                                // Handle exceptions gracefully
                                $sampleData[$tableName] = collect([]);
                                \Log::error('Error retrieving data for ' . $tableName . ' using DB: ' . $e->getMessage());
                            }
                        }
                    }
                }
            }
        }

        // Calculate total damage/loss values for each table
        $tableTotals = [];
        foreach ($columns as $tableName => $tableColumns) {
            if (!empty($sampleData[$tableName])) {
                foreach ($numericColumns[$tableName] as $numericColumn) {
                    $sum = 0;
                    foreach ($sampleData[$tableName] as $item) {
                        if (isset($item->$numericColumn) && is_numeric($item->$numericColumn)) {
                            $sum += $item->$numericColumn;
                        }
                    }
                    $tableTotals[$tableName][$numericColumn] = $sum;
                }
            }
        }

        return view('kebutuhan.list', compact('tables', 'columns', 'sampleData', 'relationshipData', 'numericColumns', 'tableTotals'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $bencana = Bencana::with('kategori_bencana')->findOrFail($id);

        return view('kebutuhan.create', compact('bencana'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        // Basic validation
        $validated = $request->validate([
            'kebutuhan_material' => 'required|string',
            'kebutuhan_sdm' => 'required|string',
            'kebutuhan_dana' => 'required|numeric',
        ]);

        $bencana = Bencana::findOrFail($id);

        // Implementation will depend on your database structure
        // This is a placeholder until the model for Kebutuhan is created

        return redirect()->route('kebutuhan.index')->with('success', 'Data kebutuhan berhasil disimpan');
    }
    /**
     * Display the specified resource.
     */    public function show($id)
    {
        $bencana = Bencana::with('kategori_bencana')->findOrFail($id);
        
        // Get damage and loss data for this specific disaster
        $kerusakan = Kerusakan::where('bencana_id', $id)->with('detail', 'bencana', 'kategori_bangunan')->get();
        $kerugian = Kerugian::where('bencana_id', $id)->with('bencana')->get();
        
        // Get data from Form3
         $form = Pendataan::where('bencana_id', $id)->first();
        
        // Get data from Form4 tables
        $perumahan = Format1Form4::where('bencana_id', $id)->get();
        $government = GovernmentReport::where('bencana_id', $id)->get();
        $environment = EnvironmentalReport::where('bencana_id', $id)->get();
        $transportation = TransportationReport::where('bencana_id', $id)->get();
        
        // Get data from Form4 Format2 (Pendidikan)
        $format2 = Format2Form4::where('bencana_id', $id)->get();
        
        // Gabungkan kerusakan dan kerugian pada format2 (Pendidikan)
        $totalKerusakanFormat2 = $format2->sum(function($item) {
            return ($item->total_kerusakan ?? 0) + ($item->total_kerugian ?? 0);
        });
        $totalKerugianFormat2 = 0; // Tidak dipakai lagi, hanya kerusakan
        
        // Get data from Form7
        $fgd = Fgd::where('bencana_id', $id)->first();
        
        // Get additional data from detail_kerusakan related to this kerusakan
        $detailKerusakan = [];
        foreach ($kerusakan as $item) {
            if ($item->detail && $item->detail->count() > 0) {
                foreach ($item->detail as $detail) {
                    $detailKerusakan[] = $detail;
                }
            }
        }
        
        // Identify and extract numeric columns from each model
        $numericData = [];
        
        // For Kerusakan
        $kerusakanTable = Schema::getColumnListing('kerusakan');
        $kerusakanNumeric = $this->extractNumericColumns('kerusakan', $kerusakanTable, $kerusakan);
        if (!empty($kerusakanNumeric)) {
            $numericData['kerusakan'] = $kerusakanNumeric;
        }
        
        // For Kerugian
        $kerugianTable = Schema::getColumnListing('kerugian');
        $kerugianNumeric = $this->extractNumericColumns('kerugian', $kerugianTable, $kerugian);
        if (!empty($kerugianNumeric)) {
            $numericData['kerugian'] = $kerugianNumeric;
        }
        
        // For Detail Kerusakan
        $detailTable = Schema::getColumnListing('detail_kerusakan');
        $detailNumeric = $this->extractNumericColumns('detail_kerusakan', $detailTable, collect($detailKerusakan));
        if (!empty($detailNumeric)) {
            $numericData['detail_kerusakan'] = $detailNumeric;
        }
        
        // For Environmental Reports
        $envTable = Schema::getColumnListing('environmental_reports');
        $envNumeric = $this->extractNumericColumns('environmental_reports', $envTable, $environment);
        if (!empty($envNumeric)) {
            $numericData['environmental_reports'] = $envNumeric;
        }
        
        // For Government Reports
        $govTable = Schema::getColumnListing('government_reports');
        $govNumeric = $this->extractNumericColumns('government_reports', $govTable, $government);
        if (!empty($govNumeric)) {
            $numericData['government_reports'] = $govNumeric;
        }
        
        // For Form Perumahan
        $perumahanTable = Schema::getColumnListing('form_perumahan');
        $perumahanNumeric = $this->extractNumericColumns('form_perumahan', $perumahanTable, $perumahan);
        if (!empty($perumahanNumeric)) {
            $numericData['form_perumahan'] = $perumahanNumeric;
        }
        
        // Calculate environmental loss and damage
        $environmentalTotals = [
            'damage' => $environment->sum('total_kerusakan'),
            'loss' => $environment->sum('total_kerugian')
        ];
        
        // Calculate government loss and damage
        $governmentTotals = [
            'damage' => $government->sum('total_kerusakan'),
            'loss' => $government->sum('total_kerugian')
        ];
        
        // Calculate totals
        $totalKerusakan = $kerusakan->sum('BiayaKeseluruhan');
        $totalKerugian = $kerugian->sum('BiayaKeseluruhan');
        
        // Ambil total kerusakan dari Format1Form4 (tabel format1_form4s)
        $totalKerusakanFormat1 = \App\Models\Format1Form4::where('bencana_id', $id)->sum('total_kerusakan');
        
        // Format totals
        $totals = [
            'kerusakan' => $totalKerusakan,
            'kerugian' => $totalKerugian,
            'lingkungan' => $environmentalTotals,
            'pemerintah' => $governmentTotals,
            'total' => $totalKerusakan + $totalKerugian + 
                       $environmentalTotals['damage'] + $environmentalTotals['loss'] + 
                       $governmentTotals['damage'] + $governmentTotals['loss'],
            'total_kerusakan' => $totalKerusakanFormat1, // pastikan tidak hilang
            'total_kerusakan_format2' => $totalKerusakanFormat2,
            'total_kerugian_format2' => $totalKerugianFormat2
        ];

        // Get rekap data for this bencana, with all format1-17 relasi
        $rekaps = Rekap::where('bencana_id', $id)
            ->with([
                'bencana',
                'format1Form4', 'format2Form4', 'format3Form4', 'format4Form4', 'format5Form4',
                'format6Form4', 'format7Form4', 'format8Form4', 'format9Form4', 'format10Form4',
                'format11Form4', 'format12Form4', 'format13Form4', 'format14Form4', 'format15Form4',
                'format16Form4', 'format17Form4'
            ])
            ->get();
        // Tambahkan total kerusakan seluruh format ke setiap rekap
        foreach ($rekaps as $rekap) {
            $totalKerusakanSemuaFormat = 0;
            for ($i = 1; $i <= 17; $i++) {
                $relasi = "format{$i}Form4";
                if ($rekap->$relasi) {
                    $totalKerusakanSemuaFormat += $rekap->$relasi->total_kerusakan ?? 0;
                }
            }
            $rekap->total_kerusakan_semua_format = $totalKerusakanSemuaFormat;
        }

        // Calculate rekap summary
        $rekapSummary = [
            'total_rekaps' => $rekaps->count(),
            'total_kerusakan' => $rekaps->sum('total_kerusakan'),
            'total_kerugian' => $rekaps->sum('total_kerugian'),
            'completed_rekaps' => $rekaps->where('status', 'completed')->count(),
            'verified_rekaps' => $rekaps->where('status', 'verified')->count(),
            'total_formats_filled' => $rekaps->sum(function($rekap) {
                return $rekap->getFilledFormatsCount();
            }),
        ];        return view('kebutuhan.show', compact(
            'bencana', 
            'kerusakan',
            'format2',
            'totalKerusakanFormat2',
            'totalKerugianFormat2',
            'kerugian',
            'pendataan',
            'perumahan',
            'government',
            'environment',
            'transportation',
            'fgd',
            'totals',
            'numericData',
            'detailKerusakan',
            'rekaps',
            'rekapSummary'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $bencana = Bencana::findOrFail($id);

        return view('kebutuhan.edit', compact('bencana'));
    }    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Basic validation
        $validated = $request->validate([
            'kebutuhan_material' => 'required|string',
            'kebutuhan_sdm' => 'required|string',
            'kebutuhan_dana' => 'required|numeric',
        ]);

        $bencana = Bencana::findOrFail($id);

        // Implementation will depend on your database structure
        // This is a placeholder until the model for Kebutuhan is created

        return redirect()->route('kebutuhan.index')->with('success', 'Data kebutuhan berhasil diperbarui');
    }
    
    /**
     * Extract numeric columns from a table and calculate statistics
     */
    private function extractNumericColumns($tableName, $columns, $data)
    {
        $result = [];
        $numericColumnPatterns = [
            '/biaya/i', '/harga/i', '/nilai/i', '/jumlah/i', '/kuantitas/i', 
            '/rusak/i', '/kerusakan/i', '/kerugian/i', '/total/i'
        ];
        
        // Find all potentially numeric columns
        foreach ($columns as $column) {
            // Check if column name suggests it's numeric
            $isNumeric = false;
            foreach ($numericColumnPatterns as $pattern) {
                if (preg_match($pattern, $column)) {
                    $isNumeric = true;
                    break;
                }
            }
            
            // If we found a column that might be numeric, check the data
            if ($isNumeric) {
                try {
                    // Check if column exists in database as numeric type
                    $columnType = DB::connection()->getDoctrineColumn($tableName, $column)->getType()->getName();
                    $isNumericType = in_array($columnType, ['integer', 'float', 'decimal', 'bigint', 'smallint', 'double']);
                } catch (\Exception $e) {
                    // If we can't check the DB type, we'll rely on the column name pattern we already matched
                    $isNumericType = $isNumeric;
                }
                
                // If this is a numeric column, collect statistics
                if ($isNumericType) {
                    $columnData = [];
                    $sum = 0;
                    $count = 0;
                    $min = null;
                    $max = null;
                    
                    foreach ($data as $item) {
                        if (property_exists($item, $column) || isset($item->$column)) {
                            $value = $item->$column;
                            if (is_numeric($value)) {
                                $columnData[] = [
                                    'id' => $item->id,
                                    'value' => $value,
                                    'label' => $this->getItemDescriptiveLabel($item)
                                ];
                                
                                $sum += $value;
                                $count++;
                                
                                if ($min === null || $value < $min) $min = $value;
                                if ($max === null || $value > $max) $max = $value;
                            }
                        }
                    }
                    
                    // If we found numeric values, save the stats
                    if ($count > 0) {
                        $result[$column] = [
                            'data' => $columnData,
                            'stats' => [
                                'sum' => $sum,
                                'count' => $count,
                                'avg' => $count > 0 ? $sum / $count : 0,
                                'min' => $min,
                                'max' => $max
                            ]
                        ];
                    }
                }
            }
        }
        
        return $result;
    }
    
    /**
     * Get a descriptive label for an item based on its properties
     */
    private function getItemDescriptiveLabel($item)
    {
        // Try common descriptive fields
        $descriptionFields = ['deskripsi', 'nama', 'jenis', 'name', 'description', 'lokasi', 'alamat', 'tipe', 'keterangan'];
        
        foreach ($descriptionFields as $field) {
            if (property_exists($item, $field) || isset($item->$field)) {
                if (!empty($item->$field)) {
                    return $item->$field;
                }
            }
        }
        
        // Fallback to ID if no description found
        return 'Item #' . $item->id;
    }
}
