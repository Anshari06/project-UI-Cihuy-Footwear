@extends('layouts.checkout')

@section('content')
<div class="d-flex align-items-center mb-4" style="gap: 12px;">
    <a href="{{ route('collection') }}" class="text-muted" style="font-size: 20px; text-decoration: none;">
        <i class="bi bi-arrow-left"></i>
    </a>
    <h1 class="page-title mb-0">Riwayat Pesanan</h1>
</div>

@if($pesanan->isEmpty())
    <div class="text-center py-5">
        <i class="bi bi-bag-x" style="font-size: 64px; color: #e6e0da;"></i>
        <h3 class="mt-3" style="color: #2b2b2b; font-weight: 700;">Belum Ada Pesanan</h3>
        <p style="color: #7a746f; font-size: 14px;">Kamu belum pernah melakukan pesanan.</p>
        <a href="{{ route('collection') }}" class="btn" style="background: #545350; color: #fff; border-radius: 8px; padding: 10px 24px; font-weight: 600; font-size: 14px; text-decoration: none;">
            Mulai Belanja
        </a>
    </div>
@else
    <div class="d-flex flex-column gap-3">
        @foreach($pesanan as $p)
            <a href="{{ route('pesanan.show', $p->id) }}" class="text-decoration-none">
                <div class="history-card">
                    <div class="row align-items-center">
                        <div class="col-md-2">
                            <div class="history-items-preview">
                                @foreach($p->details->take(3) as $item)
                                    <div class="history-thumb">
                                        <img src="{{ asset('images/cihuy/' . $item->barang->image) }}" alt="{{ $item->barang->name }}">
                                    </div>
                                @endforeach
                                @if($p->details->count() > 3)
                                    <div class="history-thumb-more">+{{ $p->details->count() - 3 }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="history-info">
                                <div class="history-no">ORD-{{ \Carbon\Carbon::parse($p->created_at)->format('Ymd') }}-{{ str_pad($p->id, 4, '0', STR_PAD_LEFT) }}</div>
                                <div class="history-date">{{ \Carbon\Carbon::parse($p->created_at)->locale('id')->translatedFormat('d F Y, H:i') }} WIB</div>
                                <div class="history-count">{{ $p->details->count() }} produk</div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="history-alamat">
                                <small style="color: #7a746f; font-size: 11px; text-transform: uppercase; font-weight: 600;">Alamat</small>
                                <div style="color: #2b2b2b; font-size: 13px;">{{ $p->alamat }}, {{ $p->kota }}, {{ $p->provinsi }}</div>
                            </div>
                        </div>
                        <div class="col-md-2 text-center">
                            <div class="history-status-badge status-{{ $p->status }}">
                                @if($p->status === 'pending')
                                    <i class="bi bi-clock me-1"></i>Pending
                                @elseif($p->status === 'confirmed')
                                    <i class="bi bi-check-circle me-1"></i>Dikonfirmasi
                                @elseif($p->status === 'shipped')
                                    <i class="bi bi-truck me-1"></i>Dikirim
                                @elseif($p->status === 'completed')
                                    <i class="bi bi-bag-check me-1"></i>Selesai
                                @elseif($p->status === 'cancelled')
                                    <i class="bi bi-x-circle me-1"></i>Dibatalkan
                                @endif
                            </div>
                        </div>
                        <div class="col-md-1 text-end">
                            <i class="bi bi-chevron-right" style="color: #7a746f; font-size: 18px;"></i>
                        </div>
                    </div>
                    <div class="history-footer">
                        <div class="history-payment">
                            <i class="bi bi-credit-card me-1"></i>{{ $p->metode_pembayaran }}
                        </div>
                        <div class="history-total">Rp {{ number_format($p->total, 0, ',', '.') }}</div>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
@endif
@endsection

@section('extra_styles')
<style>
    .history-card {
        background: #fff;
        border: 1px solid #e6e0da;
        border-radius: 12px;
        padding: 20px;
        transition: all 0.3s;
        cursor: pointer;
    }
    .history-card:hover {
        border-color: #545350;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        transform: translateY(-2px);
    }
    .history-items-preview {
        display: flex;
        gap: 6px;
        align-items: center;
    }
    .history-thumb {
        width: 48px;
        height: 48px;
        border-radius: 8px;
        background: #faf9f7;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid #e6e0da;
    }
    .history-thumb img {
        max-width: 90%;
        max-height: 90%;
        object-fit: contain;
    }
    .history-thumb-more {
        width: 48px;
        height: 48px;
        border-radius: 8px;
        background: #efece5;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        font-weight: 700;
        color: #545350;
    }
    .history-no {
        font-size: 14px;
        font-weight: 700;
        color: #2b2b2b;
        margin-bottom: 2px;
    }
    .history-date {
        font-size: 12px;
        color: #7a746f;
        margin-bottom: 2px;
    }
    .history-count {
        font-size: 12px;
        color: #545350;
        font-weight: 600;
    }
    .history-status-badge {
        display: inline-block;
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }
    .status-pending {
        background: #fff3cd;
        color: #856404;
    }
    .status-confirmed {
        background: #d1ecf1;
        color: #0c5460;
    }
    .status-shipped {
        background: #d4edda;
        color: #155724;
    }
    .status-completed {
        background: #e8f5e9;
        color: #2e7d32;
    }
    .status-cancelled {
        background: #f8d7da;
        color: #721c24;
    }
    .history-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 14px;
        padding-top: 14px;
        border-top: 1px solid #e6e0da;
    }
    .history-payment {
        font-size: 13px;
        color: #7a746f;
    }
    .history-total {
        font-size: 16px;
        font-weight: 800;
        color: #2b2b2b;
    }
    @media (max-width: 768px) {
        .history-card .row > div { margin-bottom: 12px; }
    }
</style>
@endsection