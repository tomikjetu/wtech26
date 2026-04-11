<!DOCTYPE html>
<html lang="sk">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Doprava - trickohouse</title>
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

        <form method="POST" action="{{ route('checkout.delivery.post') }}">
          @csrf
          <div class="delivery-methods__grid">
      @php      
      
      $delivery_methods = [
            ['name' => 'standard', 'title' => 'Štandardná doprava', 'description' => 'Doručenie do 3-5 pracovných dní', 'price' => 4.99],
            ['name' => 'express', 'title' => 'Expresná doprava', 'description' => 'Doručenie do 1-2 pracovných dní', 'price' => 9.99],
            ['name' => 'pickup', 'title' => 'Osobný odber', 'description' => 'Vyzdvihnutie v našej predajni', 'price' => 0.00],
      ]
      @endphp    
      
      @foreach ($delivery_methods as $method)
          <label class="delivery-method">
            <input type="radio" name="delivery" value="{{ $method['name'] }}" {{ ($delivery_method ?? 'standard') == $method['name'] ? 'checked' : '' }} />
            <div class="delivery-method__content">
              <div class="delivery-method__info">
                <h3 class="delivery-method__title">{{ $method['title'] }}</h3>
                <p class="delivery-method__description">{{ $method['description'] }}</p>
              </div>
              <div class="delivery-method__price">{{ number_format($method['price'], 2) }}€</div>
            </div>
          </label>
      @endforeach
        </div>

        <div class="delivery-methods__actions">
          <a href="{{ route('cart') }}" class="btn btn--outline">Späť do košíka</a>
          <button type="submit" class="btn btn--teal">Pokračovať k platbe</button>
        </div>
        </form>
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