<!DOCTYPE html>
<html>
<head>
    <title>Laporan Pengajuan Barang</title>
</head>
<body>
    <h1>Laporan Pengajuan Barang</h1>
    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Tanggal Pengajuan</th>
                <th>Jumlah</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pengajuans as $index => $pengajuan)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $pengajuan->nama_barang }}</td>
                    <td>{{ $pengajuan->tanggal_pengajuan}}</td>
                    <td>{{ $pengajuan->qty }}</td>
                    <td>{{ $pengajuan->terpenuhi ? 'Sudah Terpenuhi' : 'Belum Terpenuhi' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>