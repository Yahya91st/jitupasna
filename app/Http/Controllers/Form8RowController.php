<?php
namespace App\Http\Controllers;

use App\Models\Form8Row;
use App\Models\Form8;
use Illuminate\Http\Request;

class Form8RowController extends Controller
{
    public function index($form8_id)
    {
        $form8 = Form8::findOrFail($form8_id);
        $rows = $form8->rows; // relasi hasMany di model Form8
        return view('forms.form8.rows.index', compact('form8', 'rows'));
    }

    public function create($form8_id)
    {
        return view('forms.form8.rows.create', compact('form8_id'));
    }

    public function store(Request $request, $form8_id)
    {
        $validated = $request->validate([
            'sektor_sub_sektor' => 'required|string|max:255',
            // ... field lain sesuai kebutuhan
        ]);
        $validated['form8_id'] = $form8_id;
        Form8Row::create($validated);
        return redirect()->route('form8rows.index', $form8_id)->with('success', 'Baris detail berhasil ditambah');
    }

    public function edit($id)
    {
        $row = Form8Row::findOrFail($id);
        return view('forms.form8.rows.edit', compact('row'));
    }

    public function update(Request $request, $id)
    {
        $row = Form8Row::findOrFail($id);
        $validated = $request->validate([
            'sektor_sub_sektor' => 'required|string|max:255',
            // ... field lain sesuai kebutuhan
        ]);
        $row->update($validated);
        return back()->with('success', 'Baris detail berhasil diperbarui');
    }

    public function destroy($id)
    {
        $row = Form8Row::findOrFail($id);
        $form8_id = $row->form8_id;
        $row->delete();
        return redirect()->route('form8rows.index', $form8_id)->with('success', 'Baris detail berhasil dihapus');
    }
}