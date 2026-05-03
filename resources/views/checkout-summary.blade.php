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
                @forelse ($items as $item)
                @php
                    $product = Auth::check() ? $item->product : $item['product'];
                    $size = Auth::check() ? $item->size : $item['size'];
                    $qty = Auth::check() ? $item->quantity : $item['quantity'];
                @endphp
                @php $img = $product->images->first(); @endphp
                <div class="order-item">
                  <div class="order-item__image">
                    @if ($img)
                      <img src="{{ asset( $img->path) }}" alt="{{ $product->name }}" class="order-item__img" style="object-fit:cover;">
                    @else
                      <div class="order-item__img order-item__img--shirt-white"></div>
                    @endif
                  </div>
                  <div class="order-item__info">
                    <h3 class="order-item__name">{{ $product->name }}</h3>
                    <p class="order-item__variant">{{ $product->color }}, {{ $size?->name ?? 'N/A' }}</p>
                    <p class="order-item__quantity">Množstvo: {{ $qty }}</p>
                  </div>
                  <div class="order-item__price">{{ number_format($product->price * $qty, 2) }}€</div>
                </div>
                @empty
                <p>Váš košík je prázdny.</p>
                @endforelse
              </div>
            </div>

        <div class="order-details__grid">

          @php
            $pd = $checkout_data['personal_data'] ?? [];
            $billingSame = ($pd['billingSame'] ?? null) === '1';
            $countryNames = ['SK' => 'Slovensko', 'CZ' => 'Česká republika'];
          @endphp

          <div class="order-details__section">
            <h2 class="order-details__title">Dodacia adresa</h2>
            <div class="address-info">
              <p><strong>{{ ($pd['firstName'] ?? '') }} {{ ($pd['lastName'] ?? '') }}</strong></p>
              <p>{{ $pd['address'] ?? '' }}</p>
              <p>{{ $pd['city'] ?? '' }} {{ $pd['zip'] ?? '' }}</p>
              <p>{{ $countryNames[$pd['country'] ?? ''] ?? ($pd['country'] ?? '') }}</p>
              <p>{{ $pd['email'] ?? '' }}</p>
              @if (!empty($pd['phone']))
                <p>{{ $pd['phone'] }}</p>
              @endif
            </div>
          </div>

          <div class="order-details__section">
            <h2 class="order-details__title">Fakturačná adresa</h2>
            <div class="address-info">
              @if ($billingSame)
                <p style="color:var(--muted);font-size:13px;">Rovnaká ako dodacia adresa</p>
              @else
                <p><strong>{{ ($pd['billing_firstName'] ?? '') }} {{ ($pd['billing_lastName'] ?? '') }}</strong></p>
                <p>{{ $pd['billing_address'] ?? '' }}</p>
                <p>{{ $pd['billing_city'] ?? '' }} {{ $pd['billing_zip'] ?? '' }}</p>
                <p>{{ $countryNames[$pd['billing_country'] ?? ''] ?? ($pd['billing_country'] ?? '') }}</p>
              @endif
            </div>
          </div>

          <div class="order-details__section">
            <h2 class="order-details__title">Spôsob dopravy</h2>
            <div class="shipping-info">
              <p><strong>{{ $checkout_data['delivery_title'] ?? 'Nezvolené' }}</strong></p>
              <p class="shipping-price">{{ number_format($checkout_data['delivery_price'] ?? 0, 2) }}€</p>
            </div>
          </div>

          <div class="order-details__section">
            <h2 class="order-details__title">Spôsob platby</h2>
            <div class="payment-info">
              <p><strong>{{ $checkout_data['payment_title'] ?? 'Nezvolené' }}</strong></p>
            </div>
          </div>

          <div class="order-details__section">
            <h2 class="order-details__title">Súhrn</h2>
            <div class="order-summary-box">
              <div class="order-summary-box__row">
                <span>Medzisúčet</span>
                <span>{{ number_format($total, 2) }}€</span>
              </div>
              <div class="order-summary-box__row">
                <span>Doprava</span>
                <span>{{ number_format($checkout_data['delivery_price'] ?? 0, 2) }}€</span>
              </div>
              <div class="order-summary-box__row order-summary-box__row--total">
                <span>Celkom</span>
                <span>{{ number_format($total + ($checkout_data['delivery_price'] ?? 0), 2) }}€</span>
              </div>
            </div>
          </div>

        </div>

      </div>

      <div class="order-confirmation__actions">
        <form method="POST" action="{{ route('checkout.confirm.post') }}">
          @csrf
          <button type="submit" class="btn btn--teal">POTVRDIŤ OBJEDNÁVKU</button>
        </form>
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