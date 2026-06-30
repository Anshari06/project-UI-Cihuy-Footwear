<header class="dashboard-header">
    <div class="header-left">
        <div class="logo-section">
            <a href="{{ route('landing') }}">
                <img src="/images/cihuy/cihuylogo.svg" alt="Cihuy Logo" style="height: 40px; width: auto;">
            </a>
            <span class="logo-text">CIHUY FOOTWEAR</span>
        </div>
    </div>

    <div class="header-center">
        <div class="search-box">
            <i class="bi bi-search search-icon"></i>
            <input type="text" placeholder="Find Your Shoes" id="searchInput">
        </div>
    </div>

    <div class="header-right">
        <nav class="nav-links">
            <a href="{{ route('landing') }}"><i class="bi bi-house-door"></i> Home</a>
            <a href="{{ route('collection') }}"><i class="bi bi-grid-3x3-gap"></i> Koleksi</a>
            <a href="{{ route('artikel.index') }}"><i class="bi bi-newspaper"></i> Artikel</a>
            <a href="{{ route('keranjang') }}"><i class="bi bi-cart3"></i> Keranjang</a>
            <a href="{{ route('history') }}"><i class="bi bi-clock-history"></i> Pesanan</a>
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="bi bi-box-arrow-right"></i> Logout
            </a>
        </nav>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
        <button class="mobile-menu-btn" onclick="openMobileNav()" style="background:none;border:none;font-size:24px;cursor:pointer;color:#2b2b2b;padding:4px;display:none;align-items:center;justify-content:center;">
            <i class="bi bi-list"></i>
        </button>
    </div>
</header>

<!-- Mobile Nav Overlay -->
<div class="mobile-nav-overlay" id="mobileNavOverlay" onclick="closeMobileNav()"></div>

<!-- Mobile Nav Drawer -->
<div class="mobile-nav" id="mobileNav">
    <button class="mobile-nav-close" onclick="closeMobileNav()"><i class="bi bi-x-lg"></i></button>
    <nav class="mobile-nav-links">
        <a href="{{ route('landing') }}" onclick="closeMobileNav()">
            <i class="bi bi-house-door"></i> Home
        </a>
        <a href="{{ route('collection') }}" onclick="closeMobileNav()">
            <i class="bi bi-grid-3x3-gap"></i> Koleksi
        </a>
        <a href="{{ route('artikel.index') }}" onclick="closeMobileNav()">
            <i class="bi bi-newspaper"></i> Artikel
        </a>
        <a href="{{ route('keranjang') }}" onclick="closeMobileNav()">
            <i class="bi bi-cart3"></i> Keranjang
        </a>
        <a href="{{ route('history') }}" onclick="closeMobileNav()">
            <i class="bi bi-clock-history"></i> Pesanan
        </a>
        <a href="#" onclick="event.preventDefault(); closeMobileNav(); document.getElementById('logout-form-nav').submit();">
            <i class="bi bi-box-arrow-right"></i> Logout
        </a>
        <form id="logout-form-nav" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </nav>
</div>
