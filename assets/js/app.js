(() => {
    const activeLink = document.querySelector(`.app-sidebar .nav-link[href='${location.pathname.split('/').pop()}']`);
    if (activeLink) {
        activeLink.classList.add('active');
    }

    const runtimeBadge = document.querySelector('[data-runtime-badge="true"]');
    if (runtimeBadge) {
        const phpVersion = runtimeBadge.dataset.phpVersion;
        const mysqlVersion = runtimeBadge.dataset.mysqlVersion;
        runtimeBadge.title = `Running on PHP ${phpVersion} and MySQL ${mysqlVersion}`;
    }
})();
