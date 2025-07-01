<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('detail_penjualan', function (Blueprint $table) {
            $table->id('id_detail');
            $table->unsignedBigInteger('id_penjualan');
            $table->unsignedBigInteger('id_produk');
            $table->integer('jumlah');
            $table->decimal('harga_satuan', 10, 2);
            $table->decimal('subtotal', 12, 2);
            $table->timestamps();

            $table->foreign('id_penjualan')->references('id_penjualan')->on('penjualan');
            $table->foreign('id_produk')->references('id_produk')->on('produk');
        });
    }

    public function down()
    {
        Schema::dropIfExists('detail_penjualan');
    }
};