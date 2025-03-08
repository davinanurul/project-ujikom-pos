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
        $request->validate([
            'qty' => 'required|array',
            'qty.*' => 'integer|min:1',
            'harga' => 'required|array',
            'harga.*' => 'numeric|min:0',
            'total' => 'required|array',
            'total.*' => 'numeric|min:0',
        ]);

        dd($request->all());

        DB::beginTransaction();
        try {
            $transaksi = new Transaksi();
            $transaksi->tanggal = now();
            $transaksi->user_id = Auth::id();
            $transaksi->total = array_sum($request->total);
            $transaksi->save();

            foreach ($request->id_produk as $key => $id_produk) {
                DetailTransaksi::create([
                    'transaksi_id' => $transaksi->id,
                    'qty' => $request->qty[$key],
                    'harga' => preg_replace('/\D/', '', $request->harga[$key]),
                    'subtotal' => preg_replace('/\D/', '', $request->subtotal[$key]),
                ]);
            }

            DB::commit();
            return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil disimpan');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
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
