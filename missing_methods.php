<?php

// Format 6
public function format6form4(Request $request)
{
    $bencana_id = $request->input('bencana_id');
    
    // Redirect to bencana selection if no bencana_id is provided
    if (!$bencana_id) {
        return redirect()->route('bencana.index', ['source' => 'forms']);
    }
    
    // Get bencana details
    $bencana = Bencana::findOrFail($bencana_id);
    
    return view('forms.form4.format6.format6form4', compact('bencana'));
}

// Format 8
public function format8form4(Request $request)
{
    $bencana_id = $request->input('bencana_id');
    
    // Redirect to bencana selection if no bencana_id is provided
    if (!$bencana_id) {
        return redirect()->route('bencana.index', ['source' => 'forms']);
    }
    
    // Get bencana details
    $bencana = Bencana::findOrFail($bencana_id);
    
    return view('forms.form4.format8.format8form4', compact('bencana'));
}

// Format 9
public function format9form4(Request $request)
{
    $bencana_id = $request->input('bencana_id');
    
    // Redirect to bencana selection if no bencana_id is provided
    if (!$bencana_id) {
        return redirect()->route('bencana.index', ['source' => 'forms']);
    }
    
    // Get bencana details
    $bencana = Bencana::findOrFail($bencana_id);
    
    return view('forms.form4.format9.format9form4', compact('bencana'));
}

// Format 10
public function format10form4(Request $request)
{
    $bencana_id = $request->input('bencana_id');
    
    // Redirect to bencana selection if no bencana_id is provided
    if (!$bencana_id) {
        return redirect()->route('bencana.index', ['source' => 'forms']);
    }
    
    // Get bencana details
    $bencana = Bencana::findOrFail($bencana_id);
    
    return view('forms.form4.format10.format10form4', compact('bencana'));
}

// Format 11
public function format11form4(Request $request)
{
    $bencana_id = $request->input('bencana_id');
    
    // Redirect to bencana selection if no bencana_id is provided
    if (!$bencana_id) {
        return redirect()->route('bencana.index', ['source' => 'forms']);
    }
    
    // Get bencana details
    $bencana = Bencana::findOrFail($bencana_id);
    
    return view('forms.form4.format11.format11form4', compact('bencana'));
}

// Format 12
public function format12form4(Request $request)
{
    $bencana_id = $request->input('bencana_id');
    
    // Redirect to bencana selection if no bencana_id is provided
    if (!$bencana_id) {
        return redirect()->route('bencana.index', ['source' => 'forms']);
    }
    
    // Get bencana details
    $bencana = Bencana::findOrFail($bencana_id);
    
    return view('forms.form4.format12.format12form4', compact('bencana'));
}

// Format 13
public function format13form4(Request $request)
{
    $bencana_id = $request->input('bencana_id');
    
    // Redirect to bencana selection if no bencana_id is provided
    if (!$bencana_id) {
        return redirect()->route('bencana.index', ['source' => 'forms']);
    }
    
    // Get bencana details
    $bencana = Bencana::findOrFail($bencana_id);
    
    return view('forms.form4.format13.format13form4', compact('bencana'));
}

// Format 14
public function format14form4(Request $request)
{
    $bencana_id = $request->input('bencana_id');
    
    // Redirect to bencana selection if no bencana_id is provided
    if (!$bencana_id) {
        return redirect()->route('bencana.index', ['source' => 'forms']);
    }
    
    // Get bencana details
    $bencana = Bencana::findOrFail($bencana_id);
    
    return view('forms.form4.format14.format14form4', compact('bencana'));
}

// Format 15
public function format15form4(Request $request)
{
    $bencana_id = $request->input('bencana_id');
    
    // Redirect to bencana selection if no bencana_id is provided
    if (!$bencana_id) {
        return redirect()->route('bencana.index', ['source' => 'forms']);
    }
    
    // Get bencana details
    $bencana = Bencana::findOrFail($bencana_id);
    
    return view('forms.form4.format15.format15form4', compact('bencana'));
}
