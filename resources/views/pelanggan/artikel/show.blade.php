@extends('layouts.app')

@section('content')
<main class="w-100" style="background: #faf9f7; min-height: 100vh;">
    <div class="container py-5">

        <!-- Back Button -->
        <button onclick="history.back()" class="btn mb-4 animate-on-scroll"
            style="background: #efece5; color: #2b2b2b; border: none; border-radius: 8px; font-size: 13px; font-weight: 600; padding: 8px 16px;">
            <i class="bi bi-arrow-left me-1"></i> Kembali
        </button>

        <div class="row justify-content-center">
            <div class="col-lg-8">

                <!-- Article Header -->
                <div class="mb-4 animate-on-scroll">
                    <span class="article-category-badge">{{ $artikel->category === 'trending' ? 'Trending' : 'Terbaru' }}</span>
                    <h1 class="fw-bold mt-3 mb-3" style="color: #2b2b2b; font-size: 32px; line-height: 1.3;">{{ $artikel->title }}</h1>
                    <div class="article-meta">
                        <span><i class="bi bi-person me-1"></i>{{ $artikel->author ?? 'Admin' }}</span>
                        <span class="mx-3">•</span>
                        <span><i class="bi bi-calendar me-1"></i>{{ \Carbon\Carbon::parse($artikel->published_at)->format('d M Y') }}</span>
                    </div>
                </div>

                <!-- Cover Image -->
                <div class="article-cover mb-5 animate-on-scroll">
                    @if($artikel->image)
                        <img src="{{ $artikel->image }}" alt="{{ $artikel->title }}"
                            style="width: 100%; border-radius: 16px; object-fit: cover; max-height: 450px;">
                    @else
                        <img src="https://images.unsplash.com/photo-1608258851526-1c3a29e0f3a7?w=900&h=450&fit=crop" alt="{{ $artikel->title }}"
                            style="width: 100%; border-radius: 16px; object-fit: cover; max-height: 450px;">
                    @endif
                </div>

                <!-- Article Content -->
                <div class="article-content animate-on-scroll">
                    {!! $artikel->content !!}
                </div>

                <!-- Share / Back CTA -->
                <div class="article-cta mt-5 pt-4 animate-on-scroll" style="border-top: 1px solid #e6e0da;">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                        <a href="{{ route('artikel.index') }}" class="btn" style="background: #efece5; color: #2b2b2b; border-radius: 8px; font-weight: 600; padding: 10px 20px;">
                            <i class="bi bi-arrow-left me-1"></i> Semua Artikel
                        </a>
                        <div class="share-label" style="color: #7a746f; font-size: 13px;">
                            Bagikan: <i class="bi bi-twitter-x ms-2" style="cursor: pointer;"></i>
                            <i class="bi bi-facebook ms-2" style="cursor: pointer;"></i>
                            <i class="bi bi-instagram ms-2" style="cursor: pointer;"></i>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Related Articles -->
        @if($related->count() > 0)
        <div class="mt-5 pt-4">
            <h4 class="fw-bold mb-4 animate-on-scroll" style="color: #2b2b2b;">Artikel Terkait</h4>
            <div class="row g-4">
                @foreach($related as $r)
                    <div class="col-md-4 animate-on-scroll">
                        <a href="{{ route('artikel.show', $r->slug) }}" class="text-decoration-none">
                            <div class="related-card">
                                <div class="related-img">
                                    @if($r->image)
                                        <img src="{{ $r->image }}" alt="{{ $r->title }}">
                                    @else
                                        <img src="https://images.unsplash.com/photo-1608258851526-1c3a29e0f3a7?w=400&h=250&fit=crop" alt="{{ $r->title }}">
                                    @endif
                                </div>
                                <div class="related-body">
                                    <span class="related-badge">{{ $r->category === 'trending' ? 'Trending' : 'Terbaru' }}</span>
                                    <h6 class="related-title">{{ $r->title }}</h6>
                                    <small style="color: #7a746f;">{{ \Carbon\Carbon::parse($r->published_at)->format('d M Y') }}</small>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
        @endif

    </div>
</main>
@endsection

@push('styles')
<style>
    .article-category-badge {
        display: inline-block;
        background: #efece5;
        color: #2b2b2b;
        font-size: 12px;
        font-weight: 700;
        padding: 5px 14px;
        border-radius: 20px;
        letter-spacing: 0.5px;
    }
    .article-meta {
        font-size: 13px;
        color: #7a746f;
        display: flex;
        align-items: center;
        flex-wrap: wrap;
    }
    .article-content {
        font-size: 15px;
        line-height: 1.8;
        color: #2b2b2b;
    }
    .article-content p {
        margin-bottom: 1.2rem;
    }
    .article-content h2,
    .article-content h3 {
        color: #2b2b2b;
        margin-top: 2rem;
        margin-bottom: 1rem;
    }
    .article-content img {
        max-width: 100%;
        border-radius: 8px;
        margin: 1rem 0;
    }
    .article-content ul,
    .article-content ol {
        padding-left: 1.5rem;
        margin-bottom: 1.2rem;
    }
    .article-content blockquote {
        border-left: 4px solid #e6e0da;
        padding-left: 1.2rem;
        color: #7a746f;
        font-style: italic;
        margin: 1.5rem 0;
    }
    .related-card {
        background: #fff;
        border-radius: 12px;
        overflow: hidden;
        border: 1px solid #e6e0da;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .related-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 24px rgba(0,0,0,0.08);
    }
    .related-img {
        height: 150px;
        overflow: hidden;
    }
    .related-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }
    .related-card:hover .related-img img {
        transform: scale(1.05);
    }
    .related-body {
        padding: 16px;
    }
    .related-badge {
        display: inline-block;
        background: #efece5;
        color: #2b2b2b;
        font-size: 10px;
        font-weight: 700;
        padding: 3px 8px;
        border-radius: 20px;
        letter-spacing: 0.5px;
        margin-bottom: 6px;
    }
    .related-title {
        font-size: 14px;
        font-weight: 700;
        color: #2b2b2b;
        line-height: 1.4;
        margin-bottom: 4px;
    }
</style>
@endpush
