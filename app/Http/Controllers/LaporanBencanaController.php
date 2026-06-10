<?php

namespace App\Http\Controllers;

use App\Models\LaporanBencana;
use Illuminate\Http\Request;

class LaporanBencanaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $laporan = LaporanBencana::with(['bencana', 'user'])->latest()->get();

        return view('laporan_bencana.index', compact('laporan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $bencanas = \App\Models\Bencana::all();

        return view('laporan_bencana.create', compact('bencanas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'bencana_id' => 'required|exists:bencanas,id',
            'tanggal_lapor' => 'required|date',
            'total_kerusakan' => 'required|integer',
            'total_kerugian' => 'required|integer',
        ]);

        LaporanBencana::create([
            'user_id' => auth()->id(),
            'bencana_id' => $validated['bencana_id'],
            'tanggal_lapor' => $validated['tanggal_lapor'],
            'status_laporan' => 'draft',
            'total_kerusakan' => $validated['total_kerusakan'],
            'total_kerugian' => $validated['total_kerugian'],
        ]);

        return redirect()->route('laporan-bencana.index')
            ->with('success', 'Laporan berhasil dibuat');
    }

    /**
     * Display the specified resource.
     */
    public function show(LaporanBencana $laporanBencana)
    {
        return view('laporan_bencana.show', compact('laporanBencana'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LaporanBencana $laporanBencana)
    {
        $bencanas = \App\Models\Bencana::all();

        return view('laporan_bencana.edit', compact('laporanBencana', 'bencanas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LaporanBencana $laporanBencana)
    {
        $validated = $request->validate([
            'status_laporan' => 'required|in:draft,diproses,selesai,ditolak',
            'total_kerusakan' => 'required|integer',
            'total_kerugian' => 'required|integer',
        ]);

        $laporanBencana->update($validated);

        return redirect()->route('laporan-bencana.index')
            ->with('success', 'Laporan berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LaporanBencana $laporanBencana)
    {
        $laporanBencana->delete();

        return redirect()->route('laporan-bencana.index')
            ->with('success', 'Laporan berhasil dihapus');
    }
}
