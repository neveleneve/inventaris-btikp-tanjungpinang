<div>
    @push('blade')
        @include('layouts.usernav')
    @endpush
    <div class="row mb-0 mb-md-3">
        <div class="col-12">
            <label for="year" class="fw-bold mb-0 mb-md-2">Tahun Data</label>
            <select name="year" id="year" class="form-control" wire:model='year' wire:change='load'>
                @for ($i = 0; $i < 4; $i++)
                    <option value="{{ date('Y') - $i }}">{{ date('Y') - $i }}</option>
                @endfor
            </select>
        </div>
    </div>
    <h1 class="text-center" wire:loading.block>
        <i class="fa-solid fa-spinner fa-spin"></i>
    </h1>
    <div class="row justify-content-center" wire:loading.remove>
        <div class="col-md-12">
            <canvas id="myChart" width="400" height="200"></canvas>
        </div>
    </div>
    @push('js')
        <script src="{{ url('js/chart.js') }}"></script>
        <script>
            const ctx = document.getElementById('myChart');
            const myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: @json($label),
                    datasets: @json($dataset)
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
            Livewire.on('updateChart', data => {
                myChart.data = data;
                myChart.update();
            });
        </script>
    @endpush
</div>
