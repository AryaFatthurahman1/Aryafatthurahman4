<?php
$user = current_user();
$orders = get_user_orders($user['id']);
?>

<div class="bg-glow"></div>

<div class="container" style="padding-top: 40px; padding-bottom: 80px;">
  
  <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 40px; flex-wrap: wrap; gap: 20px;">
    <div>
      <h1 style="font-size: 2.5rem; margin-bottom: 10px;">Quantum <span class="text-gradient">Dashboard</span></h1>
      <p class="text-muted">Selamat datang, <?= htmlspecialchars($user['name']) ?>. Ini adalah panel kontrol utama Anda.</p>
    </div>
    <div style="display: flex; gap: 15px;">
      <a href="?page=order" class="btn btn-primary"><i class="fa fa-plus"></i> New Project</a>
      <a href="?page=projects" class="btn btn-outline"><i class="fa fa-rocket"></i> Launch Hub</a>
    </div>
  </div>

  <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 25px; margin-bottom: 50px;">
    
    <div class="glass-panel" style="padding: 25px;">
      <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
        <h3 class="text-muted" style="font-size: 0.9rem; text-transform: uppercase; letter-spacing: 1px;">Account Status</h3>
        <i class="fa fa-shield-alt text-cyan"></i>
      </div>
      <div style="font-size: 1.8rem; font-weight: 700; font-family: var(--font-mono); margin-bottom: 5px;">ACTIVE</div>
      <div style="font-size: 0.85rem; color: var(--quantum-emerald);"><i class="fa fa-check-circle"></i> Systems Nominal</div>
    </div>

    <div class="glass-panel" style="padding: 25px;">
      <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
        <h3 class="text-muted" style="font-size: 0.9rem; text-transform: uppercase; letter-spacing: 1px;">Total Orders</h3>
        <i class="fa fa-box text-purple"></i>
      </div>
      <div style="font-size: 1.8rem; font-weight: 700; font-family: var(--font-mono); margin-bottom: 5px;"><?= count($orders) ?></div>
      <div style="font-size: 0.85rem; color: var(--text-muted);">Projects in pipeline</div>
    </div>

    <div class="glass-panel" style="padding: 25px;">
      <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
        <h3 class="text-muted" style="font-size: 0.9rem; text-transform: uppercase; letter-spacing: 1px;">Security Level</h3>
        <i class="fa fa-lock text-emerald"></i>
      </div>
      <div style="font-size: 1.8rem; font-weight: 700; font-family: var(--font-mono); margin-bottom: 5px;">Tier 1</div>
      <div style="font-size: 0.85rem; color: var(--text-muted);">Standard Access</div>
    </div>

  </div>

  <div class="glass-panel" id="orders">
    <div style="padding: 25px 30px; border-bottom: 1px solid var(--panel-border); display: flex; justify-content: space-between; align-items: center;">
      <h2 style="font-size: 1.2rem;"><i class="fa fa-history text-cyan mr-2"></i> Order History</h2>
    </div>
    
    <div style="padding: 30px;">
      <?php if (empty($orders)): ?>
        <div style="text-align: center; padding: 40px 0;">
          <div style="font-size: 3rem; color: rgba(255,255,255,0.1); margin-bottom: 20px;"><i class="fa fa-folder-open"></i></div>
          <h3 style="font-size: 1.2rem; margin-bottom: 10px;">Belum ada pesanan</h3>
          <p class="text-muted mb-6">Anda belum memesan layanan pengembangan apapun.</p>
          <a href="?page=order" class="btn btn-outline">Buat Pesanan Pertama</a>
        </div>
      <?php else: ?>
        <div style="overflow-x: auto;">
          <table style="width: 100%; text-align: left; border-collapse: collapse;">
            <thead>
              <tr style="border-bottom: 1px solid rgba(255,255,255,0.1);">
                <th style="padding: 15px 10px; color: var(--text-muted); font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px;">ID</th>
                <th style="padding: 15px 10px; color: var(--text-muted); font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px;">Layanan</th>
                <th style="padding: 15px 10px; color: var(--text-muted); font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px;">Paket</th>
                <th style="padding: 15px 10px; color: var(--text-muted); font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px;">Harga</th>
                <th style="padding: 15px 10px; color: var(--text-muted); font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px;">Status</th>
                <th style="padding: 15px 10px; color: var(--text-muted); font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px;">Tanggal</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($orders as $o): ?>
              <tr style="border-bottom: 1px solid rgba(255,255,255,0.05);">
                <td style="padding: 15px 10px; font-family: var(--font-mono); font-size: 0.9rem;">#<?= str_pad((string)$o['id'], 4, '0', STR_PAD_LEFT) ?></td>
                <td style="padding: 15px 10px; font-weight: 500;"><?= htmlspecialchars($o['service']) ?></td>
                <td style="padding: 15px 10px;"><span class="badge badge-cyan"><?= htmlspecialchars($o['package']) ?></span></td>
                <td style="padding: 15px 10px; font-family: var(--font-mono);">Rp <?= number_format($o['price'], 0, ',', '.') ?></td>
                <td style="padding: 15px 10px;">
                  <?php
                    $statusClass = match($o['status']) {
                      'pending' => 'badge-amber',
                      'processing' => 'badge-purple',
                      'done' => 'badge-emerald',
                      default => 'badge-cyan'
                    };
                  ?>
                  <span class="badge <?= $statusClass ?>"><?= strtoupper($o['status']) ?></span>
                </td>
                <td style="padding: 15px 10px; color: var(--text-muted); font-size: 0.9rem;"><?= date('d M Y', strtotime($o['created_at'])) ?></td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      <?php endif; ?>
    </div>
  </div>

</div>
