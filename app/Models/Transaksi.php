<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';

    protected $fillable = [
        'nomor_transaksi',
        'tanggal',
        'user_id',
        'member_id',
        'total',
        'pembayaran',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id', 'id');
    }

    public function detailTransaksi()
    {
        return $this->hasMany(DetailTransaksi::class, 'id_transaksi', 'id');
    }
}
