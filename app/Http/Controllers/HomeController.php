<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produk;
use App\Agen;
use App\Transaksi;
use App\TransaksiDetail;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $produk = Produk::count(); //mendapatkan jumlah produk
        $agen = Agen::count();
        $transaksi = TransaksiDetail::sum('jumlah'); //menjumlahkan pada jumlah trnsaksi
        $pendapatan = Transaksi::sum('total');
        $nama_produk = [];//memunculkan nama pada grafik
        $jumlah_penjualan = []; //memunculkan jumlah pada grafik
        $data_produk = Produk::all(); //menyimpan data produk yang ada ditabel produk
        foreach ($data_produk as $row) {
            //setiap kali petrulanagan kita akan menyimpan nama produk
            $nama_produk[] = $row->nama_produk;
            //mencari ditabel transaksi detail atau mencari transaksi di transaksi detail
            $jumlah_transaksi = TransaksiDetail::where('kd_produk', $row->kd_produk)->sum('jumlah');
            $jumlah_penjualan[] = $jumlah_transaksi;
        }

        return view('home', compact('produk', 'agen', 'transaksi', 'pendapatan','nama_produk','jumlah_penjualan'));
    }
}
