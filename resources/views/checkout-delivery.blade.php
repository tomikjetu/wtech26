<!DOCTYPE html>
<html lang="sk">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Doprava - trickohouse</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Irish+Grover&family=Nunito:wght@400;600;700;900&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="styles/style.css" />
  <link rel="stylesheet" href="styles/checkout.css" />
</head>
<body>

  <!-- ===== TOP NAV ===== -->
  <header class="top-nav">
    <div class="container top-nav__inner">

      <nav class="top-nav__links">
        <a href="/products.html" class="top-nav__link">VŠETKO</a>
        <a href="/products.html" class="top-nav__link">MUŽ</a>
        <a href="/products.html" class="top-nav__link">ŽENA</a>
      </nav>

      <a href="index.html" class="top-nav__logo">trickohouse</a>

      <div class="top-nav__icons">
        <a href="login.html" class="icon-btn" aria-label="Account">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
        </a>
        <a href="#" class="icon-btn" aria-label="Notifications">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg>
        </a>
        <a href="#" class="icon-btn cart-btn" aria-label="Cart">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>
          <span class="cart-badge">3</span>
        </a>
        <a href="#" class="icon-btn" aria-label="Wishlist">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
        </a>
      </div>

    </div>
  </header>

  <!-- ===== SECONDARY NAV ===== -->
  <nav class="sec-nav">
    <div class="container sec-nav__inner">
      <div class="sec-nav__left">
        <a href="/products.html" class="sec-nav__link">Tričká</a>
        <a href="/products.html" class="sec-nav__link">Mikiny</a>
      </div>
      <div class="sec-nav__search">
        <input type="text" placeholder="Vyhľadať..." aria-label="Vyhľadať" />
        <button aria-label="Search">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
        </button>
      </div>
    </div>
  </nav>

  <main>

    <!-- ===== CHECKOUT STEPS ===== -->
    <section class="section checkout-steps">
      <div class="container">
        <div class="checkout-steps__inner">
          <div class="checkout-step checkout-step--completed">
            <span class="checkout-step__number">1</span>
            <span class="checkout-step__label">Košík</span>
          </div>
          <div class="checkout-step checkout-step--active">
            <span class="checkout-step__number">2</span>
            <span class="checkout-step__label">Doprava</span>
          </div>
          <div class="checkout-step">
            <span class="checkout-step__number">3</span>
            <span class="checkout-step__label">Platba</span>
          </div>
          <div class="checkout-step">
            <span class="checkout-step__number">4</span>
            <span class="checkout-step__label">Osobné údaje</span>
          </div>
          <div class="checkout-step">
            <span class="checkout-step__number">5</span>
            <span class="checkout-step__label">Potvrdenie</span>
          </div>
        </div>
      </div>
    </section>

    <!-- ===== DELIVERY METHODS ===== -->
    <section class="section delivery-methods">
      <div class="container">
        <h1 class="section__title">Vyberte spôsob dopravy</h1>

        <div class="delivery-methods__grid">

          <label class="delivery-method">
            <input type="radio" name="delivery" value="standard" checked />
            <div class="delivery-method__content">
              <div class="delivery-method__info">
                <h3 class="delivery-method__title">Štandardná doprava</h3>
                <p class="delivery-method__description">Doručenie do 3-5 pracovných dní</p>
              </div>
              <div class="delivery-method__price">4.99€</div>
            </div>
          </label>

          <label class="delivery-method">
            <input type="radio" name="delivery" value="express" />
            <div class="delivery-method__content">
              <div class="delivery-method__info">
                <h3 class="delivery-method__title">Expresná doprava</h3>
                <p class="delivery-method__description">Doručenie do 1-2 pracovných dní</p>
              </div>
              <div class="delivery-method__price">9.99€</div>
            </div>
          </label>

          <label class="delivery-method">
            <input type="radio" name="delivery" value="pickup" />
            <div class="delivery-method__content">
              <div class="delivery-method__info">
                <h3 class="delivery-method__title">Osobný odber</h3>
                <p class="delivery-method__description">Vyzdvihnutie v našej predajni</p>
              </div>
              <div class="delivery-method__price">0.00€</div>
            </div>
          </label>

        </div>

        <div class="delivery-methods__actions">
          <a href="cart.html" class="btn btn--outline">Späť do košíka</a>
          <a href="checkout-payment.html" class="btn btn--teal">Pokračovať k platbe</a>
        </div>
      </div>
    </section>

  </main>

  <!-- ===== FOOTER ===== -->
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

  <script src="assets/nav.js" defer></script>
</body>
</html>