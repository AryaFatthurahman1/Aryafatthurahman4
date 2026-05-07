<div class="bg-glow-2"></div>

<div class="container auth-container">
  <div class="glass-panel auth-card">
    <div class="auth-header">
      <div class="auth-icon" style="background: linear-gradient(135deg, rgba(16,185,129,0.2), rgba(0,245,255,0.2));"><i class="fa fa-user-plus"></i></div>
      <h1 class="auth-title">Create Account</h1>
      <p class="auth-subtitle">Bergabung dengan Ekosistem AntiGravity</p>
    </div>

    <?php if (!empty($registerError)): ?>
      <div class="alert alert-error">
        <i class="fa fa-exclamation-triangle"></i> <?= htmlspecialchars($registerError) ?>
      </div>
    <?php endif; ?>

    <?php if (!empty($registerSuccess)): ?>
      <div class="alert alert-success">
        <i class="fa fa-check-circle"></i> <?= htmlspecialchars($registerSuccess) ?>
      </div>
      <div class="text-center mt-4">
        <a href="?page=login" class="btn btn-primary">Go to Login</a>
      </div>
    <?php else: ?>

      <form method="POST" action="?page=register">
        <div class="form-group">
          <label class="form-label">Full Name</label>
          <div style="position: relative;">
            <i class="fa fa-user" style="position: absolute; left: 18px; top: 50%; transform: translateY(-50%); color: var(--text-muted);"></i>
            <input type="text" name="name" class="form-control" style="padding-left: 45px;" placeholder="John Doe" required>
          </div>
        </div>

        <div class="form-group">
          <label class="form-label">Email Address</label>
          <div style="position: relative;">
            <i class="fa fa-envelope" style="position: absolute; left: 18px; top: 50%; transform: translateY(-50%); color: var(--text-muted);"></i>
            <input type="email" name="email" class="form-control" style="padding-left: 45px;" placeholder="john@example.com" required>
          </div>
        </div>
        
        <div class="form-group">
          <label class="form-label">Password</label>
          <div style="position: relative;">
            <i class="fa fa-key" style="position: absolute; left: 18px; top: 50%; transform: translateY(-50%); color: var(--text-muted);"></i>
            <input type="password" name="password" class="form-control" style="padding-left: 45px;" placeholder="Min 6 characters" required>
          </div>
        </div>

        <div class="form-group mb-6">
          <label class="form-label">Confirm Password</label>
          <div style="position: relative;">
            <i class="fa fa-lock" style="position: absolute; left: 18px; top: 50%; transform: translateY(-50%); color: var(--text-muted);"></i>
            <input type="password" name="password_confirm" class="form-control" style="padding-left: 45px;" placeholder="Re-type password" required>
          </div>
        </div>

        <button type="submit" class="btn btn-primary" style="width: 100%; justify-content: center; padding: 14px; background: linear-gradient(135deg, var(--quantum-emerald), var(--quantum-cyan));">
          Register Access <i class="fa fa-user-check ml-2"></i>
        </button>
      </form>

      <div class="auth-footer">
        Sudah memiliki akun? <a href="?page=login">Masuk di sini</a>
      </div>
    <?php endif; ?>
  </div>
</div>
