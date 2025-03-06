<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produk';
    protected $fillable = ['user_id','kategori_id','supplier_id', 'kode', 'nama', 'harga_jual'];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function batch()
    {
        return $this->hasMany(Batch::class);
    }
}
