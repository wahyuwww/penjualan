<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Rupiah;

class KeranjangResource extends JsonResource
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
            'kd_keranjang' => $this->kd_keranjang,
            'username' => $this->username,
            'kd_produk' => $this->kd_produk,
            'jumlah' => $this->jumlah,
            'harga' => $this->harga,
            'harga_rupiah' => Rupiah::get_rupiah($this->harga),
            'nama_produk' => $this->produk->nama_produk,
            'kategori' => $this->produk->kategori->kategori, //kebagian produk dulu baru kekategori  krena tidak ada relasi lngsung ke kategori
            'gambar_produk' => env('ASSET_URL') . "/uploads/" . $this->produk->gambar_produk
        ];
    }
}
