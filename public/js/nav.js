document.addEventListener('DOMContentLoaded', () => {
  const topNav = document.querySelector('.top-nav');
  const topNavInner = document.querySelector('.top-nav__inner');
  const topLinks = document.querySelector('.top-nav__links');

  if (!topNav || !topNavInner || !topLinks) {
    return;
  }

  const secNavLinks = Array.from(document.querySelectorAll('.sec-nav__left .sec-nav__link'));
  const topNavLinks = Array.from(topLinks.querySelectorAll('.top-nav__link'));

  const burgerBtn = document.createElement('button');
  burgerBtn.type = 'button';
  burgerBtn.className = 'top-nav__burger';
  burgerBtn.setAttribute('aria-expanded', 'false');
  burgerBtn.setAttribute('aria-controls', 'mobileMenu');
  burgerBtn.setAttribute('aria-label', 'Otvoriť menu');
  burgerBtn.innerHTML = '<span></span><span></span><span></span>';
  topNavInner.insertBefore(burgerBtn, topNavInner.firstChild);

  const mobilePanel = document.createElement('nav');
  mobilePanel.className = 'top-nav__mobile-panel';
  mobilePanel.id = 'mobileMenu';
  mobilePanel.setAttribute('aria-label', 'Mobilné menu');

  const linksHtml = topNavLinks
    .map(link => `<a href="${link.getAttribute('href') || '#'}" class="top-nav__mobile-link">${link.textContent || ''}</a>`)
    .join('');

  const secLinksHtml = secNavLinks
    .map(link => `<a href="${link.getAttribute('href') || '#'}" class="top-nav__mobile-link top-nav__mobile-link--sub">${link.textContent || ''}</a>`)
    .join('');

  mobilePanel.innerHTML = `${linksHtml}${secLinksHtml}<a href="/prihlasenie" class="top-nav__mobile-link top-nav__mobile-link--auth">Prihlásiť sa / Vytvoriť účet</a>`;
  topNav.appendChild(mobilePanel);

  const closeMenu = () => {
    topNav.classList.remove('top-nav--mobile-open');
    burgerBtn.setAttribute('aria-expanded', 'false');
    burgerBtn.setAttribute('aria-label', 'Otvoriť menu');
  };

  burgerBtn.addEventListener('click', () => {
    const isOpen = topNav.classList.toggle('top-nav--mobile-open');
    burgerBtn.setAttribute('aria-expanded', String(isOpen));
    burgerBtn.setAttribute('aria-label', isOpen ? 'Zavrieť menu' : 'Otvoriť menu');
  });

  mobilePanel.querySelectorAll('a').forEach(link => {
    link.addEventListener('click', closeMenu);
  });

  window.addEventListener('resize', () => {
    if (window.innerWidth > 540) {
      closeMenu();
    }
  });

  // ── Filter sidebar — auto-submit on checkbox change ───────────────────────
  const filterForm = document.querySelector('.filter-sidebar');
  if (filterForm) {
    // Checkboxes: submit immediately on change
    filterForm.querySelectorAll('input[type="checkbox"]').forEach(cb => {
      cb.addEventListener('change', () => filterForm.submit());
    });

    // Dual-handle price range slider
    const rangeWrap     = document.getElementById('priceRange');
    if (rangeWrap) {
      const minHandle     = document.getElementById('priceMinHandle');
      const maxHandle     = document.getElementById('priceMaxHandle');
      const selectedTrack = document.getElementById('priceSelectedTrack');
      const minInput      = document.getElementById('priceMin');
      const maxInput      = document.getElementById('priceMax');
      const minDisplay    = document.getElementById('priceMinDisplay');
      const maxDisplay    = document.getElementById('priceMaxDisplay');

      const boundsMin = parseFloat(rangeWrap.dataset.min) || 0;
      const boundsMax = parseFloat(rangeWrap.dataset.max) || 100;
      const step      = parseFloat(rangeWrap.dataset.step) || 1;

      let curMin = parseFloat(minInput.value) || boundsMin;
      let curMax = parseFloat(maxInput.value) || boundsMax;
      let debounceTimer = null;

      function clamp(v, lo, hi) { return Math.max(lo, Math.min(hi, v)); }
      function snap(v) { return Math.round(v / step) * step; }
      function pctOf(v) { return ((v - boundsMin) / (boundsMax - boundsMin)) * 100; }

      function render() {
        const lo = pctOf(curMin), hi = pctOf(curMax);
        minHandle.style.left     = lo + '%';
        maxHandle.style.left     = hi + '%';
        selectedTrack.style.left  = lo + '%';
        selectedTrack.style.width = (hi - lo) + '%';
        minInput.value            = curMin;
        maxInput.value            = curMax;
        if (minDisplay) minDisplay.textContent = curMin + '€';
        if (maxDisplay) maxDisplay.textContent = curMax + '€';
      }

      function scheduleSubmit(delay) {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(() => filterForm.submit(), delay ?? 1200);
      }

      function startDrag(isMin, e) {
        e.preventDefault();
        const isTouch = e.type === 'touchstart';
        const handle  = isMin ? minHandle : maxHandle;
        handle.classList.add('filter-range__handle--dragging');

        function onMove(ev) {
          const cx   = isTouch ? ev.touches[0].clientX : ev.clientX;
          const rect  = rangeWrap.getBoundingClientRect();
          const pct   = clamp((cx - rect.left) / rect.width, 0, 1);
          const val   = snap(boundsMin + pct * (boundsMax - boundsMin));
          if (isMin) curMin = clamp(val, boundsMin, curMax - step);
          else       curMax = clamp(val, curMin + step, boundsMax);
          render();
          scheduleSubmit(1200);
        }

        function onUp() {
          handle.classList.remove('filter-range__handle--dragging');
          document.removeEventListener(isTouch ? 'touchmove' : 'mousemove', onMove);
          document.removeEventListener(isTouch ? 'touchend'  : 'mouseup',  onUp);
        }

        document.addEventListener(isTouch ? 'touchmove' : 'mousemove', onMove, { passive: false });
        document.addEventListener(isTouch ? 'touchend'  : 'mouseup',  onUp);
      }

      minHandle.addEventListener('mousedown',  e => startDrag(true,  e));
      maxHandle.addEventListener('mousedown',  e => startDrag(false, e));
      minHandle.addEventListener('touchstart', e => startDrag(true,  e), { passive: false });
      maxHandle.addEventListener('touchstart', e => startDrag(false, e), { passive: false });

      rangeWrap.addEventListener('mouseleave', () => scheduleSubmit(800));

      render();
    }
  }

  // ── Search forms (header + listing) ───────────────────────────────────────
  document.querySelectorAll('[data-search-base]').forEach(form => {
    form.addEventListener('submit', e => {
      e.preventDefault();
      const input = form.querySelector('input[type="text"]');
      const q = input ? input.value.trim() : '';
      if (q) {
        window.location.href = form.dataset.searchBase + '/' + encodeURIComponent(q);
      }
    });
    // Also fire on Enter key in the input
    const input = form.querySelector('input[type="text"]');
    if (input) {
      input.addEventListener('keydown', e => {
        if (e.key === 'Enter') form.dispatchEvent(new Event('submit'));
      });
    }
  });
});

 document.querySelectorAll('.carousel-wrapper').forEach(wrapper => {
      const carousel = wrapper.querySelector('.products-carousel');
      wrapper.querySelector('.carousel-btn--next').addEventListener('click', () => {
        carousel.scrollBy({ left: 220, behavior: 'smooth' });
      });
      wrapper.querySelector('.carousel-btn--prev').addEventListener('click', () => {
        carousel.scrollBy({ left: -220, behavior: 'smooth' });
      });
    });