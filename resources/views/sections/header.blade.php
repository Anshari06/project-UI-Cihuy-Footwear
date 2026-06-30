<header class="site-header">
  <nav class="navbar navbar-expand-lg">
    <div class="container">
      <a class="site-logo" href="{{ route('landing') }}">
        <img src="/images/cihuy/cihuylogo.svg" alt="Cihuy logo">
        CIHUY FOOTWEAR
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMain" aria-controls="navMain" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse site-nav" id="navMain">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-center">
          <li class="nav-item"><a class="nav-link" href="{{ route('landing') }}">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('landing') }}#brand-recommendation">Brand</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('landing') }}#recommended-products">Katalog</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('artikel.index') }}">Artikel</a></li>
          @guest
            <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
          @else
            <li class="nav-item">
              <a class="nav-link" href="{{ route('collection') }}"><i class="bi bi-grid-3x3-gap me-1"></i> Katalog</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('keranjang') }}"><i class="bi bi-cart3 me-1"></i> Keranjang</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('history') }}"><i class="bi bi-clock-history me-1"></i> Pesanan</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="bi bi-box-arrow-right me-1"></i> Logout</a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
                @csrf
              </form>
            </li>
          @endguest
        </ul>
      </div>
    </div>
  </nav>
</header>
