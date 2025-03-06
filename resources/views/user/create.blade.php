@extends('layouts.layout')
@section('title', 'Tambah User')

@section('content')
    <div class="page-body">
        <!-- Form Tambah Pengguna -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold">Form Tambah User</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('user.store')}}" method="POST">
                    @csrf
                    <!-- Username -->
                    <div class="form-group">
                        <label for="user_nama">Username</label>
                        <input type="text" name="user_nama" id="user_nama"
                            class="form-control @error('user_nama') is-invalid @enderror" value="{{ old('user_nama') }}"
                            required maxlength="255">
                        @error('user_nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="form-group">
                        <label for="user_pass">Password</label>
                        <input type="password" name="user_pass" id="user_pass"
                            class="form-control @error('user_pass') is-invalid @enderror" required minlength="5">
                        @error('user_pass')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Hak Akses -->
                    <div class="form-group">
                        <label for="user_hak">Hak Akses</label>
                        <select class="form-control @error('user_hak') is-invalid @enderror" id="user_hak" name="user_hak"
                            required>
                            <option value="" disabled {{ old('user_hak') ? '' : 'selected' }}>Pilih Role</option>
                            <option value="admin" {{ old('user_hak') == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="kasir" {{ old('user_hak') == 'kasir' ? 'selected' : '' }}>Kasir</option>
                        </select>
                        @error('user_hak')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Tombol -->
                    <div class="text-end mt-4">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('user.index') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
