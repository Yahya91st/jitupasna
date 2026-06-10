<?php

namespace App\Http\Controllers;

use App\Models\Formulir;
use Illuminate\Http\Request;
use App\Models\Bencana;

class FormulirController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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

        return view('forms.form-list', compact('bencana'));
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Formulir $formulir)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Formulir $formulir)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Formulir $formulir)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Formulir $formulir)
    {
        //
    }
}
