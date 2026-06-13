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
            <a href="{{ route('keranjang') }}"><i class="bi bi-cart3"></i> Keranjang</a>
            <a href="{{ route('history') }}"><i class="bi bi-clock-history"></i> Pesanan</a>
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="bi bi-box-arrow-right"></i> Logout
            </a>
        </nav>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
        <button class="mobile-menu-btn" onclick="toggleMobileMenu()">
            <i class="bi bi-list"></i>
        </button>
    </div>
</header>