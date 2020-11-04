<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Produk;
use App\Http\Resources\ProdukResource;

class ProdukController extends Controller
{
    public function get_produk_kategori(Request $request)
    {
        //mengangkap inputan kategori
        $kd_kategori = $request->input('kd_kategori');
        //menyimpan ketegori tertentu krena kondisi ada 2 
        //menggunakan array
        $produk = Produk::where([
            ['kd_kategori', $kd_kategori],
            ['stok','>', 0]
        ])->get();
//penegcekan produk ada
        if($produk->isEmpty())
        {
            return response()->json([
                'status'=>FALSE,
                'msg'=>'Produk tidak ditemukan'
            ],200);
        }

        //jika produk ada memakai resaouce
        return ProdukResource::collection($produk);
    }
}

