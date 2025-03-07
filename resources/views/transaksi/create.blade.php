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

                    <!-- Tabel Produk -->
                    <div class="table-responsive">
                        <table class="table table-bordered" id="produkTable">
                            <thead class="thead-light">
                                <tr>
                                    <th class="text-center">Produk</th>
                                    <th class="text-center">Warna</th>
                                    <th class="text-center">Size</th>
                                    <th class="text-center">Harga</th>
                                    <th class="text-center">Jumlah</th>
                                    <th class="text-center">Total</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <select class="form-control produk-select" required>
                                            <option value="" disabled selected>Pilih Produk</option>
                                            @foreach ($produks as $produk)
                                                <option value="{{ $produk->id }}">{{ $produk->nama }}</option>
                                            @endforeach
                                        </select>
                                    </td>

                                    <td>
                                        <select class="form-control warna-select" required>
                                            <option value="" disabled selected>Warna</option>
                                        </select>
                                    </td>

                                    <td>
                                        <select class="form-control size-select" required>
                                            <option value="" disabled selected>Ukuran</option>
                                        </select>
                                    </td>
                                    <td><input type="text" class="form-control harga_jual" readonly></td>
                                    <td><input type="number" name="quantity[]" class="form-control quantity" min="1"
                                            value="1" oninput="calculateTotal(this)" required></td>
                                    <td><input type="text" class="form-control total" readonly></td>
                                    <td><button type="button" class="btn btn-danger btn-sm remove-row"
                                            onclick="removeRow(this)">Hapus</button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Tombol Tambah Produk -->
                    <button type="button" class="btn btn-success btn-sm mb-3" onclick="addprodukRow()">+ Tambah
                        Produk</button>

                    <!-- Total Keseluruhan -->
                    <div class="form-group">
                        <label>Total Keseluruhan</label>
                        <input type="text" id="grand_total" class="form-control bg-light" readonly>
                    </div>

                    <!-- Metode Pembayaran -->
                    <div class="form-group">
                        <label for="payment_method">Metode Pembayaran</label>
                        <select id="payment_method" name="payment_method" class="form-control" required>
                            <option value="cash">Tunai</option>
                            <option value="card">Kartu</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">Simpan Transaksi</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("change", function(event) {
            let row = event.target.closest("tr"); // Cari baris yang sesuai
            if (!row) return;

            let produkDropdown = row.querySelector(".produk-select");
            let warnaDropdown = row.querySelector(".warna-select");
            let sizeDropdown = row.querySelector(".size-select");

            // Jika produk dipilih, ambil daftar warna
            if (event.target.classList.contains("produk-select")) {
                let produkId = produkDropdown.value;

                // Kosongkan dropdown warna dan size
                warnaDropdown.innerHTML = '<option value="" disabled selected>Warna</option>';
                sizeDropdown.innerHTML = '<option value="" disabled selected>Ukuran</option>';

                fetch(`/get-varians/${produkId}`)
                    .then(response => response.json())
                    .then(data => {
                        let warnaSet = new Set();
                        data.warna.forEach(varian => {
                            if (!warnaSet.has(varian.warna)) {
                                warnaSet.add(varian.warna);
                                let option = document.createElement("option");
                                option.value = varian.warna;
                                option.textContent = varian.warna;
                                warnaDropdown.appendChild(option);
                            }
                        });
                    });
            }

            // Jika warna dipilih, ambil daftar size yang sesuai
            if (event.target.classList.contains("warna-select")) {
                let produkId = produkDropdown.value;
                let warna = warnaDropdown.value;

                // Kosongkan dropdown size
                sizeDropdown.innerHTML = '<option value="" disabled selected>Ukuran</option>';

                fetch(`/get-sizes/${produkId}/${warna}`)
                    .then(response => response.json())
                    .then(data => {
                        data.sizes.forEach(varian => {
                            let option = document.createElement("option");
                            option.value = varian.size;
                            option.textContent = varian.size;
                            sizeDropdown.appendChild(option);
                        });
                    });
            }
        });
    </script>

    <script>
        document.addEventListener("change", function(event) {
            if (event.target.classList.contains("warna-select") || event.target.classList.contains("size-select")) {
                let row = event.target.closest("tr");
                let produkId = row.querySelector(".produk-select").value;
                let warna = row.querySelector(".warna-select").value;
                let size = row.querySelector(".size-select").value;
                let hargaInput = row.querySelector(".harga_jual");

                if (produkId && warna && size) {
                    fetch(`/get-harga/${produkId}/${warna}/${size}`)
                        .then(response => response.json())
                        .then(data => {
                            hargaInput.value = "Rp" + parseInt(data.harga).toLocaleString();
                            calculateTotal(row.querySelector(".quantity"));
                        });
                }
            }
        });

        function calculateTotal(input) {
            let row = input.closest("tr");
            let harga_jual = parseInt(row.querySelector(".produk-select").selectedOptions[0].getAttribute(
                "data-harga_jual")) || 0;
            let quantity = parseInt(row.querySelector(".quantity").value) || 1;
            let total = harga_jual * quantity;
            row.querySelector(".total").value = "Rp" + total.toLocaleString();
            calculateGrandTotal();
        }

        function calculateGrandTotal() {
            let totalFields = document.querySelectorAll(".total");
            let grandTotal = 0;
            totalFields.forEach(field => {
                grandTotal += parseInt(field.value.replace(/\D/g, "")) || 0;
            });
            document.getElementById("grand_total").value = "Rp" + grandTotal.toLocaleString();
        }

        function addprodukRow() {
            let table = document.getElementById("produkTable").getElementsByTagName('tbody')[0];
            let newRow = table.insertRow();
            newRow.innerHTML = `
            <td>
                <select class="form-control produk-select" id="produkDropdown" required>
                    <option value="" disabled selected>Pilih Produk</option>
                        @foreach ($produks as $produk)
                            <option value="{{ $produk->id }}">{{ $produk->nama }}</option>
                        @endforeach
                </select>
            </td>
            <td>
                <select class="form-control warna-select" id="warnaDropdown" required>
                    <option value="" disabled selected>Warna</option>
                </select>
            </td>
            <td>
                <select class="form-control size-select" id="sizeDropdown" required>
                    <option value="" disabled selected>Ukuran</option>
                </select>
            </td>
            <td><input type="text" class="form-control harga_jual" readonly></td>
            <td><input type="number" name="quantity[]" class="form-control quantity" min="1" value="1" oninput="calculateTotal(this)" required></td>
            <td><input type="text" class="form-control total" readonly></td>
            <td><button type="button" class="btn btn-danger btn-sm remove-row" onclick="removeRow(this)">Hapus</button></td>
        `;
        }

        function removeRow(button) {
            let row = button.closest("tr");
            row.remove();
            calculateGrandTotal();
        }
    </script>
@endsection
