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
            'nama' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $gambarNama = null;
        if ($request->hasFile('gambar')) {
            $gambarNama = $request->file('gambar')->store('produk-img', 'public');
            $gambarNama = basename($gambarNama); // Ambil hanya nama file-nya
        }

        $produk = Produk::create([
            'kode' => Produk::generateKodeBarang(),
            'nama' => $request->nama,
            'kategori_id' => $request->kategori_id,
            'supplier_id' => $request->supplier_id,
            'user_id' => auth()->id(),
            'gambar' => $gambarNama,
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
        ]);

        $produk = Produk::findOrFail($id);
        $produk->update([
            'nama' => $request->nama,
            'kategori_id' => $request->kategori_id,
            'supplier_id' => $request->supplier_id,
            'kode' => $request->kode,
        ]);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil diperbarui!');
    }

    public function details($id)
    {
        $produk = Produk::findOrFail($id);
        $produkVarians = $produk->varian;

        return view('produk.details', compact('produk', 'produkVarians'));
    }
}
