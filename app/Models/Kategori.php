<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategori';
    protected $primaryKey = 'id_kategori';
    protected $fillable = ['nama_kategori'];

    // Contoh relasi jika diperlukan di masa depan
    // public function produk()
    // {
    //     return $this->hasMany(Produk::class);
    // }
}
