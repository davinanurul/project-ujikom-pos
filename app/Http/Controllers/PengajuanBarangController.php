<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\PengajuanBarang;
use App\Models\Produk;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

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
        $members = Member::all();

        if ($request->has('export_pdf')) {
            $pdf = Pdf::loadView('Pengajuan_barang.pdf', compact('pengajuans', 'members'));
            return $pdf->stream('Pengajuan_barang.pdf');
        }

        return view('Pengajuan_barang.index', compact('pengajuans', 'members'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_pengaju' => 'required|string|max:255',
            'nama_barang' => 'required|string|max:255',
            'qty' => 'required|integer|min:1',
        ]);

        // Cek apakah nama_barang sudah ada di penerimaan_barang
        $barangSudahDiterima = DB::table('penerimaan_barang')
            ->join('produk', 'penerimaan_barang.id_produk', '=', 'produk.id')
            ->where('produk.nama', $request->nama_barang)
            ->exists();

        // Jika sudah ada, berikan alert error
        if ($barangSudahDiterima) {
            return redirect()->route('pengajuanBarang.index')
                ->with('error', 'Barang yang anda ajukan sudah tersedia!');
        }

        // Simpan data pengajuan barang
        PengajuanBarang::create([
            'nama_pengaju' => $request->nama_pengaju,
            'nama_barang' => $request->nama_barang,
            'tanggal_pengajuan' => now(),
            'qty' => $request->qty,
            'terpenuhi' => 0, // Default belum terpenuhi
        ]);

        return redirect()->route('pengajuanBarang.index')
            ->with('success', 'Pengajuan barang berhasil ditambahkan!');
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

    public function update(Request $request, $id)
    {
        $pengajuan = PengajuanBarang::findOrFail($id);

        $validated = $request->validate([
            'nama_pengaju' => 'required|string|max:255',
            'nama_barang' => 'required|string|max:255',
            'qty' => 'required|integer|min:1',
        ]);

        $pengajuan->update([
            'nama_pengaju' => $validated['nama_pengaju'],
            'nama_barang' => $validated['nama_barang'],
            'qty' => $validated['qty'],
        ]);

        return redirect()->route('pengajuanBarang.index')->with('success', 'Pengajuan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $pengajuan = PengajuanBarang::findOrFail($id);
        $pengajuan->delete();

        return redirect()->route('pengajuanBarang.index')->with('success', 'Pengajuan berhasil dihapus!');
    }

    public function getDataPengajuan()
    {
        // Ambil data pengajuan dari model
        $dataPengajuan = PengajuanBarang::getDataPengajuan();

        // Format data untuk chart
        $labels = ['Belum Terpenuhi', 'Terpenuhi'];
        $data = [0, 0]; // Default value

        foreach ($dataPengajuan as $item) {
            if ($item->terpenuhi == 0) {
                $data[0] = $item->total; // Data untuk "Belum Terpenuhi"
            } else {
                $data[1] = $item->total; // Data untuk "Terpenuhi"
            }
        }

        return response()->json([
            'labels' => $labels,
            'data' => $data,
        ]);
    }
}