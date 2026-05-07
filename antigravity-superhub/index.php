<?php
/**
 * AntiGravity SuperHub V4.0 - LUXURY EDITION
 * The definitive entry point for the AntiGravity Ecosystem.
 */
require_once dirname(__DIR__) . '/shared/portal_helpers.php';

$rootPath = dirname(__DIR__);
$exclude = ['.', '..', 'laragon', 'tmp', 'antigravity-superhub', 'backup', 'shared', '.vscode', '.knox', 'jakarta-luxury-ai.zip', 'ProjectHotel_Luxury.zip'];

$projects = [];
$dirs = scandir($rootPath);

foreach ($dirs as $dir) {
    if (in_array($dir, $exclude)) continue;
    $fullPath = $rootPath . DIRECTORY_SEPARATOR . $dir;
    
    if (is_dir($fullPath)) {
        $stack = "PHP Core"; $icon = "📁"; $cat = "native"; $db = null;
        
        if (file_exists($fullPath . '/package.json')) {
            $pkg = json_decode(file_get_contents($fullPath . '/package.json'), true);
            if (isset($pkg['dependencies']['next'])) { $stack = "Next.js 15"; $icon = "⚛️"; }
            elseif (isset($pkg['dependencies']['react'])) { $stack = "React 18"; $icon = "⚛️"; }
            elseif (isset($pkg['dependencies']['vue'])) { $stack = "Vue 3"; $icon = "🖖"; }
        } elseif (file_exists($fullPath . '/artisan')) {
            $stack = "Laravel 11"; $icon = "🚀";
            $db = str_replace(['-', ' '], '_', strtolower($dir));
        } elseif (file_exists($fullPath . '/pubspec.yaml')) {
            $stack = "Flutter SDK"; $icon = "📱";
        }

        $dbStatus = $db ? (portal_database_exists($db) ? 'Online' : 'None') : 'N/A';

        $projects[] = [
            'name' => ucwords(str_replace(['-', '_'], ' ', $dir)),
            'url' => '/' . $dir . '/',
            'stack' => $stack,
            'icon' => $icon,
            'dbStatus' => $dbStatus
        ];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AntiGravity | Unified Luxury Ecosystem</title>
    <link rel="stylesheet" href="../shared/css/luxury.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .hero-luxury {
            position: relative;
            padding: 180px 48px 120px;
            text-align: center;
            overflow: hidden;
        }
        .hero-img-bg {
            position: absolute;
            inset: 0;
            z-index: -1;
            opacity: 0.2;
            background: url('assets/orb.png') center/cover no-repeat;
            mask-image: radial-gradient(circle, black, transparent 70%);
        }
        .nav-sidebar {
            width: 80px;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            z-index: 1000;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 40px 0;
            border-right: 1px solid var(--lux-border);
            background: rgba(1, 3, 9, 0.8);
            backdrop-filter: blur(20px);
        }
        .nav-icon {
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--lux-text-dim);
            font-size: 20px;
            border-radius: 14px;
            margin-bottom: 24px;
            transition: var(--lux-transition);
            text-decoration: none;
        }
        .nav-icon:hover, .nav-icon.active {
            color: #fff;
            background: rgba(34, 211, 238, 0.1);
            box-shadow: 0 0 20px rgba(34, 211, 238, 0.2);
        }
        .main-lux { margin-left: 80px; }
        .lux-card-project {
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 100%;
        }
        .lux-card-project h3 { font-size: 24px; font-weight: 800; margin-bottom: 12px; }
        .lux-tag {
            font-family: 'JetBrains Mono', monospace;
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: var(--lux-cyan);
            margin-bottom: 24px;
            display: block;
        }
        .lux-stats-bar {
            display: flex;
            gap: 40px;
            justify-content: center;
            margin-top: 60px;
        }
        .lux-stat-item { text-align: center; }
        .lux-stat-val { font-size: 32px; font-weight: 900; color: #fff; font-family: 'Outfit'; }
        .lux-stat-lbl { font-size: 10px; text-transform: uppercase; letter-spacing: 2px; color: var(--lux-text-dark); }
    </style>
</head>
<body>

<div class="lux-mesh"></div>

<nav class="nav-sidebar">
    <div style="font-weight: 900; color: #fff; font-size: 24px; margin-bottom: 60px;">AG</div>
    <a href="#" class="nav-icon active"><i class="fas fa-th-large"></i></a>
    <a href="#projects" class="nav-icon"><i class="fas fa-project-diagram"></i></a>
    <a href="quantum_lab.php" class="nav-icon"><i class="fas fa-atom"></i></a>
    <a href="#settings" class="nav-icon" style="margin-top: auto;"><i class="fas fa-cog"></i></a>
</nav>

<div class="main-lux">
    <section class="hero-luxury">
        <div class="hero-img-bg"></div>
        <div class="lux-glow" style="top: 20%; left: 30%;"></div>
        
        <div style="font-size: 12px; font-weight: 800; color: var(--lux-cyan); letter-spacing: 4px; text-transform: uppercase; margin-bottom: 32px;">Quantum Powered Platform</div>
        <h1 class="lux-h1">Anti<span class="lux-grad-text">Gravity</span></h1>
        <p style="font-size: 20px; color: var(--lux-text-dim); max-width: 800px; margin: 24px auto 48px;">
            The world's most advanced unified development ecosystem. Orchestrating high-performance neural networks, quantum simulations, and luxury enterprise applications.
        </p>
        
        <div style="display: flex; gap: 24px; justify-content: center;">
            <a href="#projects" class="lux-btn">Explore Repositories</a>
            <a href="quantum_lab.php" class="lux-btn lux-btn-outline">Launch Quantum Lab</a>
        </div>

        <div class="lux-stats-bar">
            <div class="lux-stat-item"><div class="lux-stat-val"><?= count($projects) ?></div><div class="lux-stat-lbl">Active Nodes</div></div>
            <div class="lux-stat-item"><div class="lux-stat-val">99.9%</div><div class="lux-stat-lbl">System Uptime</div></div>
            <div class="lux-stat-item"><div class="lux-stat-val">1.2ms</div><div class="lux-stat-lbl">Latency Index</div></div>
        </div>
    </section>

    <section class="section" id="projects" style="padding: 100px 48px;">
        <div style="margin-bottom: 80px; text-align: center;">
            <h2 style="font-size: 48px; font-weight: 900; letter-spacing: -2px;">Repository <span class="lux-grad-text">Nexus</span></h2>
            <p style="color: var(--lux-text-dim);">Real-time monitoring and deployment of entire stack architecture.</p>
        </div>

        <div class="lux-grid">
            <?php foreach ($projects as $p): ?>
            <div class="lux-card lux-card-project" onclick="window.location='<?= $p['url'] ?>'">
                <div>
                    <span class="lux-tag"><?= $p['stack'] ?></span>
                    <h3><?= portal_h($p['name']) ?></h3>
                </div>
                <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 40px;">
                    <div style="display: flex; align-items: center; gap: 8px;">
                        <div style="width: 8px; height: 8px; background: var(--lux-emerald); border-radius: 50%; box-shadow: 0 0 10px var(--lux-emerald);"></div>
                        <span style="font-size: 11px; font-weight: 700; color: var(--lux-text-dark);">ACTIVE</span>
                    </div>
                    <div style="font-size: 18px; color: var(--lux-text-dim);"><?= $p['icon'] ?></div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </section>

    <footer style="padding: 100px 48px; border-top: 1px solid var(--lux-border); text-align: center;">
        <div style="font-size: 24px; font-weight: 900; margin-bottom: 32px;">Anti<span class="lux-grad-text">Gravity</span></div>
        <p style="font-family: 'JetBrains Mono'; font-size: 11px; color: var(--lux-text-dark); letter-spacing: 4px;">EST 2026 • QUANTUM SUPREMACY • UNIFIED SYSTEMS</p>
    </footer>
</div>

<script>
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth'
            });
        });
    });
</script>
</body>
</html>
