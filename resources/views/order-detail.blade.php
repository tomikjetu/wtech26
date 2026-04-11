<!DOCTYPE html>
<html lang="sk">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Objednávka #TRK-{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }} - trickohouse</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Irish+Grover&family=Nunito:wght@400;600;700;900&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/profile.css') }}" />
</head>
<body class="profile-template-page">

  @include('include.header')
<main class="profile-main">
    <section class="container profile-header-row" aria-label="Používateľský profil">
      <div class="profile-user-info">
        <div class="profile-avatar" aria-hidden="true">
          <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
        </div>
        <div>
          <p class="profile-name">
            @auth
              {{ auth()->user()->email }}
            @else
              Používateľské meno
            @endauth
          </p>
          <a href="#" onclick="document.getElementById('logout-form').submit();" class="profile-logout">Odhlásiť sa</a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
          </form>
        </div>
      </div>

      <a href="{{ route('profile') }}" class="profile-help-link">← Späť do profilu</a>
    </section>

    <section class="container profile-content-layout">
      <aside class="profile-sidebar" aria-label="Profilové menu">
        <details class="profile-menu-group" open>
          <summary>MOJE NÁKUPY</summary>
          <ul>
            <li><a href="{{ route('profile') }}">Minulé objednávky</a></li>
            <li><a href="#">Vrátenia a reklamácie</a></li>
          </ul>
        </details>

        <details class="profile-menu-group" open>
          <summary>MOJE VÝHODY</summary>
          <ul>
            <li><a href="#">Zľavové kupóny</a></li>
            <li><a href="#">Vernostné body</a></li>
            <li><a href="#">VIP ponuky</a></li>
          </ul>
        </details>

        <details class="profile-menu-group" open>
          <summary>MÔJ ÚČET</summary>
          <ul>
            <li><a href="#">Osobné údaje</a></li>
            <li><a href="#">Fakturačné informácie</a></li>
            <li><a href="#">Dodacie adresy</a></li>
            <li><a href="#">Platobné metódy</a></li>
            <li><a href="#">Nastavenia notifikácií</a></li>
            <li><a href="#">Zmena hesla</a></li>
          </ul>
        </details>
      </aside>

      <div class="profile-main-content" aria-label="Detaily objednávky">
        <div class="order-detail-header">
          <h1 class="order-detail-title">Objednávka #TRK-{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}</h1>
          <div class="order-detail-meta">
            <span class="order-date">{{ $order->created_at->format('d.m.Y H:i') }}</span>
            <span class="order-status status-{{ $order->status }}">
              @switch($order->status)
                @case('pending')
                  Čaká na spracovanie
                  @break
                @case('confirmed')
                  Potvrdená
                  @break
                @case('shipped')
                  Odoslaná
                  @break
                @case('delivered')
                  Doručená
                  @break
                @case('cancelled')
                  Zrušená
                  @break
                @default
                  {{ $order->status }}
              @endswitch
            </span>
          </div>
        </div>

        <div class="order-detail-grid">
          <!-- Order Items -->
          <div class="order-detail-section">
            <h2 class="section-title">Objednané produkty</h2>
            <div class="order-items-detailed">
              @foreach($order->items as $item)
              <div class="order-item-detailed">
                <div class="item-image-large">
                  <div class="item-placeholder-large"></div>
                </div>
                <div class="item-info-detailed">
                  <h3 class="item-name-detailed">{{ $item->product_name }}</h3>
                  <p class="item-variant-detailed">
                    {{ $item->product_color }}
                    @if($item->size_name)
                      , {{ $item->size_name }}
                    @endif
                  </p>
                  <div class="item-pricing">
                    <span class="item-quantity-detailed">{{ $item->quantity }} × {{ number_format($item->price, 2) }}€</span>
                    <span class="item-total-detailed">{{ number_format($item->price * $item->quantity, 2) }}€</span>
                  </div>
                </div>
              </div>
              @endforeach
            </div>
          </div>

          <!-- Order Summary -->
          <div class="order-detail-section">
            <h2 class="section-title">Súhrn objednávky</h2>
            <div class="order-summary-box">
              <div class="summary-row">
                <span>Medzisúčet</span>
                <span>{{ number_format($order->subtotal, 2) }}€</span>
              </div>
              <div class="summary-row">
                <span>Doprava ({{ $order->delivery_title }})</span>
                <span>{{ number_format($order->delivery_price, 2) }}€</span>
              </div>
              <div class="summary-row summary-total">
                <span>Celkom</span>
                <span>{{ number_format($order->total_amount, 2) }}€</span>
              </div>
            </div>
          </div>

          <!-- Delivery Info -->
          <div class="order-detail-section">
            <h2 class="section-title">Dodacia adresa</h2>
            <div class="address-info">
              <p><strong>{{ $order->customer_first_name }} {{ $order->customer_last_name }}</strong></p>
              <p>{{ $order->customer_address }}</p>
              <p>{{ $order->customer_city }} {{ $order->customer_zip }}</p>
              <p>{{ $order->customer_country == 'SK' ? 'Slovensko' : 'Česká republika' }}</p>
              <p>{{ $order->customer_email }}</p>
              <p>{{ $order->customer_phone }}</p>
            </div>
          </div>

          <!-- Payment Info -->
          <div class="order-detail-section">
            <h2 class="section-title">Spôsob platby</h2>
            <div class="payment-info">
              <p><strong>{{ $order->payment_title }}</strong></p>
              <p>{{ $order->delivery_method == 'pickup' ? 'Platba pri osobnom odbere' : 'Online platba' }}</p>
            </div>
          </div>
        </div>

        <div class="order-actions-bar">
          <a href="{{ route('profile') }}" class="btn btn--outline">Späť do profilu</a>
          @if($order->status === 'confirmed' || $order->status === 'pending')
            <button class="btn btn--outline">Zrušiť objednávku</button>
          @endif
          <button class="btn btn--teal">Stiahnuť faktúru</button>
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

      <div class="footer__bottom">
        <p>Trickohouse WTECH 2026</p>
      </div>

    </div>
  </footer>

  <script src="{{ asset('js/nav.js') }}" defer></script>
</body>
</html>