<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\ProdukVarian;
use Illuminate\Http\Request;

class ProdukVarianController extends Controller
{
    public function index()
    {
        $produkVarians = ProdukVarian::all();
        return view('produk_varian.index', compact('produkVarians'));
    }

    public function create()
    {
        $produks = Produk::all();
        return view('produk_varian.create', compact('produks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_produk'  => 'required|exists:produk,id',
            'size'       => 'required|in:S,M,L,XL',
            'warna'      => 'required|string|max:50',
            'harga_jual' => 'required|numeric|min:0',
        ]);

        ProdukVarian::create([
            'id_produk'  => $request->id_produk,
            'size'       => $request->size,
            'warna'      => $request->warna,
            'harga_jual' => $request->harga_jual,
        ]);

        return redirect()->route('produk_varian.index')->with('success', 'Varian produk berhasil ditambahkan.');
    }
}
