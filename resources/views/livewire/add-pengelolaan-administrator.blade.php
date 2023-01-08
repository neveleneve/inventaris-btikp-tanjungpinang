<div>
    @push('blade')
        @include('layouts.usernav')
    @endpush
    <div class="row justify-content-center mb-3">
        <div class="col-12 col-md-4 mb-3 mb-md-0">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <label for="id" class="fw-bold">ID Pengelolaan</label>
                            <input type="text" class="form-control" id="id" name="id"
                                wire:model='datapengelolaan.id' readonly>
                        </div>
                        <div class="col-12 mb-3">
                            <label for="id" class="fw-bold">Penanggung Jawab</label>
                            <input type="text" class="form-control" id="nama" name="nama"
                                wire:model='datapengelolaan.nama' placeholder="Nama Penanggung Jawab">
                            @if ($inputerror['nama'] == '0')
                                <small class="text-danger">Lengkapi data penanggung jawab pengelolaan</small>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-3 d-block d-md-none">
                        <div class="col-12">
                            <table class="table table-bordered text-center text-nowrap">
                                <thead class="table-primary">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Item</th>
                                        <th>Jenis Pengelolaan</th>
                                        <th>Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($itemselected as $item)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ ucwords($item['nama']) }}</td>
                                            <td>{{ $this->jenisPengelolaan($item['jenis']) }}</td>
                                            <td>{{ $item['jumlah'] }}</td>
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
                    {{-- <pre>
                        @php
                            print_r($itemselected);
                            print_r($inputerror);
                        @endphp
                    </pre> --}}
                    <div class="row mb-1">
                        <div class="col-12 d-grid gap-2 mb-3">
                            <button class="btn btn-primary fw-bold" wire:click='store'>
                                Simpan
                            </button>
                        </div>
                        <div class="col-12 d-grid gap-2">
                            <button class="btn btn-danger fw-bold" wire:click='kembali'>
                                Kembali
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-8">
            <div class="card">
                <div class="card-body">
                    <h3 class="text-center fw-bold">Data Barang</h3>
                    <div class="row mb-3">
                        <div class="col-12">
                            <input type="text" class="form-control" placeholder="Pencarian" wire:model='search'>
                        </div>
                    </div>
                    @if ($inputerror['item'] == '0')
                        <small class="text-danger text-center">Lengkapi data pengelolaan barang</small>
                    @endif
                    <div class="table-responsive" style="height: 155px">
                        <table class="table table-bordered text-center text-nowrap">
                            <thead style="position: sticky; top: 0;" class="table-primary">
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
                                        $iditem = $item->id;
                                    @endphp
                                    <tr>
                                        <td>
                                            <input type="checkbox" class="form-check"
                                                {{ $checkboxselectedstate[$item->id]['enable'] == 1 ? 'checked' : null }}
                                                wire:click='checkedItem({{ $item->id }})'>
                                        </td>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ ucwords($item->nama) }}</td>
                                        <td>{{ $item->jumlah }}</td>
                                        <td>
                                            <select class="form-select"
                                                wire:model='itemselected.{{ $item->id }}.jenis'
                                                {{ $checkboxselectedstate[$item->id]['enable'] == 0 ? 'disabled' : null }}>
                                                <option selected hidden value="0">Pilih Jenis Pengelolaan
                                                </option>
                                                @foreach ($tipepengelolaan as $item)
                                                    @if ($jumlahitem == 0)
                                                        @if ($item->id == 1)
                                                            <option value="{{ $item->id }}">{{ $item->nama }}
                                                            </option>
                                                        @endif
                                                    @else
                                                        <option value="{{ $item->id }}">{{ $item->nama }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <input type="number" class="form-control" min="0"
                                                {{ isset($itemselected[$iditem]['jenis']) ? ($itemselected[$iditem]['jenis'] == 1 ? null : "max=$jumlahitem") : null }}
                                                wire:model='itemselected.{{ $iditem }}.jumlah'
                                                {{ $checkboxselectedstate[$iditem]['enable'] == 0 ? 'disabled' : null }}>
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
    <div class="row d-none d-md-block">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="text-center fw-bold">Data Barang Pengelolaan</h3>
                    <table class="table table-bordered text-center text-nowrap">
                        <thead class="table-primary">
                            <tr>
                                <th>No</th>
                                <th>Nama Item</th>
                                <th>Jenis Pengelolaan</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($itemselected as $item)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ ucwords($item['nama']) }}</td>
                                    <td>{{ $this->jenisPengelolaan($item['jenis']) }}</td>
                                    <td>{{ $item['jumlah'] }}</td>
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
</div>
