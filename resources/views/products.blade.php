<!DOCTYPE html>
<html lang="sk">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>{{ $pageTitle }} — trickohouse</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Irish+Grover&family=Nunito:wght@400;600;700;900&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/filter.css') }}" />
</head>
<body>

  @include('include.header')

  <main>
    <div class="container">

      <!-- ===== LISTING WRAPPER ===== -->
      <div class="listing-wrapper">

        <!-- FULL-WIDTH HEADER BAR -->
        <div class="listing-header">
          <span class="listing-header__count">
            @php
              $c = count($products);
              $label = $c === 1 ? 'produkt' : ($c < 5 ? 'produkty' : 'produktov');
            @endphp
            {{ $c }} {{ $label }}
            @if ($mode === 'featured')
              &mdash; odporúčané
            @elseif ($mode === 'category' && $selectedCategory)
              &mdash; {{ $selectedCategory['name'] }}
            @elseif ($mode === 'search' && $searchQuery)
              &mdash; „{{ $searchQuery }}"
            @endif
          </span>

          <div class="products-filters-wrapper">
            <form class="listing-header__search sec-nav__search"
                  data-search-base="{{ url('/produkty/hladat') }}"
                  action="#"
                  onsubmit="return false;">
              <input type="text"
                     placeholder="Hľadať produkty..."
                     aria-label="Hľadať v produktoch"
                     value="{{ $searchQuery ?? '' }}" />
              <button type="submit" aria-label="Search">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
                </svg>
              </button>
            </form>

            <div class="sort-control">
              <label for="sortSelect">Zoradiť:</label>
              <select id="sortSelect">
                <option value="default">Odporúčané</option>
                <option value="price-asc">Cena: od najnižšej</option>
                <option value="price-desc">Cena: od najvyššej</option>
              </select>
            </div>
          </div>
        </div>

        <!-- SIDEBAR + GRID -->
        <div class="listing-body">

          <!-- ===== FILTER SIDEBAR ===== -->
          {{-- Filters post to current URL so category/search context is preserved --}}
          <form class="filter-sidebar" method="GET" action="{{ request()->url() }}">

            @if ($mode === 'category' && $selectedCategory)
              {{-- Show the active category as a badge with a clear link --}}
              <div class="filter-active-category">
                <span class="filter-active-category__label">{{ $selectedCategory['name'] }}</span>
                <a href="{{ route('products.all') }}"
                   class="filter-active-category__clear"
                   aria-label="Zrušiť filter kategórie">
                  <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
                  </svg>
                </a>
              </div>
            @else
              {{-- Category navigation links — clicking navigates to /produkty/kategoria/{slug} --}}
              <div class="filter-group">
                <h3 class="filter-group__title">Kategória</h3>
                <ul class="filter-group__list">
                  @foreach ($categories as $cat)
                    <li>
                      <a href="{{ route('products.category', $cat['slug']) }}"
                         class="filter-category-link">
                        <span class="filter-checkbox__label">{{ $cat['name'] }}</span>
                        <span class="filter-checkbox__count">({{ $cat['count'] }})</span>
                      </a>
                    </li>
                  @endforeach
                </ul>
              </div>
            @endif

            <!-- Size filter -->
            <div class="filter-group">
              <h3 class="filter-group__title">Veľkosť</h3>
              <ul class="filter-group__list">
                @foreach ($sizes as $size)
                  @php $sizeVal = strtolower($size); @endphp
                  <li>
                    <label class="filter-checkbox">
                      <input type="checkbox" name="sizes[]" value="{{ $sizeVal }}"
                             {{ in_array($sizeVal, (array) ($activeFilters['sizes'] ?? [])) ? 'checked' : '' }} />
                      <span class="filter-checkbox__box"></span>
                      <span class="filter-checkbox__label">{{ $size }}</span>
                    </label>
                  </li>
                @endforeach
              </ul>
            </div>

            <!-- Color filter -->
            <div class="filter-group">
              <h3 class="filter-group__title">Farba</h3>
              <ul class="filter-group__list">
                @foreach ($colors as $color)
                  <li>
                    <label class="filter-checkbox">
                      <input type="checkbox" name="colors[]" value="{{ $color['value'] }}"
                             {{ in_array($color['value'], (array) ($activeFilters['colors'] ?? [])) ? 'checked' : '' }} />
                      <span class="filter-checkbox__box"></span>
                      <span class="filter-checkbox__label">{{ $color['label'] }}</span>
                    </label>
                  </li>
                @endforeach
              </ul>
            </div>

            <!-- Price range filter -->
            <div class="filter-group">
              <h3 class="filter-group__title">Cena do</h3>
              <div class="filter-range">
                <div class="filter-range__value">
                  <span id="priceMaxDisplay">{{ $activeFilters['price_max'] ?? 100 }}€</span>
                </div>
                <input type="range" id="priceMax" name="price_max"
                       class="filter-range__slider"
                       min="0" max="100" step="1"
                       value="{{ $activeFilters['price_max'] ?? 100 }}" />
              </div>
            </div>

          </form><!-- /.filter-sidebar -->

          <!-- ===== PRODUCTS GRID ===== -->
          <div class="products-listing">

            @forelse ($products as $product)
              <a href="{{ route('product.detail', $product['id']) }}" class="product-card product-card--grid">
                <button class="wishlist-btn" aria-label="Add to wishlist"
                        onclick="event.preventDefault(); event.stopPropagation();">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
                </button>

                @if ($product['sale_percent'])
                  <span class="badge badge--sale">-{{ $product['sale_percent'] }}%</span>
                @endif

                <div class="product-card__img {{ $product['img_class'] }}"></div>
                <p class="product-card__name">{{ $product['name'] }}</p>
                <p class="product-card__price">
                  @if ($product['original_price'])
                    <span class="product-card__price--original">{{ number_format($product['original_price'], 2) }}€</span>
                  @endif
                  {{ number_format($product['price'], 2) }}€
                </p>
              </a>
            @empty
              <div class="products-listing__empty">
                <p>Žiadne produkty sa nezhodujú s vašimi filtrami.</p>
                <a href="{{ route('products.all') }}" class="btn btn--outline">Zobraziť všetky</a>
              </div>
            @endforelse

          </div><!-- /.products-listing -->

        </div><!-- /.listing-body -->
      </div><!-- /.listing-wrapper -->

    </div><!-- /.container -->
  </main>

  <!-- ===== FOOTER ===== -->
  <footer class="footer">
    <div class="container footer__inner">

      <div class="footer__logo">trickohouse</div>

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

</body>
</html>
