<div class="row mb-3">
    <div class="col-12">
        <ul class="nav nav-tabs nav-fill">
            <li class="nav-item">
                <a class="nav-link{{ Request::is('dashboard*') ? ' active fw-bold' : ' text-dark' }}"
                    href="{{ route('home') }}">Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link{{ Request::is('item*') ? ' active fw-bold' : ' text-dark' }}"
                    href="{{ route('item') }}">Item</a>
            </li>
            <li class="nav-item">
                <a class="nav-link{{ Request::is('pengelolaan*') ? ' active fw-bold' : ' text-dark' }}"
                    href="{{ route('pengelolaan') }}">Pengelolaan</a>
            </li>
            <li class="nav-item">
                <a class="nav-link{{ Request::is('report*') ? ' active fw-bold' : ' text-dark' }}"
                    href="{{ route('report') }}">Laporan</a>
            </li>
        </ul>
    </div>
</div>
