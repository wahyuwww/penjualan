<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksi';
    protected $primaryKey = 'kd_transaksi';
    protected $fillable = [
        'no_faktur',
        'tgl_penjualan',
        'kd_agen',
        'username',
        'total'
    ];

    public function agen(){
        return $this->belongsTo('App\Agen','kd_agen');
    }

    public function getTglPenjualanAttribute()
    {
        return \Carbon\Carbon::parse($this->attributes['tgl_penjualan'])->format('d-F-Y');
    }
}
