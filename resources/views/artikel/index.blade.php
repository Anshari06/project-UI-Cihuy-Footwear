@extends('layouts.app')

@section('content')
<main class="w-100">
  <section class="py-5" style="background: #faf9f7;">
    <div class="container">
      <div class="text-center mb-5">
        <h2 class="section-title">ARTIKEL KAMI</h2>
        <p class="text-muted">Tips dan panduan seputar sepatu untuk setiap aktivitasmu.</p>
      </div>

      <div class="row g-4">
        @forelse($artikel as $i => $a)
          <div class="col-12 col-md-6 col-lg-3">
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
                  <h5 class="article-title">{{ $a->title }}</h5>
                  <p class="article-excerpt">{{ Str::limit(strip_tags($a->content), 80) }}</p>
                  <span class="article-link">
                    BACA SELENGKAPNYA
                    <i class="bi bi-arrow-right"></i>
                  </span>
                </div>
              </div>
            </a>
          </div>
        @empty
          <div class="col-12 text-center py-5 text-muted">
            <p>Belum ada artikel.</p>
          </div>
        @endforelse
      </div>
    </div>
  </section>
</main>
@endsection
