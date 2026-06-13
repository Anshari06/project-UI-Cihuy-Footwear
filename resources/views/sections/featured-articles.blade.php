<section id="featured-articles">
  <div class="container">
    <div class="section-heading animate-on-scroll">
      <h2>ARTIKEL PILIHAN</h2>
      <p>Tips memilih sepatu sesuai aktivitas dan bentuk kaki.</p>
      <a href="{{ route('artikel.index') }}" class="btn btn-sm mt-2" style="background: #545350; color: #fff; border-radius: 8px; font-size: 12px; font-weight: 600; padding: 6px 20px;">
        LIHAT SEMUA <i class="bi bi-arrow-right ms-1"></i>
      </a>
    </div>

    <div class="articles-tabs">
      <button class="tab-btn active" onclick="filterArticles('all', this)">Semua</button>
      <button class="tab-btn" onclick="filterArticles('trending', this)">Trending</button>
    </div>

    <div class="row g-4" id="articles-grid">
      @forelse($artikel as $i => $a)
        <div class="col-12 col-md-6 col-lg-3 animate-on-scroll delay-{{ $i + 1 }}" data-category="{{ $a->category }}">
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
              <a href="{{ route('artikel.show', $a->slug) }}" class="article-link">
                LIHAT SEMUA
                <i class="bi bi-arrow-right"></i>
              </a>
            </div>
          </div>
        </div>
      @empty
        <div class="col-12 text-center py-5 text-muted">
          <p>Belum ada artikel. <a href="{{ route('admin.artikel.create') }}">Tambah artikel pertama</a></p>
        </div>
      @endforelse
    </div>
  </div>
</section>

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