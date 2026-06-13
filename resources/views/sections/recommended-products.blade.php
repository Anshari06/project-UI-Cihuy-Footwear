<section id="recommended-products" class="py-14 bg-white">
    <div class="container">
        <div class="section-heading animate-on-scroll">
            <h2>OUR BEST RECOMMENDATION</h2>
            <p>Find what you've been looking for since the first click.</p>
        </div>

        <div class="row g-4">
            @forelse($recommended as $i => $p)
                <div class="col-12 col-md-6 col-lg-3 animate-on-scroll delay-{{ $i + 1 }}">
                    <div class="product-card">
                        <div class="card-img-wrap">
                            <span class="product-badge {{ $p->badge == 'Best Seller' ? 'badge-bestseller' : 'badge-new' }}">
                                {{ $p->badge }}
                            </span>
                            <img src="{{ asset('images/cihuy/' . $p->image) }}" alt="{{ $p->name }}">
                        </div>
                        <div class="card-body">
                            <h5 class="product-name">{{ $p->name }}</h5>
                            <p class="product-desc">{{ Str::limit($p->description, 60) }}</p>
                            <div class="product-footer">
                                <span class="product-price">Rp {{ number_format($p->price, 0, ',', '.') }}</span>
                                <div class="product-actions">
                                    <button class="btn-add"><i class="bi bi-cart3"></i> Add Chart</button>
                                    <button class="btn-buy"><i class="bi bi-bag"></i> Buy Now</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center text-muted">
                    <p>No products available.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>