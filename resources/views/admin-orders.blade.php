<!DOCTYPE html>
<html lang="sk">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin Objednávky - trickohouse</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Irish+Grover&family=Nunito:wght@400;600;700;900&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/admin-header.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/admin.css') }}" />
</head>
<body class="admin-page">
  @include('include.admin-header', ['page' => 'orders'])
<main class="admin-shell">
    <header class="admin-toolbar" aria-label="Admin panel toolbar">
      <div class="admin-toolbar__left">
        <div class="admin-module admin-module--icon-left">
          <label class="sr-only" for="admin-sort">Sortovanie</label>
          <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="4" y1="21" x2="4" y2="14"></line><line x1="4" y1="10" x2="4" y2="3"></line><line x1="12" y1="21" x2="12" y2="12"></line><line x1="12" y1="8" x2="12" y2="3"></line><line x1="20" y1="21" x2="20" y2="16"></line><line x1="20" y1="12" x2="20" y2="3"></line><line x1="1" y1="14" x2="7" y2="14"></line><line x1="9" y1="8" x2="15" y2="8"></line><line x1="17" y1="16" x2="23" y2="16"></line></svg>
          <input id="admin-sort" type="text" placeholder="Sort / Filter" />
        </div>

        <div class="admin-module admin-module--icon-left">
          <label class="sr-only" for="admin-search">Vyhladavanie objednavky</label>
          <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="11" cy="11" r="8" /><line x1="21" y1="21" x2="16.65" y2="16.65" /></svg>
          <input id="admin-search" type="text" placeholder="Search order" />
        </div>

        <div class="admin-module admin-module--readonly">
          <span>Objednávky</span>
        </div>
      </div>

      <button type="button" class="admin-add-global" aria-label="Pridat objednavku">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
      </button>
    </header>

    <section class="admin-list" aria-label="List of orders">
      <article class="admin-row admin-row--orders">
        <div class="admin-thumb" aria-hidden="true">
          <span class="admin-order-number">#TRK-2026-001</span>
        </div>

        <div class="admin-id">
          <div class="admin-order-customer">order.1</div>
          <div class="admin-order-date">27.03.2026</div>
        </div>

        <div class="admin-meta" role="group" aria-label="Stav objednávky 1">
          <button type="button" class="admin-meta-chip admin-meta-chip--status admin-meta-chip--pending" aria-label="Stav Spracováva sa">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="10"/><polyline points="12,6 12,12 16,14"/></svg>
            <span>Spracováva sa</span>
          </button>
          <button type="button" class="admin-meta-chip" aria-label="Celková suma 114.96 EUR">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
            <span>114.96 EUR</span>
          </button>
          <button type="button" class="admin-meta-chip" aria-label="Zobraziť detaily">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
            <span>Zobraziť</span>
          </button>
        </div>

        <div class="admin-actions">
          <button type="button" class="admin-action-btn admin-action-btn--edit" aria-label="Upraviť objednávku">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 20h9"/><path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4Z"/></svg>
          </button>
          <button type="button" class="admin-action-btn admin-action-btn--delete" aria-label="Zrušiť objednávku">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="5" y1="12" x2="19" y2="12" /></svg>
          </button>
        </div>
      </article>

      <article class="admin-row admin-row--orders">
        <div class="admin-thumb" aria-hidden="true">
          <span class="admin-order-number">#TRK-2026-002</span>
        </div>

        <div class="admin-id">
          <div class="admin-order-customer">order.2</div>
          <div class="admin-order-date">26.03.2026</div>
        </div>

        <div class="admin-meta" role="group" aria-label="Stav objednávky 2">
          <button type="button" class="admin-meta-chip admin-meta-chip--status admin-meta-chip--shipped" aria-label="Stav Odoslané">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="1" y="3" width="15" height="13"/><polyline points="16,8 20,8 23,11 23,16 16,16 16,8"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg>
            <span>Odoslané</span>
          </button>
          <button type="button" class="admin-meta-chip" aria-label="Celková suma 89.97 EUR">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
            <span>89.97 EUR</span>
          </button>
          <button type="button" class="admin-meta-chip" aria-label="Zobraziť detaily">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
            <span>Zobraziť</span>
          </button>
        </div>

        <div class="admin-actions">
          <button type="button" class="admin-action-btn admin-action-btn--edit" aria-label="Upraviť objednávku">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 20h9"/><path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4Z"/></svg>
          </button>
          <button type="button" class="admin-action-btn admin-action-btn--delete" aria-label="Zrušiť objednávku">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="5" y1="12" x2="19" y2="12" /></svg>
          </button>
        </div>
      </article>

      <article class="admin-row admin-row--orders">
        <div class="admin-thumb" aria-hidden="true">
          <span class="admin-order-number">#TRK-2026-003</span>
        </div>

        <div class="admin-id">
          <div class="admin-order-customer">order.3</div>
          <div class="admin-order-date">25.03.2026</div>
        </div>

        <div class="admin-meta" role="group" aria-label="Stav objednávky 3">
          <button type="button" class="admin-meta-chip admin-meta-chip--status admin-meta-chip--delivered" aria-label="Stav Doručené">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20,6 9,17 4,12"/></svg>
            <span>Doručené</span>
          </button>
          <button type="button" class="admin-meta-chip" aria-label="Celková suma 149.95 EUR">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
            <span>149.95 EUR</span>
          </button>
          <button type="button" class="admin-meta-chip" aria-label="Zobraziť detaily">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
            <span>Zobraziť</span>
          </button>
        </div>

        <div class="admin-actions">
          <button type="button" class="admin-action-btn admin-action-btn--edit" aria-label="Upraviť objednávku">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 20h9"/><path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4Z"/></svg>
          </button>
          <button type="button" class="admin-action-btn admin-action-btn--delete" aria-label="Zrušiť objednávku">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="5" y1="12" x2="19" y2="12" /></svg>
          </button>
        </div>
      </article>
    </section>
  </main>

  <footer class="admin-header-footer">
    <div class="container admin-header-footer__inner">
      <div class="admin-header-footer__links">
        <a href="products.html">Obchod</a>
        <a href="admin-products.html">Produkty</a>
        <a href="admin-orders.html">Objednavky</a>
        <a href="#">Nastavenia</a>
      </div>
      <p class="admin-header-footer__copy">Admin Panel WTECH 2026</p>
    </div>
  </footer>
</body>
</html>