<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Cetak Pengelolaan {{ $id }}</title>

    <script src="{{ asset('js/bootstrap.bundle.min.js') }}" defer></script>
    <script src="{{ asset('js/jquery.min.js') }}" defer></script>
    <link href="{{ asset('fontawesome/js/all.js') }}" rel="stylesheet">

    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('fontawesome/css/all.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
        <div class="row justify-content-center">
            <div class="col-12">
                <h1 class="text-center">PT. Solnet Indonesia</h1>
                <h4 class="text-center">Jalan W.R. Supratman No. 77, (+62) 771 728 171</h4>
                <hr>
            </div>
            <div class="col-6">
                <label class="fw-bold" for="nama">Nama</label>
                <label class="fw-bold" for="nama">{{ $master['nama_penanggung_jawab'] }}</label>

            </div>
            <div class="col-6"></div>
        </div>
    </div>
</body>

</html>
