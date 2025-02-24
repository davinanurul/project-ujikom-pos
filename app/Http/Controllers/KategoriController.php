<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $kategoris = Kategori::all();
        return view('kategori.index', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
        ]);

        Kategori::create([
            'nama_kategori' => $request->nama_kategori,
        ]);

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function update(Request $request, $id_kategori)
    {
        $kategori = Kategori::findOrFail($id_kategori);

        // Validasi input
        $validated = $request->validate([
            'nama_kategori' => 'required|string|max:255',
        ]);

        // Update data kategori
        $kategori->update([
            'nama_kategori' => $validated['nama_kategori'],
        ]);

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil diperbarui!');
    }
}