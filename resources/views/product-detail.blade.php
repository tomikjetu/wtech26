<!DOCTYPE html>
<html lang="sk">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>{{ $product->name }} - trickohouse</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Irish+Grover&family=Nunito:wght@400;600;700;900&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/productDetail.css') }}" />
</head>
<body>

  @include('include.header')
<main>

    <section class="section product-detail">
      <div class="container">
        <div class="product-detail__inner">
          
          <div class="product-detail__image">
            <div class="product-detail__img product-detail__img--shirt-white"></div>
            <div class="product-detail__thumbnails">
              <div class="product-detail__thumbnail active product-detail__img--shirt-white"></div>
              <div class="product-detail__thumbnail product-detail__img--shirt-white"></div>
              <div class="product-detail__thumbnail product-detail__img--shirt-white"></div>
            </div>
          </div>

          <div class="product-detail__info">
            <h1 class="product-detail__title">{{ $product->name }}</h1>
            <p class="product-detail__description">{{ $product->description }}</p>

            <div class="product-detail__sizes">
              <label class="product-detail__sizes-label">Veľkosť</label>
              <div class="product-detail__sizes-options">
                @foreach ($product->sizes as $i => $size)
                    <button class="product-detail__size {{ $i === 0 ? 'active' : '' }}" 
                            onclick="selectSize(this)"
                            data-size-id="{{ $size->id }}">{{ $size->name }}</button>
                @endforeach
              </div>
            </div>

            <form method="POST" action="{{ route('cart.add') }}">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="hidden" id="selectedSize" name="size_id" value="{{ $product->sizes->first()?->id }}">

                <div class="product-detail__quantity">
                    <label class="product-detail__sizes-label">Množstvo</label>
                    <div class="cart-item__quantity">
                        <button type="button" class="quantity-btn" onclick="changeQty(-1)">-</button>
                        <input type="number" id="quantityInput" name="quantity" value="1" min="1" style="width:40px;text-align:center;border:none;">
                        <button type="button" class="quantity-btn" onclick="changeQty(1)">+</button>
                    </div>
                </div>

                <div class="product-detail__footer">
                    @if ($product->sale_percent > 0)
                        <div class="product-detail__price product-detail__price--discount">
                            <span class="product-detail__price-label">Cena</span>
                            <div class="product-detail__price-values">
                                <span class="product-detail__price-original">{{ number_format($product->price, 2) }}€</span>
                                <span class="product-detail__price-value">{{ number_format($product->price * (1 - $product->sale_percent / 100), 2) }}€</span>
                            </div>
                        </div>
                    @else
                        <div class="product-detail__price">
                            <span class="product-detail__price-label">Cena</span>
                            <div class="product-detail__price-values">
                                <span class="product-detail__price-value">{{ number_format($product->price, 2) }}€</span>
                            </div>
                        </div>
                    @endif
                    <button type="submit" class="btn btn--teal">Pridať do košíka</button>
                </div>
            </form>
          </div>

        </div>
      </div>
    </section>

    <section class="section">
      <div class="container">
        <h2 class="section__subtitle">Podobné produkty</h2>
        <div class="carousel-wrapper">
          <button class="carousel-btn carousel-btn--prev" aria-label="Previous">&#8249;</button>
          <div class="products-carousel" id="similarCarousel">
            @php
                $similar = App\Models\Product::where('category_id', $product->category_id)
                    ->where('id', '!=', $product->id)
                    ->take(5)
                    ->get();
            @endphp
            @foreach ($similar as $s)
                <a href="{{ route('product.detail', $s->id) }}" class="product-card">
                    <button class="wishlist-btn" aria-label="Add to wishlist" onclick="event.preventDefault(); event.stopPropagation();">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
                    </button>
                    @if ($s->sale_percent)
                        <span class="badge badge--sale">-{{ $s->sale_percent }}%</span>
                    @endif
                    <div class="product-card__img product-card__img--shirt-white"></div>
                    <p class="product-card__name">{{ $s->name }}</p>
                    <p class="product-card__price">{{ number_format($s->price, 2) }}€</p>
                </a>
            @endforeach
          </div>
          <button class="carousel-btn carousel-btn--next" aria-label="Next">&#8250;</button>
        </div>
      </div>
    </section>

  </main>

  <footer class="footer">
    <div class="container footer__inner">
      <div class="footer__logo">
        <a href="/" class="footer__logo-link">trickohouse</a>
      </div>
      <div class="footer__cols">
        <div class="footer__col">
          <h3>Zásady používania</h3>
          <ul>
            <li><a href="#">Cookies</a></li>
            <li><a href="#">Terms &amp; Conditions</a></li>
            <li><a href="#">Privacy Policy</a></li>
          </ul>
        </div>
        <div class="footer__col">
          <h3>Sociálne siete</h3>
          <div class="footer__socials">
            <a href="#" aria-label="Instagram">
              <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
            </a>
            <a href="#" aria-label="Facebook">
              <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
            </a>
          </div>
        </div>
        <div class="footer__col">
          <h3>Kontakty</h3>
          <a href="mailto:tricka@trickohouse.sk" class="footer__email">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
            tricka@trickohouse.sk
          </a>
        </div>
      </div>
      <div class="footer__bottom">
        <p>Trickohouse WTECH 2026</p>
      </div>
    </div>
  </footer>

  <script src="{{ asset('js/nav.js') }}" defer></script>
  <script src="{{ asset('js/productDetail.js') }}" defer></script>

</body>
</html>