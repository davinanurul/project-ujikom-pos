<?php

namespace App\Http\Controllers;

use App\Models\PengajuanBarang;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class PengajuanBarangController extends Controller
{
    public function index(Request $request)
    {
        $query = PengajuanBarang::orderBy('created_at', 'desc');

        if ($request->filled('tanggal_mulai') && $request->filled('tanggal_selesai')) {
            $tanggalMulai = Carbon::parse($request->tanggal_mulai)->startOfDay();
            $tanggalSelesai = Carbon::parse($request->tanggal_selesai)->endOfDay();

            $query->whereBetween('created_at', [$tanggalMulai, $tanggalSelesai]);
        }

        $pengajuans = $query->get();
        $members = \App\Models\Member::all();

        return view('pengajuan_barang.index', compact('pengajuans', 'members'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pengaju' => 'required|string|max:255',
            'nama_barang' => 'required|string|max:255',
            'qty' => 'required|integer|min:1',
        ]);

        // Cek apakah barang sudah ada di tabel produk
        if (Produk::where('nama', $request->nama_barang)->exists()) {
            return redirect()->route('pengajuanBarang.index')->with('error', 'Barang yang anda ajukan sudah ada di daftar produk!');
        }

        PengajuanBarang::create([
            'nama_pengaju' => $request->nama_pengaju,
            'nama_barang' => $request->nama_barang,
            'qty' => $request->qty,
            'terpenuhi' => false,
        ]);

        return redirect()->route('pengajuanBarang.index')->with('success', 'Pengajuan berhasil dibuat!');
    }

    public function cekTerpenuhi()
    {
        $pengajuans = PengajuanBarang::where('terpenuhi', false)->get();

        foreach ($pengajuans as $pengajuan) {
            if (Produk::where('nama', $pengajuan->nama_barang)->exists()) {
                $pengajuan->update(['terpenuhi' => true]);
            }
        }

        return redirect()->route('pengajuanBarang.index')->with('success', 'Cek terpenuhi selesai!');
    }
}
