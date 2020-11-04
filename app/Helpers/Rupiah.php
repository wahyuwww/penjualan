<?php
namespace App\Helpers;

class Rupiah {
    public static function get_rupiah($nominal) {
        return "Rp ".number_format($nominal, 0, ',', '.');
    }
}