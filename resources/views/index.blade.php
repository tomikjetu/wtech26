<!DOCTYPE html>
<html lang="sk">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>trickohouse</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Irish+Grover&family=Nunito:wght@400;600;700;900&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
</head>
<body>

  @include('include.header')
<main>

    <!-- ===== HERO ===== -->
    <section class="hero">
      <div class="container hero__inner">
        <div class="hero__content">
          <h1 class="hero__title">KÚP SI NAŠE PREKLIATE TRIČKO</h1>
          <a href="#" class="btn btn--teal">IDEM DO TOHO</a>
        </div>
        <div class="hero__brand-tag">Trickohouse</div>
      </div>
    </section>

    <!-- ===== CATEGORIES ===== -->
    <section class="section categories">
      <div class="container">
        <h2 class="section__title">KATEGÓRIE</h2>
        <div class="categories__grid">
          <a href="/produkty" class="category-card">
            <div class="category-card__img category-card__img--muzi"></div>
            <span>MUŽI</span>
          </a>
          <a href="/produkty" class="category-card">
            <div class="category-card__img category-card__img--zeny"></div>
            <span>ŽENY</span>
          </a>
          <a href="/produkty" class="category-card">
            <div class="category-card__img category-card__img--oblecenie"></div>
            <span>OBLEČENIE</span>
          </a>
          <a href="/produkty" class="category-card">
            <div class="category-card__img category-card__img--topanky"></div>
            <span>TOPÁNKY</span>
          </a>
          <a href="/produkty" class="category-card">
            <div class="category-card__img category-card__img--vypredaj"></div>
            <span>VÝPREDAJ</span>
          </a>
          <a href="/produkty" class="category-card">
            <div class="category-card__img category-card__img--doplnky"></div>
            <span>DOPLNKY</span>
          </a>
        </div>
      </div>
    </section>

    <!-- ===== FEATURED PRODUCTS ===== -->
    <section class="section products-row">
      <div class="container">
        <h2 class="section__subtitle">Charakteristické</h2>
        <div class="carousel-wrapper">
          <button class="carousel-btn carousel-btn--prev" aria-label="Previous">&#8249;</button>
          <div class="products-carousel" id="featuredCarousel">
              @foreach($products as $product)
                  @include('include.product-card')
              @endforeach
          </div>
          <button class="carousel-btn carousel-btn--next" aria-label="Next">&#8250;</button>
        </div>
      </div>
    </section>

    <!-- ===== SALE PRODUCTS ===== -->
    <section class="section products-row">
      <div class="container">
        <h2 class="section__subtitle">Zľavy</h2>
        <div class="carousel-wrapper">
          <button class="carousel-btn carousel-btn--prev" aria-label="Previous">&#8249;</button>
          <div class="products-carousel" id="saleCarousel">

            <div class="product-card">
              <button class="wishlist-btn" aria-label="Add to wishlist"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg></button>
              <span class="badge badge--sale">-15%</span>
              <div class="product-card__img product-card__img--shirt-white"></div>
              <p class="product-card__name">TrickoHouse core</p>
              <p class="product-card__price">24.99€</p>
            </div>

            <div class="product-card">
              <button class="wishlist-btn" aria-label="Add to wishlist"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg></button>
              <span class="badge badge--sale">-15%</span>
              <div class="product-card__img product-card__img--hoodie-black"></div>
              <p class="product-card__name">Hoodie</p>
              <p class="product-card__price">59.99€</p>
            </div>

            <div class="product-card">
              <button class="wishlist-btn" aria-label="Add to wishlist"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg></button>
              <span class="badge badge--sale">-15%</span>
              <div class="product-card__img product-card__img--cap-white"></div>
              <p class="product-card__name">Cap</p>
              <p class="product-card__price">24.99€</p>
            </div>

            <div class="product-card">
              <button class="wishlist-btn" aria-label="Add to wishlist"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg></button>
              <span class="badge badge--sale">-15%</span>
              <div class="product-card__img product-card__img--backpack-black"></div>
              <p class="product-card__name">Backpack</p>
              <p class="product-card__price">54.99€</p>
            </div>

            <div class="product-card">
              <button class="wishlist-btn" aria-label="Add to wishlist"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg></button>
              <span class="badge badge--sale">-15%</span>
              <div class="product-card__img product-card__img--tote"></div>
              <p class="product-card__name">Tote CarryAll</p>
              <p class="product-card__price">24.99€</p>
            </div>

          </div>
          <button class="carousel-btn carousel-btn--next" aria-label="Next">&#8250;</button>
        </div>
      </div>
    </section>

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

  <script>
    document.querySelectorAll('.carousel-wrapper').forEach(wrapper => {
      const carousel = wrapper.querySelector('.products-carousel');
      wrapper.querySelector('.carousel-btn--next').addEventListener('click', () => {
        carousel.scrollBy({ left: 220, behavior: 'smooth' });
      });
      wrapper.querySelector('.carousel-btn--prev').addEventListener('click', () => {
        carousel.scrollBy({ left: -220, behavior: 'smooth' });
      });
    });
  </script>
  <script src="{{ asset('js/nav.js') }}" defer></script>
</body>
</html>