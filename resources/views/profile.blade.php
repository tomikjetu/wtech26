<!DOCTYPE html>
<html lang="sk">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>trickohouse | Profil</title>
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
          <a href="/logout" class="profile-logout">Odhlásiť sa</a>
        </div>
      </div>

      <a href="faq.html" class="profile-help-link">Potrebuješ pomoc?</a>
    </section>

    <section class="container profile-content-layout">
      <aside class="profile-sidebar" aria-label="Profilové menu">
        <details class="profile-menu-group" open>
          <summary>MOJE NÁKUPY</summary>
          <ul>
            <li><a href="#">Minulé objednávky</a></li>
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

      <div class="profile-main-content" aria-label="Obsah profilu">
        <div class="profile-tags">
          <button type="button" class="profile-tag profile-tag-active">Aktívne objednávky</button>
          <button type="button" class="profile-tag">História nákupov</button>
        </div>

        <p class="profile-wide-text">MOJE NÁKUPY: sledujte stav zásielok, pozrite si minulé objednávky a spravujte fakturačné informácie.</p>

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

  <script src="assets/nav.js" defer></script>
</body>
</html>
