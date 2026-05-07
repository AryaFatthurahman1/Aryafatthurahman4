<?php
$quantumSystems = [
  [
    'icon' => 'fa-atom',
    'color' => 'cyan',
    'title' => 'Quantum Processing Unit (QPU)',
    'desc' => 'Access to real quantum processors via IBM Q, Google Sycamore, and IonQ trapped-ion systems. Execute quantum circuits with up to 127 qubits.',
    'metrics' => ['127 Qubits', '99.9% Gate Fidelity', '< 100μs Latency'],
  ],
  [
    'icon' => 'fa-brain',
    'color' => 'purple',
    'title' => 'Quantum Machine Learning',
    'desc' => 'Hybrid quantum-classical ML pipelines using Qiskit Machine Learning, PennyLane, and TensorFlow Quantum for enhanced model training.',
    'metrics' => ['3x Faster Training', 'Quantum Kernels', 'Variational Circuits'],
  ],
  [
    'icon' => 'fa-lock',
    'color' => 'blue',
    'title' => 'Post-Quantum Cryptography',
    'desc' => 'Quantum-resistant encryption protocols implementing NIST-approved lattice-based and code-based cryptographic algorithms.',
    'metrics' => ['NIST PQC Standard', 'QKD Integration', 'Zero-Trust Architecture'],
  ],
  [
    'icon' => 'fa-flask',
    'color' => 'emerald',
    'title' => 'Quantum Simulation',
    'desc' => 'Molecular and materials simulation using VQE, QAOA, and quantum phase estimation for drug discovery and materials science.',
    'metrics' => ['Molecular Dynamics', 'VQE/QAOA', 'Chemistry Engine'],
  ],
  [
    'icon' => 'fa-network-wired',
    'color' => 'pink',
    'title' => 'Quantum Networking',
    'desc' => 'Quantum internet protocols with entanglement distribution, quantum repeaters, and teleportation-based communication channels.',
    'metrics' => ['Entanglement Distribution', 'Quantum Repeaters', 'Teleportation Protocol'],
  ],
  [
    'icon' => 'fa-project-diagram',
    'color' => 'amber',
    'title' => 'Quantum Error Correction',
    'desc' => 'Surface code and topological error correction implementations for fault-tolerant quantum computing at scale.',
    'metrics' => ['Surface Code', 'Logical Qubits', 'Fault-Tolerant'],
  ],
];
?>

<div class="bg-glow"></div>
<div class="bg-glow-2"></div>

<section style="padding: 60px 0 40px;">
  <div class="container">
    <div class="badge badge-cyan mb-6" style="display: inline-flex; align-items: center; gap: 8px;"><i class="fa fa-atom"></i> HYBRID QUANTUM SYSTEMS</div>
    <h1 class="section-title mb-4" style="font-size: 3.5rem;">Quantum Computing <span class="text-gradient">Infrastructure</span></h1>
    <p class="text-muted" style="max-width: 800px; margin-bottom: 60px; font-size: 1.15rem; line-height: 1.8;">Explore our hybrid quantum-classical architecture that bridges the gap between theoretical quantum computing and practical enterprise applications.</p>
  </div>
</section>

<!-- Quantum Architecture Diagram -->
<section style="padding: 0 0 60px;">
  <div class="container">
    <div class="glass-panel" style="padding: 50px; text-align: center; border-color: rgba(0,245,255,0.2); background: linear-gradient(180deg, rgba(0,245,255,0.03), rgba(15,15,20,0.6));">
      <div style="display: flex; justify-content: center; align-items: center; gap: 40px; flex-wrap: wrap; margin-bottom: 40px;">
        <div style="text-align: center;">
          <div style="width: 80px; height: 80px; border-radius: 50%; background: rgba(0,245,255,0.1); border: 2px solid rgba(0,245,255,0.3); display: flex; align-items: center; justify-content: center; font-size: 2rem; color: var(--quantum-cyan); margin: 0 auto 15px;">
            <i class="fa fa-atom"></i>
          </div>
          <div style="font-weight: 600; margin-bottom: 4px;">Quantum Layer</div>
          <div class="text-muted" style="font-size: 0.85rem;">QPU + QEC</div>
        </div>
        <div style="font-size: 2rem; color: var(--quantum-cyan);">⟷</div>
        <div style="text-align: center;">
          <div style="width: 80px; height: 80px; border-radius: 50%; background: rgba(168,85,247,0.1); border: 2px solid rgba(168,85,247,0.3); display: flex; align-items: center; justify-content: center; font-size: 2rem; color: var(--quantum-purple); margin: 0 auto 15px;">
            <i class="fa fa-microchip"></i>
          </div>
          <div style="font-weight: 600; margin-bottom: 4px;">Classical Layer</div>
          <div class="text-muted" style="font-size: 0.85rem;">CPU + GPU + TPU</div>
        </div>
        <div style="font-size: 2rem; color: var(--quantum-purple);">⟷</div>
        <div style="text-align: center;">
          <div style="width: 80px; height: 80px; border-radius: 50%; background: rgba(16,185,129,0.1); border: 2px solid rgba(16,185,129,0.3); display: flex; align-items: center; justify-content: center; font-size: 2rem; color: var(--quantum-emerald); margin: 0 auto 15px;">
            <i class="fa fa-cloud"></i>
          </div>
          <div style="font-weight: 600; margin-bottom: 4px;">Cloud Layer</div>
          <div class="text-muted" style="font-size: 0.85rem;">API + DevOps</div>
        </div>
      </div>
      <p class="text-muted" style="max-width: 600px; margin: 0 auto;">Our three-tier hybrid architecture seamlessly integrates quantum processing with classical computing and cloud infrastructure for optimal performance.</p>
    </div>
  </div>
</section>

<!-- Quantum Systems Grid -->
<section style="padding: 0 0 100px;">
  <div class="container">
    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(380px, 1fr)); gap: 30px;">
      <?php foreach ($quantumSystems as $qs): ?>
      <div class="glass-panel" style="padding: 40px; position: relative; overflow: hidden;">
        <div style="position: absolute; top: 0; left: 0; right: 0; height: 2px; background: linear-gradient(90deg, var(--quantum-<?= $qs['color'] ?>, var(--quantum-cyan)), transparent); opacity: 0.5;"></div>
        <div style="width: 60px; height: 60px; border-radius: 16px; background: rgba(0,245,255,0.08); border: 1px solid rgba(0,245,255,0.15); display: flex; align-items: center; justify-content: center; font-size: 1.8rem; color: var(--quantum-<?= $qs['color'] ?>, var(--quantum-cyan)); margin-bottom: 25px;">
          <i class="fa <?= $qs['icon'] ?>"></i>
        </div>
        <h3 style="font-size: 1.4rem; margin-bottom: 12px; font-family: var(--font-display);"><?= $qs['title'] ?></h3>
        <p class="text-muted" style="margin-bottom: 20px; line-height: 1.7;"><?= $qs['desc'] ?></p>
        <div style="display: flex; flex-wrap: wrap; gap: 8px;">
          <?php foreach ($qs['metrics'] as $m): ?>
          <span class="badge badge-cyan" style="font-size: 0.75rem;"><?= $m ?></span>
          <?php endforeach; ?>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- CTA -->
<section style="padding: 0 0 100px;">
  <div class="container">
    <div class="glass-panel" style="padding: 60px; text-align: center; border-color: rgba(0,245,255,0.2); background: linear-gradient(180deg, rgba(0,245,255,0.05), rgba(15,15,20,0.8));">
      <h2 style="font-size: 2.5rem; margin-bottom: 20px; font-family: var(--font-display);">Ready to Enter the <span class="text-gradient">Quantum Realm</span>?</h2>
      <p class="text-muted" style="font-size: 1.1rem; max-width: 600px; margin: 0 auto 40px;">Get started with hybrid quantum computing today. Our team will help you design and deploy quantum-enhanced solutions for your enterprise.</p>
      <div style="display: flex; gap: 15px; justify-content: center; flex-wrap: wrap;">
        <a href="?page=order&service=<?= urlencode('Hybrid Quantum Systems') ?>" class="btn btn-primary" style="padding: 14px 36px;"><i class="fa fa-rocket"></i> Request Quantum Access</a>
        <a href="?page=services" class="btn btn-outline" style="padding: 14px 36px;"><i class="fa fa-th-large"></i> All Services</a>
      </div>
    </div>
  </div>
</section>
