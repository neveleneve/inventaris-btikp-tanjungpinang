<div>
    @push('blade')
        @include('layouts.usernav')
    @endpush
    <div class="row justify-content-center">
        @if (session()->has('message'))
            <div class="col-12 mb-3">
                <div class="alert alert-{{ session('color') }}">
                    {{ session('message') }}
                </div>
            </div>
        @endif
        <div class="col-12 col-md-6 d-grid gap-2 mb-3">
            <input type="text" class="form-control" name="search" id="search" placeholder="Pencarian..."
                wire:model='pencarian'>
        </div>
        <div class="col-12 col-md-6 d-grid gap-2 mb-3">
            <button title="Tambah Data Item" class="btn btn-primary fw-bold" wire:click='goToView("pengelolaanadd")'>
                <i class="fa fa-file-circle-plus d-inline d-md-none"></i>
                <span class="d-none d-md-inline">Tambah Data Pengelolaan</span>
            </button>
        </div>
        <div class="col-12 mb-3">
            <div class="table-responsive">
                <table class="table table-bordered text-center text-nowrap">
                    <thead class="table-primary">
                        <tr>
                            <th>No</th>
                            <th>Nomor Pengelolaan</th>
                            <th>Nama Penanggung Jawab</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pengelolaan as $item)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $item->id_pengelolaan }}</td>
                                <td>{{ ucwords($item->nama_penanggung_jawab) }}</td>
                                <td>
                                    <a href="#">
                                        <button class="btn btn-warning btn-sm"
                                            wire:click='goToView({{ $item->id }})'>
                                            <i class="fa fa-eye d-inline d-md-none"></i>
                                            <span class="fw-bold d-none d-md-inline">Lihat</span>
                                        </button>
                                        <button class="btn btn-danger btn-sm">
                                            <i class="fa fa-trash d-inline d-md-none"></i>
                                            <span class="fw-bold d-none d-md-inline">Hapus</span>
                                        </button>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">
                                    <h3 class="text-center fw-bold">Data Kosong</h3>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
