</div><!-- /.page-wrapper -->

<!-- ─── Footer ─────────────────────────────────────────────────────────────── -->
<footer class="footer">
  <div class="footer-glow"></div>
  <div class="footer-container">
    <!-- Brand -->
    <div class="footer-brand">
      <div class="footer-logo">
        <span class="logo-gradient">AntiGravity</span>
        <span class="footer-logo-sub">Quantum Hub</span>
      </div>
      <p class="footer-desc">Platform terpadu yang menyatukan seluruh ekosistem proyek web, AI, mobile, dan quantum computing dalam satu hub kontrol yang elegan dan powerful.</p>
      <div class="footer-socials">
        <a href="https://berlinquantumhackathon.com/" target="_blank" class="social-pill"><i class="fa fa-globe"></i> Quantum Berlin</a>
        <a href="https://quantumai.google/" target="_blank" class="social-pill"><i class="fab fa-google"></i> Google Quantum</a>
        <a href="https://www.ibm.com/quantum" target="_blank" class="social-pill"><i class="fas fa-microchip"></i> IBM Quantum</a>
      </div>
    </div>

    <!-- Links -->
    <div class="footer-links-group">
      <h4>Layanan</h4>
      <a href="?page=services#ai">AI Concierge</a>
      <a href="?page=services#web">Web Development</a>
      <a href="?page=services#mobile">Mobile Apps</a>
      <a href="?page=services#ml">Machine Learning API</a>
      <a href="?page=quantum">Hybrid Quantum Systems</a>
    </div>

    <div class="footer-links-group">
      <h4>Proyek</h4>
      <a href="/jakarta-luxury-ai/" target="_blank">Jakarta Luxury AI</a>
      <a href="/Facetology/" target="_blank">Facetology Studio</a>
      <a href="/DarkUniverse/" target="_blank">DarkUniverse Pro</a>
      <a href="/ProjectHotel_Luxury/" target="_blank">Hotel Luxury</a>
      <a href="/Toko_Barang1/" target="_blank">RetailDash</a>
      <a href="?page=projects">Semua Proyek →</a>
    </div>

    <div class="footer-links-group">
      <h4>Akun</h4>
      <a href="?page=login">Masuk</a>
      <a href="?page=register">Daftar</a>
      <a href="?page=order">Pesan Layanan</a>
      <a href="?page=dashboard">Dashboard</a>
      <a href="/phpmyadmin/" target="_blank">phpMyAdmin</a>
    </div>

    <!-- Tech Stack Badge Wall -->
    <div class="footer-tech">
      <h4>Tech Stack</h4>
      <div class="tech-badges">
        <?php foreach (['React','Next.js','Vue 3','Angular','Svelte','TypeScript','Tailwind','Laravel','Node.js','Python','FastAPI','Flutter','Docker','MySQL','MongoDB','Redis','PostgreSQL','PyTorch','TensorFlow','Three.js','HTMX','Alpine.js','Rust','Go','Redis'] as $t): ?>
        <span class="tech-badge"><?= $t ?></span>
        <?php endforeach; ?>
      </div>
    </div>
  </div>

  <div class="footer-bottom">
    <p>© <?= date('Y') ?> <strong>AntiGravity Quantum Hub</strong> · Powered by Hybrid Quantum + AI Systems</p>
    <p class="footer-stack-line">
      <span>PHP <?= PHP_MAJOR_VERSION.'.'.PHP_MINOR_VERSION ?></span> ·
      <span>MySQL</span> · <span>React + Vite</span> · <span>Laravel</span> ·
      <span>Docker</span> · <span>Laragon</span>
    </p>
  </div>
</footer>

<!-- Toast Notification -->
<div class="toast-container" id="toastContainer"></div>

<!-- Scripts -->
<script>
// ─── Particle Canvas ───────────────────────────────────────────────────────
(function() {
  const canvas = document.getElementById('particleCanvas');
  const ctx = canvas.getContext('2d');
  let particles = [];
  function resize() { canvas.width = innerWidth; canvas.height = innerHeight; }
  resize();
  window.addEventListener('resize', resize);
  class Particle {
    constructor() { this.reset(); }
    reset() {
      this.x = Math.random() * canvas.width;
      this.y = Math.random() * canvas.height;
      this.size = Math.random() * 2 + 0.5;
      this.speedX = (Math.random() - 0.5) * 0.4;
      this.speedY = (Math.random() - 0.5) * 0.4;
      this.opacity = Math.random() * 0.5 + 0.1;
      this.color = Math.random() > 0.5 ? '0,245,255' : '168,85,247';
    }
    update() {
      this.x += this.speedX; this.y += this.speedY;
      if (this.x < 0 || this.x > canvas.width || this.y < 0 || this.y > canvas.height) this.reset();
    }
    draw() {
      ctx.beginPath();
      ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
      ctx.fillStyle = `rgba(${this.color},${this.opacity})`;
      ctx.fill();
    }
  }
  for (let i = 0; i < 120; i++) particles.push(new Particle());
  function animate() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    particles.forEach(p => { p.update(); p.draw(); });
    requestAnimationFrame(animate);
  }
  animate();
})();

// ─── Navbar scroll effect ──────────────────────────────────────────────────
const nav = document.getElementById('mainNav');
window.addEventListener('scroll', () => {
  nav.classList.toggle('scrolled', window.scrollY > 40);
});

// ─── Hamburger ─────────────────────────────────────────────────────────────
const ham = document.getElementById('hamburgerBtn');
const navLinks = document.getElementById('navLinks');
ham.addEventListener('click', () => {
  ham.classList.toggle('open');
  navLinks.classList.toggle('open');
});

// ─── Dropdown Hover (desktop) ──────────────────────────────────────────────
document.querySelectorAll('.has-dropdown').forEach(el => {
  el.addEventListener('mouseenter', () => el.classList.add('active'));
  el.addEventListener('mouseleave', () => el.classList.remove('active'));
});

// ─── Toast helper ──────────────────────────────────────────────────────────
function showToast(msg, type='success') {
  const tc = document.getElementById('toastContainer');
  const t = document.createElement('div');
  t.className = `toast toast-${type}`;
  t.innerHTML = `<i class="fa ${type==='success'?'fa-check-circle':'fa-exclamation-circle'}"></i> ${msg}`;
  tc.appendChild(t);
  setTimeout(() => t.classList.add('show'), 50);
  setTimeout(() => { t.classList.remove('show'); setTimeout(() => t.remove(), 300); }, 3500);
}

// ─── Counter animation ─────────────────────────────────────────────────────
function animateCounter(el) {
  const target = parseInt(el.dataset.target || el.textContent, 10);
  let count = 0;
  const step = Math.ceil(target / 60);
  const timer = setInterval(() => {
    count = Math.min(count + step, target);
    el.textContent = count.toLocaleString('id-ID');
    if (count >= target) clearInterval(timer);
  }, 20);
}
const observer = new IntersectionObserver(entries => {
  entries.forEach(e => { if (e.isIntersecting) { animateCounter(e.target); observer.unobserve(e.target); }});
}, { threshold: 0.5 });
document.querySelectorAll('.counter').forEach(el => observer.observe(el));
</script>
</body>
</html>
