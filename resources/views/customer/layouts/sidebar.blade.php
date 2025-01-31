<div class="nk-sidebar">
    <div class="nk-nav-scroll">
        <ul class="metismenu" id="menu">
            <li class="nav-label">Produk</li>
            <li>
                <a href="{{ route('customer.produk') }}" aria-expanded="false">
                    <i class="icon-grid menu-icon"></i><span class="nav-text">Produk</span>
                </a>
            </li>
            <li class="nav-label">Apps</li>
            <li>
                <a href="{{ route('customer.keranjang') }}" aria-expanded="false">
                    <i class="icon-basket menu-icon"></i><span class="nav-text">Keranjang Belanja</span>
                </a>
            </li>
            <li>
                <a href="{{ route('customer.riwayat') }}" aria-expanded="false">
                    <i class="fa fa-shopping-cart"></i> <span class="nav-text">Riwayat Belanja</span>
                </a>
            </li>
            <li>
                <a href="{{ route('logOut.login') }}" aria-expanded="false"
                    onclick="return confirm('Apakah anda yakin ingin LogOut ?')">
                    <i class="icon-logout menu-icon"></i><span class="nav-text">logout</span>
                </a>
            </li>
        </ul>
    </div>
</div>