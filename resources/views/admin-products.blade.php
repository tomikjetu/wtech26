<!DOCTYPE html>
<html lang="sk">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="csrf-token" content="{{ csrf_token() }}" />
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

    <!-- Toolbar -->
    <header class="admin-toolbar" aria-label="Admin panel toolbar">
      <div class="admin-toolbar__left">
        <div class="admin-module admin-module--icon-left">
          <label class="sr-only" for="admin-search">Vyhľadávanie produktu</label>
          <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
          <input id="admin-search" type="text" placeholder="Hľadať produkt..." autocomplete="off" />
        </div>
        <div class="admin-module admin-module--readonly">
          <span id="product-count">Produkty ({{ $products->count() }})</span>
        </div>
      </div>
      <button type="button" class="admin-add-global" aria-label="Pridať produkt" onclick="openProductModal()">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
      </button>
    </header>

    <!-- Toast notification -->
    <div id="admin-toast" class="admin-toast" aria-live="polite"></div>

    <!-- Product list -->
    <section class="admin-list" aria-label="Zoznam produktov">
      @foreach($products as $product)
        @include('include.product-card-admin')
      @endforeach

      <button type="button" class="admin-add-row" aria-label="Pridať nový produkt" onclick="openProductModal()">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        <span>Pridať produkt</span>
      </button>
    </section>

    <!-- Add Product Modal -->
    <div id="productModal" class="admin-modal" role="dialog" aria-modal="true" aria-labelledby="modal-title">
      <div class="admin-modal__backdrop" onclick="closeProductModal()"></div>
      <div class="admin-modal__content">
        <div class="admin-modal__header">
          <h2 id="modal-title">Pridať produkt</h2>
          <button type="button" class="admin-modal__close" onclick="closeProductModal()" aria-label="Zavrieť">✕</button>
        </div>
        <form id="productForm" class="admin-modal__form">
          @csrf
          <div class="admin-form-group">
            <label for="add-name">Názov produktu *</label>
            <input type="text" id="add-name" name="name" required placeholder="Napr. TrickoHouse Core" />
            <span class="admin-form-error" id="add-nameError"></span>
          </div>
          <div class="admin-form-group">
            <label for="add-description">Popis</label>
            <textarea id="add-description" name="description" rows="4" placeholder="Popis produktu..."></textarea>
          </div>
          <div class="admin-edit-grid">
            <div class="admin-form-group">
              <label for="add-price">Cena (EUR) *</label>
              <input type="number" id="add-price" name="price" required placeholder="24.99" step="0.01" min="0" />
            </div>
            <div class="admin-form-group">
              <label for="add-stock">Sklad (ks) *</label>
              <input type="number" id="add-stock" name="stock" required placeholder="100" min="0" />
            </div>
            <div class="admin-form-group">
              <label for="add-color">Farba</label>
              <input type="text" id="add-color" name="color" placeholder="Napr. čierna" />
            </div>
            <div class="admin-form-group">
              <label for="add-sale">Zľava (%)</label>
              <input type="number" id="add-sale" name="sale_percent" placeholder="0" min="0" max="100" />
            </div>
          </div>
          <div class="admin-form-group">
            <label>Kategória *</label>
            <div class="admin-category-grid">
              @foreach($categories as $category)
                <input type="radio" class="admin-category-input" name="category_id" id="add-cat-{{ $category->id }}" value="{{ $category->id }}" required />
                <label class="admin-category-label" for="add-cat-{{ $category->id }}">{{ $category->display_name }}</label>
              @endforeach
            </div>
            <span class="admin-form-error" id="add-categoryError"></span>
          </div>
          <div class="admin-form-group">
            <label>Veľkosti</label>
            <div class="admin-size-grid">
              @foreach($sizes as $size)
                <input type="checkbox" class="admin-size-input" name="sizes[]" id="add-size-{{ $size->id }}" value="{{ $size->id }}" />
                <label class="admin-size-label" for="add-size-{{ $size->id }}">{{ $size->name }}</label>
              @endforeach
            </div>
          </div>
          <div class="admin-form-group">
            <label for="add-photos">Fotografie</label>
            <label class="admin-file-drop" id="add-file-drop">
              <input type="file" id="add-photos" name="photos[]" multiple accept="image/*" onchange="previewAddImages(this)" />
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>
              <span>Kliknite alebo pretiahnite obrázky</span>
            </label>
            <div id="add-photo-preview" class="admin-photo-preview"></div>
          </div>
          <div class="admin-modal__actions">
            <button type="button" class="admin-modal__btn admin-modal__btn--cancel" onclick="closeProductModal()">Zrušiť</button>
            <button type="button" class="admin-modal__btn admin-modal__btn--save" onclick="submitAddForm(this)">
              <span class="btn-text">Uložiť produkt</span>
            </button>
          </div>
        </form>
      </div>
    </div>

  </main>

  <footer class="admin-header-footer">
    <div class="container admin-header-footer__inner">
      <div class="admin-header-footer__links">
        <a href="{{ route('home') }}">Obchod</a>
        <a href="{{ route('admin.products') }}">Produkty</a>
        <a href="{{ route('admin.orders') }}">Objednávky</a>
      </div>
      <p class="admin-header-footer__copy">Admin Panel WTECH 2026</p>
    </div>
  </footer>

  <script>
    const CSRF = document.querySelector('meta[name="csrf-token"]').content;
    let totalProducts = {{ $products->count() }};

    /* ── Modal ── */
    function openProductModal() {
      document.getElementById('productModal').classList.add('admin-modal--visible');
      document.body.style.overflow = 'hidden';
    }
    function closeProductModal() {
      document.getElementById('productModal').classList.remove('admin-modal--visible');
      document.body.style.overflow = '';
      document.getElementById('productForm').reset();
      document.getElementById('add-photo-preview').innerHTML = '';
    }

    /* ── Submit add form ── */
    async function submitAddForm(btn) {
      const form = document.getElementById('productForm');
      if (!form.checkValidity()) { form.reportValidity(); return; }

      btn.disabled = true;
      btn.querySelector('.btn-text').textContent = 'Ukladá sa...';

      const formData = new FormData(form);

      try {
        const resp = await fetch('{{ route("products.store") }}', {
          method: 'POST',
          headers: { 'X-CSRF-TOKEN': CSRF, 'Accept': 'application/json' },
          body: formData,
        });
        const data = await resp.json();
        if (data.success) {
          closeProductModal();
          showToast('Produkt bol úspešne pridaný.', 'success');
          setTimeout(() => location.reload(), 900);
        } else {
          throw new Error(JSON.stringify(data.errors || data.message || 'Chyba'));
        }
      } catch (err) {
        showToast('Chyba: ' + err.message, 'error');
        btn.disabled = false;
        btn.querySelector('.btn-text').textContent = 'Uložiť produkt';
      }
    }

    /* ── Add-modal image preview ── */
    function previewAddImages(input) {
      const container = document.getElementById('add-photo-preview');
      container.innerHTML = '';
      Array.from(input.files).forEach(file => {
        const reader = new FileReader();
        reader.onload = e => {
          const div = document.createElement('div');
          div.className = 'admin-preview-thumb';
          div.innerHTML = `<img src="${e.target.result}" alt="" />`;
          container.appendChild(div);
        };
        reader.readAsDataURL(file);
      });
    }

    /* ── Expand / collapse product row ── */
    function toggleProduct(id) {
      const body  = document.getElementById('body-' + id);
      const btn   = document.getElementById('expand-btn-' + id);
      const open  = body.style.display !== 'none' && body.style.display !== '';
      body.style.display = open ? 'none' : 'block';
      btn.setAttribute('aria-expanded', !open);
      btn.classList.toggle('rotated', !open);
    }

    function cancelEdit(id) {
      const body = document.getElementById('body-' + id);
      body.style.display = 'none';
      const btn = document.getElementById('expand-btn-' + id);
      btn.setAttribute('aria-expanded', 'false');
      btn.classList.remove('rotated');
      // Clear removal marks
      document.querySelectorAll('#images-' + id + ' .admin-image-item').forEach(el => {
        el.classList.remove('marked-for-removal');
      });
      document.getElementById('remove-inputs-' + id).innerHTML = '';
      // Clear new photo previews
      const gallery = document.getElementById('images-' + id);
      if (gallery) gallery.querySelectorAll('.admin-image-preview-new').forEach(el => el.remove());
    }

    /* ── Mark existing image for removal ── */
    function markImageForRemoval(productId, imageId, btn) {
      const item = document.getElementById('image-item-' + imageId);
      const marked = item.classList.toggle('marked-for-removal');
      const container = document.getElementById('remove-inputs-' + productId);
      const existing = container.querySelector('[data-img-id="' + imageId + '"]');
      if (marked && !existing) {
        const inp = document.createElement('input');
        inp.type = 'hidden';
        inp.name = 'remove_images[]';
        inp.value = imageId;
        inp.dataset.imgId = imageId;
        container.appendChild(inp);
      } else if (!marked && existing) {
        existing.remove();
      }
    }

    /* ── Preview new images (edit form) ── */
    function previewNewImages(productId, input) {
      const gallery = document.getElementById('images-' + productId);
      gallery.querySelectorAll('.admin-image-preview-new').forEach(el => el.remove());
      const addLabel = gallery.querySelector('.admin-image-add');
      Array.from(input.files).forEach(file => {
        const reader = new FileReader();
        reader.onload = e => {
          const div = document.createElement('div');
          div.className = 'admin-image-item admin-image-preview-new';
          div.innerHTML = '<img src="' + e.target.result + '" alt="" />';
          gallery.insertBefore(div, addLabel);
        };
        reader.readAsDataURL(file);
      });
    }

    /* ── Save edited product ── */
    async function saveProduct(id, event) {
      event.preventDefault();
      const form = document.getElementById('edit-form-' + id);
      const btn  = form.querySelector('.save-btn');
      btn.disabled = true;
      btn.querySelector('.btn-text').textContent = 'Ukladá sa...';

      const formData = new FormData(form);

      try {
        const resp = await fetch('/admin/products/' + id, {
          method: 'POST',
          headers: { 'X-CSRF-TOKEN': CSRF, 'Accept': 'application/json' },
          body: formData,
        });
        const data = await resp.json();

        if (resp.ok && data.success) {
          const p = data.product;
          const row = document.querySelector('[data-product-id="' + id + '"]');

          // Update collapsed display
          row.setAttribute('data-product-name', p.name.toLowerCase());
          row.querySelector('.admin-row__name').textContent = p.name;
          row.querySelector('.chip-price-' + id).textContent = p.price + ' EUR';
          row.querySelector('.chip-stock-' + id).textContent = p.stock + ' ks';
          row.querySelector('.chip-cat-' + id).textContent = p.category;

          // Update sale chip
          const existingSale = row.querySelector('.chip-sale-' + id);
          if (p.sale_percent > 0) {
            if (existingSale) {
              existingSale.textContent = '-' + p.sale_percent + '%';
            } else {
              const chip = document.createElement('span');
              chip.className = 'admin-meta-chip admin-meta-chip--sale chip-sale-' + id;
              chip.textContent = '-' + p.sale_percent + '%';
              row.querySelector('.admin-meta').appendChild(chip);
            }
          } else if (existingSale) {
            existingSale.remove();
          }

          // Update thumbnail
          if (p.image) {
            const thumb = row.querySelector('.admin-thumb img');
            const src = '/' + p.image + '?v=' + Date.now();
            if (thumb) { thumb.src = src; }
            else {
              const img = document.createElement('img');
              img.src = src;
              img.alt = p.name;
              row.querySelector('.admin-thumb').appendChild(img);
            }
          }

          cancelEdit(id);
          showToast('Zmeny boli uložené.', 'success');
        } else {
          const errors = data.errors ? Object.values(data.errors).flat().join(', ') : (data.message || 'Neznáma chyba');
          throw new Error(errors);
        }
      } catch (err) {
        showToast('Chyba: ' + err.message, 'error');
      } finally {
        btn.disabled = false;
        btn.querySelector('.btn-text').textContent = 'Uložiť zmeny';
      }
    }

    /* ── Delete product ── */
    function deleteProduct(productId, event) {
      if (event) event.stopPropagation();
      if (!confirm('Naozaj chcete odstrániť tento produkt?')) return;

      fetch('/admin/products/' + productId, {
        method: 'DELETE',
        headers: { 'X-CSRF-TOKEN': CSRF, 'Content-Type': 'application/json' },
      }).then(resp => {
        if (resp.ok) {
          const row = document.querySelector('[data-product-id="' + productId + '"]');
          row.remove();
          totalProducts--;
          updateCount();
          showToast('Produkt bol odstránený.', 'success');
        } else {
          showToast('Nepodarilo sa odstrániť produkt.', 'error');
        }
      }).catch(() => showToast('Nastala chyba.', 'error'));
    }

    /* ── Search ── */
    document.getElementById('admin-search').addEventListener('input', function () {
      const q = this.value.toLowerCase().trim();
      let visible = 0;
      document.querySelectorAll('.admin-row[data-product-id]').forEach(row => {
        const name = row.getAttribute('data-product-name') || '';
        const match = !q || name.includes(q);
        row.style.display = match ? '' : 'none';
        if (match) visible++;
      });
      document.getElementById('product-count').textContent = 'Produkty (' + visible + ')';
    });

    function updateCount() {
      const visible = document.querySelectorAll('.admin-row[data-product-id]').length;
      document.getElementById('product-count').textContent = 'Produkty (' + visible + ')';
    }

    /* ── Toast ── */
    function showToast(msg, type) {
      const t = document.getElementById('admin-toast');
      t.textContent = msg;
      t.className = 'admin-toast admin-toast--' + type + ' admin-toast--visible';
      setTimeout(() => t.classList.remove('admin-toast--visible'), 3000);
    }

    /* ── Close modal on Escape ── */
    document.addEventListener('keydown', e => {
      if (e.key === 'Escape') closeProductModal();
    });
  </script>

</body>
</html>
