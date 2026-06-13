<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Cihuy Footwear</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/cihuy/cihuylogo.svg') }}">
    <style>
        :root { --primary: #faf9f7; --secondary: #efece5; --accent: #545350; --text-dark: #2b2b2b; --text-muted: #7a746f; --border: #e6e0da; }
        * { box-sizing: border-box; font-family: 'Poppins', sans-serif; }
        body { background: var(--primary); color: var(--text-dark); margin: 0; }
        a { text-decoration: none; }
        .admin-sidebar { width: 240px; min-height: 100vh; background: #fff; border-right: 1px solid var(--border); position: fixed; top: 0; left: 0; padding: 24px 0; display: flex; flex-direction: column; }
        .sidebar-brand { padding: 0 24px 24px; border-bottom: 1px solid var(--border); margin-bottom: 16px; }
        .sidebar-brand img { height: 36px; }
        .sidebar-nav a { display: flex; align-items: center; gap: 10px; padding: 12px 24px; color: var(--text-muted); font-size: 14px; font-weight: 500; transition: all 0.2s; }
        .sidebar-nav a:hover, .sidebar-nav a.active { background: var(--secondary); color: var(--text-dark); }
        .sidebar-nav a i { font-size: 18px; }
        .admin-main { margin-left: 240px; min-height: 100vh; }
        .admin-topbar { background: #fff; border-bottom: 1px solid var(--border); padding: 16px 32px; display: flex; align-items: center; justify-content: space-between; }
        .admin-content { padding: 32px; }
        .stat-card { background: #fff; border: 1px solid var(--border); border-radius: 12px; padding: 24px; }
        .stat-card .stat-icon { font-size: 32px; color: var(--accent); margin-bottom: 12px; }
        .stat-card .stat-value { font-size: 28px; font-weight: 800; color: var(--text-dark); }
        .stat-card .stat-label { font-size: 13px; color: var(--text-muted); margin-top: 4px; }
        .admin-table { background: #fff; border: 1px solid var(--border); border-radius: 12px; overflow: hidden; }
        .admin-table th { background: var(--secondary); padding: 14px 16px; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px; font-weight: 700; color: var(--text-dark); }
        .admin-table td { padding: 14px 16px; font-size: 14px; vertical-align: middle; }
        .admin-table tr:hover td { background: #faf9f7; }
        .badge-status { display: inline-block; padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 600; }
        .badge-pending { background: #fff3cd; color: #856404; }
        .badge-confirmed { background: #d1ecf1; color: #0c5460; }
        .badge-shipped { background: #d4edda; color: #155724; }
        .badge-completed { background: #e8f5e9; color: #2e7d32; }
        .badge-cancelled { background: #f8d7da; color: #721c24; }
        .badge-admin { background: var(--accent); color: #fff; }
        .badge-pelanggan { background: var(--secondary); color: var(--text-dark); }
    </style>
</head>
<body>
<div class="d-flex">
    <!-- Sidebar -->
    <aside class="admin-sidebar">
        <div class="sidebar-brand">
            <a href="{{ route('landing') }}" class="d-flex align-items-center gap-2">
                <img src="/images/cihuy/cihuylogo.svg" alt="Logo">
                <span style="font-size: 13px; font-weight: 700; color: var(--text-dark);">ADMIN</span>
            </a>
        </div>
        <nav class="sidebar-nav flex-grow-1">
            <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="bi bi-grid"></i> Dashboard
            </a>
            <a href="{{ route('admin.barang.index') }}" class="{{ request()->routeIs('admin.barang.*') ? 'active' : '' }}">
                <i class="bi bi-box-seam"></i> Produk
            </a>
            <a href="{{ route('admin.artikel.index') }}" class="{{ request()->routeIs('admin.artikel.index') || request()->routeIs('admin.artikel.create') || request()->routeIs('admin.artikel.edit') ? 'active' : '' }}">
                <i class="bi bi-newspaper"></i> Artikel
            </a>
            <a href="{{ route('admin.artikel.arsip') }}" class="{{ request()->routeIs('admin.artikel.arsip') ? 'active' : '' }}">
                <i class="bi bi-archive"></i> Arsip Artikel
            </a>
            <a href="{{ route('admin.pesanan.index') }}" class="{{ request()->routeIs('admin.pesanan.*') ? 'active' : '' }}">
                <i class="bi bi-receipt"></i> Pesanan
            </a>
            <a href="{{ route('admin.pengguna.index') }}" class="{{ request()->routeIs('admin.pengguna.*') ? 'active' : '' }}">
                <i class="bi bi-people"></i> Kelola Pengguna
            </a>
        </nav>
        <nav class="sidebar-nav border-top pt-3 mt-3">
            <a href="#" onclick="document.getElementById('logout-form').submit()">
                <i class="bi bi-box-arrow-right"></i> Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">@csrf</form>
        </nav>
    </aside>

    <!-- Main -->
    <div class="admin-main flex-grow-1">
        <div class="admin-topbar">
            <h5 class="mb-0 fw-bold" style="color: var(--text-dark);">@yield('admin-title')</h5>
            <div class="d-flex align-items-center gap-2">
                <i class="bi bi-person-circle" style="font-size: 20px; color: var(--text-muted;"></i>
                <span style="font-size: 13px; color: var(--text-muted);">{{ auth()->user()->username }}</span>
            </div>
        </div>
        <div class="admin-content">
            @yield('admin-content')
        </div>
    </div>
</div>
</body>
</html>