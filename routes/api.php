<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('agen','Api\AgenController');
Route::get('search_agen','Api\AgenController@search');
Route::post('login_pegawai','Api\PegawaiController@login_pegawai');
Route::get('get_kategori','Api\KategoriController@get_all');
Route::post('get_produk','Api\ProdukController@get_produk_kategori'); //yang terkahir itu function
Route::post('add_cart','Api\TransaksiController@add_cart'); 
Route::post('get_cart','Api\TransaksiController@get_cart'); 
Route::post('delete_item_cart','Api\TransaksiController@delete_item_cart'); 
Route::post('delete_cart','Api\TransaksiController@delete_cart'); 
Route::post('checkout','Api\TransaksiController@checkout'); 
Route::post('get_transaksi','Api\TransaksiController@get_transaksi'); 
Route::post('get_detail_transaksi','Api\TransaksiController@get_detail_transaksi'); 