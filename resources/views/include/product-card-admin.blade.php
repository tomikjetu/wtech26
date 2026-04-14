<article class="admin-row">
    <div class="admin-thumb" aria-hidden="true">
        @if ($product->images->isNotEmpty())
            <img src="{{ asset($product->images->first()->path) }}" alt="{{ $product->name }}" />
        @endif
    </div>
    <div class="admin-id">
        <label class="sr-only" for="name-{{ $product->id }}">Nazov produktu</label>
        <input id="name-{{ $product->id }}" type="text" value="{{ $product->name }}" />
    </div>
    <div class="admin-meta" role="group" aria-label="Nastavenia produktu {{ $product->id }}">
        <button type="button" class="admin-meta-chip"><span>Cena: {{ $product->price }} EUR</span></button>
        <button type="button" class="admin-meta-chip"><span>Sklad: {{ $product->stock }} ks</span></button>
        <button type="button" class="admin-meta-chip"><span>Kategorie: {{ $product->category->display_name }}</span></button>
    </div>
    <button type="button" class="admin-remove" aria-label="Odstranit produkt" onclick="deleteProduct({{ $product->id }})">
        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="5" y1="12" x2="19" y2="12" /></svg>
    </button>
</article>

<script>
    function deleteProduct(productId) {
        if (confirm('Naozaj chcete odstrániť tento produkt?')) {
            fetch(`/admin/products/${productId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                }
            })
            .then(response => {
                if (response.ok) {
                    location.reload();
                } else {
                    alert('Nepodarilo se odstranit produkt.');
                }
            })
            .catch(error => {
                console.error('Chyba při odstraňování produktu:', error);
                alert('Nastala chyba při odstraňování produktu.');
            });
        }
    }
</script>