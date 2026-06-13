<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Cihuy Footwear' }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="/css/landing.css" rel="stylesheet">
    <link href="/css/dashboard.css" rel="stylesheet">
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/cihuy/cihuylogo.svg') }}">
    <style>body { font-family: 'Poppins', sans-serif; }

        /* Toast */
        .toast-container {
            position: fixed; top: 24px; right: 24px; z-index: 9999;
            display: flex; flex-direction: column; gap: 10px; pointer-events: none;
        }
        .toast {
            display: flex; align-items: center; gap: 12px; padding: 14px 20px;
            border-radius: 12px; box-shadow: 0 8px 30px rgba(0,0,0,0.12);
            min-width: 300px; max-width: 400px; pointer-events: auto;
            animation: toastIn 0.4s cubic-bezier(0.34, 1.56, 0.64, 1) forwards;
            font-size: 14px; font-weight: 500;
        }
        .toast.hiding { animation: toastOut 0.3s ease forwards; }
        .toast.success { background: #fff; border-left: 4px solid #27ae60; color: #2b2b2b; }
        .toast.success .toast-icon { color: #27ae60; }
        .toast.error { background: #fff; border-left: 4px solid #e74c3c; color: #2b2b2b; }
        .toast.error .toast-icon { color: #e74c3c; }
        .toast.info { background: #fff; border-left: 4px solid #545350; color: #2b2b2b; }
        .toast.info .toast-icon { color: #545350; }
        .toast.warning { background: #fff; border-left: 4px solid #f59e0b; color: #2b2b2b; }
        .toast.warning .toast-icon { color: #f59e0b; }
        .toast-icon { font-size: 20px; flex-shrink: 0; }
        .toast-message { flex: 1; line-height: 1.4; }
        .toast-close { background: none; border: none; font-size: 16px; color: #7a746f; cursor: pointer; padding: 0; flex-shrink: 0; }
        .toast-close:hover { color: #2b2b2b; }
        .toast-progress { position: absolute; bottom: 0; left: 0; height: 3px; border-radius: 0 0 12px 12px; animation: toastProgress 3s linear forwards; }
        .toast.success .toast-progress { background: #27ae60; }
        .toast.error .toast-progress { background: #e74c3c; }
        .toast.info .toast-progress { background: #545350; }
        .toast.warning .toast-progress { background: #f59e0b; }
        @keyframes toastIn {
            from { opacity: 0; transform: translateX(100px) scale(0.8); }
            to { opacity: 1; transform: translateX(0) scale(1); }
        }
        @keyframes toastOut {
            from { opacity: 1; transform: translateX(0) scale(1); }
            to { opacity: 0; transform: translateX(100px) scale(0.8); }
        }
        @keyframes toastProgress {
            from { width: 100%; } to { width: 0%; }
        }
    </style>
</head>
<body>

<!-- Header -->
<x-header />

<!-- Toast Container -->
<div class="toast-container" id="toastContainer"></div>

<!-- Sidebar Overlay -->
<div class="sidebar-overlay" id="sidebarOverlay" onclick="closeSidebar()"></div>

<!-- Main Container -->
<div class="main-container">

    <!-- Content -->
    <main class="content">
        @yield('content')
    </main>
</div>

<!-- Quick View Modal -->
<div class="modal-overlay" id="modalOverlay" onclick="closeModal(event)">
    <button class="modal-close" onclick="closeModal(event)"><i class="bi bi-x-lg"></i></button>
    <div class="modal-content" onclick="event.stopPropagation()">
        <div class="modal-image">
            <img src="" alt="" id="modalImage">
        </div>
        <div class="modal-info">
            <div class="modal-price" id="modalPrice"></div>
            <div class="modal-name" id="modalName"></div>
            <div class="modal-desc" id="modalDesc"></div>
            <button class="add-to-cart-btn" onclick="addToCart()">
                <i class="bi bi-cart3"></i> Tambah ke Keranjang
            </button>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function openSidebar() {
        document.getElementById('sidebar').classList.add('active');
        document.getElementById('sidebarOverlay').classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function closeSidebar() {
        document.getElementById('sidebar').classList.remove('active');
        document.getElementById('sidebarOverlay').classList.remove('active');
        document.body.style.overflow = '';
    }

    function toggleMobileMenu() { openSidebar(); }

    function openModal(index) {
        const p = products[index];
        document.getElementById('modalImage').src = document.querySelectorAll('.product-card img')[index].src;
        document.getElementById('modalImage').alt = p.name;
        document.getElementById('modalPrice').textContent = 'Rp ' + Number(p.price).toLocaleString('id-ID');
        document.getElementById('modalName').textContent = p.name;
        document.getElementById('modalDesc').textContent = p.description;
        document.getElementById('modalOverlay').classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function closeModal(e) {
        if (!e.target || e.target === document.getElementById('modalOverlay') || e.target.classList.contains('modal-close')) {
            document.getElementById('modalOverlay').classList.remove('active');
            document.body.style.overflow = '';
        }
    }

    function addToCart() {
        const name = document.getElementById('modalName').textContent;
        var toastContainer = document.getElementById('toastContainer');
        if (toastContainer) {
            var toast = document.createElement('div');
            toast.className = 'toast success';
            toast.innerHTML = '<i class="bi toast-icon bi-check-circle-fill"></i><span class="toast-message">' + name + ' telah ditambahkan ke keranjang!</span><button class="toast-close" onclick="this.parentElement.remove()"><i class="bi bi-x"></i></button><div class="toast-progress"></div>';
            toastContainer.appendChild(toast);
            setTimeout(function() {
                toast.classList.add('hiding');
                setTimeout(function() { if (toast.parentElement) toast.remove(); }, 300);
            }, 3000);
        }
        closeModal({ target: document.getElementById('modalOverlay') });
    }

    function applyFilters() {
        const search = document.getElementById('searchInput').value.toLowerCase();
        const filters = {};
        document.querySelectorAll('input[type="radio"]:checked').forEach(r => filters[r.name] = r.value);

        document.querySelectorAll('.product-card').forEach((card, i) => {
            const p = products[i];
            const matchSearch = p.name.toLowerCase().includes(search) || p.brand.toLowerCase().includes(search);
            let matchFilter = true;
            for (const [k, v] of Object.entries(filters)) {
                if (p[k].toLowerCase() !== v.toLowerCase()) { matchFilter = false; break; }
            }
            card.style.display = (matchSearch && matchFilter) ? '' : 'none';
        });
    }

    document.getElementById('searchInput').addEventListener('input', applyFilters);

    document.querySelectorAll('input[type="radio"]').forEach(r => {
        r.addEventListener('change', () => { applyFilters(); if (window.innerWidth <= 768) setTimeout(closeSidebar, 300); });
        r.addEventListener('dblclick', function() { this.checked = false; applyFilters(); });
    });

    document.addEventListener('keydown', e => { if (e.key === 'Escape') { closeModal({target: document.getElementById('modalOverlay')}); closeSidebar(); } });

    function showToast(message, type = 'info', duration = 3000) {
        const container = document.getElementById('toastContainer');
        const icons = {
            success: 'bi-check-circle-fill',
            error: 'bi-x-circle-fill',
            warning: 'bi-exclamation-circle-fill',
            info: 'bi-info-circle-fill'
        };
        const toast = document.createElement('div');
        toast.className = `toast ${type}`;
        toast.innerHTML = `
            <i class="bi toast-icon ${icons[type]}"></i>
            <span class="toast-message">${message}</span>
            <button class="toast-close" onclick="this.parentElement.remove()"><i class="bi bi-x"></i></button>
            <div class="toast-progress"></div>
        `;
        container.appendChild(toast);
        setTimeout(() => {
            toast.classList.add('hiding');
            setTimeout(() => toast.remove(), 300);
        }, duration);
    }
</script>
@yield('scripts')
</body>
</html>