@extends('layouts.layout')
@section('title', 'Laporan Transaksi')
@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between mb-3">
            <form class="d-flex align-items-center" id="filterForm">
                <div class="input-group">
                    <input type="date" class="form-control rounded-0" id="start_date" name="start_date" required>
                    <input type="date" class="form-control rounded-0" id="end_date" name="end_date" required>
                    <div class="input-group-append">
                        <button type="button" id="filterBtn" class="btn btn-success rounded-0">Filter</button>
                        <button type="button" id="resetBtn" class="btn btn-secondary rounded-0">Reset</button>
                    </div>
                </div>
            </form>                     
            <a href="{{ route('export.pdf') }}" class="btn btn-success" target="_blank">Export PDF</a>
        </div>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tabel Laporan Transaksi</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="datatable" width="100%" cellspacing="0">
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
                            @foreach ($daftarTransaksi as $transaksi)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="text-center">{{ $transaksi->nomor_transaksi }}</td>
                                    <td class="text-center">{{ $transaksi->tanggal }}</td>
                                    <td class="text-center">{{ $transaksi->user->user_nama }}</td>
                                    <td class="text-center">{{ number_format($transaksi->total) }}</td>
                                    <td class="text-center">{{ $transaksi->pembayaran }}</td>
                                    <td class="text-center">{{ $transaksi->member?->nama ?? '-' }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('transaksi.details', $transaksi->id) }}" class="btn btn-warning">
                                            <i class="fa fa-eye"></i> Detail
                                        </a>
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
            var table = $('#datatable').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.13.7/i18n/Indonesian.json"
                }
            });

            $('#filterBtn').on('click', function(e) {
                e.preventDefault();
                var startDate = $('#start_date').val();
                var endDate = $('#end_date').val();

                if (startDate && endDate) {
                    $.ajax({
                        url: "{{ route('laporan.transaksi') }}",
                        type: "GET",
                        data: { start_date: startDate, end_date: endDate },
                        success: function(response) {
                            table.clear();
                            response.data.forEach(function(transaksi, index) {
                                table.row.add([
                                    index + 1,
                                    transaksi.nomor_transaksi,
                                    transaksi.tanggal,
                                    transaksi.user.user_nama,
                                    transaksi.total.toLocaleString(),
                                    transaksi.pembayaran,
                                    transaksi.member ? transaksi.member.nama : '-',
                                    `<a href="/transaksi/details/${transaksi.id}" class="btn btn-primary">
                                        <i class="fa fa-eye"></i> Detail
                                    </a>`
                                ]).draw();
                            });
                        }
                    });
                } else {
                    alert('Harap pilih rentang tanggal!');
                }
            });

            $('#resetBtn').on('click', function() {
                $('#start_date').val('');
                $('#end_date').val('');
                location.reload();
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
    </script>
@endsection