<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKeranjangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keranjang', function (Blueprint $table) {
            $table->increments('kd_keranjang');
            $table->string('username', 100);
            $table->foreign('username')->references('username')->on('pegawai'); //relasi
            $table->unsignedInteger('kd_produk');
            $table->foreign('kd_produk')->references('kd_produk')->on('produk');
            $table->integer('jumlah');
            $table->integer('harga');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('keranjang', function (Blueprint $table) {
            $table->dropForeign(['username']);
            $table->dropForeign(['kd_produk']);
        });
        Schema::dropIfExists('keranjang');
    }
}
