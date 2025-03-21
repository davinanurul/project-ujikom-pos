<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $table = 'member';

    protected $fillable = [
        'nama',
        'telepon',
        'alamat',
        'tanggal_bergabung',
        'status',
    ];

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'member_id', 'id');
    }
}
