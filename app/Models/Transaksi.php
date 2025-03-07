<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

    public static function generateNumberTransaksi()
    {
        $date = now()->format('Ymd');
        $latestNumber = DB::table('transactions')
            ->whereDate('created_at', now())
            ->max('number_transaksi'); // Ambil nomor transaksi terakhir hari ini

        if ($latestNumber) {
            $lastNumber = (int) substr($latestNumber, -4); // Ambil 4 digit terakhir
            $nextNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT); // Tambah 1
        } else {
            $nextNumber = '0001'; // Jika belum ada transaksi hari ini, mulai dari 0001
        }

        return 'TRX-' . $date . '-' . $nextNumber;
    }
}
