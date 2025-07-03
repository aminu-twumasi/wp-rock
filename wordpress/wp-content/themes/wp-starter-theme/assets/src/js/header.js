document.addEventListener('DOMContentLoaded', function() {
  // Burger menu toggle
  const burger = document.querySelector('.zoo-header__burger');
  const nav = document.querySelector('.zoo-header__nav');
  burger.addEventListener('click', function() {
    nav.classList.toggle('active');
    burger.setAttribute('aria-expanded', nav.classList.contains('active'));
  });

  // Search popout toggle
  const searchBtn = document.querySelector('.zoo-header__search-btn');
  const searchPopout = document.querySelector('.zoo-header__search-popout');
  if (searchBtn && searchPopout) {
    searchBtn.addEventListener('click', function(e) {
      e.stopPropagation();
      searchPopout.classList.toggle('active');
      if (searchPopout.classList.contains('active')) {
        const input = searchPopout.querySelector('input[type="search"]');
        if (input) input.focus();
      }
    });
    document.addEventListener('click', function(e) {
      if (!searchPopout.contains(e.target) && !searchBtn.contains(e.target)) {
        searchPopout.classList.remove('active');
      }
    });
  }

  // Optional: Close menu/search when clicking outside
  document.addEventListener('click', function(e) {
    if (!nav.contains(e.target) && !burger.contains(e.target)) {
      nav.classList.remove('active');
      burger.setAttribute('aria-expanded', 'false');
    }
    if (!searchPopout.contains(e.target) && !searchBtn.contains(e.target)) {
      searchPopout.classList.remove('active');
    }
  });
});
