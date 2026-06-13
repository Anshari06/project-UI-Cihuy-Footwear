@extends('admin.layouts.app')

@section('admin-title', 'Pesanan')

@section('admin-content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="mb-0" style="color: var(--text-dark);">Pesanan ({{ $pesanan->count() }})</h5>
</div>

<div class="admin-table">
    <table class="table mb-0">
        <thead>
            <tr>
                <th>No</th>
                <th>No Pesanan</th>
                <th>Pelanggan</th>
                <th>Items</th>
                <th>Status</th>
                <th>Total</th>
                <th>Tanggal</th>
                <th style="width: 160px;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pesanan as $i => $p)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td style="font-weight: 700; font-size: 13px;">
                        ORD-{{ \Carbon\Carbon::parse($p->created_at)->format('Ymd') }}-{{ str_pad($p->id, 4, '0', STR_PAD_LEFT) }}
                    </td>
                    <td>
                        <div style="font-weight: 600;">{{ $p->nama_depan }} {{ $p->nama_belakang }}</div>
                        <div style="font-size: 12px; color: #7a746f;">{{ $p->email }}</div>
                    </td>
                    <td>{{ $p->details->count() }} produk</td>
                    <td>
                        <span class="badge-status badge-{{ $p->status }}">{{ ucfirst($p->status) }}</span>
                    </td>
                    <td style="font-weight: 700;">Rp {{ number_format($p->total, 0, ',', '.') }}</td>
                    <td style="font-size: 12px; color: #7a746f;">
                        {{ \Carbon\Carbon::parse($p->created_at)->locale('id')->translatedFormat('d M Y, H:i') }} WIB
                    </td>
                    <td>
                        <a href="{{ route('admin.pesanan.show', $p->id) }}" class="btn btn-sm" style="background: var(--secondary); color: var(--text-dark); border-radius: 6px; font-size: 12px; font-weight: 600; margin-right: 4px;">
                            <i class="bi bi-eye"></i>
                        </a>
                        <form action="{{ route('admin.pesanan.status', $p->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PUT')
                            <select name="status" onchange="this.form.submit()" class="form-select form-select-sm" style="font-size: 12px; border-radius: 6px; display: inline-block; width: auto;">
                                <option value="pending" {{ $p->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="confirmed" {{ $p->status === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                <option value="shipped" {{ $p->status === 'shipped' ? 'selected' : '' }}>Shipped</option>
                                <option value="completed" {{ $p->status === 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="cancelled" {{ $p->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="8" class="text-center py-5 text-muted">Belum ada pesanan.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection