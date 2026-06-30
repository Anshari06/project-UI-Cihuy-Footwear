@extends('layouts.app')

@section('content')
<main class="w-100" style="background: #faf9f7; min-height: 100vh;">
    <div class="container py-5">

        <!-- Page Header -->
        <div class="mb-4 animate-on-scroll">
            <h1 class="fw-bold" style="color: #2b2b2b; font-size: 32px;">Artikel</h1>
            <p class="mb-0" style="color: #7a746f;">Tips, tren, dan panduan seputar dunia sepatu.</p>
        </div>

        <!-- Category Tabs -->
        <div class="articles-tabs mb-4 animate-on-scroll">
            <button class="tab-btn active" onclick="filterArticles('all', this)">Semua</button>
            <button class="tab-btn" onclick="filterArticles('trending', this)">Trending</button>
            <button class="tab-btn" onclick="filterArticles('terbaru', this)">Terbaru</button>
        </div>

        <!-- Articles Grid -->
        <div class="row g-4" id="articles-grid">
            @forelse($artikel as $i => $a)
                <div class="col-12 col-md-6 col-lg-4 animate-on-scroll delay-{{ ($i % 3) + 1 }}" data-category="{{ $a->category }}">
                    <a href="{{ route('artikel.show', $a->slug) }}" class="text-decoration-none">
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
                                <div class="article-meta mb-2">
                                    <small style="color: #7a746f;">
                                        <i class="bi bi-person me-1"></i>{{ $a->author ?? 'Admin' }}
                                        <span class="mx-2">•</span>
                                        <i class="bi bi-calendar me-1"></i>{{ \Carbon\Carbon::parse($a->published_at)->format('d M Y') }}
                                    </small>
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
                    <p style="color: #7a746f;"> Mulai dengan <a href="{{ route('admin.artikel.create') }}" style="color: #545350; font-weight: 600;">menambah artikel baru</a>.</p>
                </div>
            @endforelse
        </div>

    </div>
</main>
@endsection

@push('styles')
<style>
    .article-card {
        background: #fff;
        border-radius: 12px;
        overflow: hidden;
        border: 1px solid #e6e0da;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        display: flex;
        flex-direction: column;
    }
    .article-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 24px rgba(0,0,0,0.08);
    }
    .article-img {
        position: relative;
        height: 200px;
        overflow: hidden;
    }
    .article-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }
    .article-card:hover .article-img img {
        transform: scale(1.05);
    }
    .article-badge {
        position: absolute;
        top: 12px;
        left: 12px;
        background: #efece5;
        color: #2b2b2b;
        font-size: 11px;
        font-weight: 700;
        padding: 4px 10px;
        border-radius: 20px;
        z-index: 1;
        letter-spacing: 0.5px;
    }
    .article-body {
        padding: 20px;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }
    .article-meta small {
        font-size: 12px;
    }
    .article-title {
        font-size: 16px;
        font-weight: 700;
        color: #2b2b2b;
        margin-bottom: 8px;
        line-height: 1.4;
    }
    .article-excerpt {
        font-size: 13px;
        color: #7a746f;
        line-height: 1.6;
        margin-bottom: auto;
        flex-grow: 1;
    }
    .article-link {
        font-size: 12px;
        font-weight: 700;
        color: #545350;
        letter-spacing: 0.5px;
        display: inline-flex;
        align-items: center;
        gap: 4px;
        margin-top: 12px;
        transition: gap 0.2s ease;
    }
    .article-card:hover .article-link {
        gap: 8px;
    }
    .articles-tabs {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
    }
    .tab-btn {
        background: #efece5;
        color: #7a746f;
        border: none;
        border-radius: 20px;
        padding: 8px 20px;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s ease;
    }
    .tab-btn:hover,
    .tab-btn.active {
        background: #2b2b2b;
        color: #fff;
    }
</style>
@endpush

@push('scripts')
<script>
    function filterArticles(category, btn) {
        document.querySelectorAll('.tab-btn').forEach(t => t.classList.remove('active'));
        btn.classList.add('active');

        document.querySelectorAll('#articles-grid [data-category]').forEach(card => {
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
