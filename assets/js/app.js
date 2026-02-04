// Runtime target: PHP 8.4+ / MySQL 8.4+
(() => {
    const activeLink = document.querySelector(`.app-sidebar .nav-link[href='${location.pathname.split('/').pop()}']`);
    if (activeLink) {
        activeLink.classList.add('active');
    }
})();
