@php
  $cartCount  = $cartCount ?? 0;
    $notifCount = 1;
  $categories = \App\Models\Category::orderBy('id')->get();

    $isProductsCat = request()->routeIs('products.category');
    $catSlug       = $isProductsCat ? request()->route('slug') : null;

    $isAllProducts = request()->routeIs('products.all')
                  || request()->routeIs('products.featured')
          || request()->routeIs('products.search');

    $isMuzi   = $isProductsCat && $catSlug === 'men';
    $isZeny   = $isProductsCat && $catSlug === 'women';
@endphp

  <!-- ===== TOP NAV ===== -->
  <header class="top-nav">
    <div class="container top-nav__inner">

      <nav class="top-nav__links">
        <a href="{{ route('products.all') }}"              class="top-nav__link {{ $isAllProducts ? 'active' : '' }}">VŠETKO</a>
        <a href="{{ route('products.category', 'men') }}" class="top-nav__link {{ $isMuzi  ? 'active' : '' }}">MUŽ</a>
        <a href="{{ route('products.category', 'women') }}" class="top-nav__link {{ $isZeny  ? 'active' : '' }}">ŽENA</a>
      </nav>

      <a href="{{ route('home') }}" class="top-nav__logo">trickohouse</a>

      <div class="top-nav__icons">
        <a href="{{ route('profile') }}" class="icon-btn" aria-label="Account">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
        </a>

        <a href="#" class="icon-btn notif-btn" aria-label="Notifications">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg>
          @if ($notifCount > 0)
            <span class="notif-badge">{{ $notifCount }}</span>
          @endif
        </a>

        <a href="{{ route('cart') }}" class="icon-btn cart-btn" aria-label="Cart">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>
          <span class="cart-badge">{{ $cartCount }}</span>
        </a>

        <a href="#" class="icon-btn" aria-label="Wishlist">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
        </a>
      </div>

    </div>
  </header>

  <!-- ===== SECONDARY NAV ===== -->
  <nav class="sec-nav">
    <div class="container sec-nav__inner">
      <div class="sec-nav__left">
        @foreach ($categories as $category)
          <a href="{{ route('products.category', $category->name) }}" class="sec-nav__link {{ $isProductsCat && $catSlug === $category->name ? 'active' : '' }}">{{ mb_strtoupper($category->display_name) }}</a>
        @endforeach
      </div>
      <form class="sec-nav__search" data-search-base="{{ url('/produkty/hladat') }}" action="#" onsubmit="return false;">
        <input type="text" placeholder="Vyhľadať..." aria-label="Vyhľadať" />
        <button type="submit" aria-label="Search">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
        </button>
      </form>
    </div>
  </nav>
