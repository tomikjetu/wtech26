<!DOCTYPE html>
<html lang="sk">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin Produkty - trickohouse</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Irish+Grover&family=Nunito:wght@400;600;700;900&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/admin-header.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/admin.css') }}" />
</head>
<body class="admin-page">
    @include('include.admin-header', ['page' => 'products'])
<main class="admin-shell">
    <header class="admin-toolbar" aria-label="Admin panel toolbar">
      <div class="admin-toolbar__left">
        <div class="admin-module admin-module--icon-left">
          <label class="sr-only" for="admin-sort">Sortovanie</label>
          <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="4" y1="21" x2="4" y2="14"></line><line x1="4" y1="10" x2="4" y2="3"></line><line x1="12" y1="21" x2="12" y2="12"></line><line x1="12" y1="8" x2="12" y2="3"></line><line x1="20" y1="21" x2="20" y2="16"></line><line x1="20" y1="12" x2="20" y2="3"></line><line x1="1" y1="14" x2="7" y2="14"></line><line x1="9" y1="8" x2="15" y2="8"></line><line x1="17" y1="16" x2="23" y2="16"></line></svg>
          <input id="admin-sort" type="text" placeholder="Sort / Filter" />
        </div>

        <div class="admin-module admin-module--icon-left">
          <label class="sr-only" for="admin-search">Vyhladavanie produktu</label>
          <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="11" cy="11" r="8" /><line x1="21" y1="21" x2="16.65" y2="16.65" /></svg>
          <input id="admin-search" type="text" placeholder="Search product" />
        </div>

        <div class="admin-module admin-module--readonly">
          <span>Produkty (4)</span>
        </div>
      </div>

      <button type="button" class="admin-add-global" aria-label="Pridat produkt" onclick="openProductModal()">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
      </button>
    </header>

    <section class="admin-list" aria-label="Zoznam produktov">
      @foreach($products as $product)
        @include('include.product-card-admin')
      @endforeach

      <button type="button" class="admin-add-row" aria-label="Pridat novy produkt" onclick="openProductModal()">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
      </button>
    </section>

    <!-- Product Modal -->
    <div id="productModal" class="admin-modal">
      <div class="admin-modal__backdrop" onclick="closeProductModal()"></div>
      <div class="admin-modal__content">
        <div class="admin-modal__header">
          <h2>Pridať produkt</h2>
          <button type="button" class="admin-modal__close" onclick="closeProductModal()">✕</button>
        </div>
            <form id="productForm" class="admin-modal__form" method="POST" action="{{ route('products.store') }}">
            @csrf
              <div class="admin-form-group">
            <label for="productName">Názov produktu *</label>
            <input type="text" id="productName" name="name" required placeholder="Napríklad: TrickoHouse core" />
            <span class="admin-form-error" id="nameError"></span>
          </div>
          <div class="admin-form-group">
            <label for="productDescription">Popis *</label>
            <textarea id="productDescription" name="description" required placeholder="Popis produktu..." rows="4"></textarea>
            <span class="admin-form-error" id="descriptionError"></span>
          </div>
          <div class="admin-form-group">
            <label for="productPrice">Cena (EUR) *</label>
            <input type="number" id="productPrice" name="price" required placeholder="Napríklad: 24.99" step="0.01" min="0" />
            <span class="admin-form-error" id="priceError"></span>
          </div>
          <div class="admin-form-group">
            <label for="productStock">Sklad (ks) *</label>
            <input type="number" id="productStock" name="stock" required placeholder="Napríklad: 100" min="0" />
            <span class="admin-form-error" id="stockError"></span>
          </div>
          <div class="admin-form-group">
            <div class="admin-category-header">
              <label>Kategória *</label>
            </div>
            <div class="admin-category-grid">
              <input type="radio" class="admin-category-option" name="category" id="cat-muzi" value="muzi" />
              <label class="admin-btn" for="cat-muzi">Muži</label>
              <input type="radio" class="admin-category-option" name="category" id="cat-zeny" value="zeny" />
              <label class="admin-btn" for="cat-zeny">Ženy</label>
              <input type="radio" class="admin-category-option" name="category" id="cat-oblecenie" value="oblecenie" />
              <label class="admin-btn" for="cat-oblecenie">Oblečenie</label>
              <input type="radio" class="admin-category-option" name="category" id="cat-topanky" value="topanky" />
              <label class="admin-btn" for="cat-topanky">Topánky</label>
              <input type="radio" class="admin-category-option" name="category" id="cat-vypredaj" value="vypredaj" />
              <label class="admin-btn" for="cat-vypredaj">Výpredaj</label>
              <input type="radio" class="admin-category-option" name="category" id="cat-doplnky" value="doplnky" />
              <label class="admin-btn" for="cat-doplnky">Doplnky</label>
            </div>
            <span class="admin-form-error" id="categoryError"></span>
          </div>
          <div class="admin-form-group">
            <label for="productPhotos">Fotografie (minimum 2) *</label>
            <input type="file" id="productPhotos" name="photos" multiple accept="image/*" />
            <span class="admin-form-error" id="photosError"></span>
            <div id="photoPreview" class="admin-photo-preview"></div>
          </div>
          <div class="admin-modal__actions">
            <button type="button" class="admin-modal__btn admin-modal__btn--cancel" onclick="closeProductModal()">Zrušiť</button>
            <button type="submit" class="admin-modal__btn admin-modal__btn--save">Uložiť produkt</button>
          </div>
        </form>
      </div>
    </div>
  </main>

  <footer class="admin-header-footer">
    <div class="container admin-header-footer__inner">
      <div class="admin-header-footer__links">
        <a href="products.html">Obchod</a>
        <a href="admin-products.html">Produkty</a>
        <a href="#">Objednavky</a>
        <a href="#">Nastavenia</a>
      </div>
      <p class="admin-header-footer__copy">Admin Panel WTECH 2026</p>
    </div>
  </footer>

  <script>
    function openProductModal() {
      document.getElementById('productModal').classList.add('admin-modal--visible');
    }
    function closeProductModal() {
      document.getElementById('productModal').classList.remove('admin-modal--visible');
    }
  </script>

</body>
</html>