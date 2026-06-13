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
            <div class="filter-option">
                <label for="gender-pria">Pria</label>
                <input type="radio" name="gender" id="gender-pria" value="pria">
            </div>
            <div class="filter-option">
                <label for="gender-wanita">Wanita</label>
                <input type="radio" name="gender" id="gender-wanita" value="wanita">
            </div>
            <div class="filter-option">
                <label for="gender-anak">Anak-anak</label>
                <input type="radio" name="gender" id="gender-anak" value="anak">
            </div>
            <div class="filter-option">
                <label for="gender-unisex">Unisex</label>
                <input type="radio" name="gender" id="gender-unisex" value="unisex">
            </div>
        </div>

        <!-- Filter Brand -->
        <div class="filter-section">
            <h3 class="filter-title"><i class="bi bi-tag"></i> Brand</h3>
            @foreach ($barang->pluck('brand')->unique() as $b)
                <div class="filter-option">
                    <label for="brand-{{ Str::slug($b) }}">{{ $b }}</label>
                    <input type="radio" name="brand" id="brand-{{ Str::slug($b) }}" value="{{ $b }}">
                </div>
            @endforeach
        </div>

        <!-- Filter Type -->
        <div class="filter-section">
            <h3 class="filter-title"><i class="bi bi-grid-3x3-gap"></i> Jenis Sepatu</h3>
            @foreach ($barang->pluck('type')->unique() as $t)
                <div class="filter-option">
                    <label for="type-{{ $t }}">{{ ucfirst($t) }}</label>
                    <input type="radio" name="type" id="type-{{ $t }}" value="{{ $t }}">
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
                <a href="{{ route('detailproduk', $b->id) }}" class="text-decoration-none">
                    <div class="product-card" data-brand="{{ $b->brand }}" data-type="{{ $b->type }}"
                        data-gender="{{ $b->gender }}">
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
            @endforeach
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    const products = @json($barang);
</script>
@endsection