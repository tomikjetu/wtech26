<header class="admin-header-header">
  <div class="container admin-header-header__inner">
    <a href="/admin" class="admin-header-logo">trickohouse admin</a>

    <nav class="admin-header-nav" aria-label="Admin navigation">
      <a href="/" class="admin-header-link">Obchod</a>
      <a href="/admin/products" class="admin-header-link {{ ($page ?? '') === 'products' ? 'admin-header-link--active' : '' }}" aria-current="{{ ($page ?? '') === 'products' ? 'page' : 'false' }}">Produkty</a>
      <a href="/admin/orders" class="admin-header-link {{ ($page ?? '') === 'orders' ? 'admin-header-link--active' : '' }}" aria-current="{{ ($page ?? '') === 'orders' ? 'page' : 'false' }}">Objednavky</a>
    </nav>

    {!! $hideLogout ? null : '
      <form method="POST" action="/admin/logout">
          @csrf
          <button type="submit" class="admin-btn admin-btn--logout">ODHLASIŤ</button>
      </form>
    ' !!}
  </div>
</header>