<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Member;
use App\Models\Produk;
use App\Models\DetailTransaksi;
use App\Models\ProdukVarian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    public function index()
    {
        $daftarTransaksi = Transaksi::all();
        return view('transaksi.index', compact('daftarTransaksi'));
    }

    public function create()
    {
        $produks = Produk::whereHas('varian', function ($query) {
            $query->where('stok', '>', 0);
        })->get();
        $members = Member::all();
        return view('transaksi.create', compact('produks', 'members'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'member_id' => 'nullable|exists:member,id',
            'pembayaran' => 'required|in:TUNAI,DEBIT,QRIS',
            'warna' => 'required|array',
            'size' => 'required|array',
            'qty' => 'required|array',
            'qty.*' => 'integer|min:1',
            'harga' => 'required|array',
            'subtotal' => 'required|array',
        ]);

        $nomor_transaksi = Transaksi::generateNomorTransaksi();

        $transaksi = Transaksi::create([
            'nomor_transaksi' => $nomor_transaksi,
            'tanggal' => now(),
            'member_id' => $request->member_id,
            'pembayaran' => $request->pembayaran,
            'total' => preg_replace('/[^\d]/', '', $request->total),
            'user_id' => Auth::id(),
        ]);

        foreach ($request->produk_id as $index => $produk_id) {
            $varian = ProdukVarian::where([
                'id_produk' => $produk_id,
                'warna' => $request->warna[$index],
                'size' => $request->size[$index],
            ])->first();

            if ($varian) {
                $transaksi->DetailTransaksi()->create([
                    'produk_id' => $produk_id,
                    'id_varian' => $varian->id,
                    'qty' => $request->qty[$index],
                    'harga' => preg_replace('/[^\d]/', '', $request->harga[$index]),
                    'subtotal' => preg_replace('/[^\d]/', '', $request->subtotal[$index]),
                ]);

                // Kurangi stok
                $varian->stok -= $request->qty[$index];
                $varian->save();
            }
        }

        return redirect()->route('transaksi.create')->with('success', 'Transaksi berhasil dibuat');
    }

    public function getVariansByProduk($produkId)
    {
        $warnaList = ProdukVarian::where('id_produk', $produkId)
            ->where('stok', '>', 0)
            ->select('warna')
            ->distinct()
            ->get();

        return response()->json(['warna' => $warnaList]);
    }

    public function getSizesByWarna($produkId, $warna)
    {
        $sizeList = ProdukVarian::where('id_produk', $produkId)
            ->where('warna', $warna)
            ->where('stok', '>', 0)
            ->select('size')
            ->distinct()
            ->get();

        return response()->json(['sizes' => $sizeList]);
    }

    // public function getHarga($produkId, $warna, $size)
    // {
    //     $varian = ProdukVarian::where('id_produk', $produkId)
    //         ->where('warna', $warna)
    //         ->where('size', $size)
    //         ->where('stok', '>', 0)
    //         ->first();

    //     return response()->json(['harga' => $varian ? $varian->harga_jual : 0]);
    // }

    public function getHarga($produkId, $warna, $size)
    {
        $varian = ProdukVarian::where('id_produk', $produkId)
            ->where('warna', $warna)
            ->where('size', $size)
            ->where('stok', '>', 0)
            ->first();

        return response()->json([
            'harga' => $varian ? $varian->harga_jual : 0,
            'id_varian' => $varian ? $varian->id : null // Tambahkan id_varian ke response
        ]);
    }
}
