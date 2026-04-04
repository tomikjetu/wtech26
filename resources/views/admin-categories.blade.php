<!DOCTYPE html>
<html lang="sk">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin Kategórie - trickohouse</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Irish+Grover&family=Nunito:wght@400;600;700;900&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="style.css" />
  <link rel="stylesheet" href="admin-header.css" />
  <link rel="stylesheet" href="admin.css" />
</head>
<body class="admin-page">
  @include('include.admin-header')
<main class="admin-shell">
    <header class="admin-toolbar" aria-label="Admin panel toolbar">
      <div class="admin-toolbar__left">
        <div class="admin-module admin-module--icon-left">
          <label class="sr-only" for="admin-search">Vyhladavanie kategórie</label>
          <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="11" cy="11" r="8" /><line x1="21" y1="21" x2="16.65" y2="16.65" /></svg>
          <input id="admin-search" type="text" placeholder="Vyhladavanie kategórie" />
        </div>

        <div class="admin-module admin-module--readonly">
          <span>Kategórie (6)</span>
        </div>
      </div>

      <button type="button" class="admin-add-global" aria-label="Pridat kategóriu">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
      </button>
    </header>

    <section class="admin-list" aria-label="Zoznam kategórií">
      <article class="admin-row">
        <div class="admin-thumb" aria-hidden="true"></div>

        <div class="admin-id">
          <label class="sr-only" for="cat-name-1">Názov kategórie</label>
          <input id="cat-name-1" type="text" value="Muži" disabled />
        </div>

        <div class="admin-meta" role="group" aria-label="Nastavenia kategórie 1">
          <button type="button" class="admin-meta-chip" aria-label="Počet produktov 12">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>
            <span>Počet produktov: 12</span>
          </button>
        </div>

        <button type="button" class="admin-remove" aria-label="Odstranit kategóriu" disabled>
          <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="5" y1="12" x2="19" y2="12" /></svg>
        </button>
      </article>

      <article class="admin-row">
        <div class="admin-thumb" aria-hidden="true"></div>

        <div class="admin-id">
          <label class="sr-only" for="cat-name-2">Názov kategórie</label>
          <input id="cat-name-2" type="text" value="Ženy" disabled />
        </div>

        <div class="admin-meta" role="group" aria-label="Nastavenia kategórie 2">
          <button type="button" class="admin-meta-chip" aria-label="Počet produktov 8">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>
            <span>Počet produktov: 8</span>
          </button>
        </div>

        <button type="button" class="admin-remove" aria-label="Odstranit kategóriu" disabled>
          <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="5" y1="12" x2="19" y2="12" /></svg>
        </button>
      </article>

      <article class="admin-row">
        <div class="admin-thumb" aria-hidden="true"></div>

        <div class="admin-id">
          <label class="sr-only" for="cat-name-3">Názov kategórie</label>
          <input id="cat-name-3" type="text" value="Oblečenie" disabled />
        </div>

        <div class="admin-meta" role="group" aria-label="Nastavenia kategórie 3">
          <button type="button" class="admin-meta-chip" aria-label="Počet produktov 0">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>
            <span>Počet produktov: 0</span>
          </button>
        </div>

        <button type="button" class="admin-remove" aria-label="Odstranit kategóriu">
          <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="5" y1="12" x2="19" y2="12" /></svg>
        </button>
      </article>

      <article class="admin-row">
        <div class="admin-thumb" aria-hidden="true"></div>

        <div class="admin-id">
          <label class="sr-only" for="cat-name-4">Názov kategórie</label>
          <input id="cat-name-4" type="text" value="Topánky" disabled />
        </div>

        <div class="admin-meta" role="group" aria-label="Nastavenia kategórie 4">
          <button type="button" class="admin-meta-chip" aria-label="Počet produktov 5">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>
            <span>Počet produktov: 5</span>
          </button>
        </div>

        <button type="button" class="admin-remove" aria-label="Odstranit kategóriu" disabled>
          <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="5" y1="12" x2="19" y2="12" /></svg>
        </button>
      </article>

      <article class="admin-row">
        <div class="admin-thumb" aria-hidden="true"></div>

        <div class="admin-id">
          <label class="sr-only" for="cat-name-5">Názov kategórie</label>
          <input id="cat-name-5" type="text" value="Výpredaj" disabled />
        </div>

        <div class="admin-meta" role="group" aria-label="Nastavenia kategórie 5">
          <button type="button" class="admin-meta-chip" aria-label="Počet produktov 3">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>
            <span>Počet produktov: 3</span>
          </button>
        </div>

        <button type="button" class="admin-remove" aria-label="Odstranit kategóriu" disabled>
          <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="5" y1="12" x2="19" y2="12" /></svg>
        </button>
      </article>

      <article class="admin-row">
        <div class="admin-thumb" aria-hidden="true"></div>

        <div class="admin-id">
          <label class="sr-only" for="cat-name-6">Názov kategórie</label>
          <input id="cat-name-6" type="text" value="Doplnky" disabled />
        </div>

        <div class="admin-meta" role="group" aria-label="Nastavenia kategórie 6">
          <button type="button" class="admin-meta-chip" aria-label="Počet produktov 0">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>
            <span>Počet produktov: 0</span>
          </button>
        </div>

        <button type="button" class="admin-remove" aria-label="Odstranit kategóriu">
          <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="5" y1="12" x2="19" y2="12" /></svg>
        </button>
      </article>
    </section>
  </main>

  <footer class="admin-header-footer">
    <div class="container admin-header-footer__inner">
      <div class="admin-header-footer__links">
        <a href="products.html">Obchod</a>
        <a href="admin-products.html">Produkty</a>
        <a href="admin-categories.html">Kategórie</a>
        <a href="#">Nastavenia</a>
      </div>
      <p class="admin-header-footer__copy">Admin Panel WTECH 2026</p>
    </div>
  </footer>

</body>
</html>
