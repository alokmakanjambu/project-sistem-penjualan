<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('penjualan', function (Blueprint $table) {
            $table->id('id_penjualan');
            $table->datetime('tanggal_penjualan');
            $table->unsignedBigInteger('id_buyer');
            $table->unsignedBigInteger('id_seller');
            $table->decimal('total_harga', 12, 2);
            $table->enum('metode_pembayaran', ['COD', 'Transfer']);
            $table->enum('status_pembayaran', ['Belum Dibayar', 'Sudah Dibayar']);
            $table->datetime('tanggal_bayar')->nullable();
            $table->string('bukti_transfer', 100)->nullable();
            $table->string('keterangan', 255)->nullable();
            $table->timestamps();

            $table->foreign('id_buyer')->references('id_buyer')->on('buyers');
            $table->foreign('id_seller')->references('id_seller')->on('sellers');
        });
    }

    public function down()
    {
        Schema::dropIfExists('penjualan');
    }
};