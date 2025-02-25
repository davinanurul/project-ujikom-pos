<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Produk;
use App\Models\Supplier;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index()
    {
        return view('produk.index');
    }

    public function create()
    {
        $categories = Kategori::all();
        $suppliers = Supplier::all();
        return view('produk.create', compact('categories', 'suppliers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori_id' => 'required|exists:kategori,id',
            'supplier_id' => 'required|exists:supplier,id',
            'kode' => 'required|string|max:50|unique:produk,kode',
            'nama' => 'required|string|max:255',
            'keuntungan' => 'required|numeric|min:0',
        ]);

        $produk = Produk::create([
            'nama' => $request->nama,
            'kategori_id' => $request->kategori_id,
            'supplier_id' => $request->supplier_id,
            'kode' => $request->kode,
            'keuntungan' => $request->keuntungan,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan!');
    }
}
