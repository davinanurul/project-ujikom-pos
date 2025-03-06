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
        $produks = Produk::all();
        return view('produk.index', compact('produks'));
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
            'harga_jual' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
        ]);

        $produk = Produk::create([
            'nama' => $request->nama,
            'kategori_id' => $request->kategori_id,
            'supplier_id' => $request->supplier_id,
            'kode' => $request->kode,
            'harga_jual' => $request->harga_jual,
            'stok' => $request->stok,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan!');
    }


    public function edit($id)
    {
        $produk = Produk::findOrFail($id);
        $categories = Kategori::all();
        $suppliers = Supplier::all();

        return view('produk.edit', compact('produk', 'categories', 'suppliers'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kategori_id' => 'required|exists:kategori,id',
            'supplier_id' => 'required|exists:supplier,id',
            'kode' => 'required|string|max:50|unique:produk,kode,' . $id,
            'nama' => 'required|string|max:255',
            'harga_jual' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
        ]);

        $produk = Produk::findOrFail($id);
        $produk->update([
            'nama' => $request->nama,
            'kategori_id' => $request->kategori_id,
            'supplier_id' => $request->supplier_id,
            'kode' => $request->kode,
            'harga_jual' => $request->harga_jual,
            'stok' => $request->stok,
        ]);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil diperbarui!');
    }
}
