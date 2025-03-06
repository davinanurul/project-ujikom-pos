@extends('layouts.layout')
@section('title', 'Daftar Pengguna')
@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between mb-3">
            <a href="{{ route('user.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah User
            </a>
            <button class="btn btn-success" onclick="window.print();">
                <i class="fas fa-print"></i> Print/Ekspor
            </button>
        </div>
        
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tabel Pengguna</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="datatable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center">ID</th>
                                <th class="text-center">Nama User</th>
                                <th class="text-center">Hak Akses</th>
                                <th class="text-center">Tanggal Dibuat</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($daftarPengguna as $pengguna)
                                <tr>
                                    <td class="text-center">{{ $pengguna->user_id }}</td>
                                    <td>{{ $pengguna->user_nama }}</td>
                                    <td class="text-center">{{ $pengguna->user_hak }}</td>
                                    <td class="text-center">{{ $pengguna->created_at }}</td>
                                    <td class="text-center">{{ $pengguna->user_sts ? 'Aktif' : 'Nonaktif' }}</td>
                                    <td class="text-center" style="width: 15%">
                                        @if ($pengguna->user_sts)
                                            <button class="btn btn-sm btn-danger"
                                                onclick="confirmDeactivation({{ $pengguna->user_id }}, 'nonaktifkan')">
                                                Nonaktifkan
                                            </button>
                                        @else
                                            <button class="btn btn-sm btn-success"
                                                onclick="confirmDeactivation({{ $pengguna->user_id }}, 'aktifkan')">
                                                Aktifkan
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- DataTables Scripts -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap4.min.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#datatable').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.13.7/i18n/Indonesian.json"
                }
            });
        });
    </script>

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

        function confirmDeactivation(userId, action) {
            let title, text, confirmButtonText;

            if (action === 'nonaktifkan') {
                title = 'Konfirmasi';
                text = 'Apakah Anda yakin ingin menonaktifkan akun ini?';
                confirmButtonText = 'Ya, Nonaktifkan';
            } else if (action === 'aktifkan') {
                title = 'Konfirmasi';
                text = 'Apakah Anda yakin ingin mengaktifkan akun ini?';
                confirmButtonText = 'Ya, Aktifkan';
            }

            Swal.fire({
                title: title,
                text: text,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: confirmButtonText,
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    if (action === 'nonaktifkan') {
                        window.location.href = '/nonaktifkan-akun/' + userId;
                    } else if (action === 'aktifkan') {
                        window.location.href = '/aktifkan-akun/' + userId;
                    }
                }
            });
        }
    </script>
@endsection