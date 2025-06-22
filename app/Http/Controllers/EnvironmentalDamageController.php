<?php

namespace App\Http\Controllers;

use App\Models\EnvironmentalReport;
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
            // Damage validators
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
            'udara_damage_rb.*' => 'nullable|integer',
            'udara_damage_rs.*' => 'nullable|integer',
            'udara_damage_rr.*' => 'nullable|integer',
            'udara_damage_harga_rb.*' => 'nullable|numeric',
            'udara_damage_harga_rs.*' => 'nullable|numeric',
            'udara_damage_harga_rr.*' => 'nullable|numeric',
            
            // Loss validators
            'jasa_jenis_kerugian.*' => 'required|string',
            'jasa_dasar_perhitungan.*' => 'nullable|string',
            'jasa_rb.*' => 'nullable|integer',
            'jasa_rs.*' => 'nullable|integer',
            'jasa_rr.*' => 'nullable|integer',
            'jasa_harga_rb.*' => 'nullable|numeric',
            'jasa_harga_rs.*' => 'nullable|numeric',
            'jasa_harga_rr.*' => 'nullable|numeric',
            
            'air_jenis_kerugian.*' => 'required|string',
            'air_dasar_perhitungan.*' => 'nullable|string',
            'air_rb.*' => 'nullable|integer',
            'air_rs.*' => 'nullable|integer',
            'air_rr.*' => 'nullable|integer',
            'air_harga_rb.*' => 'nullable|numeric',
            'air_harga_rs.*' => 'nullable|numeric',
            'air_harga_rr.*' => 'nullable|numeric',
            
            'udara_jenis_kerugian.*' => 'required|string',
            'udara_dasar_perhitungan.*' => 'nullable|string',
            'udara_loss_rb.*' => 'nullable|integer',
            'udara_loss_rs.*' => 'nullable|integer',
            'udara_loss_rr.*' => 'nullable|integer',
            'udara_loss_harga_rb.*' => 'nullable|numeric',
            'udara_loss_harga_rs.*' => 'nullable|numeric', 
            'udara_loss_harga_rr.*' => 'nullable|numeric'
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
            $prefix = ($type === 'udara') ? "{$type}_damage" : $type;
            
            EnvironmentalReport::create([
                'bencana_id' => session('bencana_id'), // Make sure to set this in your session
                'report_type' => 'damage',
                'ekosistem' => $type,
                'jenis_kerusakan' => $request->input("{$type}_jenis_kerusakan.{$i}"),
                'rb' => $request->input("{$prefix}_rb.{$i}"),
                'rs' => $request->input("{$prefix}_rs.{$i}"),
                'rr' => $request->input("{$prefix}_rr.{$i}"),
                'harga_rb' => $request->input("{$prefix}_harga_rb.{$i}"),
                'harga_rs' => $request->input("{$prefix}_harga_rs.{$i}"),
                'harga_rr' => $request->input("{$prefix}_harga_rr.{$i}"),
            ]);
        }
    }

    private function storeLosses(Request $request, string $type, string $jenis_kerugian)
    {
        $count = count($request->input("{$type}_jenis_kerugian", []));
        
        for ($i = 0; $i < $count; $i++) {
            $prefix = ($type === 'udara') ? "{$type}_loss" : $type;
            
            $data = [
                'bencana_id' => session('bencana_id'), // Make sure to set this in your session
                'report_type' => 'loss',
                'jenis_kerugian' => $jenis_kerugian,
                'jenis' => $request->input("{$type}_jenis_kerugian.{$i}"),
                'dasar_perhitungan' => $request->input("{$type}_dasar_perhitungan.{$i}"),
                'rb' => $request->input("{$prefix}_rb.{$i}"),
                'rs' => $request->input("{$prefix}_rs.{$i}"),
                'rr' => $request->input("{$prefix}_rr.{$i}"),
                'harga_rb' => $request->input("{$prefix}_harga_rb.{$i}") ? $request->input("{$prefix}_harga_rb.{$i}") : 0,
                'harga_rs' => $request->input("{$prefix}_harga_rs.{$i}") ? $request->input("{$prefix}_harga_rs.{$i}") : 0,
                'harga_rr' => $request->input("{$prefix}_harga_rr.{$i}") ? $request->input("{$prefix}_harga_rr.{$i}") : 0,
            ];
            EnvironmentalReport::create($data);
        }
    }
}