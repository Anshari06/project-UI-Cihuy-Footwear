@extends('admin.layouts.app')

@section('admin-title', 'Tambah Produk')

@section('admin-content')
<a href="{{ route('admin.barang.index') }}" class="btn mb-3" style="background: #efece5; color: #2b2b2b; border-radius: 8px; font-size: 13px; font-weight: 600;">
    <i class="bi bi-arrow-left me-1"></i> Kembali
</a>

<div class="admin-table p-4">
    <form action="{{ route('admin.barang.store') }}" method="POST">
        @csrf
        <div class="row g-4">
            <div class="col-md-6">
                <label class="form-label" style="font-size: 13px; font-weight: 600; color: #2b2b2b;">Nama Produk</label>
                <input type="text" name="name" class="form-control" placeholder="Nama produk" required style="border: 1.5px solid #e6e0da; border-radius: 8px; padding: 10px 14px; font-size: 14px;">
            </div>
            <div class="col-md-6">
                <label class="form-label" style="font-size: 13px; font-weight: 600; color: #2b2b2b;">Brand</label>
                <input type="text" name="brand" class="form-control" placeholder="Nama brand" required style="border: 1.5px solid #e6e0da; border-radius: 8px; padding: 10px 14px; font-size: 14px;">
            </div>
            <div class="col-md-4">
                <label class="form-label" style="font-size: 13px; font-weight: 600; color: #2b2b2b;">Harga (Rp)</label>
                <input type="number" name="price" class="form-control" placeholder="150000" required min="0" style="border: 1.5px solid #e6e0da; border-radius: 8px; padding: 10px 14px; font-size: 14px;">
            </div>
            <div class="col-md-4">
                <label class="form-label" style="font-size: 13px; font-weight: 600; color: #2b2b2b;">Type</label>
                <select name="type" class="form-select" required style="border: 1.5px solid #e6e0da; border-radius: 8px; padding: 10px 14px; font-size: 14px;">
                    <option value="sneakers">Sneakers</option>
                    <option value="olahraga">Olahraga</option>
                    <option value="formal">Formal</option>
                    <option value="boots">Boots</option>
                    <option value="casual">Casual</option>
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label" style="font-size: 13px; font-weight: 600; color: #2b2b2b;">Gender</label>
                <select name="gender" class="form-select" required style="border: 1.5px solid #e6e0da; border-radius: 8px; padding: 10px 14px; font-size: 14px;">
                    <option value="pria">Pria</option>
                    <option value="wanita">Wanita</option>
                    <option value="anak">Anak-anak</option>
                    <option value="unisex">Unisex</option>
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label" style="font-size: 13px; font-weight: 600; color: #2b2b2b;">Badge</label>
                <select name="badge" class="form-select" style="border: 1.5px solid #e6e0da; border-radius: 8px; padding: 10px 14px; font-size: 14px;">
                    <option value="">Tidak Ada</option>
                    <option value="Best Seller">Best Seller</option>
                    <option value="New Arrival">New Arrival</option>
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label" style="font-size: 13px; font-weight: 600; color: #2b2b2b;">Nama File Gambar</label>
                <input type="text" name="image" class="form-control" placeholder="contoh: nike_airforce1.png" style="border: 1.5px solid #e6e0da; border-radius: 8px; padding: 10px 14px; font-size: 14px;">
                <small style="color: #7a746f; font-size: 11px;">Simpan gambar di public/images/cihuy/</small>
            </div>
            <div class="col-12">
                <label class="form-label" style="font-size: 13px; font-weight: 600; color: #2b2b2b;">Deskripsi</label>
                <textarea name="description" class="form-control" rows="3" placeholder="Deskripsi produk..." style="border: 1.5px solid #e6e0da; border-radius: 8px; padding: 10px 14px; font-size: 14px; resize: none;"></textarea>
            </div>
        </div>
        <div class="mt-4">
            <button type="submit" class="btn" style="background: #545350; color: #fff; border-radius: 8px; padding: 10px 28px; font-weight: 600; font-size: 14px;">
                <i class="bi bi-check-lg me-1"></i> Simpan Produk
            </button>
        </div>
    </form>
</div>
@endsection