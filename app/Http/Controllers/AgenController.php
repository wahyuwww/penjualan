<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Agen;

class AgenController extends Controller
{
    public function index()
    {
        $agen = Agen::orderBy('nama_toko', 'ASC')->paginate(10);
        $data_agen = Agen::all();
        //setiap data ditabel agen akan dibuat array
        $x=0;
        foreach ($data_agen as $row) {
            $hasil[$x]['0'] = $row->nama_toko;
            $hasil[$x]['1'] = $row->latitude;
            $hasil[$x]['2'] = $row->longitude;
            $x++; //incement varibel x ditambah trus
        }
        $hasil_lat_long = json_encode($hasil); //konversi data array di php menjdi format json
        $lokasi = Agen::first(); //record diddalam tabel agen atau posisi sertart dari petanya
       
        return view('agen.index', compact('agen','hasil_lat_long','lokasi')); //data ditampilkan diview
    }
}
