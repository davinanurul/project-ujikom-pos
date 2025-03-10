<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rekap Penjualan Produk</title>
    <style>
        body {
            font-family: sans-serif;
        }

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
        <h3 style="margin: 0;">Rekap Data Penjualan Produk</h3>
    </div>

    <div class="table-rekap">
        <table style="border: 1px solid">
            <thead>
                <tr>
                    <th>Nama Produk</th>
                    <th>Size</th>
                    <th>Warna</th>
                    <th>Harga</th>
                    <th>Stok Sisa</th>
                    <th>Total Terjual</th>
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
                        <td class="text-center">
                            {{ $varian->detailTransaksi->sum('total_terjual') ?? 0 }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Tidak ada data.</td>
                    </tr>
                @endforelse
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
