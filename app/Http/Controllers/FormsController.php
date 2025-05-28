<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bencana;

class FormsController extends Controller
{
    public function index(Request $request)
    {
        $bencana_id = $request->input('bencana_id');
        $bencana = null;
        
        // Redirect to bencana selection page if no bencana_id is provided
        if (!$bencana_id) {
            return redirect()->route('bencana.index', ['source' => 'forms']);
        }
        
        // Get bencana details if ID is provided
        $bencana = Bencana::findOrFail($bencana_id);

        $forms = [
            [
                'id' => 1,
                'nama' => 'Form Analisis Kebutuhan Darurat',
                'deskripsi' => 'Formulir untuk menganalisis kebutuhan tanggap darurat bencana.',
                'route' => $bencana_id ? '#' : '#'
            ],
            [
                'id' => 2,
                'nama' => 'Form Penilaian Kerusakan',
                'deskripsi' => 'Formulir untuk menilai tingkat kerusakan infrastruktur pasca bencana.',
                'route' => $bencana_id ? '#' : '#'
            ],
            [
                'id' => 3,
                'nama' => 'Form Evakuasi dan Pengungsian',
                'deskripsi' => 'Formulir untuk mencatat data evakuasi dan kondisi pengungsian.',
                'route' => $bencana_id ? '#' : '#'
            ],
            [
                'id' => 4,
                'nama' => 'Form Pengumpulan Data Sektor',
                'deskripsi' => 'Formulir untuk mengumpulkan data per sektor.',
                'route' => route('forms.form4.index', ['bencana_id' => $bencana_id])
            ]
        ];

        return view('forms.form-list', compact('forms', 'bencana'));
    }
}