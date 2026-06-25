@extends('admin.layouts.app')

@section('admin-title', 'Detail Pesanan')

@section('admin-content')
<a href="{{ route('admin.pesanan.index') }}" class="btn mb-3" style="background: var(--secondary); color: var(--text-dark); border-radius: 8px; font-size: 13px; font-weight: 600;">
    <i class="bi bi-arrow-left me-1"></i> Kembali
</a>

@if(session('success'))
    <div class="alert alert-success" style="border-radius: 8px; font-size: 14px;">{{ session('success') }}</div>
@endif

<div class="row g-4">
    <!-- Left -->
    <div class="col-lg-8">
        <!-- Order Items -->
        <div class="admin-table mb-4">
            <div class="p-3 border-bottom" style="border-color: #e6e0da;">
                <h6 class="mb-0 fw-bold" style="color: #2b2b2b;">Produk Dipesan</h6>
            </div>
            @foreach($pesanan->details as $item)
                <div class="p-3 border-bottom" style="border-color: #e6e0da;">
                    <div class="d-flex gap-3 align-items-center">
                        <div style="width: 64px; height: 64px; background: #faf9f7; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                            <img src="{{ asset('images/cihuy/' . $item->barang->image) }}" alt="{{ $item->barang->name }}" style="max-width: 90%; max-height: 90%; object-fit: contain;">
                        </div>
                        <div class="flex-grow-1">
                            <div style="font-size: 11px; color: #7a746f; text-transform: uppercase; font-weight: 700;">{{ $item->barang->brand }}</div>
                            <div style="font-weight: 700; color: #2b2b2b; font-size: 14px;">{{ $item->barang->name }}</div>
                            <div style="font-size: 12px; color: #7a746f;">Size: {{ $item->size }} &bull; Qty: {{ $item->jumlah }}</div>
                        </div>
                        <div class="text-end">
                            <div style="font-weight: 700; color: #2b2b2b; font-size: 14px;">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</div>
                            <div style="font-size: 12px; color: #7a746f;">{{ $item->jumlah }}x Rp {{ number_format($item->price, 0, ',', '.') }}</div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Shipping Address -->
        <div class="admin-table">
            <div class="p-3 border-bottom" style="border-color: #e6e0da;">
                <h6 class="mb-0 fw-bold" style="color: #2b2b2b;">Alamat Pengiriman</h6>
            </div>
            <div class="p-3">
                <div style="font-weight: 700; color: #2b2b2b; font-size: 14px;">{{ $pesanan->nama_depan }} {{ $pesanan->nama_belakang }}</div>
                <div style="font-size: 13px; color: #7a746f; margin-bottom: 4px;">{{ $pesanan->no_telp }}</div>
                <div style="font-size: 13px; color: #7a746f;">{{ $pesanan->alamat }}</div>
                @if($pesanan->alamat !== 'Store Pickup')
                    <div style="font-size: 13px; color: #7a746f;">{{ $pesanan->kelurahan }}, {{ $pesanan->kecamatan }}, {{ $pesanan->kota }}, {{ $pesanan->provinsi }} {{ $pesanan->kode_pos }}</div>
                @endif
            </div>
        </div>
    </div>

    <!-- Right: Summary -->
    <div class="col-lg-4">
        <!-- Order Info -->
        <div class="admin-table p-3 mb-3">
            <div class="d-flex justify-content-between mb-2">
                <span style="color: #7a746f; font-size: 13px;">No Pesanan</span>
                <span style="font-weight: 700; font-size: 13px;">ORD-{{ \Carbon\Carbon::parse($pesanan->created_at)->format('Ymd') }}-{{ str_pad($pesanan->id, 4, '0', STR_PAD_LEFT) }}</span>
            </div>
            <div class="d-flex justify-content-between mb-2">
                <span style="color: #7a746f; font-size: 13px;">Tanggal</span>
                <span style="font-weight: 600; font-size: 13px;">{{ \Carbon\Carbon::parse($pesanan->created_at)->locale('id')->translatedFormat('d M Y, H:i') }} WIB</span>
            </div>
            <div class="d-flex justify-content-between mb-2">
                <span style="color: #7a746f; font-size: 13px;">Metode Bayar</span>
                <span style="font-weight: 600; font-size: 13px;">{{ $pesanan->metode_pembayaran }}</span>
            </div>
            <div class="d-flex justify-content-between align-items-center pt-2 mt-2 border-top" style="border-color: #e6e0da;">
                <span style="font-weight: 700; color: #2b2b2b; font-size: 15px;">Total</span>
                <span style="font-weight: 800; color: #2b2b2b; font-size: 18px;">Rp {{ number_format($pesanan->total, 0, ',', '.') }}</span>
            </div>
        </div>

        <!-- Status Update -->
        <div class="admin-table p-3">
            <h6 class="fw-bold mb-3" style="color: #2b2b2b;">Update Status</h6>
            <form action="{{ route('admin.pesanan.status', $pesanan->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="d-flex gap-2">
                    <select name="status" class="form-select" style="border: 1.5px solid #e6e0da; border-radius: 8px; font-size: 13px; padding: 8px 12px;">
                        <option value="P" {{ $pesanan->status === 'P' ? 'selected' : '' }}>P</option>
                        <option value="CON" {{ $pesanan->status === 'CON' ? 'selected' : '' }}>CON</option>
                        <option value="S" {{ $pesanan->status === 'S' ? 'selected' : '' }}>S</option>
                        <option value="D" {{ $pesanan->status === 'D' ? 'selected' : '' }}>D</option>
                        <option value="C" {{ $pesanan->status === 'C' ? 'selected' : '' }}>C</option>
                    </select>
                    <button type="submit" class="btn" style="background: #545350; color: #fff; border-radius: 8px; font-size: 13px; font-weight: 600; white-space: nowrap;">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
