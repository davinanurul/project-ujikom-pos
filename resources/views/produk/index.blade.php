@extends('layouts.layout')
@section('title', 'Produk')
@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between mb-3">
            <a href="{{ route('produk.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Produk
            </a>
            <button class="btn btn-success" onclick="window.print();">
                <i class="fas fa-print"></i> Print/Ekspor
            </button>
        </div>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tabel Produk</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Supplier</th>
                                <th class="text-center">Kategori</th>
                                <th class="text-center">Kode</th>
                                <th class="text-center">Nama</th>
                                <th class="text-center">Gambar</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($produks as $index => $produk)
                                <tr>
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    <td class="text-center">{{ $produk->supplier->nama }}</td>
                                    <td class="text-center">{{ $produk->kategori->nama_kategori }}</td>
                                    <td class="text-center">{{ $produk->kode }}</td>
                                    <td class="text-center">{{ $produk->nama }}</td>
                                    <td>
                                        @if ($produk->gambar)
                                            <img src="{{ asset('/storage/produk-img/' . $produk->gambar) }}" alt="Gambar Produk" width="100">
                                        @else
                                            Tidak Ada Gambar
                                        @endif
                                    </td>
                                    <td class="text-center" style="width: 20%">
                                        <div class="btn-group">
                                            <a href="{{ route('produk.details', $produk->id) }}" class="btn btn-primary">
                                                Detail
                                            </a>
                                            <a href="{{ route('produk.edit', ['id' => $produk->id]) }}" class="btn btn-warning">
                                                Edit
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
