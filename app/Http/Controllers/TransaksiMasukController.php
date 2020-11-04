<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TransaksiMasuk;
use App\Produk;
use App\Supplier;
use Validator;

class TransaksiMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $transaksi_masuk = TransaksiMasuk::orderBy('tgl_transaksi', 'DESC')->paginate('5');
        $start_date = $request->get('start_date');
        $end_date = $request->get('end_date');
        if ($start_date != "" && $end_date != "") {
            $transaksi_masuk = TransaksiMasuk::whereBetween('tgl_transaksi', [$start_date, $end_date])->orderBy('tgl_transaksi', 'DESC')->paginate(20);
        $start_date = \Carbon\Carbon::parse($start_date)->format('d-F-Y');
        $end_date = \Carbon\Carbon::parse($end_date)->format('d-F-Y');
        }
        return view('transaksi_masuk.index', compact('transaksi_masuk','start_date','end_date'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $produk = Produk::all();
        $supplier = Supplier::all();
        return view('transaksi_masuk.create', compact('produk', 'supplier'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $validator =  Validator::make($input, [
            'tgl_transaksi' => 'required|date',
            'jumlah' => 'required|numeric',
            'harga' => 'required|numeric'

        ]);
        if ($validator->fails()) {
            return redirect()->route('transaksi_masuk.create')->withErrors($validator)->withInput();
        }
        TransaksiMasuk::create($input);
        $produk = Produk::find($input['kd_produk']);
        $data['stok'] = $produk->stok + $input['jumlah'];
        $produk->update($data);
        return redirect()->route('transaksi_masuk.index')->with('status', 'transaksi masuk berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id=
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $transaksi_masuk = TransaksiMasuk::findOrfail($id);
        $jumlah = $transaksi_masuk->jumlah;

        $produk = Produk::find($transaksi_masuk->kd_produk);
        $data['stok'] = $produk->stok - $jumlah;
        $produk->update($data);

        $transaksi_masuk->delete();
        return redirect()->route('transaksi_masuk.index')->with('status', 'transaksi masuk berhasil dihapus');
    }
}
