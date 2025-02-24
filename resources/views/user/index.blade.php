@extends('layouts.layout')
@section('title', 'Daftar Pengguna')
@section('content')
    <div role="main">
        <div class="">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="x_panel">
                        <div class="x_title d-flex justify-content-between">
                            <a href="{{ route('user.create')}}" class="btn btn-primary">
                                <i class="fa fa-plus"></i>
                                Tambah User
                            </a>
                            <button class="btn btn-success" onclick="window.print();">
                                <i class="fa fa-print"></i> Print/Ekspor
                            </button>
                        </div>
                        <div class="x_content">
                            <table class="table table-striped jambo_table bulk_action" id="datatable">
                                <thead>
                                    <tr>
                                        <th class="text-center">ID</th>
                                        <th class="text-center">NAMA USER</th>
                                        <th class="text-center">HAK AKSES</th>
                                        <th class="text-center">TANGGAL DIBUAT</th>
                                        <th class="text-center">STATUS</th>
                                        <th class="text-center">AKSI</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($daftarPengguna as $daftarPengguna)
                                        <tr>
                                            <td>{{ $daftarPengguna->user_id }}</td>
                                            <td>{{ $daftarPengguna->user_nama }}</td>
                                            <td>{{ $daftarPengguna->user_hak }}</td>
                                            <td>{{ $daftarPengguna->created_at}}</td>
                                            <td>{{ $daftarPengguna->user_sts ? 'Aktif' : 'Nonaktif' }}</td>
                                            <td style="width: 10%">
                                                @if ($daftarPengguna->user_sts)
                                                    <button class="btn btn-small btn-danger"
                                                        onclick="confirmDeactivation({{ $daftarPengguna->user_id }}, 'nonaktifkan')">
                                                        Nonaktifkan
                                                    </button>
                                                @else
                                                    <button class="btn btn-small btn-success"
                                                        onclick="confirmDeactivation({{ $daftarPengguna->user_id }}, 'aktifkan')">
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
