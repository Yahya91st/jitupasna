<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VerifikasiController extends Controller
{
    public function index()
    {
        return view('verifikasi.pemukiman');
    }
    public function jalan()
    {
        return view('verifikasi.jalan');
    }
    public function jembatan()
    {
        return view('verifikasi.jembatan');
    }
}
