@extends('layouts.app')

@section('content')
<main class="w-100" style="background: #faf9f7; min-height: 100vh;">
    <div class="container py-5">

        <!-- Page Header -->
        <div class="mb-4 animate-on-scroll">
            <h1 class="fw-bold" style="color: #2b2b2b; font-size: 32px;">Artikel</h1>
            <p class="mb-0" style="color: #7a746f;">Tips, tren, dan panduan seputar dunia sepatu.</p>
        </div>

        <!-- Category Tabs (pill style) -->
        <div class="articles-tabs pill-tabs mb-4 animate-on-scroll">
            <button class="tab-btn active" onclick="filterArticles('all', this)">Semua</button>
            <button class="tab-btn" onclick="filterArticles('trending', this)">Trending</button>
            <button class="tab-btn" onclick="filterArticles('terbaru', this)">Terbaru</button>
        </div>

        <!-- Articles Grid -->
        <div class="row g-4" id="articles-grid">
            @forelse($artikel as $i => $a)
                <div class="col-12 col-md-6 col-lg-4 animate-on-scroll delay-{{ ($i % 3) + 1 }}" data-category="{{ $a->category }}">
                    <a href="{{ route('artikel.show', $a->slug) }}" class="text-decoration-none d-block h-100">
                        <div class="article-card h-100">
                            <div class="article-img">
                                <span class="article-badge">{{ $a->category === 'trending' ? 'Trending' : 'Terbaru' }}</span>
                                @if($a->image)
                                    <img src="{{ $a->image }}" alt="{{ $a->title }}">
                                @else
                                    <img src="https://images.unsplash.com/photo-1608258851526-1c3a29e0f3a7?w=600&h=400&fit=crop" alt="{{ $a->title }}">
                                @endif
                            </div>
                            <div class="article-body">
                                <div class="article-meta">
                                    <i class="bi bi-person me-1"></i>{{ $a->author ?? 'Admin' }}
                                    <span class="mx-2">•</span>
                                    <i class="bi bi-calendar me-1"></i>{{ \Carbon\Carbon::parse($a->published_at)->format('d M Y') }}
                                </div>
                                <h5 class="article-title">{{ $a->title }}</h5>
                                <p class="article-excerpt">{{ Str::limit(strip_tags($a->content), 100) }}</p>
                                <span class="article-link">
                                    Baca Selengkapnya
                                    <i class="bi bi-arrow-right"></i>
                                </span>
                            </div>
                        </div>
                    </a>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <i class="bi bi-newspaper" style="font-size: 64px; color: #e6e0da;"></i>
                    <h5 class="mt-3" style="color: #7a746f;">Belum ada artikel</h5>
                    <p style="color: #7a746f;">
                        Mulai dengan <a href="{{ route('admin.artikel.create') }}" style="color: #545350; font-weight: 600;">menambah artikel baru</a>.
                    </p>
                </div>
            @endforelse
        </div>

    </div>
</main>
@endsection

@push('scripts')
<script>
    function filterArticles(category, btn) {
        document.querySelectorAll('.tab-btn').forEach(function(t) { t.classList.remove('active'); });
        btn.classList.add('active');

        document.querySelectorAll('#articles-grid [data-category]').forEach(function(card) {
            if (category === 'all' || card.dataset.category === category) {
                card.style.display = '';
                card.classList.add('visible');
            } else {
                card.style.display = 'none';
                card.classList.remove('visible');
            }
        });
    }
</script>
@endpush
