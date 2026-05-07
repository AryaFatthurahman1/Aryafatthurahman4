<div class="bg-glow"></div>

<div class="container auth-container">
  <div class="glass-panel auth-card">
    <div class="auth-header">
      <div class="auth-icon"><i class="fa fa-lock"></i></div>
      <h1 class="auth-title">Welcome Back</h1>
      <p class="auth-subtitle">Masuk ke AntiGravity Quantum Hub</p>
    </div>

    <?php if (!empty($loginError)): ?>
      <div class="alert alert-error">
        <i class="fa fa-exclamation-triangle"></i> <?= htmlspecialchars($loginError) ?>
      </div>
    <?php endif; ?>

    <form method="POST" action="?page=login">
      <div class="form-group">
        <label class="form-label">Email Address</label>
        <div style="position: relative;">
          <i class="fa fa-envelope" style="position: absolute; left: 18px; top: 50%; transform: translateY(-50%); color: var(--text-muted);"></i>
          <input type="email" name="email" class="form-control" style="padding-left: 45px;" placeholder="admin@antigravity.com" required>
        </div>
      </div>
      
      <div class="form-group mb-6">
        <label class="form-label">Password</label>
        <div style="position: relative;">
          <i class="fa fa-key" style="position: absolute; left: 18px; top: 50%; transform: translateY(-50%); color: var(--text-muted);"></i>
          <input type="password" name="password" class="form-control" style="padding-left: 45px;" placeholder="••••••••" required>
        </div>
      </div>

      <button type="submit" class="btn btn-primary" style="width: 100%; justify-content: center; padding: 14px;">
        Initialize Session <i class="fa fa-arrow-right ml-2"></i>
      </button>
    </form>

    <div class="auth-footer">
      Belum memiliki akses? <a href="?page=register">Daftar sekarang</a>
    </div>
  </div>
</div>
