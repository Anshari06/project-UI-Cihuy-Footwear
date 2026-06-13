@extends('admin.layouts.app')

@section('admin-title', 'Arsip Artikel')

@section('admin-content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="mb-0" style="color: var(--text-dark);">Arsip Artikel ({{ $arsip->count() }})</h5>
    <a href="{{ route('admin.artikel.index') }}" class="btn" style="background: #efece5; color: #2b2b2b; border-radius: 8px; padding: 8px 20px; font-size: 13px; font-weight: 600;">
        <i class="bi bi-arrow-left me-1"></i> Kembali ke Artikel
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success" style="border-radius: 8px; font-size: 14px;">{{ session('success') }}</div>
@endif

<div class="admin-table">
    <table class="table mb-0">
        <thead>
            <tr>
                <th style="width: 60px;">No</th>
                <th style="width: 80px;">Gambar</th>
                <th>Judul</th>
                <th>Author</th>
                <th>Kategori</th>
                <th>Dihapus Pada</th>
                <th style="width: 160px;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($arsip as $i => $a)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>
                        <div style="width: 56px; height: 56px; background: #faf9f7; border-radius: 8px; display: flex; align-items: center; justify-content: center; border: 1px solid #e6e0da; overflow: hidden;">
                            @if($a->image)
                                <img src="{{ $a->image }}" alt="{{ $a->title }}" style="max-width: 90%; max-height: 90%; object-fit: cover; opacity: 0.5;">
                            @else
                                <i class="bi bi-image" style="color: #ccc; font-size: 20px;"></i>
                            @endif
                        </div>
                    </td>
                    <td style="font-weight: 600; color: #2b2b2b; opacity: 0.7;">{{ $a->title }}</td>
                    <td style="color: #7a746f; font-size: 13px; opacity: 0.7;">{{ $a->author ?? '-' }}</td>
                    <td>
                        @if($a->category === 'trending')
                            <span class="badge" style="background: #2b2b2b; color: #fff; font-size: 11px;">Trending</span>
                        @else
                            <span class="badge" style="background: #efece5; color: #545350; font-size: 11px;">Terbaru</span>
                        @endif
                    </td>
                    <td style="color: #7a746f; font-size: 13px;">{{ $a->deleted_at->format('d M Y') }}</td>
                    <td>
                        <form action="{{ route('admin.artikel.restore', $a->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-sm" style="background: #d4edda; color: #155724; border-radius: 6px; font-size: 12px; font-weight: 600; margin-right: 4px;" onclick="return confirm('Kembalikan artikel ini?');">
                                <i class="bi bi-arrow-counterclockwise"></i>
                            </button>
                        </form>
                        <form action="{{ route('admin.artikel.forceDelete', $a->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus permanen? Tindakan ini tidak bisa dibatalkan.');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm" style="background: #f8d7da; color: #721c24; border-radius: 6px; font-size: 12px; font-weight: 600;">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center py-5 text-muted">Arsip kosong.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection