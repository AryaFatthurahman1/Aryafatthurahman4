<?php
// Initialize stats
$stats = get_all_stats();
?>

<div class="bg-glow"></div>
<div class="bg-glow-2"></div>

<section class="hero-section">
  <div class="container hero-grid">
    <div class="hero-content">
      <div class="badge badge-cyan mb-6">ANTI-GRAVITY ECOSYSTEM</div>
      <h1>Accelerate Your<br><span class="text-gradient">Digital Reality</span></h1>
      <p>A hyper-converged hub merging Quantum AI, Next-Gen Web Frameworks, Mobile Apps, and Cloud Architectures into one unified control pane.</p>
      
      <div class="hero-actions">
        <a href="?page=services" class="btn btn-primary"><i class="fa fa-rocket"></i> Explore Services</a>
        <a href="?page=projects" class="btn btn-outline"><i class="fa fa-code"></i> View Projects</a>
      </div>
      
      <div class="hero-stats" style="display: flex; gap: 30px; margin-top: 50px;">
        <div>
          <div class="text-cyan font-mono" style="font-size: 2rem; font-weight: 700;"><span class="counter" data-target="9">0</span>+</div>
          <div class="text-muted" style="font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px;">Live Projects</div>
        </div>
        <div>
          <div class="text-purple font-mono" style="font-size: 2rem; font-weight: 700;"><span class="counter" data-target="15">0</span>+</div>
          <div class="text-muted" style="font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px;">Tech Stacks</div>
        </div>
        <div>
          <div class="text-emerald font-mono" style="font-size: 2rem; font-weight: 700;"><span class="counter" data-target="<?= $stats['users'] ?>">0</span></div>
          <div class="text-muted" style="font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px;">Registered Users</div>
        </div>
      </div>
    </div>
    
    <div class="hero-visual">
      <div class="q-sphere">
        <div class="q-ring"></div>
        <div class="q-ring"></div>
      </div>
    </div>
  </div>
</section>

<!-- Features Grid -->
<section style="padding: 100px 0; position: relative;">
  <div class="container">
    <div class="section-subtitle mb-8">CORE ARCHITECTURE</div>
    <h2 class="section-title mb-8">Quantum-Ready <span class="text-gradient">Infrastructure</span></h2>
    
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 30px;">
      
      <div class="glass-panel" style="padding: 40px;">
        <div style="width: 60px; height: 60px; border-radius: 16px; background: rgba(0,245,255,0.1); border: 1px solid rgba(0,245,255,0.2); display: flex; align-items: center; justify-content: center; font-size: 1.8rem; color: var(--quantum-cyan); margin-bottom: 25px;">
          <i class="fa fa-layer-group"></i>
        </div>
        <h3 style="font-size: 1.5rem; margin-bottom: 15px;">Unified Monorepo Hub</h3>
        <p class="text-muted">Manajemen terpusat untuk puluhan aplikasi. Mulai dari Laravel monolith, React SPA, hingga Flutter mobile apps dalam satu dashboard.</p>
      </div>

      <div class="glass-panel" style="padding: 40px;">
        <div style="width: 60px; height: 60px; border-radius: 16px; background: rgba(168,85,247,0.1); border: 1px solid rgba(168,85,247,0.2); display: flex; align-items: center; justify-content: center; font-size: 1.8rem; color: var(--quantum-purple); margin-bottom: 25px;">
          <i class="fa fa-microchip"></i>
        </div>
        <h3 style="font-size: 1.5rem; margin-bottom: 15px;">AI & Machine Learning</h3>
        <p class="text-muted">Integrasi mulus dengan model AI via API Python/Flask, siap melayani prediksi data cerdas dan analisis prediktif.</p>
      </div>

      <div class="glass-panel" style="padding: 40px;">
        <div style="width: 60px; height: 60px; border-radius: 16px; background: rgba(16,185,129,0.1); border: 1px solid rgba(16,185,129,0.2); display: flex; align-items: center; justify-content: center; font-size: 1.8rem; color: var(--quantum-emerald); margin-bottom: 25px;">
          <i class="fa fa-database"></i>
        </div>
        <h3 style="font-size: 1.5rem; margin-bottom: 15px;">Distributed Databases</h3>
        <p class="text-muted">Konektivitas multi-database dari MySQL relasional hingga arsitektur NoSQL, terkelola secara realtime.</p>
      </div>

    </div>
  </div>
</section>

<!-- Call to Action -->
<section style="padding: 100px 0;">
  <div class="container">
    <div class="glass-panel" style="padding: 60px; text-align: center; border-color: rgba(168,85,247,0.3); background: linear-gradient(180deg, rgba(15,15,20,0.8), rgba(168,85,247,0.05));">
      <h2 style="font-size: 3rem; margin-bottom: 20px;">Ready to Quantum Jump?</h2>
      <p class="text-muted" style="font-size: 1.2rem; max-width: 600px; margin: 0 auto 40px;">Deploy your next-generation application with AntiGravity's cutting edge tech stack. From conceptual design to hybrid cloud deployment.</p>
      <a href="?page=register" class="btn btn-primary" style="padding: 16px 40px; font-size: 1.1rem;">Create Enterprise Account</a>
    </div>
  </div>
</section>
