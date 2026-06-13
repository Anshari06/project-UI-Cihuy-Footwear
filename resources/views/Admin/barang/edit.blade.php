@extends('admin.layouts.app')

@section('admin-title', 'Edit Produk')

@section('admin-content')
<a href="{{ route('admin.barang.index') }}" class="btn mb-3" style="background: #efece5; color: #2b2b2b; border-radius: 8px; font-size: 13px; font-weight: 600;">
    <i class="bi bi-arrow-left me-1"></i> Kembali
</a>

<div class="admin-table p-4">
    <form action="{{ route('admin.barang.update', $barang->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row g-4">
            <div class="col-md-6">
                <label class="form-label" style="font-size: 13px; font-weight: 600; color: #2b2b2b;">Nama Produk</label>
                <input type="text" name="name" value="{{ $barang->name }}" class="form-control" required style="border: 1.5px solid #e6e0da; border-radius: 8px; padding: 10px 14px; font-size: 14px;">
            </div>
            <div class="col-md-6">
                <label class="form-label" style="font-size: 13px; font-weight: 600; color: #2b2b2b;">Brand</label>
                <input type="text" name="brand" value="{{ $barang->brand }}" class="form-control" required style="border: 1.5px solid #e6e0da; border-radius: 8px; padding: 10px 14px; font-size: 14px;">
            </div>
            <div class="col-md-4">
                <label class="form-label" style="font-size: 13px; font-weight: 600; color: #2b2b2b;">Harga (Rp)</label>
                <input type="number" name="price" value="{{ $barang->price }}" class="form-control" required min="0" style="border: 1.5px solid #e6e0da; border-radius: 8px; padding: 10px 14px; font-size: 14px;">
            </div>
            <div class="col-md-4">
                <label class="form-label" style="font-size: 13px; font-weight: 600; color: #2b2b2b;">Type</label>
                <select name="type" class="form-select" style="border: 1.5px solid #e6e0da; border-radius: 8px; padding: 10px 14px; font-size: 14px;">
                    @foreach(['sneakers','olahraga','formal','boots','casual'] as $t)
                        <option value="{{ $t }}" {{ $barang->type === $t ? 'selected' : '' }}>{{ ucfirst($t) }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label" style="font-size: 13px; font-weight: 600; color: #2b2b2b;">Gender</label>
                <select name="gender" class="form-select" style="border: 1.5px solid #e6e0da; border-radius: 8px; padding: 10px 14px; font-size: 14px;">
                    @foreach(['pria','wanita','anak','unisex'] as $g)
                        <option value="{{ $g }}" {{ $barang->gender === $g ? 'selected' : '' }}>{{ ucfirst($g) }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label" style="font-size: 13px; font-weight: 600; color: #2b2b2b;">Badge</label>
                <select name="badge" class="form-select" style="border: 1.5px solid #e6e0da; border-radius: 8px; padding: 10px 14px; font-size: 14px;">
                    <option value="">Tidak Ada</option>
                    <option value="Best Seller" {{ $barang->badge === 'Best Seller' ? 'selected' : '' }}>Best Seller</option>
                    <option value="New Arrival" {{ $barang->badge === 'New Arrival' ? 'selected' : '' }}>New Arrival</option>
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label" style="font-size: 13px; font-weight: 600; color: #2b2b2b;">Nama File Gambar</label>
                <input type="text" name="image" value="{{ $barang->image }}" class="form-control" style="border: 1.5px solid #e6e0da; border-radius: 8px; padding: 10px 14px; font-size: 14px;">
                <small style="color: #7a746f; font-size: 11px;">Simpan gambar di public/images/cihuy/</small>
            </div>
            <div class="col-12">
                <label class="form-label" style="font-size: 13px; font-weight: 600; color: #2b2b2b;">Deskripsi</label>
                <textarea name="description" class="form-control" rows="3" style="border: 1.5px solid #e6e0da; border-radius: 8px; padding: 10px 14px; font-size: 14px; resize: none;">{{ $barang->description }}</textarea>
            </div>
        </div>
        <div class="mt-4">
            <button type="submit" class="btn" style="background: #545350; color: #fff; border-radius: 8px; padding: 10px 28px; font-weight: 600; font-size: 14px;">
                <i class="bi bi-check-lg me-1"></i> Update Produk
            </button>
        </div>
    </form>
</div>
@endsection