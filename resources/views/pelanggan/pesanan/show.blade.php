@extends('layouts.checkout')

@section('content')
<div class="d-flex align-items-center mb-4" style="gap: 12px;">
    <a href="{{ route('history') }}" class="text-muted" style="font-size: 20px; text-decoration: none;">
        <i class="bi bi-arrow-left"></i>
    </a>
    <h1 class="page-title mb-0">Detail Pesanan</h1>
</div>

<!-- Order Info Header -->
<div class="bg-white rounded-3 border mb-4" style="border-color: #e6e0da;">
    <div class="row p-4">
        <div class="col-md-6">
            <div class="detail-label">No. Pesanan</div>
            <div class="detail-value">ORD-{{ \Carbon\Carbon::parse($pesanan->created_at)->format('Ymd') }}-{{ str_pad($pesanan->id, 4, '0', STR_PAD_LEFT) }}</div>
            <div class="detail-label mt-3">Tanggal</div>
            <div class="detail-sub">{{ \Carbon\Carbon::parse($pesanan->created_at)->locale('id')->translatedFormat('d F Y, H:i') }} WIB</div>
        </div>
        <div class="col-md-3">
            <div class="detail-label">Status</div>
            <div class="status-badge status-{{ $pesanan->status }}">
                @if($pesanan->status === 'P')
                    <i class="bi bi-clock me-1"></i>P
                @elseif($pesanan->status === 'CON')
                    <i class="bi bi-check-circle me-1"></i>CON
                @elseif($pesanan->status === 'S')
                    <i class="bi bi-truck me-1"></i>S
                @elseif($pesanan->status === 'D')
                    <i class="bi bi-bag-check me-1"></i>D
                @elseif($pesanan->status === 'C')
                    <i class="bi bi-x-circle me-1"></i>C
                @endif
            </div>
        </div>
        <div class="col-md-3 text-md-end">
            <div class="detail-label">Metode Pembayaran</div>
            <div class="detail-sub"><i class="bi bi-credit-card me-1"></i>{{ $pesanan->metode_pembayaran }}</div>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Left: Items & Address -->
    <div class="col-lg-8">
        <!-- Products -->
        <div class="bg-white rounded-3 border mb-4" style="border-color: #e6e0da;">
            <div class="p-4 border-bottom" style="border-color: #e6e0da !important;">
                <h5 class="fw-bold mb-0" style="color: #2b2b2b;">Produk</h5>
            </div>
            @foreach($pesanan->details as $item)
                <div class="p-4 border-bottom" style="border-color: #e6e0da !important;">
                    <div class="d-flex gap-3">
                        <div class="detail-thumb">
                            <img src="{{ asset('images/cihuy/' . $item->barang->image) }}" alt="{{ $item->barang->name }}">
                        </div>
                        <div class="flex-grow-1">
                            <div style="font-size: 11px; color: #7a746f; text-transform: uppercase; font-weight: 600;">{{ $item->barang->brand }}</div>
                            <div class="fw-bold" style="color: #2b2b2b; font-size: 15px;">{{ $item->barang->name }}</div>
                            <div style="color: #7a746f; font-size: 13px;">Size: {{ $item->size }} &bull; Qty: {{ $item->jumlah }}</div>
                        </div>
                        <div class="text-end">
                            <div class="detail-item-price">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</div>
                            <div style="font-size: 12px; color: #7a746f;">{{ $item->jumlah }}x Rp {{ number_format($item->price, 0, ',', '.') }}</div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Address -->
        @if($pesanan->alamat !== 'Store Pickup')
        <div class="bg-white rounded-3 border" style="border-color: #e6e0da;">
            <div class="p-4 border-bottom" style="border-color: #e6e0da !important;">
                <h5 class="fw-bold mb-0" style="color: #2b2b2b;">Alamat Pengiriman</h5>
            </div>
            <div class="p-4">
                <div class="fw-bold" style="color: #2b2b2b; font-size: 15px;">{{ $pesanan->nama_depan }} {{ $pesanan->nama_belakang }}</div>
                <div style="color: #7a746f; font-size: 13px; margin-bottom: 4px;">{{ $pesanan->no_telp }}</div>
                <div style="color: #7a746f; font-size: 13px;">{{ $pesanan->alamat }}</div>
                <div style="color: #7a746f; font-size: 13px;">{{ $pesanan->kelurahan }}, {{ $pesanan->kecamatan }}, {{ $pesanan->kota }}, {{ $pesanan->provinsi }} {{ $pesanan->kode_pos }}</div>
            </div>
        </div>
        @else
        <div class="bg-white rounded-3 border p-4" style="border-color: #e6e0da;">
            <div class="d-flex align-items-center gap-2" style="color: #27ae60;">
                <i class="bi bi-shop" style="font-size: 24px;"></i>
                <div>
                    <div class="fw-bold" style="color: #2b2b2b; font-size: 14px;">Pengambilan di Toko</div>
                    <div style="color: #7a746f; font-size: 13px;">Pesanan akan diambil di toko Cihuy Footwear.</div>
                </div>
            </div>
        </div>
        @endif
    </div>

    <!-- Right: Summary -->
    <div class="col-lg-4">
        <div class="summary-card">
            <h5 class="summary-title">Ringkasan Pembayaran</h5>

            @foreach($pesanan->details as $item)
                <div class="d-flex justify-content-between mb-2">
                    <span style="color: #7a746f; font-size: 13px;">{{ $item->barang->name }} x{{ $item->jumlah }}</span>
                    <span style="color: #2b2b2b; font-size: 13px; font-weight: 500;">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</span>
                </div>
            @endforeach

            <div class="summary-divider"></div>

            <div class="summary-row">
                <span class="label">Subtotal</span>
                <span class="value">Rp {{ number_format($pesanan->total, 0, ',', '.') }}</span>
            </div>
            <div class="summary-row">
                <span class="label">Ongkos Kirim</span>
                <span class="value" style="color: #7a746f; font-size: 12px;">
                    @if($pesanan->kurir && $pesanan->kurir !== 'store')
                        {{ $pesanan->kurir }}
                    @else
                        -
                    @endif
                </span>
            </div>
            <div class="summary-row">
                <span class="label">Diskon</span>
                <span class="value" style="color: #27ae60;">Rp 0</span>
            </div>

            <div class="summary-divider"></div>

            <div class="summary-row summary-total">
                <span class="label">Total</span>
                <span class="value">Rp {{ number_format($pesanan->total, 0, ',', '.') }}</span>
            </div>
        </div>
    </div>
</div>
@endsection

@section('extra_styles')
<style>
    .detail-label { font-size: 11px; color: #7a746f; text-transform: uppercase; font-weight: 600; margin-bottom: 4px; }
    .detail-value { font-size: 18px; font-weight: 800; color: #2b2b2b; }
    .detail-sub { font-size: 13px; color: #7a746f; }
    .detail-thumb { width: 72px; height: 72px; background: #faf9f7; border-radius: 10px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; border: 1px solid #e6e0da; }
    .detail-thumb img { max-width: 90%; max-height: 90%; object-fit: contain; }
    .detail-item-price { font-size: 15px; font-weight: 700; color: #2b2b2b; }
    .status-badge { display: inline-block; padding: 6px 14px; border-radius: 20px; font-size: 12px; font-weight: 600; }
    .status-P { background: #fff3cd; color: #856404; }
    .status-CON { background: #d1ecf1; color: #0c5460; }
    .status-S { background: #d4edda; color: #155724; }
    .status-D { background: #e8f5e9; color: #2e7d32; }
    .status-C { background: #f8d7da; color: #721c24; }
</style>
@endsection
