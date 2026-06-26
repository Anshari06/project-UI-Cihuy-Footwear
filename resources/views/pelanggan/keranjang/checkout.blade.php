@extends('layouts.checkout')

@section('content')
<h1 class="page-title">Transaksi Kamu</h1>

<!-- Step Indicator -->
<div class="step-indicator mb-4">
    <div class="step-item active" id="step-pengiriman">
        <div class="step-icon"><i class="bi bi-truck"></i></div>
        <span>Pengiriman</span>
    </div>
    <div class="step-line"></div>
    <div class="step-item" id="step-pembayaran">
        <div class="step-icon"><i class="bi bi-credit-card"></i></div>
        <span>Pembayaran</span>
    </div>
</div>

<form id="checkoutForm">
<div class="row g-4">
    <!-- Left: Form Steps -->
    <div class="col-lg-8">

        <!-- ===== STEP 1: PENGIRIMAN ===== -->
        <div class="step-content" id="content-pengiriman">
            <div class="bg-white p-4 rounded-3 border" style="border-color: #e6e0da;">
                <h5 class="fw-bold mb-3" style="color: #2b2b2b;">Informasi Pengiriman</h5>

                <input type="hidden" id="provinceName" name="provinsi" value="">
                <input type="hidden" id="cityName" name="kota" value="">
                <input type="hidden" id="districtName" name="kecamatan" value="">
                <input type="hidden" id="villageName" name="kelurahan" value="">

                <div class="mb-3">
                    <label class="form-label fw-semibold" style="font-size: 13px; color: #2b2b2b;">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="email@contoh.com"
                        style="border: 1.5px solid #e6e0da; border-radius: 8px; padding: 10px 14px; font-size: 14px;">
                    <small style="color: #7a746f; font-size: 12px;">Konfirmasi & bukti transaksi akan dikirim ke email ini</small>
                </div>

                <!-- Delivery Method Toggle -->
                <div class="mb-4">
                    <label class="form-label fw-semibold" style="font-size: 13px; color: #2b2b2b;">Metode Pengiriman</label>
                    <div class="d-flex gap-2">
                        <button type="button" class="delivery-btn active" id="btn-delivery" onclick="selectDelivery('delivery')">
                            <i class="bi bi-truck me-2"></i>Delivery
                        </button>
                        <button type="button" class="delivery-btn" id="btn-store" onclick="selectDelivery('store')">
                            <i class="bi bi-shop me-2"></i>On The Store
                        </button>
                    </div>
                </div>

                <!-- Data Diri / Delivery Form -->
                <div id="delivery-form">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold" style="font-size: 13px; color: #2b2b2b;">Nama Depan</label>
                            <input type="text" class="form-control" id="nama_depan" name="nama_depan" placeholder="Masukkan nama depan"
                                style="border: 1.5px solid #e6e0da; border-radius: 8px; padding: 10px 14px; font-size: 14px;">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold" style="font-size: 13px; color: #2b2b2b;">Nama Belakang</label>
                            <input type="text" class="form-control" id="nama_belakang" name="nama_belakang" placeholder="Masukkan nama belakang"
                                style="border: 1.5px solid #e6e0da; border-radius: 8px; padding: 10px 14px; font-size: 14px;">
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold" style="font-size: 13px; color: #2b2b2b;">Alamat</label>
                            <textarea class="form-control" id="alamat" name="alamat" rows="2" placeholder="Masukkan alamat lengkap"
                                style="border: 1.5px solid #e6e0da; border-radius: 8px; padding: 10px 14px; font-size: 14px; resize: none;"></textarea>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold" style="font-size: 13px; color: #2b2b2b;">Provinsi</label>
                            <select class="form-select" id="province"
                                onchange="loadCities()"
                                style="border: 1.5px solid #e6e0da; border-radius: 8px; padding: 10px 14px; font-size: 14px;">
                                <option selected disabled>Pilih Provinsi</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold" style="font-size: 13px; color: #2b2b2b;">Kota</label>
                            <select class="form-select" id="city"
                                onchange="loadDistricts()"
                                style="border: 1.5px solid #e6e0da; border-radius: 8px; padding: 10px 14px; font-size: 14px;">
                                <option selected disabled>Pilih Kota</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold" style="font-size: 13px; color: #2b2b2b;">Kecamatan</label>
                            <select class="form-select" id="district"
                                onchange="loadVillages()"
                                style="border: 1.5px solid #e6e0da; border-radius: 8px; padding: 10px 14px; font-size: 14px;">
                                <option selected disabled>Pilih Kecamatan</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold" style="font-size: 13px; color: #2b2b2b;">Kelurahan/Desa</label>
                            <select class="form-select" id="village"
                                onchange="updateVillageName()"
                                style="border: 1.5px solid #e6e0da; border-radius: 8px; padding: 10px 14px; font-size: 14px;">
                                <option selected disabled>Pilih Kelurahan/Desa</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold" style="font-size: 13px; color: #2b2b2b;">Kode Pos</label>
                            <input type="text" class="form-control" id="kode_pos" name="kode_pos" placeholder="12345"
                                style="border: 1.5px solid #e6e0da; border-radius: 8px; padding: 10px 14px; font-size: 14px;">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold" style="font-size: 13px; color: #2b2b2b;">Nomor Telepon</label>
                            <input type="tel" class="form-control" id="no_telp" name="no_telp" placeholder="08xxxxxxxxxx"
                                style="border: 1.5px solid #e6e0da; border-radius: 8px; padding: 10px 14px; font-size: 14px;">
                        </div>
                    </div>
                </div>

                <!-- Store Location (hidden by default) -->
                <div id="store-form" class="d-none">
                    <div class="alert" style="background: #faf9f7; border: 1px solid #e6e0da; border-radius: 8px; color: #7a746f; font-size: 14px;">
                        <i class="bi bi-info-circle me-2"></i>Silakan ambil pesanan di toko Cihuy Footwear terdekat setelah konfirmasi.
                    </div>
                </div>

                <button type="button" class="checkout-btn mt-3" onclick="goToStep('pembayaran')">
                    Go to Payment <i class="bi bi-arrow-right ms-2"></i>
                </button>
            </div>
        </div>

        <!-- ===== STEP 2: PEMBAYARAN ===== -->
        <div class="step-content d-none" id="content-pembayaran">
            <div class="bg-white p-4 rounded-3 border mb-4" style="border-color: #e6e0da;">
                <h5 class="fw-bold mb-3" style="color: #2b2b2b;">Metode Pembayaran</h5>
                <p class="mb-3" style="color: #7a746f; font-size: 13px;">Pilih metode pembayaran</p>

                <input type="hidden" id="selectedPayment" name="metode_pembayaran" value="">
                <input type="hidden" id="selectedDelivery" name="kurir" value="delivery">

                <div class="payment-methods">
                    <div class="payment-option" onclick="selectPayment(this, 'Virtual Account')">
                        <div class="d-flex align-items-center gap-3 w-100">
                            <div class="payment-radio"></div>
                            <div class="flex-grow-1">
                                <div class="fw-semibold" style="font-size: 14px; color: #2b2b2b;">Virtual Account</div>
                                <small style="color: #7a746f;">BCA, Mandiri, BNI, BRI</small>
                            </div>
                        </div>
                    </div>

                    <div class="payment-option" onclick="selectPayment(this, 'Credit Card')">
                        <div class="d-flex align-items-center gap-3 w-100">
                            <div class="payment-radio"></div>
                            <div class="flex-grow-1">
                                <div class="fw-semibold" style="font-size: 14px; color: #2b2b2b;">Credit Card</div>
                                <small style="color: #7a746f;">Visa, Mastercard, JCB</small>
                            </div>
                        </div>
                    </div>

                    <div class="payment-option" onclick="selectPayment(this, 'QRIS')">
                        <div class="d-flex align-items-center gap-3 w-100">
                            <div class="payment-radio"></div>
                            <div class="flex-grow-1">
                                <div class="fw-semibold" style="font-size: 14px; color: #2b2b2b;">QRIS Pay</div>
                                <small style="color: #7a746f;">Scan QR dengan aplikasi bank</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Terms -->
                <div class="mt-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="termsCheck" style="accent-color: #545350;">
                        <label class="form-check-label" for="termsCheck" style="font-size: 12px; color: #7a746f;">
                            Dengan memilih Pay Now, saya menyetujui Syarat & Ketentuan serta Kebijakan Privasi Cihuy Footwear Indonesia
                        </label>
                    </div>
                </div>
            </div>

            <!-- Navigation Buttons -->
            <div class="d-flex gap-2">
                <button type="button" class="btn flex-grow-1 py-2" onclick="goToStep('pengiriman')"
                    style="background: #efece5; color: #2b2b2b; border: none; border-radius: 8px; font-weight: 600; font-size: 14px;">
                    <i class="bi bi-arrow-left me-2"></i>Kembali
                </button>
                <button type="button" class="btn flex-grow-1 py-2" id="btnSubmit"
                    style="background: #545350; color: #fff; border: none; border-radius: 8px; font-weight: 600; font-size: 14px;">
                    <i class="bi bi-check-circle me-2"></i>Buat Pesanan
                </button>
            </div>
        </div>
    </div>

    <!-- Right: Summary -->
    <div class="col-lg-4">
        <div class="summary-card">
            <h5 class="summary-title">Ringkasan</h5>

            @foreach ($items as $key => $item)
                <div class="d-flex gap-3 mb-3 pb-3" style="border-bottom: 1px solid #e6e0da;">
                    <div style="width: 60px; height: 60px; background: #faf9f7; border-radius: 8px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                        <img src="{{ asset('images/cihuy/' . $item['image']) }}" alt="{{ $item['name'] }}"
                            style="max-width: 90%; max-height: 90%; object-fit: contain;">
                    </div>
                    <div class="flex-grow-1">
                        <div style="font-size: 11px; color: #7a746f; text-transform: uppercase; font-weight: 600;">{{ $item['brand'] }}</div>
                        <div class="fw-semibold" style="font-size: 13px; color: #2b2b2b;">{{ $item['name'] }}</div>
                        <div style="font-size: 12px; color: #7a746f;">Size: {{ $item['size'] }} &bull; Qty: {{ $item['qty'] }}</div>
                        <div class="fw-bold" style="font-size: 14px; color: #2b2b2b;">Rp {{ number_format($item['price'] * $item['qty'], 0, ',', '.') }}</div>
                    </div>
                </div>
            @endforeach

            <div class="summary-divider"></div>

            <div class="summary-row">
                <span class="label">Subtotal</span>
                <span class="value">Rp {{ number_format($total, 0, ',', '.') }}</span>
            </div>
            <div class="summary-row">
                <span class="label">Pengiriman</span>
                <span class="value" style="color: #7a746f; font-size: 12px;">belum terhitung</span>
            </div>
            <div class="summary-row">
                <span class="label">Diskon</span>
                <span class="value" style="color: #27ae60;">Rp 0</span>
            </div>

            <div class="summary-divider"></div>

            <div class="summary-row summary-total">
                <span class="label">Total</span>
                <span class="value">Rp {{ number_format($total, 0, ',', '.') }}</span>
            </div>
        </div>
    </div>
</div>
</form>
@endsection

@section('extra_styles')
<style>
    .step-indicator { display: flex; align-items: center; gap: 0; margin-bottom: 28px; }
    .step-item { display: flex; align-items: center; gap: 10px; padding: 10px 20px; border-radius: 30px; background: #fff; border: 1.5px solid #e6e0da; color: #7a746f; font-size: 14px; font-weight: 600; transition: all 0.3s; }
    .step-item.active { background: #545350; border-color: #545350; color: #fff; }
    .step-item.done { background: #efece5; border-color: #efece5; color: #2b2b2b; }
    .step-icon { width: 28px; height: 28px; display: flex; align-items: center; justify-content: center; font-size: 14px; }
    .step-line { flex: 0 0 40px; height: 2px; background: #e6e0da; }
    .delivery-btn { flex: 1; padding: 10px 16px; border: 1.5px solid #e6e0da; border-radius: 8px; background: #fff; color: #7a746f; font-size: 13px; font-weight: 600; cursor: pointer; transition: all 0.2s; display: flex; align-items: center; justify-content: center; }
    .delivery-btn:hover { border-color: #545350; color: #2b2b2b; }
    .delivery-btn.active { background: #545350; border-color: #545350; color: #fff; }
    .payment-methods { display: flex; flex-direction: column; gap: 10px; }
    .payment-option { padding: 14px 16px; border: 1.5px solid #e6e0da; border-radius: 10px; cursor: pointer; transition: all 0.2s; }
    .payment-option:hover { border-color: #545350; background: #faf9f7; }
    .payment-option.selected { border-color: #545350; background: #faf9f7; }
    .payment-radio { width: 20px; height: 20px; border: 2px solid #e6e0da; border-radius: 50%; flex-shrink: 0; transition: all 0.2s; position: relative; }
    .payment-option.selected .payment-radio { border-color: #545350; background: #545350; }
    .payment-option.selected .payment-radio::after { content: ''; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 8px; height: 8px; background: #fff; border-radius: 50%; }
    @media (max-width: 768px) { .step-indicator { flex-wrap: wrap; gap: 8px; } .step-line { display: none; } }
</style>
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

    var currentStep = 'pengiriman';
    var deliveryMethod = 'delivery';

    document.addEventListener('DOMContentLoaded', function() {
        loadProvinces();
        document.getElementById('btnSubmit').addEventListener('click', submitOrder);
    });

    async function loadProvinces() {
        var res = await fetch('{{ route("regions.provinces") }}');
        var data = await res.json();
        var select = document.getElementById('province');
        select.innerHTML = '<option selected disabled>Pilih Provinsi</option>';
        data.forEach(function(p) {
            select.innerHTML += '<option value="' + p.id + '" data-name="' + p.name + '">' + p.name + '</option>';
        });
    }

    async function loadCities() {
        var provinceSelect = document.getElementById('province');
        var selectedOption = provinceSelect.options[provinceSelect.selectedIndex];
        document.getElementById('provinceName').value = selectedOption ? selectedOption.getAttribute('data-name') || provinceSelect.value : '';

        var provinceId = provinceSelect.value;
        var res = await fetch('{{ route("regions.cities") }}?province_id=' + provinceId);
        var data = await res.json();
        var select = document.getElementById('city');
        select.innerHTML = '<option selected disabled>Pilih Kota</option>';
        data.forEach(function(c) {
            select.innerHTML += '<option value="' + c.id + '" data-name="' + c.name + '">' + c.name + '</option>';
        });
        document.getElementById('district').innerHTML = '<option selected disabled>Pilih Kecamatan</option>';
        document.getElementById('village').innerHTML = '<option selected disabled>Pilih Kelurahan/Desa</option>';
        document.getElementById('cityName').value = '';
        document.getElementById('districtName').value = '';
        document.getElementById('villageName').value = '';
    }

    async function loadDistricts() {
        var citySelect = document.getElementById('city');
        var selectedOption = citySelect.options[citySelect.selectedIndex];
        document.getElementById('cityName').value = selectedOption ? selectedOption.getAttribute('data-name') || citySelect.value : '';

        var cityId = citySelect.value;
        var res = await fetch('{{ route("regions.districts") }}?city_id=' + cityId);
        var data = await res.json();
        var select = document.getElementById('district');
        select.innerHTML = '<option selected disabled>Pilih Kecamatan</option>';
        data.forEach(function(d) {
            select.innerHTML += '<option value="' + d.id + '" data-name="' + d.name + '">' + d.name + '</option>';
        });
        document.getElementById('village').innerHTML = '<option selected disabled>Pilih Kelurahan/Desa</option>';
        document.getElementById('districtName').value = '';
        document.getElementById('villageName').value = '';
    }

    function updateVillageName() {
        var villageSelect = document.getElementById('village');
        var selectedOption = villageSelect.options[villageSelect.selectedIndex];
        document.getElementById('villageName').value = selectedOption ? selectedOption.getAttribute('data-name') || villageSelect.value : '';
    }

    async function loadVillages() {
        var districtSelect = document.getElementById('district');
        var selectedOption = districtSelect.options[districtSelect.selectedIndex];
        document.getElementById('districtName').value = selectedOption ? selectedOption.getAttribute('data-name') || districtSelect.value : '';

        var districtId = districtSelect.value;
        var res = await fetch('{{ route("regions.villages") }}?district_id=' + districtId);
        var data = await res.json();
        var select = document.getElementById('village');
        select.innerHTML = '<option selected disabled>Pilih Kelurahan/Desa</option>';
        data.forEach(function(v) {
            select.innerHTML += '<option value="' + v.id + '" data-name="' + v.name + '">' + v.name + '</option>';
        });
        document.getElementById('villageName').value = '';
    }

    function goToStep(step) {
        document.querySelectorAll('.step-content').forEach(function(el) { el.classList.add('d-none'); });
        document.getElementById('content-' + step).classList.remove('d-none');
        document.querySelectorAll('.step-item').forEach(function(el) { el.classList.remove('active', 'done'); });
        if (step === 'pembayaran') {
            document.getElementById('step-pengiriman').classList.add('done');
            document.getElementById('step-pembayaran').classList.add('active');
        } else {
            document.getElementById('step-pengiriman').classList.add('active');
        }
        currentStep = step;
    }

    function selectDelivery(method) {
        deliveryMethod = method;
        document.querySelectorAll('.delivery-btn').forEach(function(b) { b.classList.remove('active'); });
        document.getElementById('btn-' + method).classList.add('active');
        document.getElementById('selectedDelivery').value = method;
        if (method === 'store') {
            document.getElementById('delivery-form').classList.add('d-none');
            document.getElementById('store-form').classList.remove('d-none');
        } else {
            document.getElementById('delivery-form').classList.remove('d-none');
            document.getElementById('store-form').classList.add('d-none');
        }
    }

    function selectPayment(el, method) {
        document.querySelectorAll('.payment-option').forEach(function(opt) { opt.classList.remove('selected'); });
        el.classList.add('selected');
        document.getElementById('selectedPayment').value = method;
    }

    function submitOrder() {
        var terms = document.getElementById('termsCheck');
        var payment = document.getElementById('selectedPayment').value;
        var delivery = document.getElementById('selectedDelivery').value;

        if (!payment) {
            showToast('Silakan pilih metode pembayaran terlebih dahulu.', 'warning');
            return;
        }
        if (!terms.checked) {
            showToast('Silakan centang persetujuan Syarat & Ketentuan terlebih dahulu.', 'warning');
            return;
        }

        // Validate delivery fields if delivery method selected
        if (delivery !== 'store') {
            var requiredFields = [
                { id: 'nama_depan', label: 'Nama Depan' },
                { id: 'nama_belakang', label: 'Nama Belakang' },
                { id: 'alamat', label: 'Alamat' },
                { id: 'province', label: 'Provinsi' },
                { id: 'city', label: 'Kota' },
                { id: 'district', label: 'Kecamatan' },
                { id: 'village', label: 'Kelurahan/Desa' },
                { id: 'kode_pos', label: 'Kode Pos' },
                { id: 'no_telp', label: 'Nomor Telepon' },
            ];
            for (var i = 0; i < requiredFields.length; i++) {
                var el = document.getElementById(requiredFields[i].id);
                if (!el || !el.value || el.value.trim() === '') {
                    showToast('Silakan lengkapi field: ' + requiredFields[i].label, 'warning');
                    return;
                }
            }
        }

        var form = document.getElementById('checkoutForm');
        var formData = new FormData(form);
        var btn = document.getElementById('btnSubmit');
        btn.disabled = true;
        btn.innerHTML = '<i class="bi bi-hourglass-split me-2"></i>Memproses...';

        fetch('{{ route("checkout.process") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
            body: formData
        })
        .then(function(res) { return res.json(); })
        .then(function(data) {
            if (data.success) {
                showToast('Pesanan berhasil dibuat! No. Pesanan: ' + data.no_pesanan, 'success');
                setTimeout(function() {
                    window.location.href = '{{ route("keranjang") }}';
                }, 2000);
            } else {
                showToast(data.message || 'Terjadi kesalahan.', 'error');
                btn.disabled = false;
                btn.innerHTML = '<i class="bi bi-check-circle me-2"></i>Buat Pesanan';
            }
        })
        .catch(function() {
            showToast('Terjadi kesalahan. Silakan coba lagi.', 'error');
            btn.disabled = false;
            btn.innerHTML = '<i class="bi bi-check-circle me-2"></i>Buat Pesanan';
        });
    }
</script>
@endsection