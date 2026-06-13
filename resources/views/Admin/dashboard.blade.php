@extends('admin.layouts.app')

@section('admin-title', 'Dashboard')

@section('admin-content')
<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="stat-card">
            <div class="stat-icon"><i class="bi bi-receipt"></i></div>
            <div class="stat-value">{{ $totalPesanan }}</div>
            <div class="stat-label">Total Pesanan</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card">
            <div class="stat-icon"><i class="bi bi-clock text-warning"></i></div>
            <div class="stat-value">{{ $pesananPending }}</div>
            <div class="stat-label">Pesanan Pending</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card">
            <div class="stat-icon"><i class="bi bi-box-seam"></i></div>
            <div class="stat-value">{{ $totalBarang }}</div>
            <div class="stat-label">Total Produk</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card">
            <div class="stat-icon"><i class="bi bi-currency-dollar"></i></div>
            <div class="stat-value">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</div>
            <div class="stat-label">Total Revenue</div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="admin-table">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>No Pesanan</th>
                        <th>Pelanggan</th>
                        <th>Status</th>
                        <th>Total</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php $pesanan = \App\Models\Pesanan::with('user')->latest()->take(5)->get(); @endphp
                    @forelse($pesanan as $i => $p)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>
                                <span style="font-weight: 600;">ORD-{{ \Carbon\Carbon::parse($p->created_at)->format('Ymd') }}-{{ str_pad($p->id, 4, '0', STR_PAD_LEFT) }}</span>
                            </td>
                            <td>{{ $p->user->username }}</td>
                            <td>
                                <span class="badge-status badge-{{ $p->status }}">{{ ucfirst($p->status) }}</span>
                            </td>
                            <td>Rp {{ number_format($p->total, 0, ',', '.') }}</td>
                            <td>{{ \Carbon\Carbon::parse($p->created_at)->locale('id')->translatedFormat('d M Y') }}</td>
                            <td>
                                <a href="{{ route('admin.pesanan.show', $p->id) }}" class="btn btn-sm" style="background: var(--secondary); color: var(--text-dark); border-radius: 6px; font-size: 12px; font-weight: 600;">
                                    <i class="bi bi-eye"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="text-center py-4 text-muted">Belum ada pesanan.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection