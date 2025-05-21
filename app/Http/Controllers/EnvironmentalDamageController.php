<?php

namespace App\Http\Controllers;

use App\Models\EnvironmentalDamage;
use App\Models\EnvironmentalLoss;
use Illuminate\Http\Request;

class EnvironmentalDamageController extends Controller
{
    public function index()
    {
        return view('forms.format17');
    }

    public function store(Request $request)
    {
        // Validate request
        $request->validate([
            'darat_jenis_kerusakan.*' => 'required|string',
            'darat_rb.*' => 'nullable|integer',
            'darat_rs.*' => 'nullable|integer',
            'darat_rr.*' => 'nullable|integer',
            'darat_harga_rb.*' => 'nullable|numeric',
            'darat_harga_rs.*' => 'nullable|numeric',
            'darat_harga_rr.*' => 'nullable|numeric',
            
            'laut_jenis_kerusakan.*' => 'required|string',
            'laut_rb.*' => 'nullable|integer',
            'laut_rs.*' => 'nullable|integer',
            'laut_rr.*' => 'nullable|integer',
            'laut_harga_rb.*' => 'nullable|numeric',
            'laut_harga_rs.*' => 'nullable|numeric',
            'laut_harga_rr.*' => 'nullable|numeric',
            
            'udara_jenis_kerusakan.*' => 'required|string',
            'udara_rb.*' => 'nullable|integer',
            'udara_rs.*' => 'nullable|integer',
            'udara_rr.*' => 'nullable|integer',
            'udara_harga_rb.*' => 'nullable|numeric',
            'udara_harga_rs.*' => 'nullable|numeric',
            'udara_harga_rr.*' => 'nullable|numeric',
            
            'jasa_jenis_kerugian.*' => 'required|string',
            'jasa_dasar_perhitungan.*' => 'nullable|string',
            'jasa_rb.*' => 'nullable|integer',
            'jasa_rs.*' => 'nullable|integer',
            'jasa_rr.*' => 'nullable|integer',
            
            'air_jenis_kerugian.*' => 'required|string',
            'air_dasar_perhitungan.*' => 'nullable|string',
            'air_rb.*' => 'nullable|integer',
            'air_rs.*' => 'nullable|integer',
            'air_rr.*' => 'nullable|integer',
            
            'udara_jenis_kerugian.*' => 'required|string',
            'udara_dasar_perhitungan.*' => 'nullable|string',
            'udara_rb.*' => 'nullable|integer',
            'udara_rs.*' => 'nullable|integer',
            'udara_rr.*' => 'nullable|integer',
        ]);

        // Store Environmental Damages
        $this->storeDamages($request, 'darat');
        $this->storeDamages($request, 'laut');
        $this->storeDamages($request, 'udara');

        // Store Environmental Losses
        $this->storeLosses($request, 'jasa', 'kehilangan_jasa_lingkungan');
        $this->storeLosses($request, 'air', 'pencemaran_air');
        $this->storeLosses($request, 'udara', 'pencemaran_udara');

        return redirect()->route('forms.format17.index')
            ->with('success', 'Data lingkungan hidup berhasil disimpan');
    }

    private function storeDamages(Request $request, string $type)
    {
        $count = count($request->input("{$type}_jenis_kerusakan", []));
        
        for ($i = 0; $i < $count; $i++) {
            EnvironmentalDamage::create([
                'bencana_id' => session('bencana_id'), // Make sure to set this in your session
                'ekosistem' => $type,
                'jenis_kerusakan' => $request->input("{$type}_jenis_kerusakan.{$i}"),
                'rb' => $request->input("{$type}_rb.{$i}"),
                'rs' => $request->input("{$type}_rs.{$i}"),
                'rr' => $request->input("{$type}_rr.{$i}"),
                'harga_rb' => $request->input("{$type}_harga_rb.{$i}"),
                'harga_rs' => $request->input("{$type}_harga_rs.{$i}"),
                'harga_rr' => $request->input("{$type}_harga_rr.{$i}"),
            ]);
        }
    }

    private function storeLosses(Request $request, string $type, string $jenis_kerugian)
    {
        $count = count($request->input("{$type}_jenis_kerugian", []));
        
        for ($i = 0; $i < $count; $i++) {
            EnvironmentalLoss::create([
                'bencana_id' => session('bencana_id'), // Make sure to set this in your session
                'jenis_kerugian' => $jenis_kerugian,
                'jenis' => $request->input("{$type}_jenis_kerugian.{$i}"),
                'dasar_perhitungan' => $request->input("{$type}_dasar_perhitungan.{$i}"),
                'rb' => $request->input("{$type}_rb.{$i}"),
                'rs' => $request->input("{$type}_rs.{$i}"),
                'rr' => $request->input("{$type}_rr.{$i}"),
            ]);
        }
    }
}