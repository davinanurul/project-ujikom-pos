<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function create()
    {
        $produks = Produk::all();
        return view('transaksi.create', compact('produks'));
    }
}
