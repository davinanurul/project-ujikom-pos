<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rekap Transaksi</title>
    <style>
        body { font-family: sans-serif; }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 10px 0;
        }

        th,
        td {
            border: 1px solid #a3a3a3;
            padding: 8px;
        }

        th {
            background-color: #36c1eb;
        }

        h1 {
            text-align: center;
        }

        .text-center {
            text-align: center;
        }
    </style>
</head>

<body>
    <div style="text-align: center">
        <h3 style="margin: 0;">Rekap Data Transaksi</h3>
        <p style="font-size: 15px; margin: 0;">
            {{-- PERIODE STUFFING : {{ $startDate }} s/d {{ $endDate }} --}}
        </p>
    </div>

    <div class="table-rekap">
        <table style="border: 1px solid">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nomor Transaksi</th>
                    <th>Tanggal</th>
                    <th>Kasir</th>
                    <th>Total</th>
                    <th>Pembayaran</th>
                    <th>Member</th>
                </tr>
            </thead>
            <tbody>
                {{-- @if ($filterApplied && $transactions->isEmpty())
                    <tr>
                        <td colspan="13" class="text-center">Tidak ada transaksi untuk periode yang dipilih.</td>
                    </tr>
                @elseif(!$filterApplied)
                    <tr>
                        <td colspan="13" class="text-center">Silakan lakukan filter berdasarkan stuffing date.</td>
                    </tr>
                @else --}}
                    @foreach ($daftarTransaksi as $index => $transaksi)
                        <tr>
                            <td>{{ $transaksi->id }}</td>
                            <td>{{ $transaksi->nomor_transaksi }}</td>
                            <td>{{ $transaksi->tanggal }}</td>
                            <td>{{ $transaksi->user->user_nama }}</td>
                            <td>{{ number_format($transaksi->total) }}</td>
                            <td>{{ $transaksi->pembayaran }}</td>
                            <td>{{ $transaksi->member?->nama ?? '-' }}</td>
                        </tr>
                    @endforeach
                {{-- @endif --}}
            </tbody>
            {{-- <tfoot>
                <tr>
                    <th colspan="7">Total</th>
                    <th>{{ $totalNetWeight }}</th>
                    <th>{{ $totalGrossWeight }}</th>
                    <th>{{ $totalFreightCost }}</th>
                    <th>{{ $totalAmount }}</th>
                    <th>{{ $total }}</th>
                </tr>
            </tfoot> --}}
        </table>
    </div>
</body>

</html>