<div>
    @push('blade')
        @include('layouts.usernav')
    @endpush
    <div class="row justify-content-center">
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
                        <pre>
                            @php
                                print_r($datapengelolaan);
                            @endphp
                        </pre>
                    </div>
                    <div class="row">
                        <div class="col-12">
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
                                        <tr>
                                            <td>
                                                <input type="checkbox" class="form-check">
                                            </td>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $item->nama }}</td>
                                            <td>{{ $item->jumlah }}</td>
                                            <td>
                                                <select name="tipe" id="tipe" class="form-select">
                                                    <option selected hidden>Pilih Jenis Pengelolaan</option>
                                                    @forelse ($tipepengelolaan as $item)
                                                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                                    @empty
                                                    @endforelse
                                                </select>
                                            </td>
                                            <td>
                                                <input type="number" name="jumlah" id="jumlah"
                                                    class="form-control">
                                            </td>
                                        </tr>
                                    @empty
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
