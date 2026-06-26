@extends('layouts.checkout')

@section('content')
<h1 class="page-title">Keranjang Kamu</h1>

<div class="row g-4">
    <!-- Cart Items -->
    <div class="col-lg-8">
        @if (count($items) > 0)
            @foreach ($items as $key => $item)
                <div class="cart-item">
                    <div class="cart-item-image">
                        <img src="{{ asset('images/cihuy/' . $item['image']) }}" alt="{{ $item['name'] }}">
                    </div>
                    <div class="cart-item-info">
                        <div class="cart-item-name">{{ $item['name'] }}</div>
                        <div class="cart-item-brand">{{ $item['brand'] }} &bull; Size: {{ $item['size'] }}</div>
                        <div class="cart-item-price">Rp {{ number_format($item['price'], 0, ',', '.') }}</div>
                        <div class="qty-control">
                            <button class="qty-btn" onclick="updateQty('{{ $key }}', {{ $item['qty'] - 1 }})">−</button>
                            <span class="qty-value">{{ $item['qty'] }}</span>
                            <button class="qty-btn" onclick="updateQty('{{ $key }}', {{ $item['qty'] + 1 }})">+</button>
                        </div>
                    </div>
                    <div class="cart-item-subtotal">
                        <div class="label">Subtotal</div>
                        <div class="value">Rp {{ number_format($item['price'] * $item['qty'], 0, ',', '.') }}</div>
                    </div>
                    <button class="remove-btn" onclick="removeItem('{{ $key }}')">
                        <i class="bi bi-trash"></i>
                    </button>
                </div>
            @endforeach
        @else
            <div class="empty-cart">
                <i class="bi bi-cart3"></i>
                <h3>Keranjang Kosong</h3>
                <p>Belum ada produk yang ditambahkan ke keranjang.</p>
                <a href="{{ route('collection') }}" class="btn-shop">Mulai Belanja</a>
            </div>
        @endif
    </div>

    <!-- Summary -->
    <div class="col-lg-4">
        <div class="summary-card">
            <h5 class="summary-title">Ringkasan</h5>

            <div class="summary-row">
                <span class="label">Subtotal</span>
                <span class="value" id="summary-subtotal">Rp {{ number_format($total, 0, ',', '.') }}</span>
            </div>
            <div class="summary-row">
                <span class="label">Diskon</span>
                <span class="value" id="summary-discount" style="color: #27ae60;">Rp 0</span>
            </div>

            <div class="summary-divider"></div>

            <div class="summary-row summary-total">
                <span class="label">Total</span>
                <span class="value" id="summary-total">Rp {{ number_format($total, 0, ',', '.') }}</span>
            </div>

            <div class="discount-section">
                <div class="discount-input-group">
                    <input type="text" placeholder="Kode diskon" id="discountCode">
                    <button type="button" onclick="applyDiscount()">Gunakan</button>
                </div>
            </div>

            <a href="{{ route('checkout') }}" class="checkout-btn">Lanjut ke Checkout</a>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    var toastStyle = document.createElement('style');
    toastStyle.id = 'toast-inline-styles';
    toastStyle.textContent = [
        '.cf-toast-container{position:fixed;top:24px;right:24px;z-index:9999;display:flex;flex-direction:column;gap:10px;pointer-events:none}',
        '.cf-toast{display:flex;align-items:center;gap:12px;padding:14px 20px;border-radius:12px;box-shadow:0 8px 30px rgba(0,0,0,0.12);min-width:300px;max-width:400px;pointer-events:auto;animation:cfSlideIn .4s cubic-bezier(.34,1.56,.64,1) forwards;font-family:Poppins,sans-serif;font-size:14px;font-weight:500;position:relative;overflow:hidden}',
        '.cf-toast.hiding{animation:cfSlideOut .3s ease forwards}',
        '.cf-toast.success{border-left:4px solid #27ae60}',
        '.cf-toast.error{border-left:4px solid #e74c3c}',
        '.cf-toast.info{border-left:4px solid #545350}',
        '.cf-toast.warning{border-left:4px solid #f59e0b}',
        '.cf-toast-icon{font-size:20px;flex-shrink:0}',
        '.cf-toast.success .cf-toast-icon{color:#27ae60}',
        '.cf-toast.error .cf-toast-icon{color:#e74c3c}',
        '.cf-toast.info .cf-toast-icon{color:#545350}',
        '.cf-toast.warning .cf-toast-icon{color:#f59e0b}',
        '.cf-toast-msg{flex:1;line-height:1.4;color:#2b2b2b}',
        '.cf-toast-close{background:none;border:none;font-size:16px;color:#7a746f;cursor:pointer;padding:0;flex-shrink:0}',
        '.cf-toast-close:hover{color:#2b2b2b}',
        '.cf-toast-bar{position:absolute;bottom:0;left:0;height:3px;width:100%;border-radius:0 0 12px 12px;animation:cfProgress 3s linear forwards}',
        '.cf-toast.success .cf-toast-bar{background:#27ae60}',
        '.cf-toast.error .cf-toast-bar{background:#e74c3c}',
        '.cf-toast.info .cf-toast-bar{background:#545350}',
        '.cf-toast.warning .cf-toast-bar{background:#f59e0b}',
        '@keyframes cfSlideIn{from{opacity:0;transform:translateX(100px) scale(.8)}to{opacity:1;transform:translateX(0) scale(1)}}',
        '@keyframes cfSlideOut{from{opacity:1;transform:translateX(0)}to{opacity:0;transform:translateX(100px)}}',
        '@keyframes cfProgress{from{width:100%}to{width:0%}}'
    ].join('');
    document.head.appendChild(toastStyle);

    function showToast(msg, type) {
        var icons = { success: 'bi-check-circle-fill', error: 'bi-x-circle-fill', warning: 'bi-exclamation-circle-fill', info: 'bi-info-circle-fill' };
        var container = document.getElementById('toastContainer');
        if (!container) {
            container = document.body;
        }
        var toast = document.createElement('div');
        toast.className = 'cf-toast ' + type;
        toast.style.cssText = 'display:flex;align-items:center;gap:12px;padding:14px 20px;border-radius:12px;box-shadow:0 8px 30px rgba(0,0,0,0.12);min-width:300px;max-width:400px;pointer-events:auto;animation:cfSlideIn .4s cubic-bezier(.34,1.56,.64,1) forwards;font-family:Poppins,sans-serif;font-size:14px;font-weight:500;position:relative;overflow:hidden;background:#fff;' +
            (type === 'success' ? 'border-left:4px solid #27ae60;' : '') +
            (type === 'error' ? 'border-left:4px solid #e74c3c;' : '') +
            (type === 'info' ? 'border-left:4px solid #545350;' : '') +
            (type === 'warning' ? 'border-left:4px solid #f59e0b;' : '');
        toast.innerHTML =
            '<i class="bi ' + icons[type] + ' cf-toast-icon" style="font-size:20px;flex-shrink:0;' +
            (type === 'success' ? 'color:#27ae60' : '') +
            (type === 'error' ? 'color:#e74c3c' : '') +
            (type === 'info' ? 'color:#545350' : '') +
            (type === 'warning' ? 'color:#f59e0b' : '') + '"></i>' +
            '<span class="cf-toast-msg" style="flex:1;line-height:1.4;color:#2b2b2b">' + msg + '</span>' +
            '<button class="cf-toast-close" onclick="this.parentElement.remove()" style="background:none;border:none;font-size:16px;color:#7a746f;cursor:pointer;padding:0;flex-shrink:0"><i class="bi bi-x"></i></button>' +
            '<div class="cf-toast-bar" style="position:absolute;bottom:0;left:0;height:3px;width:100%;border-radius:0 0 12px 12px;animation:cfProgress 3s linear forwards;background:' +
            (type === 'success' ? '#27ae60' : '') +
            (type === 'error' ? '#e74c3c' : '') +
            (type === 'info' ? '#545350' : '') +
            (type === 'warning' ? '#f59e0b' : '') + '"></div>';
        container.appendChild(toast);
        setTimeout(function() {
            toast.style.animation = 'cfSlideOut .3s ease forwards';
            setTimeout(function() { if (toast.parentElement) toast.remove(); }, 300);
        }, 3000);
    }

    async function updateQty(key, qty) {
        if (qty < 1) { await removeItem(key); return; }
        await fetch('{{ route("cart.update") }}', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            body: JSON.stringify({ key, qty })
        });
        location.reload();
    }

    async function removeItem(key) {
        await fetch('{{ route("cart.remove") }}', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            body: JSON.stringify({ key })
        });
        location.reload();
    }

    function applyDiscount() {
        var code = document.getElementById('discountCode').value;
        if (code.trim()) {
            showToast('Kode diskon "' + code + '" diterapkan!', 'success');
        } else {
            showToast('Silakan masukkan kode diskon terlebih dahulu.', 'warning');
        }
    }
</script>
@endsection