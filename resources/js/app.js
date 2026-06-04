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

// =========================================
// HERO PARTICLES
// =========================================
(function() {
  const canvas = document.getElementById("hero-particles");
  if (!canvas) return;
  const ctx = canvas.getContext("2d");
  const hero = canvas.closest(".home-hero-v3");
  let particles = [], animId;

  function resize() {
    canvas.width = hero.offsetWidth;
    canvas.height = hero.offsetHeight;
  }

  function createParticles() {
    particles = [];
    const count = Math.floor((canvas.width * canvas.height) / 6000);
    for (let i = 0; i < count; i++) {
      particles.push({
        x: Math.random() * canvas.width,
        y: Math.random() * canvas.height,
        r: Math.random() * 1.4 + 0.4,
        vx: (Math.random() - 0.5) * 0.35,
        vy: (Math.random() - 0.5) * 0.35,
        alpha: Math.random() * 0.6 + 0.15,
        red: Math.random() > 0.65
      });
    }
  }

  function draw() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    particles.forEach(function(p) {
      ctx.beginPath();
      ctx.arc(p.x, p.y, p.r, 0, Math.PI * 2);
      ctx.fillStyle = p.red
        ? "rgba(247,0,56," + p.alpha + ")"
        : "rgba(245,243,239," + (p.alpha * 0.4) + ")";
      ctx.fill();
      p.x += p.vx;
      p.y += p.vy;
      if (p.x < 0) p.x = canvas.width;
      if (p.x > canvas.width) p.x = 0;
      if (p.y < 0) p.y = canvas.height;
      if (p.y > canvas.height) p.y = 0;
    });

    for (let i = 0; i < particles.length; i++) {
      for (let j = i + 1; j < particles.length; j++) {
        const dx = particles[i].x - particles[j].x;
        const dy = particles[i].y - particles[j].y;
        const dist = Math.sqrt(dx * dx + dy * dy);
        if (dist < 90) {
          ctx.beginPath();
          ctx.moveTo(particles[i].x, particles[i].y);
          ctx.lineTo(particles[j].x, particles[j].y);
          ctx.strokeStyle = "rgba(247,0,56," + (0.06 * (1 - dist / 90)) + ")";
          ctx.lineWidth = 0.4;
          ctx.stroke();
        }
      }
    }
    animId = requestAnimationFrame(draw);
  }

  resize();
  createParticles();
  draw();

  window.addEventListener("resize", function() {
    cancelAnimationFrame(animId);
    resize();
    createParticles();
    draw();
  });
})();