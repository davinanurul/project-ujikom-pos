@extends('layouts.layout')
@section('title', 'Produk')
@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between mb-3">
            <a href="{{ route('penerimaan_barang.create')}}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Stok
            </a>
            <a href="{{ route('export_produk.pdf') }}" class="btn btn-success" target="_blank">Export PDF</a>
        </div>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tabel Varian Produk</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center">Nama Produk</th>
                                <th class="text-center">Size</th>
                                <th class="text-center">Warna</th>
                                <th class="text-center">Harga</th>
                                <th class="text-center">Stok</th>
                                <th class="text-center">Total Terjual</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($produkVarians as $varian)
                                <tr>
                                    <td class="text-center">{{ $varian->produk->nama }}</td>
                                    <td class="text-center">{{ $varian->size }}</td>
                                    <td class="text-center">{{ $varian->warna }}</td>
                                    <td class="text-center">{{ number_format($varian->harga_jual) }}</td>
                                    <td class="text-center">{{ $varian->stok }}</td>
                                    <td class="text-center">{{ $varian->detailTransaksi->sum('total_terjual') ?? 0 }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">Tidak ada data.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
 
     <!-- SweetAlert2 -->
     <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
     <script>
         document.addEventListener("DOMContentLoaded", function() {
             @if (session('success'))
                 Swal.fire({
                     icon: 'success',
                     title: 'Berhasil',
                     text: {!! json_encode(session('success')) !!}
                 });
             @endif
 
             @if (session('error'))
                 Swal.fire({
                     icon: 'error',
                     title: 'Gagal',
                     text: {!! json_encode(session('error')) !!}
                 });
             @endif
         });
     </script>
@endsection