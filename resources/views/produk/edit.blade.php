@extends('layouts.layout')
@section('title', 'Edit Produk')

@section('content')
    <div class="page-body">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold">Form Edit Produk</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('produk.update', $produk->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group mt-0">
                        <label for="kategori_id">Kategori</label>
                        <select name="kategori_id" id="kategori_id" class="form-control" required>
                            <option value="">Pilih Kategori</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" 
                                    {{ old('kategori_id', $produk->kategori_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mt-0">
                        <label for="supplier_id">Supplier</label>
                        <select name="supplier_id" id="supplier_id" class="form-control" required>
                            <option value="">Pilih Supplier</option>
                            @foreach ($suppliers as $supplier)
                                <option value="{{ $supplier->id }}" 
                                    {{ old('supplier_id', $produk->supplier_id) == $supplier->id ? 'selected' : '' }}>
                                    {{ $supplier->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mt-0">
                        <label for="kode">Kode</label>
                        <input type="text" name="kode" id="kode" class="form-control" 
                            value="{{ old('kode', $produk->kode) }}" required>
                    </div>

                    <div class="form-group mt-0">
                        <label for="nama">Nama</label>
                        <input type="text" name="nama" id="nama" class="form-control" 
                            value="{{ old('nama', $produk->nama) }}" required>
                    </div>

                    <div class="form-group mt-0">
                        <label for="keuntungan">Harga Jual</label>
                        <input type="number" name="harga_jual" id="harga_jual" class="form-control" 
                            value="{{ old('harga_jual', $produk->harga_jual) }}" required step="0.01">
                    </div>

                    <div class="text-end mt-4">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('produk.index') }}" class="btn btn-secondary me-1">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection