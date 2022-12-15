<div>
    <div class="row mb-3">
        <div class="col-3 col-md-2 offset-0 offset-md-2 d-grid gap-2">
            <a class="btn btn-danger fw-bold" href="{{ route('item') }}">
                <i class="fa fa-chevron-left d-inline d-md-none"></i>
                <span class="d-none d-md-inline">
                    Kembali
                </span>
            </a>
        </div>
    </div>
    <div class="row justify-content-center mb-3">
        <div class="col-12 col-md-8 mb-3">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <h3 class="text-center fw-bold">Data Item</h3>
                            <hr>
                        </div>
                        @if (session()->has('message'))
                            <div class="col-12">
                                <div class="alert alert-{{ session('color') }}">
                                    {{ session('message') }}
                                </div>
                            </div>
                        @endif
                        <div class="col-12 form-group text-center mb-3">
                            <label for="nama" class="fw-bold">Nama Item</label>
                            <input type="text" class="form-control" placeholder="Nama Item" name="nama"
                                id="nama" required wire:model='dataview.nama'>
                        </div>
                        <div class="col-12 form-group text-center mb-3">
                            <label for="jumlah" class="fw-bold">Jumlah Item</label>
                            <input type="number" class="form-control" placeholder="Jumlah Item" name="jumlah"
                                id="jumlah" wire:model='dataview.jumlah' readonly>
                        </div>
                        <div class="col-12 form-group text-center mb-3">
                            <label for="satuan" class="fw-bold">Satuan Item</label>
                            <input type="text" class="form-control" placeholder="Satuan Item" name="satuan"
                                id="satuan" wire:model='dataview.satuan'>
                        </div>
                        <div class="col-12 form-group text-center mb-3">
                            <label for="jenis" class="fw-bold">Jenis Item</label>
                            <select name="jenis" id="jenis" class="form-select"
                                wire:model='dataview.id_jenis_item'>
                                @foreach ($jenisitem as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12 form-group d-grid gap-2 text-center mb-3">
                            <button class="btn btn-primary fw-bold" wire:click='update'>Ubah Data</button>
                        </div>
                        {{-- <pre>
                            @php
                                echo 'data barang -> ';
                                print_r($dataview);
                                echo 'data pengelolaan -> ';
                                print_r($datapengelolaan);
                            @endphp
                        </pre> --}}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-8 mb-3">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <h3 class="text-center fw-bold">Data Pengelolaan Item</h3>
                            <hr>
                        </div>
                        <div class="col-12">
                            <table class="table table-bordered text-center">
                                <thead class="table-primary fw-bold">
                                    <tr>
                                        <td>No</td>
                                        <td>Nomor Pengelolaan</td>
                                        <td>Jenis Pengelolaan</td>
                                        <td>Tipe</td>
                                        <td>Jumlah Item</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($datapengelolaan) == 0)
                                        <tr>
                                            <td colspan="5">
                                                <h3 class="text-center">Data Kosong</h3>
                                            </td>
                                        </tr>
                                    @else
                                        @for ($i = 0; $i < count($datapengelolaan); $i++)
                                            <tr>
                                                <td>{{ $i + 1 }}</td>
                                                <td>{{ $datapengelolaan[$i]['id_pengelolaan'] }}</td>
                                                <td>{{ $datapengelolaan[$i]['nama'] }}</td>
                                                <td>{{ $datapengelolaan[$i]['tipe'] == '+' ? 'Penambahan' : 'Pengurangan' }}
                                                </td>
                                                <td>{{ $datapengelolaan[$i]['jumlah'] }}</td>
                                            </tr>
                                        @endfor
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
