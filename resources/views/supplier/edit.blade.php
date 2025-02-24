@extends('layouts.layout')
@section('title', 'Edit Supplier')
@section('content')
<div class="page-body">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold">Form Edit Supplier</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('supplier.update', $supplier->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group mt-0">
                    <label for="nama">Nama</label>
                    <input type="text" name="nama" id="nama" value="{{ old('nama', $supplier->nama) }}" class="form-control" required>
                </div>
                <div class="form-group mt-0">
                    <label for="kontak">Kontak</label>
                    <input type="number" name="kontak" id="kontak" value="{{ old('kontak', $supplier->kontak) }}" class="form-control" required>
                </div>
                <div class="form-group mt-0">
                    <label for="alamat">Alamat</label>
                    <input type="text" name="alamat" id="alamat" value="{{ old('alamat', $supplier->alamat) }}" class="form-control" required>
                </div>
                <div class="text-end mt-4">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('supplier.index') }}" class="btn btn-secondary me-1">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection