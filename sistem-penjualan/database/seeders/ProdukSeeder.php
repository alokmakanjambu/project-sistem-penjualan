<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Produk;

class ProdukSeeder extends Seeder
{
    public function run()
    {
        $produk = [
            [
                'id_produk' => 1,
                'nama_produk' => 'Samsung Galaxy A14',
                'jenis_produk' => 'Smartphone Android',
                'harga_satuan' => 2399000,
                'stok' => 20
            ],
            [
                'id_produk' => 2,
                'nama_produk' => 'Xiaomi Redmi Note 12',
                'jenis_produk' => 'Smartphone Android',
                'harga_satuan' => 2799000,
                'stok' => 10
            ],
            [
                'id_produk' => 3,
                'nama_produk' => 'Realme C55',
                'jenis_produk' => 'Smartphone Android',
                'harga_satuan' => 2499000,
                'stok' => 18
            ],
            [
                'id_produk' => 4,
                'nama_produk' => 'OPPO A78 5G',
                'jenis_produk' => 'Smartphone Android',
                'harga_satuan' => 3999000,
                'stok' => 17
            ]
        ];

        foreach ($produk as $item) {
            Produk::create($item);
        }
    }
}