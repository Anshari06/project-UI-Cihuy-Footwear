@extends('admin.layouts.app')

@section('admin-title', 'Produk')

@section('admin-content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="mb-0" style="color: var(--text-dark);">Produk ({{ $barang->count() }})</h5>
    <a href="{{ route('admin.barang.create') }}" class="btn" style="background: var(--accent); color: #fff; border-radius: 8px; padding: 8px 20px; font-size: 13px; font-weight: 600;">
        <i class="bi bi-plus-lg me-1"></i> Tambah Produk
    </a>
</div>

<div class="admin-table">
    <table class="table mb-0">
        <thead>
            <tr>
                <th style="width: 60px;">No</th>
                <th style="width: 80px;">Gambar</th>
                <th>Nama</th>
                <th>Brand</th>
                <th>Harga</th>
                <th>Type</th>
                <th>Gender</th>
                <th>Badge</th>
                <th style="width: 140px;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($barang as $i => $b)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>
                        <div style="width: 56px; height: 56px; background: #faf9f7; border-radius: 8px; display: flex; align-items: center; justify-content: center; border: 1px solid #e6e0da;">
                            <img src="{{ asset('images/cihuy/' . $b->image) }}" alt="{{ $b->name }}" style="max-width: 90%; max-height: 90%; object-fit: contain;">
                        </div>
                    </td>
                    <td style="font-weight: 600; color: #2b2b2b;">{{ $b->name }}</td>
                    <td>{{ $b->brand }}</td>
                    <td style="font-weight: 700;">Rp {{ number_format($b->price, 0, ',', '.') }}</td>
                    <td><span class="badge" style="background: #efece5; color: #545350; font-weight: 600; font-size: 12px;">{{ ucfirst($b->type) }}</span></td>
                    <td style="color: #7a746f; font-size: 13px;">{{ ucfirst($b->gender) }}</td>
                    <td>
                        @if($b->badge)
                            <span class="badge" style="background: {{ $b->badge === 'Best Seller' ? '#2b2b2b' : '#27ae60' }}; color: #fff; font-size: 11px;">{{ $b->badge }}</span>
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.barang.edit', $b->id) }}" class="btn btn-sm" style="background: #efece5; color: #2b2b2b; border-radius: 6px; font-size: 12px; font-weight: 600; margin-right: 4px;">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form action="{{ route('admin.barang.destroy', $b->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus produk ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm" style="background: #f8d7da; color: #721c24; border-radius: 6px; font-size: 12px; font-weight: 600;">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="9" class="text-center py-5 text-muted">Belum ada produk. <a href="{{ route('admin.barang.create') }}">Tambah produk pertama</a></td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
