function switchImage(thumbnail, src) {
    document.getElementById('mainProductImage').src = src;
    document.querySelectorAll('.product-detail__thumbnail').forEach(t => t.classList.remove('active'));
    thumbnail.classList.add('active');
}

function selectSize(btn) {
    document.querySelectorAll('.product-detail__size').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
    document.getElementById('selectedSize').value = btn.dataset.sizeId;
}


// Custom sort dropdown
(function () {
    var trigger = document.getElementById('sortTrigger');
    var menu    = document.getElementById('sortMenu');
    var current = document.getElementById('sortCurrent');
    var hidden  = document.getElementById('sortHidden');
    if (!trigger || !menu) return;

    function closeMenu() {
        menu.classList.remove('sort-dropdown__menu--open');
        trigger.setAttribute('aria-expanded', 'false');
    }

    trigger.addEventListener('click', function (e) {
        e.stopPropagation();
        var open = menu.classList.toggle('sort-dropdown__menu--open');
        trigger.setAttribute('aria-expanded', open ? 'true' : 'false');
    });

    menu.querySelectorAll('.sort-dropdown__option').forEach(function (opt) {
        opt.addEventListener('click', function () {
            var value = this.dataset.value;
            // update display
            current.textContent = this.textContent.trim();
            // update active state
            menu.querySelectorAll('.sort-dropdown__option').forEach(function (o) {
                o.classList.remove('sort-dropdown__option--active');
            });
            this.classList.add('sort-dropdown__option--active');
            closeMenu();
            // sync hidden + submit
            if (hidden) hidden.value = value;
            var form = document.querySelector('.filter-sidebar');
            if (form) form.submit();
        });
    });

    // close on outside click
    document.addEventListener('click', function (e) {
        if (!trigger.contains(e.target) && !menu.contains(e.target)) {
            closeMenu();
        }
    });

    // close on Escape
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') closeMenu();
    });
}());

function changeQty(delta) {
    const input = document.getElementById('quantityInput');
    input.value = Math.max(1, parseInt(input.value) + delta);
}

