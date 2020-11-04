<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Rupiah;

class TransaksiDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
       return [
           'kd_transaksi_detail'=>$this->kd_transaksi_detail,
           'no_faktur'=>$this->no_faktur,
           'kd_produk'=>$this->kd_produk,
           'jumlah'=>$this->jumlah,
           'harga'=>$this->harga,
           'harga_rupiah'=>Rupiah::get_rupiah($this->harga),
           'nama_produk'=>$this->produk->nama_produk, //karna sdh ada di transaksi detail relasinya
           'kategori'=>$this->produk->kategori->kategori,
           'gambar_produk'=>env('ASSET_URL')."/uploads/".$this->produk->gambar_produk
       ];
    }
}
