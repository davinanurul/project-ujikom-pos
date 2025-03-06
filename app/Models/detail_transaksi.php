<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTransaksi extends Model
{
    use HasFactory;

    protected $table = 'detail_transaksi';

    protected $fillable = [
        'id_transaksi',
        'id_produk',
        'qty',
        'subtotal',
    ];

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'id_transaksi', 'id');
    }

    public function produk()
    {
        return $this->hasMany(Produk::class, 'id_produk', 'id');
    }
}
