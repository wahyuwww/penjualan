<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PegawaiResource extends JsonResource
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
           'username'=>$this->username,
           'password'=>$this->password,
           'nama_pegawai'=>$this->nama_pegawai,
           'jk'=>$this->jk,
           'alamat'=>$this->alamat,
           'is_aktif'=>$this->is_aktif,

       ]; 
    }
}
