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

// Dual-handle price range
(function () {
    var rangeEl = document.getElementById('priceRange');
    var minInput = document.getElementById('priceMin');
    var maxInput = document.getElementById('priceMax');
    var minHandle = document.getElementById('priceMinHandle');
    var maxHandle = document.getElementById('priceMaxHandle');
    var selectedTrack = document.getElementById('priceSelectedTrack');
    var minDisplay = document.getElementById('priceMinDisplay');
    var maxDisplay = document.getElementById('priceMaxDisplay');
    if (!rangeEl || !minInput || !maxInput || !minHandle || !maxHandle || !selectedTrack || !minDisplay || !maxDisplay) return;

    var form = document.querySelector('.filter-sidebar');
    var hardMin = Number(rangeEl.dataset.min);
    var hardMax = Number(rangeEl.dataset.max);
    var step = Number(rangeEl.dataset.step) || 1;

    var dragging = null;
    var moved = false;

    function clamp(value, min, max) {
        return Math.max(min, Math.min(value, max));
    }

    function snap(value) {
        return Math.round(value / step) * step;
    }

    function valueToPercent(value) {
        var range = Math.max(1, hardMax - hardMin);
        return ((value - hardMin) / range) * 100;
    }

    function pointerToValue(clientX) {
        var rect = rangeEl.getBoundingClientRect();
        var ratio = clamp((clientX - rect.left) / Math.max(1, rect.width), 0, 1);
        return snap(hardMin + ratio * (hardMax - hardMin));
    }

    function getValues() {
        var minVal = Number(minInput.value);
        var maxVal = Number(maxInput.value);

        minVal = snap(clamp(minVal, hardMin, hardMax));
        maxVal = snap(clamp(maxVal, hardMin, hardMax));

        if (minVal > maxVal) {
            var t = minVal;
            minVal = maxVal;
            maxVal = t;
        }

        minInput.value = String(minVal);
        maxInput.value = String(maxVal);

        return { minVal: minVal, maxVal: maxVal };
    }

    function render() {
        var values = getValues();
        var minVal = values.minVal;
        var maxVal = values.maxVal;

        var from = valueToPercent(minVal);
        var to = valueToPercent(maxVal);
        var width = Math.max(0.5, to - from);

        minHandle.style.left = from + '%';
        maxHandle.style.left = to + '%';
        selectedTrack.style.left = from + '%';
        selectedTrack.style.width = width + '%';

        minDisplay.textContent = minVal + '€';
        maxDisplay.textContent = maxVal + '€';
    }

    function submitFilters() {
        if (form) form.submit();
    }

    function startDrag(which, e) {
        e.preventDefault();
        dragging = which;
        moved = false;

        if (which === 'min') {
            minHandle.classList.add('filter-range__handle--dragging');
        } else {
            maxHandle.classList.add('filter-range__handle--dragging');
        }
    }

    function updateDrag(clientX) {
        if (!dragging) return;
        moved = true;

        var values = getValues();
        var next = pointerToValue(clientX);

        if (dragging === 'min') {
            values.minVal = clamp(next, hardMin, values.maxVal);
        } else {
            values.maxVal = clamp(next, values.minVal, hardMax);
        }

        minInput.value = String(values.minVal);
        maxInput.value = String(values.maxVal);
        render();
    }

    function endDrag() {
        if (!dragging) return;

        minHandle.classList.remove('filter-range__handle--dragging');
        maxHandle.classList.remove('filter-range__handle--dragging');
        dragging = null;

        if (moved) submitFilters();
    }

    minHandle.addEventListener('pointerdown', function (e) { startDrag('min', e); });
    maxHandle.addEventListener('pointerdown', function (e) { startDrag('max', e); });

    rangeEl.addEventListener('pointerdown', function (e) {
        if (e.target === minHandle || e.target === maxHandle) return;

        var values = getValues();
        var clickedValue = pointerToValue(e.clientX);
        var distToMin = Math.abs(clickedValue - values.minVal);
        var distToMax = Math.abs(clickedValue - values.maxVal);
        var target = distToMin <= distToMax ? 'min' : 'max';

        startDrag(target, e);
        updateDrag(e.clientX);
    });

    document.addEventListener('pointermove', function (e) {
        updateDrag(e.clientX);
    });

    document.addEventListener('pointerup', endDrag);
    document.addEventListener('pointercancel', endDrag);

    render();
}());

function changeQty(delta) {
    const input = document.getElementById('quantityInput');
    input.value = Math.max(1, parseInt(input.value) + delta);
}

