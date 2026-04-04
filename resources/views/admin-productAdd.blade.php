<!DOCTYPE html>
<html lang="sk">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin Produkty - trickohouse</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Irish+Grover&family=Nunito:wght@400;600;700;900&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="styles/style.css" />
  <link rel="stylesheet" href="styles/admin-header.css" />
  <link rel="stylesheet" href="styles/admin.css" />
</head>
<body class="admin-page">
  @include('include.admin-header')
<main class="admin-shell">

    <!-- Product Modal -->
    <div id="productModal" class="admin-modal admin-modal--visible">
      <div class="admin-modal__backdrop" onclick="closeProductModal()"></div>
      <div class="admin-modal__content">
        <div class="admin-modal__header">
          <h2 id="modalTitle">Pridať produkt</h2>
          <button type="button" class="admin-modal__close" onclick="closeProductModal()">✕</button>
        </div>

        <form id="productForm" class="admin-modal__form">

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

          <!-- Category picker -->
          <div class="admin-form-group">
            <div class="admin-category-header">
              <label>Kategória *</label>
              <a href="admin-categories.html">Správa kategórií</a>
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
            <a href="admin-products.html">
              <button type="button" class="admin-modal__btn admin-modal__btn--cancel" onclick="closeProductModal()">Zrušiť</button>
            </a>
            <button type="submit" class="admin-modal__btn admin-modal__btn--save">Uložiť produkt</button>
          </div>

        </form>
      </div>
    </div>

  </main>

</body>
</html>