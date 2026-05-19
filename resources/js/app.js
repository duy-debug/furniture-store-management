import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

document.addEventListener('DOMContentLoaded', () => {
    const revealItems = document.querySelectorAll('[data-scroll-reveal]');

    if (!revealItems.length) {
        return;
    }

    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-visible');
                observer.unobserve(entry.target);
            }
        });
    }, {
        threshold: 0.18,
        rootMargin: '0px 0px -10% 0px',
    });

    revealItems.forEach((item) => observer.observe(item));
});
