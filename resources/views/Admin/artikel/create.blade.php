@extends('admin.layouts.app')

@section('admin-title', 'Tambah Artikel')

@section('admin-content')
<a href="{{ route('admin.artikel.index') }}" class="btn mb-3" style="background: #efece5; color: #2b2b2b; border-radius: 8px; font-size: 13px; font-weight: 600;">
    <i class="bi bi-arrow-left me-1"></i> Kembali
</a>

<div class="admin-table p-4">
    <form action="{{ route('admin.artikel.store') }}" method="POST">
        @csrf
        <div class="row g-4">
            <div class="col-12">
                <label class="form-label" style="font-size: 13px; font-weight: 600; color: #2b2b2b;">Judul Artikel</label>
                <input type="text" name="title" class="form-control" placeholder="Judul artikel" required style="border: 1.5px solid #e6e0da; border-radius: 8px; padding: 10px 14px; font-size: 14px;">
            </div>
            <div class="col-md-6">
                <label class="form-label" style="font-size: 13px; font-weight: 600; color: #2b2b2b;">Author</label>
                <input type="text" name="author" class="form-control" placeholder="Nama author" style="border: 1.5px solid #e6e0da; border-radius: 8px; padding: 10px 14px; font-size: 14px;">
            </div>
            <div class="col-md-6">
                <label class="form-label" style="font-size: 13px; font-weight: 600; color: #2b2b2b;">Kategori</label>
                <select name="category" class="form-select" style="border: 1.5px solid #e6e0da; border-radius: 8px; padding: 10px 14px; font-size: 14px;">
                    <option value="all">Terbaru</option>
                    <option value="trending">Trending</option>
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label" style="font-size: 13px; font-weight: 600; color: #2b2b2b;">URL Gambar</label>
                <input type="text" name="image" class="form-control" placeholder="https://images.unsplash.com/..." style="border: 1.5px solid #e6e0da; border-radius: 8px; padding: 10px 14px; font-size: 14px;">
            </div>
            <div class="col-12">
                <label class="form-label" style="font-size: 13px; font-weight: 600; color: #2b2b2b;">Konten</label>
                <textarea name="content" class="form-control" rows="8" placeholder="Isi artikel..." required style="border: 1.5px solid #e6e0da; border-radius: 8px; padding: 10px 14px; font-size: 14px; resize: vertical;"></textarea>
            </div>
        </div>
        <div class="mt-4">
            <button type="submit" class="btn" style="background: #545350; color: #fff; border-radius: 8px; padding: 10px 28px; font-weight: 600; font-size: 14px;">
                <i class="bi bi-check-lg me-1"></i> Simpan Artikel
            </button>
        </div>
    </form>
</div>
@endsection
