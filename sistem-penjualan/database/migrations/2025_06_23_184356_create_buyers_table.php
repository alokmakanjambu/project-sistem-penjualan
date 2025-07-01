<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('buyers', function (Blueprint $table) {
            $table->id('id_buyer');
            $table->string('nama_buyer', 100);
            $table->string('username', 100)->unique();
            $table->string('password_buyer', 100);
            $table->string('alamat', 255);
            $table->string('no_telepon', 15);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('buyers');
    }
};