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

    // Range slider: sync display label + fill gradient + debounced submit
    const maxSlider  = document.getElementById('priceMax');
    const maxDisplay = document.getElementById('priceMaxDisplay');
    let rangeTimer;

    function syncRange(slider) {
      if (!slider) return;
      const val = parseInt(slider.value, 10);
      const min = parseInt(slider.min, 10) || 0;
      const max = parseInt(slider.max, 10) || 100;
      const pct = ((val - min) / (max - min)) * 100;
      slider.style.setProperty('--fill', pct + '%');
      if (maxDisplay) maxDisplay.textContent = val + '€';
    }

    if (maxSlider) {
      maxSlider.addEventListener('input', function () {
        syncRange(this);
        clearTimeout(rangeTimer);
        rangeTimer = setTimeout(() => filterForm.submit(), 500);
      });
      syncRange(maxSlider);
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
