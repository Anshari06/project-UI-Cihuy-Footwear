@extends('layouts.produk')

@section('content')
<div class="d-flex gap-3 w-100 collection-wrapper">
    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-close d-md-none">
            <button onclick="closeSidebar()"><i class="bi bi-x-lg"></i></button>
        </div>

        <!-- Filter Gender -->
        <div class="filter-section">
            <h3 class="filter-title"><i class="bi bi-person"></i> Jenis Kelamin</h3>
            @foreach ($barang->pluck('gender')->unique() as $g)
                <div class="filter-option">
                    <label for="gender-{{ $g }}">{{ ucfirst($g) }}</label>
                    <input type="radio" name="gender" id="gender-{{ $g }}" value="{{ $g }}" data-group="gender">
                </div>
            @endforeach
        </div>

        <!-- Filter Brand -->
        <div class="filter-section">
            <h3 class="filter-title"><i class="bi bi-tag"></i> Brand</h3>
            @foreach ($barang->pluck('brand')->unique() as $b)
                <div class="filter-option">
                    <label for="brand-{{ Str::slug($b) }}">{{ $b }}</label>
                    <input type="radio" name="brand" id="brand-{{ Str::slug($b) }}" value="{{ $b }}" data-group="brand">
                </div>
            @endforeach
        </div>

        <!-- Filter Type -->
        <div class="filter-section">
            <h3 class="filter-title"><i class="bi bi-grid-3x3-gap"></i> Jenis Sepatu</h3>
            @foreach ($barang->pluck('type')->unique() as $t)
                <div class="filter-option">
                    <label for="type-{{ $t }}">{{ ucfirst($t) }}</label>
                    <input type="radio" name="type" id="type-{{ $t }}" value="{{ $t }}" data-group="type">
                </div>
            @endforeach
        </div>
    </aside>

    <!-- Products Area -->
    <div class="products-area flex-grow-1 min-width-0">
        <div class="breadcrumb">
            <a href="{{ route('landing') }}">Home</a> / all collection
        </div>
        <h1 class="page-title">Our Collection</h1>

        <button class="filter-toggle-btn d-md-none" onclick="openSidebar()">
            <i class="bi bi-funnel"></i> Filter
        </button>

        <div class="product-grid" id="productGrid">
            @foreach ($barang as $b)
                <div class="product-card-wrapper" data-id="{{ $b->id }}" data-brand="{{ strtolower($b->brand) }}" data-type="{{ strtolower($b->type) }}" data-gender="{{ strtolower($b->gender) }}">
                    <a href="{{ route('detailproduk', $b->id) }}" class="text-decoration-none product-card-link">
                        <div class="product-card">
                            <div class="product-image">
                                <span class="product-badge {{ $b->badge == 'Best Seller' ? 'badge-bestseller' : 'badge-new' }}">
                                    {{ $b->badge }}
                                </span>
                                <img src="{{ asset('images/cihuy/' . $b->image) }}" alt="{{ $b->name }}">
                            </div>
                            <div class="product-info">
                                <div class="product-price">Rp {{ number_format($b->price, 0, ',', '.') }}</div>
                                <div class="product-name">{{ $b->name }}</div>
                                <div class="product-desc">{{ Str::limit($b->description, 60) }}</div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    var allCards = Array.from(document.querySelectorAll('.product-card-wrapper'));
    var grid = document.getElementById('productGrid');
    var activeFilters = { gender: null, brand: null, type: null };

    function applyFilters() {
        var genderVal = document.querySelector('input[name="gender"]:checked');
        var brandVal = document.querySelector('input[name="brand"]:checked');
        var typeVal = document.querySelector('input[name="type"]:checked');

        activeFilters.gender = genderVal ? genderVal.value.toLowerCase() : null;
        activeFilters.brand = brandVal ? brandVal.value.toLowerCase() : null;
        activeFilters.type = typeVal ? typeVal.value.toLowerCase() : null;

        var visibleCards = [];
        var hiddenCount = 0;

        allCards.forEach(function(card) {
            var match = true;
            if (activeFilters.gender && card.dataset.gender !== activeFilters.gender) match = false;
            if (activeFilters.brand && card.dataset.brand !== activeFilters.brand) match = false;
            if (activeFilters.type && card.dataset.type !== activeFilters.type) match = false;

            if (match) {
                visibleCards.push(card);
            } else {
                card.style.display = 'none';
                hiddenCount++;
            }
        });

        // Reorder: visible first, then hidden
        visibleCards.forEach(function(card) {
            card.style.display = '';
            grid.appendChild(card);
        });
    }

    // Radio click to uncheck
    document.querySelectorAll('input[type="radio"]').forEach(function(radio) {
        radio.addEventListener('click', function() {
            var wasChecked = this.dataset.checked === 'true';
            this.checked = false;
            this.dataset.checked = 'false';
            if (!wasChecked) {
                this.checked = true;
                this.dataset.checked = 'true';
            }
            applyFilters();
            if (window.innerWidth <= 768) setTimeout(closeSidebar, 300);
        });
        radio.dataset.checked = 'false';
    });
</script>
@endsection
