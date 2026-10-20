(function () {
    var storageKey = 'rox_theme';
    var allowedThemes = ['light', 'dark'];

    function normalizeTheme(value) {
        return allowedThemes.indexOf(value) !== -1 ? value : 'light';
    }

    function applyTheme(theme, persist) {
        var nextTheme = normalizeTheme(theme);

        document.documentElement.setAttribute('data-bs-theme', nextTheme);
        document.documentElement.style.colorScheme = nextTheme;

        if (persist !== false) {
            try {
                localStorage.setItem(storageKey, nextTheme);
            } catch (error) {
                // Ignore storage failures and keep the active theme in-memory only.
            }
        }

        document.querySelectorAll('[data-rox-theme-option]').forEach(function (button) {
            var isActive = button.getAttribute('data-rox-theme-option') === nextTheme;
            button.classList.toggle('btn-primary', isActive);
            button.classList.toggle('btn-outline-secondary', !isActive);
            button.setAttribute('aria-pressed', isActive ? 'true' : 'false');
        });
    }

    function resolveInitialTheme() {
        try {
            return normalizeTheme(localStorage.getItem(storageKey) || '');
        } catch (error) {
            return normalizeTheme(document.documentElement.getAttribute('data-bs-theme') || '');
        }
    }

    function bindThemeButtons() {
        document.querySelectorAll('[data-rox-theme-option]').forEach(function (button) {
            if (button.dataset.roxThemeBound === '1') {
                return;
            }

            button.dataset.roxThemeBound = '1';
            button.addEventListener('click', function () {
                applyTheme(button.getAttribute('data-rox-theme-option'));
            });
        });
    }

    function init() {
        applyTheme(resolveInitialTheme(), false);
        bindThemeButtons();
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init, { once: true });
    } else {
        init();
    }

    window.roxApplyTheme = applyTheme;
})();
