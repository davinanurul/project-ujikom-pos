@extends('layouts.layout')
@section('title', 'Kategori Barang')
@section('content')
    <div role="main">
        <div class="">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="x_panel">
                        <div class="x_title d-flex justify-content-between">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addKategoriModal">
                                <i class="fa fa-plus"></i> Tambah Kategori
                            </button>
                            <button class="btn btn-success" onclick="window.print();">
                                <i class="fa fa-print"></i> Print/Ekspor
                            </button>
                        </div>
                        <div class="x_content">
                            <table class="table table-striped jambo_table bulk_action" id="datatable">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="font-size: 17px;">Nama Kategori</th>
                                        <th class="text-center" style="font-size: 17px;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($kategoris as $kategori)
                                        <tr>
                                            <td class="text-center">{{ $kategori->nama_kategori }}</td>
                                            <td class="text-center">
                                                <button class="btn btn-warning btn-sm edit-btn" data-id="{{ $kategori->id_kategori }}"
                                                    data-nama="{{ $kategori->nama_kategori }}" data-toggle="modal"
                                                    data-target="#editKategoriModal">
                                                    <i class="fa fa-edit"></i> Edit
                                                </button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="2" class="text-center">Tidak ada data.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Kategori -->
    <div class="modal fade" id="addKategoriModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Kategori Baru</h5>
                </div>
                <form action="{{ route('kategori.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nama Kategori</label>
                            <input type="text" class="form-control" name="nama_kategori" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit Kategori -->
    <div class="modal fade" id="editKategoriModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Kategori</h5>
                </div>
                <form id="editForm" action="#" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <input type="hidden" id="edit_id" name="id">
                        <div class="form-group">
                            <label>Nama Kategori</label>
                            <input type="text" class="form-control" id="edit_nama_kategori" name="nama_kategori" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Hapus Kategori -->
    <div class="modal fade" id="deleteKategoriModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi Hapus</h5>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus kategori ini?</p>
                </div>
                <div class="modal-footer">
                    <form id="deleteForm" action="#" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" id="delete_id" name="id">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('.edit-btn').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const nama = this.getAttribute('data-nama');

                document.getElementById('edit_id').value = id;
                document.getElementById('edit_nama_kategori').value = nama;
                document.getElementById('editForm').action = `/kategori/${id}`;
            });
        });

        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                document.getElementById('delete_id').value = id;
                document.getElementById('deleteForm').action = `/kategori/${id}`;
            });
        });
    </script>
@endsection