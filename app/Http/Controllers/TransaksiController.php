<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaksi;
use App\Models\Produk;
use App\Models\ProdukVarian;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    public function create()
    {
        $produks = Produk::whereHas('produk_varian', function ($query) {
            $query->where('stok', '>', 0);
        })->get();
        $produkVarians = ProdukVarian::all();
        return view('transaksi.create', compact('produks', 'produkVarians'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'produk_id' => 'required|array',
            'produk_id.*' => 'required|exists:products,id',
            'quantity' => 'required|array',
            'quantity.*' => 'required|integer|min:1',
            'payment_method' => 'required|string|in:cash,card',
        ]);

        // Generate transaksi ID
        $transaksiId = Transaksi::generateTransaksiId();

        // Simpan data transaksi ke tabel `tm_transaksi`
        $transaksi = Transaksi::create([
            'transaksi_id' => $transaksiId,
            'user_id' => Auth::id(),
            'payment_method' => $validated['payment_method'],
            'total_amount' => 0, // Akan diperbarui nanti
            'created_at' => now(),
        ]);

        $totalKeseluruhan = 0;

        // Simpan detail transaksi ke tabel `td_transaksi`
        foreach ($validated['produk_id'] as $index => $produkId) {
            $produk = Produk::find($produkId);
            $quantity = $validated['quantity'][$index];
            $totalHarga = $produk->harga_jual * $quantity;

            DetailTransaksi::create([
                'transaksi_id' => $transaksi->transaksi_id,
                'produk_id' => $produkId,
                'harga_jual' => $produk->harga_jual,
                'quantity' => $quantity,
                'total_harga' => $totalHarga,
                'created_at' => now(),
            ]);

            $totalKeseluruhan += $totalHarga;
        }

        // Update total_amount pada transaksi
        $transaksi->update(['total_amount' => $totalKeseluruhan]);

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil disimpan.');
    }

    public function getVariansByProduk($produkId)
    {
        $warnaList = ProdukVarian::where('id_produk', $produkId)
            ->select('warna')
            ->distinct()
            ->get();

        return response()->json(['warna' => $warnaList]);
    }

    public function getSizesByWarna($produkId, $warna)
    {
        $sizeList = ProdukVarian::where('id_produk', $produkId)
            ->where('warna', $warna)
            ->select('size')
            ->distinct()
            ->get();

        return response()->json(['sizes' => $sizeList]);
    }


    public function getHarga($produkId, $warna, $size)
    {
        $varian = ProdukVarian::where('id_produk', $produkId)
            ->where('warna', $warna)
            ->where('size', $size)
            ->first();

        return response()->json(['harga' => $varian ? $varian->harga_jual : 0]);
    }
}
