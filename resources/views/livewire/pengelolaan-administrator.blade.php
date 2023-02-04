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
                                    <button class="btn btn-warning btn-sm"
                                        wire:click='goToView("pengelolaanview",{{ $item->id }})'>
                                        <i class="fa fa-eye d-inline d-md-none"></i>
                                        <span class="fw-bold d-none d-md-inline">Lihat</span>
                                    </button>
                                    <button class="btn btn-info btn-sm"
                                        wire:click='cetak("{{ $item->id_pengelolaan }}")' target="__blank">
                                        <i class="fa fa-print d-inline d-md-none"></i>
                                        <span class="fw-bold d-none d-md-inline">Cetak</span>
                                    </button>
                                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#deleteitem" wire:click='selectitem({{ $item->id }})'>
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
    </div>
    <div wire:ignore.self class="modal fade" id="deleteitem" tabindex="-1" data-bs-backdrop="static">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 fw-bold" id="exampleModalToggleLabel2">Hapus Item</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Hapus data pengelolaan {{ $selectdeleted['nama'] }}?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" wire:click='cleartext' class="btn btn-danger" data-bs-dismiss="modal">
                        Batal
                    </button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal"
                        wire:click='delete({{ $selectdeleted['id'] }}); cleartext'>
                        Hapus
                    </button>
                </div>
            </div>
        </div>
    </div>
    {{-- additional script --}}
    @push('js')
        <script>
            $(document).ready(function() {
                window.livewire.on('alertremove', () => {
                    setTimeout(function() {
                        $('.alert').fadeOut('fast');
                    }, 3000);
                });
                Livewire.on('cetak', (id) => {
                    var url = "/pengelolaan/cetak/" + id;
                    window.open(url, "_blank");
                });
            });
        </script>
    @endpush
</div>
