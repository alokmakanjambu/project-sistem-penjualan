<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Seller;

class SellerSeeder extends Seeder
{
    public function run()
    {
        Seller::create([
            'id_seller' => 111,
            'nama_seller' => 'Tejo',
            'username' => 'tejo_11',
            'password' => 'pass123',
            'no_telepon' => '0852 7456 8990'
        ]);

        Seller::create([
            'id_seller' => 121,
            'nama_seller' => 'Arya Gemilang',
            'username' => 'gemilangcell',
            'password' => 'nak_nak44',
            'no_telepon' => '0813 4567 8901'
        ]);
    }
}