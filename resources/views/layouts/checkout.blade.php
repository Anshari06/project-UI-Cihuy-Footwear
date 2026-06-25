<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Cihuy Footwear' }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/cihuy/cihuylogo.svg') }}">
    <style>
        :root {
            --primary: #faf9f7;
            --secondary: #efece5;
            --accent: #545350;
            --text-dark: #2b2b2b;
            --text-muted: #7a746f;
            --border: #e6e0da;
        }

        * { box-sizing: border-box; font-family: 'Poppins', sans-serif; }

        a { text-decoration: none; }

        body {
            background: var(--primary);
            color: var(--text-dark);
            margin: 0;
            padding: 0;
            min-height: 100vh;
        }

        .checkout-header {
            background: #fff;
            padding: 16px 0;
            border-bottom: 1px solid var(--border);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .page-title {
            font-size: 28px;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 28px;
        }

        .cart-container {
            max-width: 1100px;
            margin: 0 auto;
            padding: 32px 16px;
        }

        /* Cart Items */
        .cart-item {
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 20px;
            display: flex;
            gap: 20px;
            align-items: center;
            margin-bottom: 16px;
            transition: box-shadow 0.3s;
        }

        .cart-item:hover {
            box-shadow: 0 4px 20px rgba(0,0,0,0.06);
        }

        .cart-item-image {
            width: 120px;
            height: 120px;
            background: var(--primary);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            overflow: hidden;
        }

        .cart-item-image img {
            max-width: 90%;
            max-height: 90%;
            object-fit: contain;
        }

        .cart-item-info {
            flex: 1;
            min-width: 0;
        }

        .cart-item-name {
            font-size: 16px;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 4px;
        }

        .cart-item-brand {
            font-size: 13px;
            color: var(--text-muted);
            margin-bottom: 4px;
        }

        .cart-item-price {
            font-size: 18px;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 12px;
        }

        .qty-control {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .qty-btn {
            width: 36px;
            height: 36px;
            border: 1.5px solid var(--border);
            border-radius: 8px;
            background: #fff;
            color: var(--text-dark);
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s;
        }

        .qty-btn:hover {
            background: var(--secondary);
        }

        .qty-value {
            min-width: 40px;
            text-align: center;
            font-size: 16px;
            font-weight: 600;
            color: var(--text-dark);
        }

        .cart-item-subtotal {
            text-align: right;
            min-width: 160px;
        }

        .cart-item-subtotal .label {
            font-size: 12px;
            color: var(--text-muted);
            margin-bottom: 4px;
        }

        .cart-item-subtotal .value {
            font-size: 18px;
            font-weight: 700;
            color: var(--text-dark);
        }

        .remove-btn {
            color: var(--text-muted);
            background: none;
            border: none;
            font-size: 20px;
            cursor: pointer;
            padding: 4px 8px;
            transition: color 0.2s;
        }

        .remove-btn:hover {
            color: #e74c3c;
        }

        /* Summary Panel */
        .summary-card {
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 24px;
            position: sticky;
            top: 90px;
        }

        .summary-title {
            font-size: 18px;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 20px;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
            font-size: 14px;
        }

        .summary-row .label {
            color: var(--text-muted);
        }

        .summary-row .value {
            font-weight: 600;
            color: var(--text-dark);
        }

        .summary-divider {
            border-top: 1px solid var(--border);
            margin: 16px 0;
        }

        .summary-total .label {
            font-size: 16px;
            font-weight: 700;
            color: var(--text-dark);
        }

        .summary-total .value {
            font-size: 20px;
            font-weight: 800;
            color: var(--text-dark);
        }

        .discount-section {
            margin: 20px 0;
        }

        .discount-input-group {
            display: flex;
            gap: 8px;
        }

        .discount-input-group input {
            flex: 1;
            padding: 10px 14px;
            border: 1.5px solid var(--border);
            border-radius: 8px;
            font-size: 13px;
            outline: none;
            transition: border-color 0.2s;
            background: #fff;
        }

        .discount-input-group input:focus {
            border-color: var(--accent);
        }

        .discount-input-group button {
            padding: 10px 16px;
            background: var(--secondary);
            color: var(--text-dark);
            border: 1.5px solid var(--border);
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
        }

        .discount-input-group button:hover {
            background: var(--accent);
            color: #fff;
            border-color: var(--accent);
        }

        .checkout-btn {
            width: 100%;
            padding: 14px;
            background: var(--accent);
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.3s;
            margin-top: 8px;
        }

        .checkout-btn:hover {
            background: #333;
        }

        .empty-cart {
            text-align: center;
            padding: 80px 20px;
        }

        .empty-cart i {
            font-size: 64px;
            color: var(--border);
            margin-bottom: 16px;
        }

        .empty-cart h3 {
            font-size: 20px;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 8px;
        }

        .empty-cart p {
            color: var(--text-muted);
            font-size: 14px;
            margin-bottom: 24px;
        }

        .empty-cart .btn-shop {
            display: inline-block;
            padding: 12px 24px;
            background: var(--accent);
            color: #fff;
            text-decoration: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
        }

        @media (max-width: 768px) {
            .cart-item { flex-wrap: wrap; position: relative; }
            .cart-item-image { width: 80px; height: 80px; }
            .cart-item-subtotal {
                width: 100%;
                text-align: left;
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding-top: 12px;
                border-top: 1px solid var(--border);
            }
            .remove-btn { position: absolute; top: 12px; right: 12px; }
            .checkout-header .logo-text { display: none; }
            .checkout-header .back-link { font-size: 12px; }
        }

        /* ============================================
           TOAST NOTIFICATION
           ============================================ */
        .toast-container {
            position: fixed;
            top: 24px;
            right: 24px;
            z-index: 9999;
            display: flex;
            flex-direction: column;
            gap: 10px;
            pointer-events: none;
        }

        .toast {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 20px;
            border-radius: 12px;
            box-shadow: 0 8px 30px rgba(0,0,0,0.12);
            min-width: 300px;
            max-width: 400px;
            pointer-events: auto;
            animation: toastIn 0.4s cubic-bezier(0.34, 1.56, 0.64, 1) forwards;
            font-size: 14px;
            font-weight: 500;
        }

        .toast.hiding {
            animation: toastOut 0.3s ease forwards;
        }

        .toast.success {
            background: #fff;
            border-left: 4px solid #27ae60;
            color: #2b2b2b;
        }

        .toast.success .toast-icon {
            color: #27ae60;
        }

        .toast.error {
            background: #fff;
            border-left: 4px solid #e74c3c;
            color: #2b2b2b;
        }

        .toast.error .toast-icon {
            color: #e74c3c;
        }

        .toast.info {
            background: #fff;
            border-left: 4px solid #545350;
            color: #2b2b2b;
        }

        .toast.info .toast-icon {
            color: #545350;
        }

        .toast.warning {
            background: #fff;
            border-left: 4px solid #f59e0b;
            color: #2b2b2b;
        }

        .toast.warning .toast-icon {
            color: #f59e0b;
        }

        .toast-icon {
            font-size: 20px;
            flex-shrink: 0;
        }

        .toast-message { flex: 1; line-height: 1.4; }

        .toast-close {
            background: none;
            border: none;
            font-size: 16px;
            color: #7a746f;
            cursor: pointer;
            padding: 0;
            flex-shrink: 0;
            transition: color 0.2s;
        }

        .toast-close:hover { color: #2b2b2b; }

        .toast-progress {
            position: absolute;
            bottom: 0;
            left: 0;
            height: 3px;
            border-radius: 0 0 12px 12px;
            animation: toastProgress 3s linear forwards;
        }

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
            from { width: 100%; }
            to { width: 0%; }
        }
    </style>
    @yield('extra_styles')
</head>
<body>

<!-- Header -->
<x-header-checkout />

<!-- Toast Container -->
<div class="toast-container" id="toastContainer"></div>

<div class="cart-container">
    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
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