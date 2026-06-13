@extends('admin.layouts.app')

@section('admin-title', 'Edit Pengguna')

@section('admin-content')
<a href="{{ route('admin.pengguna.index') }}" class="btn mb-3" style="background: #efece5; color: #2b2b2b; border-radius: 8px; font-size: 13px; font-weight: 600;">
    <i class="bi bi-arrow-left me-1"></i> Kembali
</a>

<div class="admin-table p-4">
    @if($errors->any())
        <div class="alert alert-danger mb-3" style="border-radius: 8px; font-size: 14px;">
            <ul class="mb-0 ps-3">
                @foreach($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.pengguna.update', $pengguna->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row g-4">
            <div class="col-md-6">
                <label class="form-label" style="font-size: 13px; font-weight: 600; color: #2b2b2b;">Username</label>
                <input type="text" name="username" class="form-control" placeholder="Nama pengguna" required value="{{ old('username', $pengguna->username) }}"
                    style="border: 1.5px solid #e6e0da; border-radius: 8px; padding: 10px 14px; font-size: 14px;">
            </div>
            <div class="col-md-6">
                <label class="form-label" style="font-size: 13px; font-weight: 600; color: #2b2b2b;">Email</label>
                <input type="email" name="email" class="form-control" placeholder="email@example.com" required value="{{ old('email', $pengguna->email) }}"
                    style="border: 1.5px solid #e6e0da; border-radius: 8px; padding: 10px 14px; font-size: 14px;">
            </div>
            <div class="col-md-6">
                <label class="form-label" style="font-size: 13px; font-weight: 600; color: #2b2b2b;">Password <span style="font-weight: 400; color: #7a746f;">(kosongkan bila tidak ganti)</span></label>
                <input type="password" name="password" class="form-control" placeholder="Min. 6 karakter"
                    style="border: 1.5px solid #e6e0da; border-radius: 8px; padding: 10px 14px; font-size: 14px;">
            </div>
            <div class="col-md-6">
                <label class="form-label" style="font-size: 13px; font-weight: 600; color: #2b2b2b;">Role</label>
                <select name="role" class="form-select" required style="border: 1.5px solid #e6e0da; border-radius: 8px; padding: 10px 14px; font-size: 14px;">
                    <option value="pelanggan" {{ $pengguna->role === 'pelanggan' ? 'selected' : '' }}>Pelanggan</option>
                    <option value="admin" {{ $pengguna->role === 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
            </div>
        </div>
        <div class="mt-4">
            <button type="submit" class="btn" style="background: #545350; color: #fff; border-radius: 8px; padding: 10px 28px; font-weight: 600; font-size: 14px;">
                <i class="bi bi-check-lg me-1"></i> Update Pengguna
            </button>
        </div>
    </form>
</div>
@endsection