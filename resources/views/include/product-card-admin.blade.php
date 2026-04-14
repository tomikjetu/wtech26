<article class="admin-row" data-product-id="{{ $product->id }}" data-product-name="{{ strtolower($product->name) }}">

  <!-- Collapsed header (clickable to expand) -->
  <div class="admin-row__header" onclick="toggleProduct({{ $product->id }})">

    <div class="admin-thumb" aria-hidden="true">
      @if($product->images->isNotEmpty())
        <img src="{{ asset($product->images->first()->path) }}" alt="{{ $product->name }}" />
      @endif
    </div>

    <span class="admin-row__name">{{ $product->name }}</span>

    <div class="admin-meta">
      <span class="admin-meta-chip chip-price-{{ $product->id }}">{{ number_format((float)$product->price, 2) }} EUR</span>
      <span class="admin-meta-chip chip-stock-{{ $product->id }}">{{ $product->stock }} ks</span>
      <span class="admin-meta-chip chip-cat-{{ $product->id }}">{{ $product->category->display_name }}</span>
      @if($product->sale_percent > 0)
        <span class="admin-meta-chip admin-meta-chip--sale chip-sale-{{ $product->id }}">-{{ $product->sale_percent }}%</span>
      @endif
    </div>

    <div class="admin-row__controls" onclick="event.stopPropagation()">
      <button type="button"
              class="admin-expand-btn"
              id="expand-btn-{{ $product->id }}"
              aria-expanded="false"
              aria-label="Rozbaliť produkt">
        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="6 9 12 15 18 9"/></svg>
      </button>
      <button type="button"
              class="admin-remove"
              aria-label="Odstraniť produkt"
              onclick="deleteProduct({{ $product->id }}, event)">
        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/><path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/></svg>
      </button>
    </div>
  </div>

  <!-- Expanded edit section -->
  <div class="admin-row__body" id="body-{{ $product->id }}" style="display:none">
    <form class="admin-edit-form"
          id="edit-form-{{ $product->id }}"
          onsubmit="saveProduct({{ $product->id }}, event)"
          enctype="multipart/form-data">
      @csrf

      <!-- Hidden inputs for image removal (populated by JS) -->
      <div id="remove-inputs-{{ $product->id }}"></div>

      <!-- Image gallery -->
      <div class="admin-edit-section">
        <p class="admin-edit-section__label">Fotografie</p>
        <div class="admin-edit-images" id="images-{{ $product->id }}">
          @foreach($product->images as $image)
            <div class="admin-image-item" id="image-item-{{ $image->id }}">
              <img src="{{ asset($image->path) }}" alt="" />
              <button type="button"
                      class="admin-image-remove"
                      onclick="markImageForRemoval({{ $product->id }}, {{ $image->id }}, this)"
                      aria-label="Odstraniť obrázok">
                <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
              </button>
            </div>
          @endforeach
          <label class="admin-image-add" title="Pridať fotografie">
            <input type="file"
                   name="photos[]"
                   multiple
                   accept="image/*"
                   onchange="previewNewImages({{ $product->id }}, this)" />
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
          </label>
        </div>
      </div>

      <!-- Fields -->
      <div class="admin-edit-fields">

        <div class="admin-form-group admin-form-group--full">
          <label for="edit-name-{{ $product->id }}">Názov *</label>
          <input type="text"
                 id="edit-name-{{ $product->id }}"
                 name="name"
                 value="{{ $product->name }}"
                 required />
        </div>

        <div class="admin-form-group admin-form-group--full">
          <label for="edit-desc-{{ $product->id }}">Popis</label>
          <textarea id="edit-desc-{{ $product->id }}"
                    name="description"
                    rows="3">{{ $product->description }}</textarea>
        </div>

        <div class="admin-form-group">
          <label for="edit-price-{{ $product->id }}">Cena (EUR) *</label>
          <input type="number"
                 id="edit-price-{{ $product->id }}"
                 name="price"
                 value="{{ $product->price }}"
                 step="0.01" min="0" required />
        </div>

        <div class="admin-form-group">
          <label for="edit-stock-{{ $product->id }}">Sklad (ks) *</label>
          <input type="number"
                 id="edit-stock-{{ $product->id }}"
                 name="stock"
                 value="{{ $product->stock }}"
                 min="0" required />
        </div>

        <div class="admin-form-group">
          <label for="edit-color-{{ $product->id }}">Farba</label>
          <input type="text"
                 id="edit-color-{{ $product->id }}"
                 name="color"
                 value="{{ $product->color }}"
                 placeholder="Napr. čierna" />
        </div>

        <div class="admin-form-group">
          <label for="edit-sale-{{ $product->id }}">Zľava (%)</label>
          <input type="number"
                 id="edit-sale-{{ $product->id }}"
                 name="sale_percent"
                 value="{{ $product->sale_percent }}"
                 min="0" max="100" />
        </div>

        <!-- Category -->
        <div class="admin-form-group admin-form-group--full">
          <label>Kategória *</label>
          <div class="admin-category-grid">
            @foreach($categories as $category)
              <input type="radio"
                     class="admin-category-input"
                     name="category_id"
                     id="edit-cat-{{ $product->id }}-{{ $category->id }}"
                     value="{{ $category->id }}"
                     {{ $product->category_id == $category->id ? 'checked' : '' }}
                     required />
              <label class="admin-category-label"
                     for="edit-cat-{{ $product->id }}-{{ $category->id }}">{{ $category->display_name }}</label>
            @endforeach
          </div>
        </div>

        <!-- Sizes -->
        <div class="admin-form-group admin-form-group--full">
          <label>Veľkosti</label>
          <div class="admin-size-grid">
            @foreach($sizes as $size)
              <input type="checkbox"
                     class="admin-size-input"
                     name="sizes[]"
                     id="edit-size-{{ $product->id }}-{{ $size->id }}"
                     value="{{ $size->id }}"
                     {{ $product->sizes->pluck('id')->contains($size->id) ? 'checked' : '' }} />
              <label class="admin-size-label"
                     for="edit-size-{{ $product->id }}-{{ $size->id }}">{{ $size->name }}</label>
            @endforeach
          </div>
        </div>

      </div><!-- /admin-edit-fields -->

      <!-- Actions -->
      <div class="admin-edit-actions">
        <button type="button"
                class="admin-modal__btn admin-modal__btn--cancel"
                onclick="cancelEdit({{ $product->id }})">Zrušiť</button>
        <button type="submit"
                class="admin-modal__btn admin-modal__btn--save save-btn">
          <span class="btn-text">Uložiť zmeny</span>
        </button>
      </div>

    </form>
  </div><!-- /admin-row__body -->

</article>
