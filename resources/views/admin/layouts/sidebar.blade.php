<div class="nk-sidebar">
    <div class="nk-nav-scroll">
        <ul class="metismenu" id="menu">
            <li class="nav-label">Dashboard</li>
            <li>
                <a href="{{ route('index.dashboard') }}" aria-expanded="false">
                    <i class="icon-speedometer menu-icon"></i><span class="nav-text">Dashboard</span>
                </a>
            </li>
            <li class="nav-label">Apps</li>

            <li class="nav-label">Produk</li>
            <li>
                <a href="{{ route('admin.produk') }}" aria-expanded="false">
                    <i class="icon-grid menu-icon"></i><span class="nav-text">Produk</span>
                </a>
            </li>
            <li>
                <a href="\" aria-expanded="false">
                    <i class="icon-user menu-icon"></i> <span class="nav-text">Customer</span>
                </a>
            </li>
            <li>
                <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class="icon-basket menu-icon"></i><span class="nav-text">Pembelian</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="/">Transaksi</a></li>
                    <li><a href="/">List Transaksi</a></li>
                </ul>
            </li>
            <li>
                <a href="{{ route('admin.produk') }}" aria-expanded="false">
                    <i class="icon-grid menu-icon"></i><span class="nav-text">Kelola Laporan</span>
                </a>
            </li>
            <li>
                <a href="{{ route('logOut.login') }}" aria-expanded="false">
                    <i class="icon-logout menu-icon"></i><span class="nav-text">logout</span>
                </a>
            </li>
        </ul>
    </div>
</div>