<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buyer extends Model
{
    use HasFactory;

    protected $table = 'buyers';
    protected $primaryKey = 'id_buyer';

    protected $fillable = [
        'username',
        'password_buyer',
        'nama_buyer',
        'alamat',
        'no_telepon'
    ];

    public function penjualan()
    {
        return $this->hasMany(Penjualan::class, 'id_buyer', 'id_buyer');
    }
}