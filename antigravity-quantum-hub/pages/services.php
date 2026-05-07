<?php
$services = [
  [
    'id' => 'ai',
    'icon' => 'fa-brain',
    'color' => 'purple',
    'title' => 'AI Concierge',
    'desc' => 'Intelligent AI-powered assistant integrating NLP, computer vision, and predictive analytics for your business workflows.',
    'features' => ['Natural Language Processing', 'Computer Vision API', 'Predictive Analytics', 'Custom Model Training'],
    'price' => 'Rp 15.000.000',
  ],
  [
    'id' => 'web',
    'icon' => 'fa-globe',
    'color' => 'cyan',
    'title' => 'Web Development',
    'desc' => 'Full-stack web applications built with Next.js, React, Vue, Svelte, and Laravel — optimized for performance and scale.',
    'features' => ['Next.js 15 / React 18', 'Vue 3 / Svelte / Angular', 'Laravel 11 Backend', 'Progressive Web Apps'],
    'price' => 'Rp 10.000.000',
  ],
  [
    'id' => 'mobile',
    'icon' => 'fa-mobile-alt',
    'color' => 'orange',
    'title' => 'Mobile Apps (Flutter)',
    'desc' => 'Cross-platform mobile applications with Flutter and React Native, delivering native performance on iOS and Android.',
    'features' => ['Flutter / React Native', 'iOS & Android', 'Offline-First Architecture', 'Push Notifications'],
    'price' => 'Rp 20.000.000',
  ],
  [
    'id' => 'ml',
    'icon' => 'fa-chart-line',
    'color' => 'blue',
    'title' => 'Machine Learning API',
    'desc' => 'Production-ready ML pipelines powered by Python, FastAPI, PyTorch, and TensorFlow with real-time inference endpoints.',
    'features' => ['PyTorch / TensorFlow', 'FastAPI Endpoints', 'Model Versioning', 'Auto-Scaling Infrastructure'],
    'price' => 'Rp 25.000.000',
  ],
  [
    'id' => 'api',
    'icon' => 'fa-server',
    'color' => 'red',
    'title' => 'REST API Development',
    'desc' => 'Robust, documented REST and GraphQL APIs built with Laravel, Node.js, Go Gin, and Rust Actix for maximum throughput.',
    'features' => ['REST & GraphQL', 'Laravel / Node.js / Go / Rust', 'API Documentation', 'Rate Limiting & Auth'],
    'price' => 'Rp 12.000.000',
  ],
  [
    'id' => 'db',
    'icon' => 'fa-database',
    'color' => 'indigo',
    'title' => 'Database Design',
    'desc' => 'Multi-database architecture with MySQL, PostgreSQL, MongoDB, and Redis — optimized for your data access patterns.',
    'features' => ['MySQL / PostgreSQL', 'MongoDB / Redis', 'Database Migration', 'Query Optimization'],
    'price' => 'Rp 8.000.000',
  ],
  [
    'id' => 'devops',
    'icon' => 'fa-docker',
    'color' => 'sky',
    'title' => 'DevOps & Docker',
    'desc' => 'Container orchestration with Docker Compose, CI/CD pipelines, monitoring with Prometheus and Grafana.',
    'features' => ['Docker Compose', 'CI/CD Pipelines', 'Prometheus & Grafana', 'Auto-Healing Systems'],
    'price' => 'Rp 18.000.000',
  ],
  [
    'id' => 'skincare',
    'icon' => 'fa-spa',
    'color' => 'pink',
    'title' => 'Skincare & Beauty Tech',
    'desc' => 'AI-powered skin analysis, product recommendation engines, and beauty tech platforms with AR try-on capabilities.',
    'features' => ['AI Skin Analysis', 'Product Recommendations', 'AR Try-On', 'E-Commerce Integration'],
    'price' => 'Rp 22.000.000',
  ],
  [
    'id' => 'ecommerce',
    'icon' => 'fa-shopping-bag',
    'color' => 'teal',
    'title' => 'E-Commerce Platform',
    'desc' => 'Full-featured e-commerce solutions with payment gateway integration, inventory management, and analytics dashboards.',
    'features' => ['Payment Gateway', 'Inventory Management', 'Analytics Dashboard', 'Multi-Vendor Support'],
    'price' => 'Rp 14.000.000',
  ],
  [
    'id' => 'hotel',
    'icon' => 'fa-hotel',
    'color' => 'yellow',
    'title' => 'Hotel & Booking Systems',
    'desc' => 'Complete hotel management and booking platforms with channel manager, revenue optimization, and guest experience tools.',
    'features' => ['Booking Engine', 'Channel Manager', 'Revenue Optimization', 'Guest Mobile App'],
    'price' => 'Rp 30.000.000',
  ],
  [
    'id' => 'consulting',
    'icon' => 'fa-lightbulb',
    'color' => 'amber',
    'title' => 'Tech Consulting',
    'desc' => 'Strategic technology consulting for digital transformation, architecture review, and team augmentation.',
    'features' => ['Architecture Review', 'Tech Stack Selection', 'Team Augmentation', 'Digital Transformation'],
    'price' => 'Rp 5.000.000',
  ],
];
?>

<div class="bg-glow"></div>

<section style="padding: 60px 0 40px;">
  <div class="container">
    <div class="section-subtitle mb-6">OUR SERVICES</div>
    <h1 class="section-title mb-4">Quantum-Grade <span class="text-gradient">Development Services</span></h1>
    <p class="text-muted" style="max-width: 700px; margin-bottom: 60px;">From AI-powered applications to full-stack web and mobile development, we deliver enterprise-grade solutions built on cutting-edge technology stacks.</p>
  </div>
</section>

<section style="padding: 0 0 100px;">
  <div class="container">
    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(380px, 1fr)); gap: 30px;">
      <?php foreach ($services as $s): ?>
      <div class="glass-panel" id="<?= $s['id'] ?>" style="padding: 40px; position: relative; overflow: hidden;">
        <div style="position: absolute; top: 0; left: 0; right: 0; height: 2px; background: linear-gradient(90deg, var(--quantum-<?= $s['color'] ?>, var(--quantum-cyan)), transparent); opacity: 0.5;"></div>
        <div style="width: 60px; height: 60px; border-radius: 16px; background: rgba(168,85,247,0.1); border: 1px solid rgba(168,85,247,0.2); display: flex; align-items: center; justify-content: center; font-size: 1.8rem; color: var(--quantum-<?= $s['color'] ?>, var(--quantum-cyan)); margin-bottom: 25px;">
          <i class="fa <?= $s['icon'] ?>"></i>
        </div>
        <h3 style="font-size: 1.5rem; margin-bottom: 12px; font-family: var(--font-display);"><?= $s['title'] ?></h3>
        <p class="text-muted" style="margin-bottom: 20px; line-height: 1.7;"><?= $s['desc'] ?></p>
        <ul style="list-style: none; margin-bottom: 25px;">
          <?php foreach ($s['features'] as $f): ?>
          <li style="padding: 6px 0; color: var(--text-muted); font-size: 0.9rem;"><i class="fa fa-check-circle" style="color: var(--quantum-emerald); margin-right: 8px;"></i><?= $f ?></li>
          <?php endforeach; ?>
        </ul>
        <div style="display: flex; justify-content: space-between; align-items: center; border-top: 1px solid var(--panel-border); padding-top: 20px;">
          <div style="font-family: var(--font-mono); font-size: 1.1rem; font-weight: 600; color: var(--quantum-cyan);"><?= $s['price'] ?></div>
          <a href="?page=order&service=<?= urlencode($s['title']) ?>" class="btn btn-outline" style="padding: 8px 20px; font-size: 0.85rem;"><i class="fa fa-arrow-right"></i> Order</a>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
