<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransaksiDetail extends Model
{
    protected $table = 'transaksi_detail';
    protected $primaryKey = 'kd_transaksi_detail';
    protected $fillable = [
        'kd_transaksi_detail',
        'no_faktur',
        'kd_produk',
        'jumlah',
        'harga'
    ];

    public function produk()
    {
        return $this->belongsTo('App\Produk','kd_produk');
    }

    public function transaksi()
    {
        return $this->belongsTo('App\Transaksi','no_faktur','no_faktur'); //nomer faktur 2 karena bukan primarykey
    }
}
