<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Kategori;
use App\Http\Resources\KategoriResource;


class KategoriController extends Controller
{
    public function get_all(){
        return KategoriResource::collection(Kategori::all());
    }
}
