@extends('admin.layouts.app')

@section('admin-title', 'Artikel')

@section('admin-content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="mb-0" style="color: var(--text-dark);">Artikel ({{ $artikel->count() }})</h5>
    <div class="d-flex gap-2">
        <a href="{{ route('admin.artikel.arsip') }}" class="btn" style="background: #efece5; color: #2b2b2b; border-radius: 8px; padding: 8px 20px; font-size: 13px; font-weight: 600;">
            <i class="bi bi-archive me-1"></i> Arsip
        </a>
        <a href="{{ route('admin.artikel.create') }}" class="btn" style="background: var(--accent); color: #fff; border-radius: 8px; padding: 8px 20px; font-size: 13px; font-weight: 600;">
            <i class="bi bi-plus-lg me-1"></i> Tambah Artikel
        </a>
    </div>
</div>

<div class="admin-table">
    <table class="table mb-0">
        <thead>
            <tr>
                <th style="width: 60px;">No</th>
                <th style="width: 80px;">Gambar</th>
                <th>Judul</th>
                <th>Author</th>
                <th>Kategori</th>
                <th>Tanggal</th>
                <th style="width: 140px;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($artikel as $i => $a)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>
                        <div style="width: 56px; height: 56px; background: #faf9f7; border-radius: 8px; display: flex; align-items: center; justify-content: center; border: 1px solid #e6e0da; overflow: hidden;">
                            @if($a->image)
                                <img src="{{ $a->image }}" alt="{{ $a->title }}" style="max-width: 90%; max-height: 90%; object-fit: cover;">
                            @else
                                <i class="bi bi-image" style="color: #ccc; font-size: 20px;"></i>
                            @endif
                        </div>
                    </td>
                    <td style="font-weight: 600; color: #2b2b2b;">{{ $a->title }}</td>
                    <td style="color: #7a746f; font-size: 13px;">{{ $a->author ?? '-' }}</td>
                    <td>
                        @if($a->category === 'trending')
                            <span class="badge" style="background: #2b2b2b; color: #fff; font-size: 11px;">Trending</span>
                        @else
                            <span class="badge" style="background: #efece5; color: #545350; font-size: 11px;">Terbaru</span>
                        @endif
                    </td>
                    <td style="color: #7a746f; font-size: 13px;">{{ $a->published_at ? $a->published_at->format('d M Y') : '-' }}</td>
                    <td>
                        <a href="{{ route('admin.artikel.edit', $a->id) }}" class="btn btn-sm" style="background: #efece5; color: #2b2b2b; border-radius: 6px; font-size: 12px; font-weight: 600; margin-right: 4px;">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form action="{{ route('admin.artikel.destroy', $a->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus artikel ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm" style="background: #f8d7da; color: #721c24; border-radius: 6px; font-size: 12px; font-weight: 600;">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="7" class="text-center py-5 text-muted">Belum ada artikel. <a href="{{ route('admin.artikel.create') }}">Tambah artikel pertama</a></td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
