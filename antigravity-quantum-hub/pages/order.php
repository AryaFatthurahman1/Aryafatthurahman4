<?php
$selectedService = $_GET['service'] ?? '';
$packages = [
  [
    'name' => 'Starter',
    'multiplier' => 1,
    'desc' => 'Basic implementation with core features',
    'features' => ['Core Features', 'Standard Support', '30-Day Warranty', 'Basic Documentation'],
  ],
  [
    'name' => 'Professional',
    'multiplier' => 2,
    'desc' => 'Full-featured with priority support',
    'features' => ['All Starter Features', 'Priority Support', '90-Day Warranty', 'Advanced Documentation', 'Source Code'],
    'popular' => true,
  ],
  [
    'name' => 'Enterprise',
    'multiplier' => 3.5,
    'desc' => 'Custom solution with dedicated team',
    'features' => ['All Pro Features', 'Dedicated Team', '12-Month Support', 'Custom Integrations', 'SLA Guarantee', 'Training Sessions'],
  ],
];

$basePrice = 10000000;
if (!$isLoggedIn) {
  header('Location: ?page=login');
  exit;
}
?>

<div class="bg-glow"></div>

<section style="padding: 60px 0 40px;">
  <div class="container">
    <div class="section-subtitle mb-6">ORDER SERVICE</div>
    <h1 class="section-title mb-4">Deploy Your <span class="text-gradient">Next Project</span></h1>
    <p class="text-muted" style="max-width: 700px; margin-bottom: 60px;">Select a service, choose your package, and let our team build your quantum-grade application.</p>
  </div>
</section>

<section style="padding: 0 0 60px;">
  <div class="container">
    <form method="POST" action="?page=order" id="orderForm">
      <div class="glass-panel" style="padding: 40px; margin-bottom: 40px;">
        <h3 style="font-size: 1.3rem; margin-bottom: 25px; font-family: var(--font-display);"><i class="fa fa-cog text-cyan" style="margin-right: 10px;"></i>Service Configuration</h3>
        
        <div style="margin-bottom: 25px;">
          <label style="display: block; margin-bottom: 8px; color: var(--text-muted); font-size: 0.9rem; text-transform: uppercase; letter-spacing: 1px;">Service</label>
          <select name="service" id="serviceSelect" required style="width: 100%; padding: 14px 18px; background: rgba(255,255,255,0.05); border: 1px solid var(--panel-border); border-radius: 12px; color: var(--text-main); font-family: var(--font-sans); font-size: 1rem; outline: none; transition: border-color 0.3s;">
            <option value="">Select a service...</option>
            <option value="AI Concierge" <?= $selectedService === 'AI Concierge' ? 'selected' : '' ?>>AI Concierge</option>
            <option value="Web Development" <?= $selectedService === 'Web Development' ? 'selected' : '' ?>>Web Development</option>
            <option value="Mobile Apps (Flutter)" <?= $selectedService === 'Mobile Apps (Flutter)' ? 'selected' : '' ?>>Mobile Apps (Flutter)</option>
            <option value="Machine Learning API" <?= $selectedService === 'Machine Learning API' ? 'selected' : '' ?>>Machine Learning API</option>
            <option value="REST API Development" <?= $selectedService === 'REST API Development' ? 'selected' : '' ?>>REST API Development</option>
            <option value="Database Design" <?= $selectedService === 'Database Design' ? 'selected' : '' ?>>Database Design</option>
            <option value="DevOps & Docker" <?= $selectedService === 'DevOps & Docker' ? 'selected' : '' ?>>DevOps & Docker</option>
            <option value="Hybrid Quantum Systems" <?= $selectedService === 'Hybrid Quantum Systems' ? 'selected' : '' ?>>Hybrid Quantum Systems</option>
            <option value="Hotel & Booking Systems" <?= $selectedService === 'Hotel & Booking Systems' ? 'selected' : '' ?>>Hotel & Booking Systems</option>
            <option value="E-Commerce Platform" <?= $selectedService === 'E-Commerce Platform' ? 'selected' : '' ?>>E-Commerce Platform</option>
            <option value="Tech Consulting" <?= $selectedService === 'Tech Consulting' ? 'selected' : '' ?>>Tech Consulting</option>
          </select>
        </div>

        <div>
          <label style="display: block; margin-bottom: 8px; color: var(--text-muted); font-size: 0.9rem; text-transform: uppercase; letter-spacing: 1px;">Additional Notes</label>
          <textarea name="notes" rows="4" placeholder="Describe your project requirements..." style="width: 100%; padding: 14px 18px; background: rgba(255,255,255,0.05); border: 1px solid var(--panel-border); border-radius: 12px; color: var(--text-main); font-family: var(--font-sans); font-size: 1rem; outline: none; resize: vertical; transition: border-color 0.3s;"></textarea>
        </div>
      </div>

      <!-- Package Selection -->
      <h3 style="font-size: 1.3rem; margin-bottom: 25px; font-family: var(--font-display); text-align: center;">Select Package</h3>
      <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 25px; margin-bottom: 40px;">
        <?php foreach ($packages as $idx => $pkg): ?>
        <label class="glass-panel" style="padding: 35px; cursor: pointer; position: relative; overflow: hidden; <?= isset($pkg['popular']) ? 'border-color: rgba(0,245,255,0.3);' : '' ?>">
          <?php if (isset($pkg['popular'])): ?>
          <div style="position: absolute; top: 15px; right: 15px;" class="badge badge-cyan">POPULAR</div>
          <?php endif; ?>
          <input type="radio" name="package" value="<?= $pkg['name'] ?>" <?= isset($pkg['popular']) ? 'checked' : '' ?> style="display: none;" class="pkg-radio">
          <h3 style="font-size: 1.4rem; margin-bottom: 8px; font-family: var(--font-display);"><?= $pkg['name'] ?></h3>
          <p class="text-muted" style="margin-bottom: 20px; font-size: 0.9rem;"><?= $pkg['desc'] ?></p>
          <div style="font-family: var(--font-mono); font-size: 1.8rem; font-weight: 700; color: var(--quantum-cyan); margin-bottom: 20px;">
            Rp <?= number_format($basePrice * $pkg['multiplier'], 0, ',', '.') ?>
          </div>
          <ul style="list-style: none;">
            <?php foreach ($pkg['features'] as $f): ?>
            <li style="padding: 5px 0; color: var(--text-muted); font-size: 0.9rem;"><i class="fa fa-check-circle" style="color: var(--quantum-emerald); margin-right: 8px;"></i><?= $f ?></li>
            <?php endforeach; ?>
          </ul>
          <input type="hidden" name="price" value="<?= $basePrice * $pkg['multiplier'] ?>">
        </label>
        <?php endforeach; ?>
      </div>

      <?php if (isset($orderResult)): ?>
      <div class="glass-panel" style="padding: 20px; margin-bottom: 30px; text-align: center; border-color: <?= $orderResult['success'] ? 'rgba(16,185,129,0.3)' : 'rgba(239,68,68,0.3)' ?>; background: <?= $orderResult['success'] ? 'rgba(16,185,129,0.05)' : 'rgba(239,68,68,0.05)' ?>;">
        <i class="fa <?= $orderResult['success'] ? 'fa-check-circle text-emerald' : 'fa-exclamation-circle text-red' ?>" style="margin-right: 8px;"></i>
        <?= htmlspecialchars($orderResult['message']) ?>
      </div>
      <?php endif; ?>

      <div style="text-align: center;">
        <button type="submit" class="btn btn-primary" style="padding: 16px 48px; font-size: 1.1rem;"><i class="fa fa-paper-plane"></i> Submit Order</button>
      </div>
    </form>
  </div>
</section>

<script>
// Package selection visual feedback
document.querySelectorAll('.pkg-radio').forEach(radio => {
  radio.addEventListener('change', function() {
    document.querySelectorAll('.pkg-radio').forEach(r => {
      r.closest('.glass-panel').style.borderColor = r === this ? 'rgba(0,245,255,0.3)' : 'var(--panel-border)';
    });
    // Update hidden price
    const prices = { 'Starter': <?= $basePrice ?>, 'Professional': <?= $basePrice * 2 ?>, 'Enterprise': <?= $basePrice * 3.5 ?> };
    document.querySelector('input[name="price"]').value = prices[this.value] || <?= $basePrice ?>;
  });
  // Trigger initial state
  if (radio.checked) radio.dispatchEvent(new Event('change'));
});
</script>
