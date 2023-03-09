<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
        <div class="nav">
            @if (auth()->user()->level == 'admin')
            <a class="nav-link" href="admin/dashboard">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                Dashboard
            </a>
            @elseif(auth()->user()->level == "petugas")
            <a class="nav-link" href="/dashboard">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                Dashboard
            </a>
            @else
            <a class="nav-link" href="/home">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                Dashboard
            </a>
            @endif
            @if (auth()->user()->level == "admin")
                
            <div class="sb-sidenav-menu-heading">Master</div>
            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                Master Data
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link" href="{{ route('Siswa.index') }}"><i class="fas fa-graduation-cap m-2"></i>Siswa</a>
                    <a class="nav-link" href="{{ route('Petugas.index') }}"><i class="fas fa-user m-2"></i>Petugas</a>
                    <a class="nav-link" href="{{ route('Kelas.index') }}"><i class="fas fa-school m-2"></i>Kelas</a>
                    <a class="nav-link" href="{{ route('Spp.index') }}"><i class="fas fa-book m-2"></i> Spp</a>
                </nav>
            </div>
            <a class="nav-link" href="{{ route('Pembayaran.index') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-money-bill"></i></div>
                Pembayaran
            </a>
            @elseif(auth()->user()->level == "petugas")
            <a class="nav-link" href="{{ route('Pembayaran.index') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-money-bill"></i></div>
                Pembayaran
            </a>
            @endif
            <a class="nav-link" href="{{ route('Pembayaran.riwayat') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-clock-rotate-left"></i></div>
                History
            </a>
        </div>
    </div>
    <div class="sb-sidenav-footer">
        <div class="small">Logged in as:</div>
        {{ auth()->user()->name }}
    </div>
</nav>