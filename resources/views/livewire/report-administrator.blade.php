<div>
    @push('blade')
        @include('layouts.usernav')
    @endpush
    {{-- <pre>
        {{ var_dump($state) }}
        {{ var_dump($statecheck) }}
    </pre> --}}
    {{ $this->buttonstate() }}
    <div class="row justify-content-center">
        <div class="col-12 col-md-8">
            <div class="card">
                <div class="card-body">
                    <label for="jenis" class="fw-bold">Jenis Laporan</label>
                    <select name="jenis" id="jenis" class="form-select mb-3" wire:model='state.jenis'>
                        <option selected hidden>Pilih Jenis Laporan</option>
                        @php
                            $jumlah = count($tipe);
                        @endphp
                        @foreach ($tipe as $item)
                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                        @endforeach
                        <option value="{{ $jumlah + 1 }}">Semua</option>
                    </select>
                    <label for="jangka" class="fw-bold">Jangka Laporan</label>
                    <select name="jangka" id="jangka" class="form-select mb-3" wire:model='state.jangka'>
                        <option selected hidden>Pilih Jangka Laporan</option>
                        <option value="1">Bulanan</option>
                        <option value="2">Tahunan</option>
                    </select>
                    <label for="bulan" class="fw-bold" {{ $state['jangka'] == 1 ? null : 'hidden' }}>Bulan
                        Laporan</label>
                    <select {{ $state['jangka'] == 1 ? null : 'hidden' }} name="bulan" id="bulan"
                        class="form-select mb-3" wire:model='state.bulan'>
                        <option selected hidden>Pilih Bulan Laporan</option>
                        @for ($i = 0; $i < 12; $i++)
                            <option value="{{ $i + 1 }}">{{ $bulan[$i] }}</option>
                        @endfor
                    </select>
                    <label for="tahun" class="fw-bold">Tahun Laporan</label>
                    <select name="tahun" id="tahun" class="form-select mb-3" wire:model='state.tahun'>
                        <option selected hidden>Pilih Tahun Laporan</option>
                        @for ($i = 0; $i < 5; $i++)
                            <option value="{{ date('Y') - $i }}">{{ date('Y') - $i }}</option>
                        @endfor
                    </select>
                    <div class="d-grid gap-2">
                        <button class="btn btn-primary fw-bold">Cetak Laporan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
