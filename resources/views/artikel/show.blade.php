@extends('layouts.app')

@section('content')
@include('sections.header')
<main class="w-100" style="padding-top: 50px;">
  <section class="py-5">
    <div class="container" style="max-width: 800px;">
      <!-- Breadcrumb -->
      <nav aria-label="breadcrumb" class="mb-4 d-flex align-items-center">
        <a href="{{ route('artikel.index') }}" class="me-2" style="color: #7a746f; font-size: 18px; text-decoration: none;">
          <i class="bi bi-arrow-left"></i>
        </a>
        <ol class="breadcrumb mb-0" style="background: transparent;">
          <li class="breadcrumb-item"><a href="{{ route('landing') }}" class="text-decoration-none" style="color: #7a746f;">Home</a></li>
          <li class="breadcrumb-item"><a href="{{ route('artikel.index') }}" class="text-decoration-none" style="color: #7a746f;">Artikel</a></li>
          <li class="breadcrumb-item active" aria-current="page" style="color: #2b2b2b;">{{ $artikel->title }}</li>
        </ol>
      </nav>

      <!-- Article Header -->
      <div class="text-center mb-4">
        <span class="badge mb-3" style="background: {{ $artikel->category === 'trending' ? '#2b2b2b' : '#efece5' }}; color: {{ $artikel->category === 'trending' ? '#fff' : '#545350' }}; font-size: 12px; font-weight: 600; padding: 6px 16px; border-radius: 20px;">
          {{ $artikel->category === 'trending' ? 'Trending' : 'Terbaru' }}
        </span>
        <h1 class="mb-3" style="font-size: 2rem; font-weight: 800; color: #2b2b2b; line-height: 1.3;">{{ $artikel->title }}</h1>
        <div class="d-flex justify-content-center align-items-center gap-3 text-muted" style="font-size: 14px;">
          @if($artikel->author)
            <span><i class="bi bi-person me-1"></i>{{ $artikel->author }}</span>
          @endif
          @if($artikel->published_at)
            <span><i class="bi bi-calendar me-1"></i>{{ $artikel->published_at->format('d M Y') }}</span>
          @endif
        </div>
      </div>

      <!-- Article Image -->
      @if($artikel->image)
        <div class="mb-4 text-center">
          <img src="{{ $artikel->image }}" alt="{{ $artikel->title }}" style="width: 100%; max-height: 420px; object-fit: cover; border-radius: 12px;">
        </div>
      @endif

      <!-- Article Content -->
      <div style="font-size: 16px; line-height: 1.8; color: #2b2b2b; text-align: justify;">
        {!! nl2br(e($artikel->content)) !!}
      </div>

      <!-- Share -->
      <div class="mt-5 pt-4 border-top">
        <p class="mb-2" style="font-size: 14px; font-weight: 600; color: #7a746f;">SHARE</p>
        <div class="d-flex gap-2">
          <a href="https://twitter.com/intent/tweet?text={{ urlencode($artikel->title) }}" target="_blank" class="btn btn-sm" style="background: #efece5; color: #2b2b2b; border-radius: 6px; font-size: 13px;">
            <i class="bi bi-twitter-x"></i>
          </a>
          <a href="https://wa.me/?text={{ urlencode($artikel->title . ' - ' . url()->current()) }}" target="_blank" class="btn btn-sm" style="background: #efece5; color: #2b2b2b; border-radius: 6px; font-size: 13px;">
            <i class="bi bi-whatsapp"></i>
          </a>
        </div>
      </div>
    </div>
  </section>

  <!-- Related Articles -->
  @if($related->isNotEmpty())
  <section class="py-5" style="background: #faf9f7;">
    <div class="container">
      <h3 class="mb-4" style="font-size: 1.25rem; font-weight: 700; color: #2b2b2b;">ARTIKEL LAINNYA</h3>
      <div class="row g-4">
        @foreach($related as $r)
          <div class="col-12 col-md-4">
            <a href="{{ route('artikel.show', $r->slug) }}" class="text-decoration-none">
              <div class="article-card h-100">
                <div class="article-img">
                  <span class="article-badge">{{ $r->category === 'trending' ? 'Trending' : 'Terbaru' }}</span>
                  @if($r->image)
                    <img src="{{ $r->image }}" alt="{{ $r->title }}">
                  @else
                    <img src="https://images.unsplash.com/photo-1608258851526-1c3a29e0f3a7?w=600&h=400&fit=crop" alt="{{ $r->title }}">
                  @endif
                </div>
                <div class="article-body">
                  <h5 class="article-title">{{ $r->title }}</h5>
                  <p class="article-excerpt">{{ Str::limit(strip_tags($r->content), 60) }}</p>
                  <span class="article-link">
                    BACA SELENGKAPNYA
                    <i class="bi bi-arrow-right"></i>
                  </span>
                </div>
              </div>
            </a>
          </div>
        @endforeach
      </div>
    </div>
  </section>
  @endif
</main>
@endsection
