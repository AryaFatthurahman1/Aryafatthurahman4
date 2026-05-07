<?php
$user = current_user();
$isLoggedIn = is_logged_in();
?><!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= htmlspecialchars($pageTitle) ?></title>
<meta name="description" content="AntiGravity Quantum Hub — Platform terpadu untuk semua proyek web, AI, ML, mobile, dan quantum computing.">
<link rel="stylesheet" href="../shared/css/luxury.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
    body { font-family: 'Plus Jakarta Sans', sans-serif; }
    .nav-logo { text-decoration: none; display: flex; align-items: center; gap: 12px; }
    .logo-name { font-size: 20px; font-weight: 800; color: #fff; }
    .logo-sub { font-size: 10px; color: var(--lux-cyan); text-transform: uppercase; letter-spacing: 2px; }
    .navbar { background: rgba(1, 3, 9, 0.85); backdrop-filter: blur(20px); border-bottom: 1px solid var(--lux-border); padding: 15px 48px; position: fixed; top: 0; left: 0; width: 100%; z-index: 1000; }
    .nav-container { max-width: 1400px; margin: 0 auto; display: flex; justify-content: space-between; align-items: center; }
    .nav-links { display: flex; list-style: none; gap: 32px; align-items: center; }
    .nav-link { color: var(--lux-text-dim); text-decoration: none; font-size: 13px; font-weight: 600; transition: var(--lux-transition); display: flex; align-items: center; gap: 8px; }
    .nav-link:hover, .nav-link.active { color: var(--lux-cyan); }
    .page-wrapper { margin-top: 80px; }
</style>
</head>
<body>

<!-- Quantum Particle Canvas -->
<canvas id="particleCanvas" class="particle-canvas"></canvas>

<!-- Navigation -->
<nav class="navbar" id="mainNav">
  <div class="nav-container">
    <!-- Logo -->
    <a href="?page=home" class="nav-logo">
      <div class="logo-icon">
        <svg viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
          <circle cx="20" cy="20" r="18" stroke="url(#lg1)" stroke-width="2"/>
          <path d="M20 8 L32 26 H8 Z" fill="url(#lg2)" opacity="0.9"/>
          <circle cx="20" cy="20" r="4" fill="#00f5ff"/>
          <defs>
            <linearGradient id="lg1" x1="0" y1="0" x2="40" y2="40">
              <stop offset="0%" stop-color="#00f5ff"/>
              <stop offset="100%" stop-color="#a855f7"/>
            </linearGradient>
            <linearGradient id="lg2" x1="0" y1="0" x2="40" y2="40">
              <stop offset="0%" stop-color="#a855f7"/>
              <stop offset="100%" stop-color="#00f5ff"/>
            </linearGradient>
          </defs>
        </svg>
      </div>
      <div class="logo-text">
        <span class="logo-name">AntiGravity</span>
        <span class="logo-sub">Quantum Hub</span>
      </div>
    </a>

    <!-- Desktop Nav Links -->
    <ul class="nav-links" id="navLinks">
      <li><a href="?page=home" class="nav-link <?= $page==='home'?'active':'' ?>"><i class="fa fa-home"></i> Beranda</a></li>

      <!-- Layanan Mega Menu -->
      <li class="has-dropdown">
        <a href="?page=services" class="nav-link <?= $page==='services'?'active':'' ?>">
          <i class="fa fa-th-large"></i> Layanan <i class="fa fa-chevron-down nav-arrow"></i>
        </a>
        <div class="mega-menu">
          <div class="mega-grid">
            <div class="mega-col">
              <div class="mega-label">AI & Quantum</div>
              <a href="?page=services#ai" class="mega-item"><i class="fa fa-brain text-purple-400"></i> AI Concierge</a>
              <a href="?page=quantum" class="mega-item"><i class="fa fa-atom text-cyan-400"></i> Hybrid Quantum Systems</a>
              <a href="?page=services#ml" class="mega-item"><i class="fa fa-chart-line text-blue-400"></i> Machine Learning API</a>
            </div>
            <div class="mega-col">
              <div class="mega-label">Web & Mobile</div>
              <a href="?page=services#web" class="mega-item"><i class="fa fa-globe text-emerald-400"></i> Web Development</a>
              <a href="?page=services#mobile" class="mega-item"><i class="fa fa-mobile-alt text-orange-400"></i> Mobile Apps (Flutter)</a>
              <a href="?page=services#hotel" class="mega-item"><i class="fa fa-hotel text-yellow-400"></i> Hotel & Booking Systems</a>
            </div>
            <div class="mega-col">
              <div class="mega-label">Backend & Data</div>
              <a href="?page=services#api" class="mega-item"><i class="fa fa-server text-red-400"></i> REST API Development</a>
              <a href="?page=services#db" class="mega-item"><i class="fa fa-database text-indigo-400"></i> Database Design</a>
              <a href="?page=services#devops" class="mega-item"><i class="fa fa-docker text-sky-400"></i> DevOps & Docker</a>
            </div>
            <div class="mega-col">
              <div class="mega-label">Konten & Commerce</div>
              <a href="?page=services#skincare" class="mega-item"><i class="fa fa-spa text-pink-400"></i> Skincare & Beauty Tech</a>
              <a href="?page=services#ecommerce" class="mega-item"><i class="fa fa-shopping-bag text-teal-400"></i> E-Commerce Platform</a>
              <a href="?page=services#consulting" class="mega-item"><i class="fa fa-lightbulb text-amber-400"></i> Tech Consulting</a>
            </div>
          </div>
        </div>
      </li>

      <!-- Proyek -->
      <li class="has-dropdown">
        <a href="?page=projects" class="nav-link <?= $page==='projects'?'active':'' ?>">
          <i class="fa fa-folder-open"></i> Proyek <i class="fa fa-chevron-down nav-arrow"></i>
        </a>
        <div class="dropdown-menu">
          <a href="/jakarta-luxury-ai/" class="dropdown-item" target="_blank"><i class="fa fa-star text-yellow-400"></i> Jakarta Luxury AI</a>
          <a href="/Facetology/" class="dropdown-item" target="_blank"><i class="fa fa-spa text-pink-400"></i> Facetology Studio</a>
          <a href="/DarkUniverse/" class="dropdown-item" target="_blank"><i class="fa fa-moon text-purple-400"></i> DarkUniverse Pro</a>
          <a href="/ProjectHotel_Luxury/" class="dropdown-item" target="_blank"><i class="fa fa-hotel text-blue-400"></i> Project Hotel Luxury</a>
          <a href="/Toko_Barang1/" class="dropdown-item" target="_blank"><i class="fa fa-store text-emerald-400"></i> RetailDash Toko</a>
          <a href="/WebsiteBaru/" class="dropdown-item" target="_blank"><i class="fa fa-code text-cyan-400"></i> Framework Labs</a>
          <a href="/mobile-computing-flutter/" class="dropdown-item" target="_blank"><i class="fa fa-mobile text-orange-400"></i> Alfamart Mobile</a>
          <div class="dropdown-divider"></div>
          <a href="?page=projects" class="dropdown-item"><i class="fa fa-th text-gray-400"></i> Semua Proyek →</a>
        </div>
      </li>

      <li><a href="?page=quantum" class="nav-link <?= $page==='quantum'?'active':'' ?>"><i class="fa fa-atom"></i> Quantum</a></li>
      <li><a href="?page=order" class="nav-link <?= $page==='order'?'active':'' ?>"><i class="fa fa-shopping-cart"></i> Pesan</a></li>
    </ul>

    <!-- Auth Buttons -->
    <div class="nav-auth">
      <?php if ($isLoggedIn): ?>
        <a href="?page=dashboard" class="btn-nav-ghost"><i class="fa fa-tachometer-alt"></i> Dashboard</a>
        <div class="user-menu-wrap has-dropdown">
          <button class="user-avatar-btn">
            <div class="user-avatar"><?= strtoupper(substr($user['name'], 0, 1)) ?></div>
            <span class="user-name-nav"><?= htmlspecialchars(explode(' ', $user['name'])[0]) ?></span>
            <i class="fa fa-chevron-down nav-arrow"></i>
          </button>
          <div class="dropdown-menu dropdown-right">
            <a href="?page=dashboard" class="dropdown-item"><i class="fa fa-user"></i> Profil Saya</a>
            <a href="?page=dashboard#orders" class="dropdown-item"><i class="fa fa-box"></i> Pesanan Saya</a>
            <div class="dropdown-divider"></div>
            <a href="?page=logout" class="dropdown-item text-red-400"><i class="fa fa-sign-out-alt"></i> Keluar</a>
          </div>
        </div>
      <?php else: ?>
        <a href="?page=login" class="btn-nav-ghost"><i class="fa fa-sign-in-alt"></i> Masuk</a>
        <a href="?page=register" class="btn-nav-primary"><i class="fa fa-user-plus"></i> Daftar</a>
      <?php endif; ?>
    </div>

    <!-- Mobile Hamburger -->
    <button class="hamburger" id="hamburgerBtn" aria-label="Menu">
      <span></span><span></span><span></span>
    </button>
  </div>
</nav>

<!-- Main content wrapper -->
<div class="page-wrapper">
