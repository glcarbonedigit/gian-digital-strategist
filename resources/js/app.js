document.addEventListener('DOMContentLoaded', () => {
    const revealItems = document.querySelectorAll('.home-reveal, .reveal-fan, .hero-stack--reveal');

    if (revealItems.length) {
        const revealObserver = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    revealObserver.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.14,
            rootMargin: '0px 0px -40px 0px'
        });

        revealItems.forEach((item) => revealObserver.observe(item));
    }

    const brandStart = document.querySelector('[data-brand-start]');
    const brandEnd = document.querySelector('[data-brand-end]');

    if (brandStart && brandEnd) {
        const updateBrandState = () => {
            const startRect = brandStart.getBoundingClientRect();
            const endRect = brandEnd.getBoundingClientRect();
            const triggerLine = window.innerHeight * 0.35;

            const isActive = startRect.top <= triggerLine && endRect.top > triggerLine;
            document.body.classList.toggle('home-brand-active', isActive);
        };

        window.addEventListener('scroll', updateBrandState, { passive: true });
        window.addEventListener('resize', updateBrandState);
        updateBrandState();
    }
});