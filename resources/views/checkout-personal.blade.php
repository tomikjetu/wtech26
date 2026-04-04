<!DOCTYPE html>
<html lang="sk">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Osobné údaje - trickohouse</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Irish+Grover&family=Nunito:wght@400;600;700;900&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="styles/style.css" />
  <link rel="stylesheet" href="styles/checkout.css" />
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

        <form class="personal-info__form">

          <div class="form-section">
            <h2 class="form-section__title">Kontaktné údaje</h2>

            <div class="form-row">
              <div class="form-group">
                <label for="email" class="form-label">Email *</label>
                <input type="email" id="email" name="email" class="form-input" required />
              </div>
              <div class="form-group">
                <label for="phone" class="form-label">Telefón</label>
                <input type="tel" id="phone" name="phone" class="form-input" />
              </div>
            </div>
          </div>

          <div class="form-section">
            <h2 class="form-section__title">Dodacia adresa</h2>

            <div class="form-row">
              <div class="form-group">
                <label for="firstName" class="form-label">Meno *</label>
                <input type="text" id="firstName" name="firstName" class="form-input" required />
              </div>
              <div class="form-group">
                <label for="lastName" class="form-label">Priezvisko *</label>
                <input type="text" id="lastName" name="lastName" class="form-input" required />
              </div>
            </div>

            <div class="form-group">
              <label for="address" class="form-label">Adresa *</label>
              <input type="text" id="address" name="address" class="form-input" placeholder="Ulice a číslo domu" required />
            </div>

            <div class="form-row">
              <div class="form-group">
                <label for="city" class="form-label">Mesto *</label>
                <input type="text" id="city" name="city" class="form-input" required />
              </div>
              <div class="form-group">
                <label for="zip" class="form-label">PSČ *</label>
                <input type="text" id="zip" name="zip" class="form-input" required />
              </div>
            </div>

            <div class="form-group">
              <label for="country" class="form-label">Krajina *</label>
              <select id="country" name="country" class="form-input" required>
                <option value="">Vyberte krajinu</option>
                <option value="SK" selected>Slovensko</option>
                <option value="CZ">Česká republika</option>
              </select>
            </div>
          </div>

          <div class="form-section">
            <label class="checkbox-group">
              <input type="checkbox" name="billingSame" checked />
              <span class="checkbox-group__checkmark"></span>
              Fakturačná adresa je rovnaká ako dodacia
            </label>
          </div>

          <div class="form-section">
            <label class="checkbox-group">
              <input type="checkbox" name="newsletter" />
              <span class="checkbox-group__checkmark"></span>
              Chcem dostávať novinky a ponuky na email
            </label>
          </div>

          <div class="personal-info__actions">
            <a href="checkout-payment.html" class="btn btn--outline">Späť k platbe</a>
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

  <script src="assets/nav.js" defer></script>
</body>
</html>