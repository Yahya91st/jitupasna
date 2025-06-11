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

        return view('forms.form-list', compact('bencana'));
    }
}