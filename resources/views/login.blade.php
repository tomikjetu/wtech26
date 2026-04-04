<!DOCTYPE html>
<html lang="sk">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Prihlásiť sa - trickohouse</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Irish+Grover&family=Nunito:wght@400;600;700;900&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/auth.css') }}" />
</head>
<body>

  @include('include.header')
<main>
    <section class="section auth-section">
      <div class="container">
        <div class="auth-card">
          <nav class="auth-card__tabs" aria-label="Prihlásenie alebo vytvorenie účtu">
            <a href="/login" class="auth-card__tab auth-card__tab--active" aria-current="page">Prihlásiť sa</a>
            <a href="/register" class="auth-card__tab">Vytvoriť účet</a>
          </nav>

          <h1 class="auth-card__title">Prihlásiť sa</h1>

          <form class="auth-form" action="/login" method="post">
            @csrf
            <div class="auth-form__group">
              <label for="login-email" class="auth-form__label">E-mail</label>
              <input id="login-email" name="email" type="email" class="auth-form__input" required value="{{ old('email') }}" />
              @error('email')
                  <span class="error-msg" style="color:red; font-size:12px;">{{ $message }}</span>
              @enderror
            </div>

            <div class="auth-form__group">
              <label for="login-password" class="auth-form__label">Heslo</label>
              <input id="login-password" name="password" type="password" class="auth-form__input" required />
            </div>

            <div class="auth-form__actions">
              <button type="submit" class="btn btn--teal">Prihlásiť sa</button>
            </div>
          </form>

          <p class="auth-form__hint">Nemáš účet? <a href="register.html">Vytvor si ho tu</a>.</p>
        </div>
      </div>
    </section>
  </main>

  <footer class="footer">
    <div class="container footer__inner">
      <div class="footer__logo">
        <a href="index.html" class="footer__logo-link">trickohouse</a>
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
