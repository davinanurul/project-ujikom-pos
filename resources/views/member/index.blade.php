@extends('layouts.layout')
@section('title', 'Member')
@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between mb-3">
            <a href="{{ route('member.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Member
            </a>
            <button class="btn btn-success" onclick="window.print();">
                <i class="fas fa-print"></i> Print/Ekspor
            </button>
        </div>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tabel Member</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="datatable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center">ID</th>
                                <th class="text-center">Nama</th>
                                <th class="text-center">Telepon</th>
                                <th class="text-center">Alamat</th>
                                <th class="text-center">Tanggal Bergabung</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($members as $member)
                                <tr>
                                    <td class="text-center">{{ $member->id }}</td>
                                    <td class="text-center">{{ $member->nama }}</td>
                                    <td class="text-center">{{ $member->telepon }}</td>
                                    <td class="text-center">{{ $member->alamat }}</td>
                                    <td class="text-center">{{ $member->tanggal_bergabung }}</td>
                                    <td class="text-center">{{ $member->status == 'aktif' ? 'Aktif' : 'Nonaktif' }}</td>
                                    <td class="text-center" style="width: 20%">
                                        <a href="{{ route('member.edit', $member->id) }}" class="btn btn-sm btn-warning">
                                            Edit
                                        </a>
                                    
                                        @if ($member->status == 'aktif')
                                            <a href="{{ route('member.nonaktifkan', $member->id) }}" class="btn btn-sm btn-danger">
                                                Nonaktifkan
                                            </a>
                                        @else
                                            <a href="{{ route('member.aktifkan', $member->id) }}" class="btn btn-sm btn-success">
                                                Aktifkan
                                            </a>
                                        @endif
                                    </td>                                    
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center">Tidak ada data.</td>
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
                    text: {!! json_encode(session('error')) !!}c
                });
            @endif
        });
    </script>
@endsection
