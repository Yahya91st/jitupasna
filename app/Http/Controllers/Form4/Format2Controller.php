<?php

namespace App\Http\Controllers\Form4;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bencana;

class Format2Controller extends Controller
{
    /**
     * Display Format 2 form for Education sector data collection
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
        
        return view('forms.form4.format2.format2form4', compact('bencana'));
    }

    /**
     * Store format2 form data (Not implemented yet)
     */
    public function store(Request $request)
    {
        return redirect()->back()->with('error', 'Format 2 (Education Sector) belum diimplementasikan.');
    }

    /**
     * Show a specific form data (Not implemented yet)
     */
    public function show($id)
    {
        return redirect()->back()->with('error', 'Format 2 (Education Sector) belum diimplementasikan.');
    }

    /**
     * List all entries for this format (Not implemented yet)
     */
    public function list(Request $request)
    {
        $bencana_id = $request->input('bencana_id');
        
        if (!$bencana_id) {
            return redirect()->route('bencana.index', ['source' => 'forms']);
        }
        
        $bencana = Bencana::findOrFail($bencana_id);
        
        return view('forms.form4.format2.not-implemented', compact('bencana'));
    }

    /**
     * Generate PDF (Not implemented yet)
     */
    public function generatePdf($id)
    {
        return redirect()->back()->with('error', 'Format 2 (Education Sector) belum diimplementasikan.');
    }

    /**
     * Preview PDF (Not implemented yet)
     */
    public function previewPdf($id)
    {
        return redirect()->back()->with('error', 'Format 2 (Education Sector) belum diimplementasikan.');
    }
}
