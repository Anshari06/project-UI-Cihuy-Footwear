@extends('layouts.produk')

@section('content')
    <div class="container py-4">
        <!-- Back Button -->
        <button onclick="history.back()" class="btn mb-3" style="background: #efece5; color: #2b2b2b; border: none; border-radius: 8px; font-size: 13px; font-weight: 600; padding: 8px 16px;">
            <i class="bi bi-arrow-left me-1"></i> Kembali
        </button>

        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb" style="background: transparent;">
                <li class="breadcrumb-item"><a href="{{ route('landing') }}" class="text-decoration-none"
                        style="color: #7a746f;">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('collection') }}" class="text-decoration-none"
                        style="color: #7a746f;">Collection</a></li>
                <li class="breadcrumb-item active" aria-current="page" style="color: #2b2b2b;">{{ $barang->name }}</li>
            </ol>
        </nav>

        <div class="row">
            <!-- Image Section -->
            <div class="col-lg-6 mb-4">
                <div class="border rounded-3 p-4 text-center" style="background: #faf9f7;">
                    @if ($barang->badge)
                        <span class="badge position-absolute top-0 start-0 m-3"
                            style="background: #efece5; color: #2b2b2b; font-weight: 600;">
                            {{ $barang->badge }}
                        </span>
                    @endif
                    <img src="{{ asset('images/cihuy/' . $barang->image) }}" alt="{{ $barang->name }}" class="img-fluid"
                        style="max-height: 400px; object-fit: contain;">
                </div>
            </div>

            <!-- Info Section -->
            <div class="col-lg-6">
                <span class="badge mb-2"
                    style="background: #efece5; color: #2b2b2b; font-weight: 600;">{{ $barang->brand }}</span>
                <h2 class="fw-bold mb-2" style="color: #2b2b2b;">{{ $barang->name }}</h2>
                <h3 class="fw-bold mb-3" style="color: #545350;">Rp {{ number_format($barang->price, 0, ',', '.') }}</h3>

                <div class="d-flex align-items-center mb-4">
                    <div class="me-2" style="color: #f59e0b;">
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-half"></i>
                    </div>
                    <small style="color: #7a746f;">400 penjualan</small>
                </div>

                <!-- Size Selection -->
                <div class="mb-4">
                    <label class="form-label fw-bold" style="color: #2b2b2b;">Ukuran</label>
                    <div class="d-flex flex-wrap gap-2">
                        @foreach (['EU 38', 'EU 39', 'EU 40', 'EU 41', 'EU 42', 'EU 43', 'EU 44', 'EU 45', 'EU 46', 'EU 47', 'EU 48', 'EU 49'] as $size)
                            <button class="btn size-btn" onclick="selectSize(this)"
                                style="border: 1.5px solid #e6e0da; color: #2b2b2b; background: #fff; border-radius: 8px; padding: 6px 14px; font-size: 13px; font-weight: 500;">
                                {{ $size }}
                            </button>
                        @endforeach
                    </div>
                </div>

                <!-- Quantity -->
                <div class="mb-4">
                    <label class="form-label fw-bold" style="color: #2b2b2b;">Jumlah</label>
                    <div class="d-flex align-items-center">
                        <button class="btn" onclick="changeQty(-1)"
                            style="border: 1.5px solid #e6e0da; color: #2b2b2b; background: #fff; border-radius: 8px; width: 40px; height: 40px; font-weight: 600;">−</button>
                        <input type="text" id="qty" value="1" readonly class="form-control text-center"
                            style="width: 60px; border: 1.5px solid #e6e0da; background: #fff; color: #2b2b2b; font-weight: 600; margin: 0 8px; border-radius: 8px;">
                        <button class="btn" onclick="changeQty(1)"
                            style="border: 1.5px solid #e6e0da; color: #2b2b2b; background: #fff; border-radius: 8px; width: 40px; height: 40px; font-weight: 600;">+</button>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="d-flex gap-2 mb-4">
                    <button class="btn flex-grow-1 py-2" id="addToCartBtn"
                        style="background: #efece5; color: #2b2b2b; border: 1.5px solid #2b2b2b; border-radius: 8px; font-weight: 600; font-size: 14px;">
                        Add to Cart
                    </button>
                    <button class="btn flex-grow-1 py-2" id="buyNowBtn"
                        style="background: #545350; color: #fff; border: none; border-radius: 8px; font-weight: 600; font-size: 14px;">
                        Buy Now
                    </button>
                </div>
            </div>
        </div>

        <!-- Description -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="p-4" style="background: #fff; border: 1px solid #e6e0da; border-radius: 12px;">
                    <h5 class="fw-bold mb-3" style="color: #2b2b2b; font-size: 16px;">{{ $barang->name }}</h5>
                    <p class="mb-4" style="color: #7a746f; line-height: 1.8; font-size: 14px;">{{ $barang->description }}</p>

                    <div class="mb-3">
                        <strong style="color: #2b2b2b; font-size: 14px;">Mengenai Ukuran:</strong>
                        <ul class="mb-0 mt-2" style="color: #7a746f; font-size: 14px; line-height: 1.8; padding-left: 18px;">
                            <li>Selisih 1-2 cm mungkin terjadi saat proses pengembangan dan produksi.</li>
                        </ul>
                    </div>
                    <div>
                        <strong style="color: #2b2b2b; font-size: 14px;">Mengenai Warna:</strong>
                        <p class="mb-0 mt-2" style="color: #7a746f; font-size: 14px; line-height: 1.8;">Warna sesungguhnya mungkin dapat berbeda. Hal ini disebabkan oleh setiap layar yang memiliki kemampuan yang berbeda-beda untuk menampilkan warna, kami tidak dapat menjamin bahwa warna yang Anda lihat adalah warna akurat dari produk tersebut.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Related Products -->
        <div class="mt-5">
            <h4 class="fw-bold mb-4" style="color: #2b2b2b;">Produk Serupa</h4>
            <div class="row g-3">
                @foreach ($related as $r)
                    <div class="col-6 col-md-4 col-lg-2">
                        <a href="{{ route('detailproduk', $r->id) }}" class="text-decoration-none">
                            <div class="card h-100 border-0 shadow-sm"
                                style="border-radius: 12px; overflow: hidden; border: 1px solid #e6e0da; transition: transform 0.3s, box-shadow 0.3s;"
                                onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 10px 30px rgba(0,0,0,0.08)'"
                                onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                                <div class="position-relative">
                                    @if ($r->badge)
                                        <span class="badge position-absolute top-0 start-0 m-2"
                                            style="background: #faf9f7; color: #2b2b2b; font-weight: 600; z-index: 2;">
                                            {{ $r->badge }}
                                        </span>
                                    @endif
                                    <img src="{{ asset('images/cihuy/' . $r->image) }}" alt="{{ $r->name }}"
                                        class="card-img-top"
                                        style="height: 140px; object-fit: cover; background: #faf9f7;">
                                </div>
                                <div class="card-body text-center p-2">
                                    <small class="fw-bold d-block text-truncate mb-1"
                                        style="color: #2b2b2b; font-size: 13px;">{{ $r->name }}</small>
                                    <small class="fw-bold" style="color: #545350; font-size: 13px;">Rp
                                        {{ number_format($r->price, 0, ',', '.') }}</small>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    var toastStyle = document.createElement('style');
    toastStyle.textContent = [
        '.cf-toast{background:#fff;border-radius:12px;box-shadow:0 8px 30px rgba(0,0,0,0.12);min-width:300px;max-width:400px;pointer-events:auto;animation:cfSlideIn .4s cubic-bezier(.34,1.56,.64,1) forwards;font-family:Poppins,sans-serif;font-size:14px;font-weight:500;position:relative;overflow:hidden}',
        '.cf-toast.hiding{animation:cfSlideOut .3s ease forwards}',
        '.cf-toast.success{border-left:4px solid #27ae60}',
        '.cf-toast.error{border-left:4px solid #e74c3c}',
        '.cf-toast.info{border-left:4px solid #545350}',
        '.cf-toast.warning{border-left:4px solid #f59e0b}',
        '@keyframes cfSlideIn{from{opacity:0;transform:translateX(100px) scale(.8)}to{opacity:1;transform:translateX(0) scale(1)}}',
        '@keyframes cfSlideOut{from{opacity:1;transform:translateX(0)}to{opacity:0;transform:translateX(100px)}}',
        '@keyframes cfProgress{from{width:100%}to{width:0%}}'
    ].join('');
    document.head.appendChild(toastStyle);

    function showToast(msg, type) {
        var icons = { success: 'bi-check-circle-fill', error: 'bi-x-circle-fill', warning: 'bi-exclamation-circle-fill', info: 'bi-info-circle-fill' };
        var container = document.getElementById('toastContainer') || document.body;
        var toast = document.createElement('div');
        toast.className = 'cf-toast ' + type;
        toast.style.cssText = 'display:flex;align-items:center;gap:12px;padding:14px 20px;border-radius:12px;box-shadow:0 8px 30px rgba(0,0,0,0.12);min-width:300px;max-width:400px;pointer-events:auto;animation:cfSlideIn .4s cubic-bezier(.34,1.56,.64,1) forwards;font-family:Poppins,sans-serif;font-size:14px;font-weight:500;position:fixed;top:24px;right:24px;z-index:9999;background:#fff;' +
            (type === 'success' ? 'border-left:4px solid #27ae60;' : '') +
            (type === 'error' ? 'border-left:4px solid #e74c3c;' : '') +
            (type === 'info' ? 'border-left:4px solid #545350;' : '') +
            (type === 'warning' ? 'border-left:4px solid #f59e0b;' : '');
        toast.innerHTML =
            '<i class="bi ' + icons[type] + '" style="font-size:20px;flex-shrink:0;' +
            (type === 'success' ? 'color:#27ae60' : type === 'error' ? 'color:#e74c3c' : type === 'info' ? 'color:#545350' : 'color:#f59e0b') + '"></i>' +
            '<span style="flex:1;line-height:1.4;color:#2b2b2b">' + msg + '</span>' +
            '<button onclick="this.parentElement.remove()" style="background:none;border:none;font-size:16px;color:#7a746f;cursor:pointer;padding:0;flex-shrink:0"><i class="bi bi-x"></i></button>' +
            '<div style="position:absolute;bottom:0;left:0;height:3px;width:100%;border-radius:0 0 12px 12px;animation:cfProgress 3s linear forwards;background:' +
            (type === 'success' ? '#27ae60' : type === 'error' ? '#e74c3c' : type === 'info' ? '#545350' : '#f59e0b') + '"></div>';
        container.appendChild(toast);
        setTimeout(function() {
            toast.style.animation = 'cfSlideOut .3s ease forwards';
            setTimeout(function() { if (toast.parentElement) toast.remove(); }, 300);
        }, 3000);
    }

    var barang = @json($barang);
    var selectedSize = null;

    function selectSize(el) {
        document.querySelectorAll('.size-btn').forEach(function(b) {
            b.style.background = '#fff';
            b.style.color = '#2b2b2b';
            b.style.border = '1.5px solid #e6e0da';
        });
        el.style.background = '#545350';
        el.style.color = '#fff';
        el.style.border = '1.5px solid #545350';
        selectedSize = el.textContent;
    }

    function changeQty(delta) {
        var input = document.getElementById('qty');
        var val = parseInt(input.value) + delta;
        if (val < 1) val = 1;
        input.value = val;
    }

    document.getElementById('addToCartBtn').addEventListener('click', async function() {
        if (!selectedSize) {
            showToast('Silakan pilih ukuran terlebih dahulu.', 'warning');
            return;
        }

        var qty = document.getElementById('qty').value;

        var res = await fetch('{{ route("cart.add") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                id: barang.id,
                name: barang.name,
                brand: barang.brand,
                price: barang.price,
                image: barang.image,
                size: selectedSize,
                qty: parseInt(qty)
            })
        });

        var data = await res.json();
        if (data.success) {
            showToast(barang.name + ' ditambahkan ke keranjang!', 'success');
        } else {
            showToast('Gagal menambahkan ke keranjang.', 'error');
        }
    });

    // Buy Now
    document.getElementById('buyNowBtn').addEventListener('click', async function() {
        if (!selectedSize) {
            showToast('Silakan pilih ukuran terlebih dahulu.', 'warning');
            return;
        }

        var qty = document.getElementById('qty').value;

        var res = await fetch('{{ route("cart.add") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                id: barang.id,
                name: barang.name,
                brand: barang.brand,
                price: barang.price,
                image: barang.image,
                size: selectedSize,
                qty: parseInt(qty)
            })
        });

        var data = await res.json();
        if (data.success) {
            window.location.href = '{{ route("keranjang") }}';
        } else {
            showToast('Gagal menambahkan ke keranjang.', 'error');
        }
    });
</script>
@endsection