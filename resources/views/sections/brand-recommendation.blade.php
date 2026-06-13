<section id="brand-recommendation">
  <div class="container">
    <div class="section-heading animate-on-scroll">
      <h2>BRAND RECOMMENDATION PACK</h2>
      <p>Choose leather so it's stylish to wear.</p>
    </div>

    <div class="brand-grid">
      @php
        $brands = [
          [
            'img' => 'images/cihuy/brand-recommendation (1).png',
            'title' => 'Get The Timeless Style, Your Partner In Every Moment',
            'cta' => 'Get Yours',
          ],
          [
            'img' => 'images/cihuy/brand-recommendation (2).png',
            'title' => 'Best Partner For You To Get Performance And Love Trail',
            'cta' => 'Get Yours',
          ],
          [
            'img' => 'images/cihuy/brand-recommendation (3).png',
            'title' => 'Adventure And Durability, You Get The Power',
            'cta' => 'Get Yours',
          ],
          [
            'img' => 'images/cihuy/redwings_moctoe.png',
            'title' => 'Your Shoes Is Your Partner',
            'cta' => 'Find More',
          ],
        ];
      @endphp

      @foreach($brands as $index => $brand)
        @php
          $imgUrl = asset(str_replace(' ', '%20', $brand['img']));
        @endphp
        <div class="brand-card animate-on-scroll delay-{{ $index + 1 }}">
          <img src="{{ $imgUrl }}" alt="{{ $brand['title'] }}">
          <div class="card-overlay">
            <p class="card-title">{{ $brand['title'] }}</p>
            @if($brand['cta'] === 'Get Yours')
              <a href="{{ route('collection') }}" class="card-btn">{{ $brand['cta'] }}</a>
            @else
              <a href="{{ route('collection') }}" class="card-btn card-btn-outline">{{ $brand['cta'] }}</a>
            @endif
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>