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

  mobilePanel.innerHTML = `${linksHtml}${secLinksHtml}<a href="login.html" class="top-nav__mobile-link top-nav__mobile-link--auth">Prihlásiť sa / Vytvoriť účet</a>`;
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
});
