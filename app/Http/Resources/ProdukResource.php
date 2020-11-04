<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Rupiah;

class ProdukResource extends JsonResource
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
            'kd_produk' => $this->kd_produk,
            'kd_kategori' => $this->kd_kategori,
            'nama_produk' => $this->nama_produk,
            'harga' => $this->harga,//membuat halper
            'harga_rupiah'=>Rupiah::get_rupiah($this->harga),
            'gambar_produk' => env('ASSET_URL') . "/uploads/" . $this->gambar_produk,
            'stok' => $this->stok,
            //harus mengakses ke tabel kategori terlebih dahulu
            'kategori' => $this->kategori->kategori
        ];
    }
}
