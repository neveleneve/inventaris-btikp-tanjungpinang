<div>
    @push('blade')
        @include('layouts.usernav')
    @endpush
    <div class="row justify-content-center mb-3">
        <div class="col-12 col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <label for="id" class="fw-bold">ID Pengelolaan</label>
                            <input type="text" class="form-control" id="id" name="id"
                                wire:model='datapengelolaan.id' readonly>
                        </div>
                        <div class="col-12 mb-3">
                            <label for="id" class="fw-bold">Nama Penanggung Jawab</label>
                            <input type="text" class="form-control" id="nama" name="nama"
                                wire:model='datapengelolaan.nama'>
                        </div>
                        {{-- <pre>
                            @php
                                // print_r($datapengelolaan);
                                // print_r($checkboxselectedstate);
                                print_r($itemselected);
                            @endphp
                        </pre> --}}
                    </div>
                    <div class="row mb-3">
                        <div class="col-12 d-grid gap-2">
                            <button class="btn btn-primary">
                                Simpan
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center mb-3">
        <div class="col-12 col-md-8">
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered text-center">
                        <thead>
                            <tr>
                                <th></th>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Tersedia</th>
                                <th>Jenis Pengelolaan</th>
                                <th>Jumlah Pengelolaan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($itemlist as $item)
                                @php
                                    $jumlahitem = $item->jumlah;
                                @endphp
                                <tr>
                                    <td>
                                        <input type="checkbox" class="form-check"
                                            wire:click='checkedItem({{ $loop->index }}, {{ $item->id }})'>
                                    </td>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->jumlah }}</td>
                                    <td>
                                        <select class="form-select" wire:model='itemselected.{{ $loop->index }}.jenis'
                                            wire:change=''
                                            {{ $checkboxselectedstate[$loop->index]['enable'] == 0 ? 'disabled' : null }}>
                                            <option selected hidden value="0">Pilih Jenis Pengelolaan
                                            </option>
                                            @foreach ($tipepengelolaan as $item)
                                                <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input type="number" class="form-control" min="0"
                                            {{ isset($itemselected[$loop->index]['jenis']) ? ($itemselected[$loop->index]['jenis'] == 1 ? null : "max=$jumlahitem") : null }}
                                            wire:model='itemselected.{{ $loop->index }}.jumlah'
                                            {{ $checkboxselectedstate[$loop->index]['enable'] == 0 ? 'disabled' : null }}>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">
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
</div>
