<!DOCTYPE html>
<html lang="sk">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>trickohouse — Zoznam produktov</title>
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

        <!-- FULL-WIDTH HEADER -->
        <div class="listing-header">
  <span class="listing-header__count">4 produkty</span>

  <div class="products-filters-wrapper">
    <div class="listing-header__search sec-nav__search">
      <input type="text" placeholder="L Tričko" aria-label="Hľadať v produktoch" />
      <button aria-label="Search">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
        </svg>
      </button>
    </div>

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

        <!-- SIDEBAR + GRID ROW -->
        <div class="listing-body">

          <!-- SIDEBAR FILTER -->
          <aside class="filter-sidebar">

            <div class="filter-group">
              <h3 class="filter-group__title">Kategória</h3>
              <ul class="filter-group__list">
                <li>
                  <label class="filter-checkbox">
                    <input type="checkbox" name="category" value="uzasne" checked />
                    <span class="filter-checkbox__box"></span>
                    <span class="filter-checkbox__label">Úžasné</span>
                    <span class="filter-checkbox__count">(20)</span>
                  </label>
                </li>
                <li>
                  <label class="filter-checkbox">
                    <input type="checkbox" name="category" value="mega" />
                    <span class="filter-checkbox__box"></span>
                    <span class="filter-checkbox__label">Mega</span>
                    <span class="filter-checkbox__count">(20)</span>
                  </label>
                </li>
              </ul>
            </div>

            <div class="filter-group">
              <h3 class="filter-group__title">Veľkosť</h3>
              <ul class="filter-group__list">
                <li>
                  <label class="filter-checkbox">
                    <input type="checkbox" name="size" value="m" />
                    <span class="filter-checkbox__box"></span>
                    <span class="filter-checkbox__label">M</span>
                    <span class="filter-checkbox__count">(20)</span>
                  </label>
                </li>
                <li>
                  <label class="filter-checkbox">
                    <input type="checkbox" name="size" value="l" checked />
                    <span class="filter-checkbox__box"></span>
                    <span class="filter-checkbox__label">L</span>
                    <span class="filter-checkbox__count">(20)</span>
                  </label>
                </li>
              </ul>
            </div>

            <div class="filter-group">
              <h3 class="filter-group__title">Farba</h3>
              <ul class="filter-group__list">
                <li>
                  <label class="filter-checkbox">
                    <input type="checkbox" name="color" value="biela" checked />
                    <span class="filter-checkbox__box"></span>
                    <span class="filter-checkbox__label">Biela</span>
                    <span class="filter-checkbox__count">(20)</span>
                  </label>
                </li>
                <li>
                  <label class="filter-checkbox">
                    <input type="checkbox" name="color" value="cierna" checked />
                    <span class="filter-checkbox__box"></span>
                    <span class="filter-checkbox__label">Čierna</span>
                    <span class="filter-checkbox__count">(20)</span>
                  </label>
                </li>
              </ul>
            </div>

          </aside>

          <!-- PRODUCTS GRID -->
          <div class="products-listing">

            <a href="productDetail.html" class="product-card product-card--grid">
              <button class="wishlist-btn" aria-label="Add to wishlist"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg></button>
              <div class="product-card__img product-card__img--shirt-white"></div>
              <p class="product-card__name">TrickoHouse core</p>
              <p class="product-card__price">24.99€</p>
            </a>

            <a href="productDetail.html" class="product-card product-card--grid">
              <button class="wishlist-btn" aria-label="Add to wishlist"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg></button>
              <span class="badge badge--sale">-15%</span>
              <div class="product-card__img product-card__img--hoodie-black"></div>
              <p class="product-card__name">Hoodie</p>
              <p class="product-card__price">59.99€</p>
            </a>

            <a href="productDetail.html" class="product-card product-card--grid">
              <button class="wishlist-btn" aria-label="Add to wishlist"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg></button>
              <div class="product-card__img product-card__img--shirt-white"></div>
              <p class="product-card__name">TrickoHouse Sport</p>
              <p class="product-card__price">29.99€</p>
            </a>

            <a href="productDetail.html" class="product-card product-card--grid">
              <button class="wishlist-btn" aria-label="Add to wishlist"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg></button>
              <span class="badge badge--sale">-20%</span>
              <div class="product-card__img product-card__img--tote"></div>
              <p class="product-card__name">TrickoHouse biele</p>
              <p class="product-card__price">24.99€</p>
            </a>

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

  <script src="assets/nav.js" defer></script>
</body>
</html>