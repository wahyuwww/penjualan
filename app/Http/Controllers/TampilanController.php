<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TampilanController extends Controller
{
    public function index()
    {
        $penjualan = TransaksiDetail::orderBy('created_at', 'DESC')->paginate(20); // TERBARU AKAN ADA DIAATSAS
        return view('tampilan.end', compact('penjualan'));
    }
}
