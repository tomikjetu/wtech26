<!DOCTYPE html>
<html lang="sk">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Potvrdenie objednávky - trickohouse</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Irish+Grover&family=Nunito:wght@400;600;700;900&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/checkout.css') }}" />
</head>
<body>

  @include('include.header')
<main>

    <!-- ===== CHECKOUT STEPS ===== -->
    <section class="section checkout-steps">
      <div class="container">
        <div class="checkout-steps__inner">
          <div class="checkout-step checkout-step--completed">
            <span class="checkout-step__number">1</span>
            <span class="checkout-step__label">Košík</span>
          </div>
          <div class="checkout-step checkout-step--completed">
            <span class="checkout-step__number">2</span>
            <span class="checkout-step__label">Doprava</span>
          </div>
          <div class="checkout-step checkout-step--completed">
            <span class="checkout-step__number">3</span>
            <span class="checkout-step__label">Platba</span>
          </div>
          <div class="checkout-step checkout-step--completed">
            <span class="checkout-step__number">4</span>
            <span class="checkout-step__label">Osobné údaje</span>
          </div>
          <div class="checkout-step checkout-step--active">
            <span class="checkout-step__number">5</span>
            <span class="checkout-step__label">Potvrdenie</span>
          </div>
        </div>
      </div>
    </section>

  <section class="section order-confirmation">
          <!-- Order Details -->
          <div class="order-details">
            <div class="order-details__section">
              <h2 class="order-details__title">Objednané produkty</h2>
              <div class="order-items">
                <div class="order-item">
                  <div class="order-item__image">
                    <div class="order-item__img order-item__img--shirt-white"></div>
                  </div>
                  <div class="order-item__info">
                    <h3 class="order-item__name">TrickoHouse core</h3>
                    <p class="order-item__variant">Biela, M</p>
                    <p class="order-item__quantity">Množstvo: 1</p>
                  </div>
                  <div class="order-item__price">24.99€</div>
                </div>

            <div class="order-item">
              <div class="order-item__image">
                <div class="order-item__img order-item__img--hoodie-black"></div>
              </div>
              <div class="order-item__info">
                <h3 class="order-item__name">Hoodie</h3>
                <p class="order-item__variant">Čierna, L</p>
                <p class="order-item__quantity">Množstvo: 2</p>
              </div>
              <div class="order-item__price">59.99€</div>
            </div>

            <div class="order-item">
              <div class="order-item__image">
                <div class="order-item__img order-item__img--cap-white"></div>
              </div>
              <div class="order-item__info">
                <h3 class="order-item__name">Cap</h3>
                <p class="order-item__variant">Biela, One Size</p>
                <p class="order-item__quantity">Množstvo: 1</p>
              </div>
              <div class="order-item__price">24.99€</div>
            </div>
          </div>
        </div>

        <div class="order-details__grid">

          <div class="order-details__section">
            <h2 class="order-details__title">Dodacia adresa</h2>
            <div class="address-info">
              <p>Ján Novák</p>
              <p>Hlavná ulica 123</p>
              <p>Bratislava 811 01</p>
              <p>Slovensko</p>
              <p>jan.novak@email.com</p>
              <p>+421 123 456 789</p>
            </div>
          </div>

          <div class="order-details__section">
            <h2 class="order-details__title">Spôsob dopravy</h2>
            <div class="shipping-info">
              <p><strong>Štandardná doprava</strong></p>
              <p>Doručenie do 3-5 pracovných dní</p>
              <p class="shipping-price">4.99€</p>
            </div>
          </div>

          <div class="order-details__section">
            <h2 class="order-details__title">Spôsob platby</h2>
            <div class="payment-info">
              <p><strong>Kreditná/debetná karta</strong></p>
              <p>Visa, MasterCard, Maestro</p>
            </div>
          </div>

          <div class="order-details__section">
            <h2 class="order-details__title">Súhrn</h2>
            <div class="order-summary-box">
              <div class="order-summary-box__row">
                <span>Medzisúčet</span>
                <span>109.97€</span>
              </div>
              <div class="order-summary-box__row">
                <span>Doprava</span>
                <span>4.99€</span>
              </div>
              <div class="order-summary-box__row order-summary-box__row--total">
                <span>Celkom</span>
                <span>114.96€</span>
              </div>
            </div>
          </div>

        </div>

      </div>

      <div class="order-confirmation__actions">
        <a href="{{ route('checkout.confirmation') }}" class="btn btn--teal">POTVRDIŤ OBJEDNÁVKU</a>
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

  <script src="{{ asset('js/nav.js') }}" defer></script>
</body>
</html>