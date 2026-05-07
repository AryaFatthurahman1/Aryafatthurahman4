<?php
$projects = [
  [
    'name' => 'Jakarta Luxury AI',
    'url' => '/jakarta-luxury-ai/',
    'icon' => 'fa-star',
    'color' => '#f59e0b',
    'stack' => ['Laravel', 'React', 'MySQL', 'AI/ML'],
    'desc' => 'AI-powered luxury service platform with intelligent concierge, predictive analytics, and premium user experience.',
    'status' => 'Live',
  ],
  [
    'name' => 'AntiGravity Quantum Hackathon',
    'url' => '/antigravity-quantum-hackathon/',
    'icon' => 'fa-atom',
    'color' => '#00f5ff',
    'stack' => ['Next.js 15', 'React 18', 'TypeScript', 'Tailwind'],
    'desc' => 'Professional quantum computing hackathon platform with real-time registration, challenges, and judging system.',
    'status' => 'Live',
  ],
  [
    'name' => 'Facetology Studio',
    'url' => '/Facetology/',
    'icon' => 'fa-spa',
    'color' => '#ec4899',
    'stack' => ['PHP', 'MySQL', 'JavaScript', 'CSS3'],
    'desc' => 'Beauty & skincare technology platform with AI skin analysis and product recommendation engine.',
    'status' => 'Live',
  ],
  [
    'name' => 'DarkUniverse Pro',
    'url' => '/DarkUniverse/',
    'icon' => 'fa-moon',
    'color' => '#a855f7',
    'stack' => ['Vue 3', 'Node.js', 'MongoDB', 'Three.js'],
    'desc' => 'Immersive dark-themed creative platform with 3D visualization and real-time collaboration.',
    'status' => 'Live',
  ],
  [
    'name' => 'Project Hotel Luxury',
    'url' => '/ProjectHotel_Luxury/',
    'icon' => 'fa-hotel',
    'color' => '#3b82f6',
    'stack' => ['PHP', 'MySQL', 'Bootstrap', 'jQuery'],
    'desc' => 'Complete hotel management and booking system with channel management and revenue optimization.',
    'status' => 'Live',
  ],
  [
    'name' => 'RetailDash Toko',
    'url' => '/Toko_Barang1/',
    'icon' => 'fa-store',
    'color' => '#10b981',
    'stack' => ['PHP', 'MySQL', 'JavaScript', 'API'],
    'desc' => 'Retail management platform with inventory tracking, POS integration, and analytics dashboard.',
    'status' => 'Live',
  ],
  [
    'name' => 'Framework Labs',
    'url' => '/WebsiteBaru/',
    'icon' => 'fa-code',
    'color' => '#06b6d4',
    'stack' => ['Multi-Framework', 'Svelte', 'Angular', 'Alpine.js'],
    'desc' => 'Experimental web framework playground testing cutting-edge technologies and design patterns.',
    'status' => 'Live',
  ],
  [
    'name' => 'Alfamart Mobile',
    'url' => '/mobile-computing-flutter/',
    'icon' => 'fa-mobile-alt',
    'color' => '#f97316',
    'stack' => ['Flutter', 'Dart', 'Firebase', 'REST API'],
    'desc' => 'Cross-platform mobile retail application with offline-first architecture and push notifications.',
    'status' => 'Live',
  ],
  [
    'name' => 'AntiGravity Quantum Hub',
    'url' => '/antigravity-quantum-hub/',
    'icon' => 'fa-satellite',
    'color' => '#8b5cf6',
    'stack' => ['PHP 8', 'MySQL', 'JavaScript', 'Canvas API'],
    'desc' => 'Unified control hub for the entire AntiGravity ecosystem with quantum particle visualization.',
    'status' => 'Live',
  ],
];
?>

<div class="bg-glow"></div>

<section style="padding: 60px 0 40px;">
  <div class="container">
    <div class="section-subtitle mb-6">PROJECT PORTFOLIO</div>
    <h1 class="section-title mb-4">All <span class="text-gradient">Live Projects</span></h1>
    <p class="text-muted" style="max-width: 700px; margin-bottom: 60px;">Explore the complete AntiGravity ecosystem — every project is live, functional, and built with production-grade technology stacks.</p>
  </div>
</section>

<section style="padding: 0 0 100px;">
  <div class="container">
    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(380px, 1fr)); gap: 30px;">
      <?php foreach ($projects as $p): ?>
      <a href="<?= $p['url'] ?>" target="_blank" class="glass-panel" style="padding: 35px; display: block; text-decoration: none; color: inherit; position: relative; overflow: hidden; transition: all 0.3s ease;">
        <div style="position: absolute; top: 0; left: 0; right: 0; height: 2px; background: linear-gradient(90deg, <?= $p['color'] ?>, transparent); opacity: 0.4;"></div>
        <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 20px;">
          <div style="width: 50px; height: 50px; border-radius: 14px; background: <?= $p['color'] ?>15; border: 1px solid <?= $p['color'] ?>30; display: flex; align-items: center; justify-content: center; font-size: 1.4rem; color: <?= $p['color'] ?>;">
            <i class="fa <?= $p['icon'] ?>"></i>
          </div>
          <div>
            <h3 style="font-size: 1.2rem; font-family: var(--font-display); margin-bottom: 2px;"><?= $p['name'] ?></h3>
            <span class="badge badge-emerald" style="font-size: 0.7rem;"><?= $p['status'] ?></span>
          </div>
        </div>
        <p class="text-muted" style="margin-bottom: 20px; line-height: 1.6; font-size: 0.9rem;"><?= $p['desc'] ?></p>
        <div style="display: flex; flex-wrap: wrap; gap: 6px;">
          <?php foreach ($p['stack'] as $tech): ?>
          <span class="tech-badge"><?= $tech ?></span>
          <?php endforeach; ?>
        </div>
      </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>
