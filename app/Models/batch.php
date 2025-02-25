<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    use HasFactory;

    protected $table = 'batch';
    protected $fillable = ['produk_id', 'jumlah', 'harga_beli', 'tanggal_kedaluwarsa'];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($batch) {
            $produk = Produk::find($batch->produk_id);
            $keuntungan = $produk->keuntungan; // Ambil keuntungan dari produk

            // Menghitung harga jual otomatis berdasarkan harga beli + keuntungan
            $batch->harga_jual = $batch->harga_beli + ($batch->harga_beli * ($keuntungan / 100));
        });
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }
}
