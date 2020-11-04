<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\KeranjangResource;
use App\Http\Resources\TransaksiDetailResource;
use App\Http\Resources\TransaksiResource;
use App\Keranjang;
use App\Produk;
use App\Transaksi;
use App\TransaksiDetail;
use Validator;
use Illuminate\Support\Facades\DB; //MENJENERIT SEBUAH NOMER YANG SIFATNYA INCEMENT

class TransaksiController extends Controller
{
    public function add_cart(Request $request)
    //mengkap seluruh inputan yang sudah dicek
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'username' => 'required|max:100',
            'kd_produk' => 'required|max:100',
            'jumlah' => 'required|max:100'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => FALSE,
                'msg' => $validator->errors()
            ], 400);
        }
        $data['username'] = $request->input('username');
        $data['kd_produk'] = $request->input('kd_produk');
        $data['jumlah'] = $request->input('jumlah');
        //mencari data stok produk
        $data_produk = Produk::find($data['kd_produk']);
        $stok_produk = $data_produk->stok;

        //mencari jumlah produk itu sendiri didalam table keranjang
        $jumlah_barang_cart = Keranjang::where('kd_produk', $data['kd_produk'])->sum('jumlah');
        $stok_hasil = $stok_produk - $jumlah_barang_cart;
        //jika stok hasil < dari jumlah yang diinputkan maka akan menamplkan "stok barang tidak mencukupi"
        if ($stok_hasil < $data['jumlah']) {
            return response()->json([
                'status' => FALSE,
                'msg' => 'stok barang tidak mencukupi'
            ], 200);
        }
        $data['harga'] = $data_produk->harga;
        Keranjang::create($data);
        return response()->json([
            'status' => TRUE,
            'msg' => 'Data Berhasil Ditambahkan'
        ], 201);
    }
    function get_cart(Request $request)
    {
        //mencari data pada tabel keranjang sesuai username
        $username = $request->input('username');
        $keranjang = Keranjang::where('username', $username)->get();
        //pengecekan ada gak username sesuai yang dipilih

        //data kosong
        if ($keranjang->isEmpty()) {
            return response()->json([
                'status' => FALSE,
                'msg' => 'Cart Kosong'
            ], 200);
        }
        //jika ada datanya 
        else {
            return KeranjangResource::collection($keranjang);
        }
    }
    function delete_item_cart(Request $request)
    { //menangkap sebuah inputan
        $kd_keranjang = $request->input('kd_keranjang');
        $keranjang = Keranjang::find($kd_keranjang);
        if (is_null($keranjang)) {
            return response()->json([
                'status' => FALSE,
                'msg' => 'Data tidak ditemukan'
            ], 404);
        }
        $keranjang->delete();
        return response()->json([
            'status' => TRUE,
            'msg' => 'Data berhasil Dihapus'
        ], 200);
    }
    function delete_cart(Request $request)
    {
        $username = $request->input('username'); //menangkap inputan dari requst
        //menghapus data
        Keranjang::where('username', $username)->delete();
        return response()->json([
            'status' => TRUE,
            'msg' => 'data berhasil dihapus'
        ], 200);
    }
    function checkout(Request $request)
    {
        //data yang akan diinsertkan ke dalam tabel transaksi
        $data['tgl_penjualan'] = date("Y-m-d");

        //diinputkan bagian api pada request
        $data['kd_agen'] = $request->input('kd_agen');
        $data['username'] = $request->input('username');

        //dijeneret oleh sistem
        $data['no_faktur'] = $this->get_nomor_faktur();
        $data['total'] = $this->get_total_cart($data['username']);
        Transaksi::create($data);
        //berelasi dengan transksi detail
        //menyimpan tabel karangjang berdasrkan username
        $cart = Keranjang::where('username', $data['username'])->get();
        foreach ($cart as $row) //perulangan akan update atau mengurangi stok
        {
            $data_cart['no_faktur'] = $data['no_faktur'];
            $data_cart['kd_produk'] = $row->kd_produk; //mewakili 1 recored dari tbale keranjang
            $data_cart['jumlah'] = $row->jumlah;
            $data_cart['harga'] = $row->harga;
            TransaksiDetail::create($data_cart);

            //mengurangi stok dari produk yang melakukan chekout
            $produk = Produk::find($row->kd_produk); //bedasarkan kode produk yang dipilih
            $data_produk['stok'] = $produk->stok - $row->jumlah; //ketika stok dikurangi jumlah berrti kita medapatkan stok saat ini
            $produk->update($data_produk);
        }
        Keranjang::where('username', $data['username'])->delete();
        return response()->json([
            'status' => TRUE,
            'msg' => 'check out berhasil'
        ], 200);
    }
    private function get_nomor_faktur()
    {
        $query = DB::select('SELECT MAX(RIGHT(no_faktur,6)) AS max_faktur FROM transaksi WHERE DATE(tgl_penjualan)=CURDATE()'); //mencari 6 digit treakhir berdarasrkan tanggal penjualan hari ini
        $kd = "";
        if (count($query) > 0) {
            foreach ($query as $row) {
                $tmp = ((int) $row->max_faktur) + 1;
                $kd = sprintf("%06s", $tmp);
            }
        } else {
            $kd = "000001";
        }
        $hasil =  date('dmy') . $kd;
        return $hasil;
    }


    private function get_total_cart($username)
    {
        $data_keranjang = Keranjang::where('username', $username)->get();
        $total = 0;
        foreach ($data_keranjang as $row) {
            $total = $total + ($row->jumlah * $row->harga); //perulangan jumalah * harga 
        }
        return $total;
    }
    function get_transaksi(Request $request)
    {
        $username = $request->input('username');
        //menyimpan pencarian data tersebut
        $data_transaksi= Transaksi::where('username',$username)->get();
        if($data_transaksi->isEmpty()){
            return response()->json([
                'status' =>FALSE,
                'msg' =>'Record data tidak ditemukan'
            ],200);
        }
        return TransaksiResource::collection($data_transaksi);
    }

    function get_detail_transaksi(Request $request)
    {

        $no_faktur = $request->input('no_faktur');
        $data_transaksi_detail = TransaksiDetail::where('no_faktur', $no_faktur)->get(); //mrngambil data dari no faktur
        if ($data_transaksi_detail->isEmpty()) {
            return response()->json([
                'status' => FALSE,
                'msg' => 'Record tidak ditemukan'
            ], 200);
        }
        return TransaksiDetailResource::collection($data_transaksi_detail);
    }
}
