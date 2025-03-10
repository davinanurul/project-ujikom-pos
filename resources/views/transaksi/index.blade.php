@extends('layouts.layout')
@section('title', 'Produk')
@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between mb-3">
            <a href="{{ route('transaksi.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Buat Transaksi
            </a>
            <button class="btn btn-success" onclick="window.print();">
                <i class="fas fa-print"></i> Print/Ekspor
            </button>
        </div>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tabel Daftar Transaksi</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Nomor Transaksi</th>
                                <th class="text-center">Tanggal</th>
                                <th class="text-center">Kasir</th>
                                <th class="text-center">Total</th>
                                <th class="text-center">Pembayaran</th>
                                <th class="text-center">Member</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($daftarTransaksi as $transaksi)
                                <tr>
                                    <td class="text-center">{{ $transaksi->id }}</td>
                                    <td class="text-center">{{ $transaksi->nomor_transaksi }}</td>
                                    <td class="text-center">{{ $transaksi->tanggal }}</td>
                                    <td class="text-center">{{ $transaksi->user->user_nama }}</td>
                                    <td class="text-center">{{ number_format($transaksi->total) }}</td>
                                    <td class="text-center">{{ $transaksi->pembayaran }}</td>
                                    <td class="text-center">{{ $transaksi->member?->nama ?? '-' }}</td>
                                    <td class="text-center" style="width: 20%">
                                        <div>
                                            <a href="{{ route('transaksi.details', $transaksi->id)}}" class="btn btn-primary">
                                                <i class="fa fa-eye"></i> Detail
                                            </a>
                                        </div>
                                    </td>                                    
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">Tidak ada data.</td>
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