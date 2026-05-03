<!DOCTYPE html>
<html lang="sk">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Osobné údaje - trickohouse</title>
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
          <div class="checkout-step checkout-step--active">
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

    <!-- ===== PERSONAL INFO FORM ===== -->
    <section class="section personal-info">
      <div class="container">
        <h1 class="section__title">Osobné údaje</h1>

        @if ($errors->any())
          <div style="background:#fff0f0;border:1px solid #e04040;border-radius:6px;padding:12px 16px;margin-bottom:24px;max-width:600px;margin-left:auto;margin-right:auto;">
            <strong style="color:#e04040;">Opravte prosím nasledujúce chyby:</strong>
            <ul style="margin:8px 0 0;padding-left:20px;color:#e04040;font-size:13px;">
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <form method="POST" action="{{ route('checkout.personal.post') }}" class="personal-info__form" novalidate>
          @csrf

          {{-- ── CONTACT ── --}}
          <div class="form-section">
            <h2 class="form-section__title">Kontaktné údaje</h2>

            <div class="form-row">
              <div class="form-group">
                <label for="email" class="form-label">Email *</label>
                <input
                  type="email"
                  id="email"
                  name="email"
                  class="form-input @error('email') form-input--error @enderror"
                  value="{{ old('email', $personal_data['email'] ?? '') }}"
                  autocomplete="email"
                />
                @error('email')
                  <span class="form-error-msg">{{ $message }}</span>
                @enderror
              </div>
              <div class="form-group">
                <label for="phone" class="form-label">Telefón</label>
                <input
                  type="tel"
                  id="phone"
                  name="phone"
                  class="form-input @error('phone') form-input--error @enderror"
                  value="{{ old('phone', $personal_data['phone'] ?? '') }}"
                  placeholder="+421 900 000 000"
                  autocomplete="tel"
                />
                @error('phone')
                  <span class="form-error-msg">{{ $message }}</span>
                @enderror
              </div>
            </div>
          </div>

          {{-- ── SHIPPING ADDRESS ── --}}
          <div class="form-section">
            <h2 class="form-section__title">Dodacia adresa</h2>

            <div class="form-row">
              <div class="form-group">
                <label for="firstName" class="form-label">Meno *</label>
                <input
                  type="text"
                  id="firstName"
                  name="firstName"
                  class="form-input @error('firstName') form-input--error @enderror"
                  value="{{ old('firstName', $personal_data['firstName'] ?? '') }}"
                  autocomplete="given-name"
                />
                @error('firstName')
                  <span class="form-error-msg">{{ $message }}</span>
                @enderror
              </div>
              <div class="form-group">
                <label for="lastName" class="form-label">Priezvisko *</label>
                <input
                  type="text"
                  id="lastName"
                  name="lastName"
                  class="form-input @error('lastName') form-input--error @enderror"
                  value="{{ old('lastName', $personal_data['lastName'] ?? '') }}"
                  autocomplete="family-name"
                />
                @error('lastName')
                  <span class="form-error-msg">{{ $message }}</span>
                @enderror
              </div>
            </div>

            <div class="form-group" style="margin-bottom:16px;">
              <label for="address" class="form-label">Adresa *</label>
              <input
                type="text"
                id="address"
                name="address"
                class="form-input @error('address') form-input--error @enderror"
                placeholder="Ulica a číslo domu"
                value="{{ old('address', $personal_data['address'] ?? '') }}"
                autocomplete="street-address"
              />
              @error('address')
                <span class="form-error-msg">{{ $message }}</span>
              @enderror
            </div>

            <div class="form-row">
              <div class="form-group">
                <label for="city" class="form-label">Mesto *</label>
                <input
                  type="text"
                  id="city"
                  name="city"
                  class="form-input @error('city') form-input--error @enderror"
                  value="{{ old('city', $personal_data['city'] ?? '') }}"
                  autocomplete="address-level2"
                />
                @error('city')
                  <span class="form-error-msg">{{ $message }}</span>
                @enderror
              </div>
              <div class="form-group">
                <label for="zip" class="form-label">PSČ *</label>
                <input
                  type="text"
                  id="zip"
                  name="zip"
                  class="form-input @error('zip') form-input--error @enderror"
                  placeholder="123 45"
                  value="{{ old('zip', $personal_data['zip'] ?? '') }}"
                  autocomplete="postal-code"
                />
                @error('zip')
                  <span class="form-error-msg">{{ $message }}</span>
                @enderror
              </div>
            </div>

            <div class="form-group">
              <label for="country" class="form-label">Krajina *</label>
              <select
                id="country"
                name="country"
                class="form-input @error('country') form-input--error @enderror"
                autocomplete="country"
              >
                <option value="">Vyberte krajinu</option>
                <option value="SK" {{ (old('country', $personal_data['country'] ?? 'SK') === 'SK') ? 'selected' : '' }}>Slovensko</option>
                <option value="CZ" {{ (old('country', $personal_data['country'] ?? '') === 'CZ') ? 'selected' : '' }}>Česká republika</option>
              </select>
              @error('country')
                <span class="form-error-msg">{{ $message }}</span>
              @enderror
            </div>
          </div>

          {{-- ── BILLING SAME CHECKBOX ── --}}
          @php
            // When validation failed, old() returns null for unchecked checkboxes (no key in request).
            // We must NOT fall back to the session value in that case, or the checkbox
            // would re-check itself and hide the billing section after an error.
            $billingSameChecked = $errors->any()
              ? (request()->old('billingSame') === '1')
              : (($personal_data['billingSame'] ?? '1') === '1');
          @endphp

          <div class="form-section">
            <label class="checkbox-group">
              <input
                type="checkbox"
                id="billingSame"
                name="billingSame"
                value="1"
                {{ $billingSameChecked ? 'checked' : '' }}
              />
              <span class="checkbox-group__checkmark"></span>
              Fakturačná adresa je rovnaká ako dodacia
            </label>
          </div>

          {{-- ── BILLING ADDRESS (shown when billingSame unchecked) ── --}}
          <div class="form-section billing-section" id="billingSection" style="{{ $billingSameChecked ? 'display:none;' : '' }}">
            <h2 class="form-section__title">Fakturačná adresa</h2>

            <div class="form-row">
              <div class="form-group">
                <label for="billing_firstName" class="form-label">Meno *</label>
                <input
                  type="text"
                  id="billing_firstName"
                  name="billing_firstName"
                  class="form-input @error('billing_firstName') form-input--error @enderror"
                  value="{{ old('billing_firstName', $personal_data['billing_firstName'] ?? '') }}"
                  autocomplete="billing given-name"
                />
                @error('billing_firstName')
                  <span class="form-error-msg">{{ $message }}</span>
                @enderror
              </div>
              <div class="form-group">
                <label for="billing_lastName" class="form-label">Priezvisko *</label>
                <input
                  type="text"
                  id="billing_lastName"
                  name="billing_lastName"
                  class="form-input @error('billing_lastName') form-input--error @enderror"
                  value="{{ old('billing_lastName', $personal_data['billing_lastName'] ?? '') }}"
                  autocomplete="billing family-name"
                />
                @error('billing_lastName')
                  <span class="form-error-msg">{{ $message }}</span>
                @enderror
              </div>
            </div>

            <div class="form-group" style="margin-bottom:16px;">
              <label for="billing_address" class="form-label">Adresa *</label>
              <input
                type="text"
                id="billing_address"
                name="billing_address"
                class="form-input @error('billing_address') form-input--error @enderror"
                placeholder="Ulica a číslo domu"
                value="{{ old('billing_address', $personal_data['billing_address'] ?? '') }}"
                autocomplete="billing street-address"
              />
              @error('billing_address')
                <span class="form-error-msg">{{ $message }}</span>
              @enderror
            </div>

            <div class="form-row">
              <div class="form-group">
                <label for="billing_city" class="form-label">Mesto *</label>
                <input
                  type="text"
                  id="billing_city"
                  name="billing_city"
                  class="form-input @error('billing_city') form-input--error @enderror"
                  value="{{ old('billing_city', $personal_data['billing_city'] ?? '') }}"
                  autocomplete="billing address-level2"
                />
                @error('billing_city')
                  <span class="form-error-msg">{{ $message }}</span>
                @enderror
              </div>
              <div class="form-group">
                <label for="billing_zip" class="form-label">PSČ *</label>
                <input
                  type="text"
                  id="billing_zip"
                  name="billing_zip"
                  class="form-input @error('billing_zip') form-input--error @enderror"
                  placeholder="123 45"
                  value="{{ old('billing_zip', $personal_data['billing_zip'] ?? '') }}"
                  autocomplete="billing postal-code"
                />
                @error('billing_zip')
                  <span class="form-error-msg">{{ $message }}</span>
                @enderror
              </div>
            </div>

            <div class="form-group">
              <label for="billing_country" class="form-label">Krajina *</label>
              <select
                id="billing_country"
                name="billing_country"
                class="form-input @error('billing_country') form-input--error @enderror"
                autocomplete="billing country"
              >
                <option value="">Vyberte krajinu</option>
                <option value="SK" {{ (old('billing_country', $personal_data['billing_country'] ?? 'SK') === 'SK') ? 'selected' : '' }}>Slovensko</option>
                <option value="CZ" {{ (old('billing_country', $personal_data['billing_country'] ?? '') === 'CZ') ? 'selected' : '' }}>Česká republika</option>
              </select>
              @error('billing_country')
                <span class="form-error-msg">{{ $message }}</span>
              @enderror
            </div>
          </div>

          {{-- ── NEWSLETTER ── --}}
          <div class="form-section">
            <label class="checkbox-group">
              <input
                type="checkbox"
                name="newsletter"
                value="1"
                {{ old('newsletter', $personal_data['newsletter'] ?? false) ? 'checked' : '' }}
              />
              <span class="checkbox-group__checkmark"></span>
              Chcem dostávať novinky a ponuky na email
            </label>
          </div>

          <div class="personal-info__actions">
            <a href="{{ route('checkout.payment') }}" class="btn btn--outline">Späť k platbe</a>
            <button type="submit" class="btn btn--teal">Pokračovať k potvrdeniu</button>
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
  <script>
    (function () {
      var cb      = document.getElementById('billingSame');
      var section = document.getElementById('billingSection');

      cb.addEventListener('change', function () {
        section.style.display = cb.checked ? 'none' : 'block';
      });
    })();
  </script>
</body>
</html>
