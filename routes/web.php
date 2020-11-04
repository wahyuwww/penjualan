<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('end');
});

Auth::routes();

Route::match(["get","post"],"/register",function(){
    return redirect('login');
})->name("register");
Route::view('end','tampilan.end');

 Route::group(['middleware' => ['auth']], function () { //buat pengakseskan

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('user','UserController');
Route::resource('supplier','SupplierController')->except(['show']);
Route::resource('pegawai','PegawaiController')->except(['show']);
Route::resource('kategori','KategoriController')->except(['show']);
Route::resource('produk','ProdukController')->except(['show']);
Route::resource('transaksi_masuk','TransaksiMasukController')->only(['index','create','store','destroy']);
Route::get('agen','AgenController@index')->name('agen');
Route::get('report_penjualan','ReportPenjualanController@index')->name('report_penjualan');
Route::get('cetak_pdf','ReportPenjualanController@cetak_pdf')->name('cetak_pdf');
Route::get('cetak_excel','ReportPenjualanController@cetak_excel')->name('cetak_excel');
//Route::get('tampilan','TampilanController@end')->name('tampilan');
 });





