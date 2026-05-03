<!DOCTYPE html>
<html lang="sk">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Košík - trickohouse</title>
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
          <div class="checkout-step checkout-step--active">
            <span class="checkout-step__number">1</span>
            <span class="checkout-step__label">Košík</span>
          </div>
          <div class="checkout-step">
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

    <!-- ===== CART ===== -->
    <section class="section cart">
      <div class="container">
        <h1 class="section__title">Košík</h1>

        <div class="cart__inner">

          <!-- Cart Items -->
<div class="cart__items">
    @forelse ($items as $key => $item)
        @php
            $product = Auth::check() ? $item->product : $item['product'];
            $size    = Auth::check() ? $item->size : $item['size'];
            $qty     = Auth::check() ? $item->quantity : $item['quantity'];
            $itemId  = Auth::check() ? $item->id : null;
        @endphp
        <div class="cart-item">
            <a href="{{ route('product.detail', $product->id) }}" class="cart-item__image">
                @php $img = $product->images->first(); @endphp
                @if ($img)
                    <img src="{{ asset($img->path) }}" alt="{{ $product->name }}" class="cart-item__img">
                @else
                    <div class="cart-item__img cart-item__img--shirt-white"></div>
                @endif
            </a>
            <div class="cart-item__info">
                <h3 class="cart-item__name"><a href="{{ route('product.detail', $product->id) }}" style="color:inherit;text-decoration:none;">{{ $product->name }}</a></h3>
                <p class="cart-item__variant">{{ $product->color }}, {{ $size?->name ?? 'N/A' }}</p>
                <form method="POST" action="{{ route('cart.update') }}">
                    @csrf
                    <input type="hidden" name="item_id" value="{{ $itemId }}">
                    <input type="hidden" name="key" value="{{ $key }}">
                    <div class="cart-item__quantity">
                        <button type="button" class="quantity-btn" onclick="changeCartQty(this, -1)">-</button>
                        <input type="number" name="quantity" value="{{ $qty }}" min="1" style="width:40px;text-align:center;border:none;" onchange="this.form.submit()">
                        <button type="button" class="quantity-btn" onclick="changeCartQty(this, 1)">+</button>
                    </div>
                </form>
            </div>
            <div class="cart-item__price">
                <span class="cart-item__price-value">{{ number_format($product->price * $qty, 2) }}€</span>
                <form method="POST" action="{{ route('cart.remove') }}">
                    @csrf
                    <input type="hidden" name="item_id" value="{{ $itemId }}">
                    <input type="hidden" name="key" value="{{ $key }}">
                    <button type="submit" class="cart-item__remove" aria-label="Remove item">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                    </button>
                </form>
            </div>
        </div>
    @empty
        <p>Váš košík je prázdny.</p>
    @endforelse
</div>

<!-- Cart Summary -->
<div class="cart__summary">
    <div class="cart-summary">
        <h3 class="cart-summary__title">Súhrn objednávky</h3>
        @php
            global $total;
            $total = collect($items)->sum(function($item) {
                $product = Auth::check() ? $item->product : $item['product'];
                $qty     = Auth::check() ? $item->quantity : $item['quantity'];
                return $product->price * $qty;
            });
        @endphp
        <div class="cart-summary__row">
            <span>Medzisúčet</span>
            <span>{{ number_format($total, 2) }}€</span>
        </div>
        <div class="cart-summary__row">
            <span>Doprava</span>
            <span>0.00€</span>
        </div>
        <div class="cart-summary__row cart-summary__row--total">
            <span>Celkom</span>
            <span>{{ number_format($total, 2) }}€</span>
        </div>
        @if ($total > 0)
            <a href="{{ route('checkout.delivery') }}" class="btn btn--teal cart-summary__checkout">Pokračovať k pokladni</a>
        @else
            <a href="/" class="btn btn--teal cart-summary__checkout">Vrátiť se do obchodu</a>
        @endif
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
  <script>
    function changeCartQty(btn, delta) {
      const form = btn.closest('form');
      const input = form.querySelector('input[name="quantity"]');
      const newVal = Math.max(1, parseInt(input.value) + delta);
      input.value = newVal;
      form.submit();
    }
  </script>
</body>
</html>