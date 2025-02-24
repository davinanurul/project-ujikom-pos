@extends('layouts.layout')
@section('title', 'Supplier')
@section('content')
    <div role="main">
        <div class="">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="x_panel">
                        <div class="x_title d-flex justify-content-between">
                            <a href="{{ route('supplier.create') }}" class="btn btn-primary">
                                <i class="fa fa-plus"></i>
                                Tambah Supplier
                            </a>
                            <button class="btn btn-success" onclick="window.print();">
                                <i class="fa fa-print"></i> Print/Ekspor
                            </button>
                        </div>
                        <div class="x_content">
                            <table class="table table-striped jambo_table bulk_action" id="datatable">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="font-size: 17px;">Nama</th>
                                        <th class="text-center" style="font-size: 17px;">Kontak</th>
                                        <th class="text-center" style="font-size: 17px;">Alamat</th>
                                        <th class="text-center" style="font-size: 17px;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($suppliers as $supplier)
                                        <tr>
                                            <td class="text-center">{{ $supplier->nama }}</td>
                                            <td class="text-center">{{ $supplier->kontak }}</td>
                                            <td class="text-center">{{ $supplier->alamat }}</td>
                                            <td class="text-center" style="width: 12%">
                                                <a href="{{ route('supplier.edit', $supplier->id) }}"
                                                    class="btn btn-small btn-warning">
                                                    <span class="icon text-white">
                                                        <i class="fa fa-edit"></i>
                                                    </span>Edit</a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="2" class="text-center">Tidak ada data.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
