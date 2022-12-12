<div>
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
            <button title="Tambah Data Item" class="btn btn-primary fw-bold" data-bs-toggle="modal"
                data-bs-target="#additem" wire:click='cleartext'>
                <i class="fa fa-file-circle-plus d-inline d-md-none"></i>
                <span class="d-none d-md-inline">Tambah Data Item</span>
            </button>
        </div>
        <div class="col-12 mb-3">
            <div class="table-responsive">
                <table class="table table-bordered text-center">
                    <thead class="table-primary">
                        <tr>
                            <th>No</th>
                            <th>Nama Item</th>
                            <th>Jenis Item</th>
                            <th>Jumlah Item</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($items as $item)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->jenis }}</td>
                                <td>{{ $item->jumlah }}</td>
                                <td>
                                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#viewitem" wire:click='viewitem({{ $item->id }})'>
                                        <i class="fa fa-eye d-inline d-md-none"></i>
                                        <span class="fw-bold d-none d-md-inline">Lihat</span>
                                    </button>
                                    <button class="btn btn-danger btn-sm">
                                        <i class="fa fa-trash d-inline d-md-none"></i>
                                        <span class="fw-bold d-none d-md-inline">Hapus</span>
                                    </button>
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
        {{ $inputdata['nama'] }}
    </div>
    {{-- Modal Tambah Data --}}
    <div wire:ignore.self class="modal fade" id="additem" tabindex="-1" data-bs-backdrop="static">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 fw-bold" id="exampleModalToggleLabel2">Tambah Data Item</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent='store'>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label class="fw-bold" for="nama">Nama Item</label>
                                <input class="form-control" type="text" name="nama" id="nama"
                                    wire:model.lazy='inputdata.nama' placeholder="Nama Item">
                            </div>
                            <div class="col-12 mb-3">
                                <label class="fw-bold" for="jenis">Jenis Item</label>
                                <select name="jenis" id="jenis" class="form-control"
                                    wire:model.lazy='inputdata.id_jenis_item'>
                                    <option selected hidden>Pilih Jenis Item</option>
                                    @foreach ($jenisitems as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                            Batal
                        </button>
                        <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- Modal View Data dan Pengelolaan --}}
    <div wire:ignore.self class="modal fade" id="viewitem" tabindex="-1" data-bs-backdrop="static">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 fw-bold" id="exampleModalToggleLabel2">View Data Item</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent='store'>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label class="fw-bold" for="nama">Nama Item</label>
                                <input class="form-control" type="text" name="nama" id="nama"
                                    wire:model='viewdata.nama'>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="fw-bold" for="jumlah">Jumlah Item</label>
                                <input readonly class="form-control" type="number" name="jumlah" id="jumlah"
                                    wire:model='viewdata.jumlah'>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="fw-bold" for="jenis">Jenis Item</label>
                                <select name="jenis" id="jenis" class="form-control"
                                    wire:model.lazy='viewdata.id_jenis_item'>
                                    <option selected hidden>Pilih Jenis Item</option>
                                    @foreach ($jenisitems as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12 mb-3">
                                <table class="table table-bordered text-center">
                                    <thead class="table-primary">
                                        <tr>
                                            <th>No</th>
                                            <th>ID Pengelolaan</th>
                                            <th>Jenis Pengelolaan</th>
                                            <th>Jumlah</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" wire:click='cleartext' class="btn btn-danger"
                            data-bs-dismiss="modal">
                            Batal
                        </button>
                        <button type="submit" wire:click='cleartext' class="btn btn-primary"
                            data-bs-dismiss="modal">
                            Ubah
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- Modal Konfirmasi Hapus Item --}}
    @push('js')
        <script>
            $(document).ready(function() {
                window.livewire.on('alertremove', () => {
                    setTimeout(function() {
                        $('.alert').fadeOut('fast');
                    }, 3000);
                });
            });
        </script>
    @endpush
</div>
