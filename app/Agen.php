<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agen extends Model
{
    protected $table = 'agen';
    protected $primaryKey = 'kd_agen';
    protected $fillable = [
        'nama_toko',
        'nama_pemilik',
        'alamat',
        'latitude',
        'longitude',
        'gambar_toko'
    ];
}
