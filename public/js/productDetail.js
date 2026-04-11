function selectSize(btn) {
    document.querySelectorAll('.product-detail__size').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
    document.getElementById('selectedSize').value = btn.dataset.sizeId;
}


document.getElementById('sortSelect').addEventListener('change', function() {
    document.getElementById('sortHidden').value = this.value;
    document.querySelector('.filter-sidebar').submit();
});

function changeQty(delta) {
    const input = document.getElementById('quantityInput');
    input.value = Math.max(1, parseInt(input.value) + delta);
}

