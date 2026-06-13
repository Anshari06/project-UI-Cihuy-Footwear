@extends('admin.layouts.app')

@section('admin-title', 'Kelola Pengguna')

@section('admin-content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="mb-0" style="color: var(--text-dark);">Pengguna ({{ $pengguna->count() }})</h5>
    <a href="{{ route('admin.pengguna.create') }}" class="btn" style="background: var(--accent); color: #fff; border-radius: 8px; padding: 8px 20px; font-size: 13px; font-weight: 600;">
        <i class="bi bi-plus-lg me-1"></i> Tambah Pengguna
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success" style="border-radius: 8px; font-size: 14px;">{{ session('success') }}</div>
@endif
@if(session('error'))
    <div class="alert alert-danger" style="border-radius: 8px; font-size: 14px;">{{ session('error') }}</div>
@endif

<div class="admin-table">
    <table class="table mb-0">
        <thead>
            <tr>
                <th style="width: 60px;">No</th>
                <th>Username</th>
                <th>Email</th>
                <th>Role</th>
                <th>Terdaftar</th>
                <th style="width: 140px;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pengguna as $i => $u)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td style="font-weight: 600; color: #2b2b2b;">{{ $u->username }}</td>
                    <td style="color: #7a746f; font-size: 13px;">{{ $u->email }}</td>
                    <td>
                        <span class="badge {{ $u->role === 'admin' ? 'badge-admin' : 'badge-pelanggan' }}">
                            {{ $u->role === 'admin' ? 'Admin' : 'Pelanggan' }}
                        </span>
                    </td>
                    <td style="color: #7a746f; font-size: 13px;">{{ $u->created_at->format('d M Y') }}</td>
                    <td>
                        <a href="{{ route('admin.pengguna.edit', $u->id) }}" class="btn btn-sm" style="background: #efece5; color: #2b2b2b; border-radius: 6px; font-size: 12px; font-weight: 600; margin-right: 4px;">
                            <i class="bi bi-pencil"></i>
                        </a>
                        @if(auth()->user()->id !== $u->id)
                            <form action="{{ route('admin.pengguna.destroy', $u->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus pengguna ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm" style="background: #f8d7da; color: #721c24; border-radius: 6px; font-size: 12px; font-weight: 600;">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        @else
                            <button type="button" class="btn btn-sm" style="background: #f0f0f0; color: #aaa; border-radius: 6px; font-size: 12px; font-weight: 600;" disabled title="Tidak bisa hapus akun sendiri">
                                <i class="bi bi-trash"></i>
                            </button>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center py-5 text-muted">Belum ada pengguna. <a href="{{ route('admin.pengguna.create') }}">Tambah pengguna pertama</a></td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
