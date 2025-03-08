@extends('layouts.layout')

@section('content')
    <div class="container-fluid">
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Form Transaksi</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('transaksi.store') }}" method="POST">
                    @csrf
                    <div class="table table-borderless">
                        <table style="width: 100%">
                            <tr>
                                <td style="width: 10%">Taggal</td>
                                <td style="width: 5%">:</td>
                                <td><span
                                        class="border px-2 py-1 rounded bg-light d-inline-block">{{ now()->format('d F Y') }}</span>
                                </td>
                                <td style="width: 20%; text-align:end">Member (Opsional)</td>
                                <td style="width: 5%">:</td>
                                <td style="width: 20%">
                                    <select class="form-control" id="member_id" name="member_id">
                                        <option value="">Pilih Member</option>
                                        @foreach ($members as $member)
                                            <option value="{{ $member->id }}">{{ $member->nama }}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Kasir</td>
                                <td>:</td>
                                <td><span
                                        class="border px-2 py-1 rounded bg-light d-inline-block">{{ Auth::user()->user_nama }}</span>
                                </td>

                            </tr>
                        </table>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered" id="produkTable">
                            <thead>
                                <tr>
                                    <th style="width: 20%">Produk</th>
                                    <th style="width: 15%">Warna</th>
                                    <th style="width: 10%">Size</th>
                                    <th>Harga</th>
                                    <th style="width: 10%">Qty</th>
                                    <th>Subtotal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <select class="form-control produk-select" name="produk_id[]" required>
                                            <option value="" disabled selected>Pilih Produk</option>
                                            @foreach ($produks as $produk)
                                                <option value="{{ $produk->id }}">{{ $produk->nama }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select class="form-control warna-select" name="warna[]" required>
                                            <option value="" disabled selected>-</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select class="form-control size-select" name="size[]" required>
                                            <option value="" disabled selected>-</option>
                                        </select>
                                    </td>
                                    <input type="hidden" class="form-control id_varian" name="id_varian[]" readonly>
                                    <td><input type="text" class="form-control harga_jual" name="harga[]" readonly></td>
                                    <td><input type="number" name="qty[]" class="form-control quantity" min="1"
                                            value="1" oninput="calculateTotal(this)" required></td>
                                    <td><input name="subtotal[]" type="text" class="form-control total" readonly></td>
                                    <td><button type="button" class="btn btn-danger btn-sm remove-row"
                                            onclick="removeRow(this)">Hapus</button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <button type="button" class="btn btn-success btn-sm mb-3" onclick="addprodukRow()">+ Tambah
                        Produk</button>

                    <div class="form-group">
                        <label>Total Keseluruhan</label>
                        <input type="text" id="grand_total" name="total" class="form-control bg-light" readonly>
                    </div>
                    <div class="form-group">
                        <label for="pembayaran" class="form-label">Metode Pembayaran</label>
                        <select class="form-control" id="pembayaran" name="pembayaran" required>
                            <option value="" disabled selected>-</option>
                            <option value="TUNAI">TUNAI</option>
                            <option value="DEBIT">DEBIT</option>
                            <option value="QRIS">QRIS</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">Simpan</button>
                </form>
            </div>
        </div>
    </div>


    <script>
        document.addEventListener("change", function(event) {
            let row = event.target.closest("tr");
            if (!row) return;

            let produkDropdown = row.querySelector(".produk-select");
            let warnaDropdown = row.querySelector(".warna-select");
            let sizeDropdown = row.querySelector(".size-select");

            // Jika produk dipilih, ambil daftar warna dengan stok lebih dari 0
            if (event.target.classList.contains("produk-select")) {
                let produkId = produkDropdown.value;

                warnaDropdown.innerHTML = '<option value="" disabled selected>-</option>';
                sizeDropdown.innerHTML = '<option value="" disabled selected>-</option>';

                fetch(`/get-varians/${produkId}`)
                    .then(response => response.json())
                    .then(data => {
                        data.warna.forEach(item => {
                            let option = document.createElement("option");
                            option.value = item.warna;
                            option.textContent = item.warna;
                            warnaDropdown.appendChild(option);
                        });
                    });
            }

            // Jika warna dipilih, ambil daftar size yang memiliki stok lebih dari 0
            if (event.target.classList.contains("warna-select")) {
                let produkId = produkDropdown.value;
                let warna = warnaDropdown.value;

                sizeDropdown.innerHTML = '<option value="" disabled selected>-</option>';

                fetch(`/get-sizes/${produkId}/${warna}`)
                    .then(response => response.json())
                    .then(data => {
                        data.sizes.forEach(item => {
                            let option = document.createElement("option");
                            option.value = item.size;
                            option.textContent = item.size;
                            sizeDropdown.appendChild(option);
                        });
                    });
            }
        });

        document.addEventListener("change", function(event) {
            if (event.target.classList.contains("warna-select") || event.target.classList.contains("size-select")) {
                let row = event.target.closest("tr");
                let produkId = row.querySelector(".produk-select").value;
                let warna = row.querySelector(".warna-select").value;
                let size = row.querySelector(".size-select").value;
                let hargaInput = row.querySelector(".harga_jual");
                let idVarianInput = row.querySelector(".id_varian");

                if (produkId && warna && size) {
                    fetch(`/get-harga/${produkId}/${warna}/${size}`)
                        .then(response => response.json())
                        .then(data => {
                            let harga = parseInt(data.harga) || 0;
                            hargaInput.value = formatRupiah(harga);
                            idVarianInput.value = data.id_varian; // Masukkan id_varian ke inputan varian
                            calculateTotal(row.querySelector(".quantity"));
                        });
                }
            }
        });

        function calculateTotal(input) {
            let row = input.closest("tr");
            let hargaInput = row.querySelector(".harga_jual").value.replace(/\D/g, ""); // Hanya ambil angka
            let harga = parseInt(hargaInput) || 0;
            let quantity = parseInt(row.querySelector(".quantity").value) || 1;
            let total = harga * quantity;

            row.querySelector(".total").value = formatRupiah(total);
            calculateGrandTotal();
        }

        function calculateGrandTotal() {
            let totalFields = document.querySelectorAll(".total");
            let grandTotal = 0;

            totalFields.forEach(field => {
                let totalValue = field.value.replace(/\D/g, ""); // Ambil hanya angka
                grandTotal += parseInt(totalValue) || 0;
            });

            document.getElementById("grand_total").value = formatRupiah(grandTotal);
        }

        // Fungsi untuk format Rupiah
        function formatRupiah(angka) {
            return "Rp. " + angka.toLocaleString("id-ID");
        }

        function addprodukRow() {
            let table = document.getElementById("produkTable").getElementsByTagName('tbody')[0];
            let newRow = table.insertRow();
            newRow.innerHTML = `
        <td>
            <select name="produk_id[]" class="form-control produk-select" id="produkDropdown" required>
                <option value="" disabled selected>Pilih Produk</option>
                    @foreach ($produks as $produk)
                        <option value="{{ $produk->id }}">{{ $produk->nama }}</option>
                    @endforeach
            </select>
        </td>
        <td>
            <select name="warna[]" class="form-control warna-select" id="warnaDropdown" required>
                <option value="" disabled selected>-</option>
            </select>
        </td>
        <td>
            <select name="size[]" class="form-control size-select" id="sizeDropdown" required>
                <option value="" disabled selected>-</option>
            </select>
        </td>
        <input type="hidden" class="form-control id_varian" name="id_varian[]" readonly>
        <td><input name="harga[]" type="text" class="form-control harga_jual" readonly></td>
        <td><input name="qty[]" type="number" name="quantity[]" class="form-control quantity" min="1" value="1" oninput="calculateTotal(this)" required></td>
        <td><input name="subtotal[]" type="text" class="form-control total" readonly></td>
        <td><button type="button" class="btn btn-danger btn-sm remove-row" onclick="removeRow(this)">Hapus</button></td>
    `;
        }

        function removeRow(button) {
            let row = button.closest("tr");
            row.remove();
            calculateGrandTotal();
        }

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
