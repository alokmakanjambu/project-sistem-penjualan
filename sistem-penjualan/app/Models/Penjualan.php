<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;

    protected $table = 'penjualan';
    protected $primaryKey = 'id_penjualan';

    protected $fillable = [
        'tanggal_penjualan',
        'id_buyer',
        'id_seller',
        'total_harga',
        'metode_pembayaran',
        'status_pembayaran',
        'tanggal_bayar',
        'bukti_transfer',
        'keterangan'
    ];

    protected $casts = [
        'tanggal_penjualan' => 'datetime',
        'tanggal_bayar' => 'datetime',
    ];

    public function buyer()
    {
        return $this->belongsTo(Buyer::class, 'id_buyer', 'id_buyer');
    }

    public function seller()
    {
        return $this->belongsTo(Seller::class, 'id_seller', 'id_seller');
    }

    public function detailPenjualan()
    {
        return $this->hasMany(DetailPenjualan::class, 'id_penjualan', 'id_penjualan');
    }
}