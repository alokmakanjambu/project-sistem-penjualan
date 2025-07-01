<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    use HasFactory;

    protected $table = 'sellers';
    protected $primaryKey = 'id_seller';

    protected $fillable = [
        'nama_seller',
        'username',
        'password',
        'no_telepon'
    ];

    public function penjualan()
    {
        return $this->hasMany(Penjualan::class, 'id_seller', 'id_seller');
    }
}