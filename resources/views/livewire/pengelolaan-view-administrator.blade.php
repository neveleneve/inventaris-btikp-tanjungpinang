<div>
    {{-- @push('blade')
        @include('layouts.usernav')
    @endpush --}}
    <div class="row justify-content-center">
        <div class="col-12 col-lg-8 mb-3 mb-lg-0">
            <div class="card">
                <div class="card-body">
                    <label for="id" class="fw-bold">ID Pengelolaan</label>
                    <input type="text" class="form-control mb-3" name="id" id="id" wire:model='master.id'
                        readonly>
                    <label for="nama" class="fw-bold">Nama Penanggung Jawab</label>
                    <input type="text" class="form-control mb-3" name="nama" id="nama"
                        wire:model='master.nama' readonly>
                    <div class="d-grid">
                        <button class="btn btn-danger mb-3 fw-bold"
                            wire:click='goToView("pengelolaan")'>Kembali</button>
                    </div>
                    <table class="table table-bordered text-center text-nowrap">
                        <thead class="table-primary">
                            <tr>
                                <th>No</th>
                                <th>Nama Item</th>
                                <th>Satuan</th>
                                <th>Tipe Pengelolaan</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pengelolaan as $item)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $item->nama_item }}</td>
                                    <td>{{ $item->satuan }}</td>
                                    <td>{{ $item->nama_pengelolaan }}</td>
                                    <td>{{ $item->jumlah }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
