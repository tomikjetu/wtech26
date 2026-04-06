<a href="{{ route('product.detail', $product->id) }}" class="product-card">
    <button class="wishlist-btn" aria-label="Add to wishlist" onclick="event.preventDefault(); event.stopPropagation();"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg></button>
    <div class="product-card__img"></div>
    <p class="product-card__name">{{ $product->name }}</p>
    <p class="product-card__price">{{ $product->price }}€</p>
</a>