import './bootstrap';

document.addEventListener('DOMContentLoaded', () => {
    const toggle = document.querySelector('[data-nav-toggle]');
    const menu = document.querySelector('[data-nav-menu]');

    if (!toggle || !menu) {
        return;
    }

    toggle.addEventListener('click', () => {
        menu.classList.toggle('hidden');
        const expanded = menu.classList.contains('hidden') ? 'false' : 'true';
        toggle.setAttribute('aria-expanded', expanded);
    });
});
