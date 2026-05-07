<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'O! Save' }}</title>
    <style>
        :root {
            color-scheme: light;
            font-family: Inter, system-ui, sans-serif;
            background: #eef2ff;
            color: #0f172a;
        }
        body { margin: 0; padding: 0; background: linear-gradient(180deg, #e0e7ff 0%, #f8fafc 100%); }
        .navbar { display: flex; justify-content: space-between; align-items: center; gap: 16px; padding: 22px 32px; background: linear-gradient(90deg, #0b1132, #1e293b); color: white; box-shadow: 0 14px 35px rgba(15,23,42,.18); position: sticky; top: 0; z-index: 10; }
        .navbar a { color: white; text-decoration: none; font-weight: 600; transition: color .15s ease; }
        .navbar a:hover { color: #93c5fd; }
        .brand { font-size: 1.4rem; letter-spacing: 0.04em; }
        .brand-subtitle { margin: 4px 0 0; color: #c7d2fe; font-size: 0.95rem; }
        .nav-links { display: flex; flex-wrap: wrap; gap: 18px; align-items: center; }
        .container { max-width: 1260px; margin: 0 auto; padding: 32px 24px 48px; }
        .card { background: white; border-radius: 24px; box-shadow: 0 28px 80px rgba(15,23,42,.12); padding: 28px; margin-bottom: 28px; }
        .button { display: inline-flex; align-items: center; justify-content: center; padding: 12px 18px; border-radius: 9999px; background: #0f172a; color: white; text-decoration: none; transition: transform .15s ease, background .15s ease, box-shadow .15s ease; }
        .button:hover { transform: translateY(-1px); background: #111827; box-shadow: 0 15px 28px rgba(15,23,42,.18); }
        .button-secondary { background: #f8fafc; color: #0f172a; border: 1px solid #e2e8f0; }
        .button-danger { background: #dc2626; }
        .button-danger:hover { background: #b91c1c; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 14px 12px; border-bottom: 1px solid #e2e8f0; text-align: left; }
        th { background: #f8fafc; font-weight: 700; color: #0f172a; }
        .alert { padding: 18px 20px; border-radius: 18px; background: #dbeafe; color: #1d4ed8; margin-bottom: 24px; }
        .form-grid { display: grid; gap: 20px; }
        .field { display: grid; gap: 10px; }
        label { font-weight: 700; color: #0f172a; }
        input, select, textarea { width: 100%; border: 1px solid #cbd5e1; border-radius: 14px; padding: 14px 16px; font-size: 1rem; background: #ffffff; }
        .actions { display: flex; flex-wrap: wrap; gap: 12px; }
        .hero { display: flex; justify-content: space-between; align-items: flex-start; gap: 22px; margin-bottom: 28px; }
        .hero-text { max-width: 640px; }
        .hero-text h1 { margin: 0 0 14px; font-size: clamp(2rem, 3vw, 3.2rem); line-height: 1.05; }
        .hero-text p { margin: 0; color: #475569; font-size: 1rem; line-height: 1.8; }
        .stats-grid { display: grid; grid-template-columns: repeat(4, minmax(0, 1fr)); gap: 18px; margin-bottom: 24px; }
        .stat-card { background: #f8fafc; border-radius: 20px; padding: 22px; box-shadow: inset 0 0 0 1px rgba(15,23,42,.05); }
        .stat-card strong { display: block; font-size: 1.75rem; color: #0f172a; margin-bottom: 6px; }
        .stat-card span { color: #64748b; font-size: 0.95rem; }
        .small-badge { display: inline-flex; padding: 6px 12px; border-radius: 9999px; background: rgba(59,130,246,.12); color: #1d4ed8; font-size: 0.85rem; font-weight: 700; }
        @media (max-width: 960px) { .stats-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); } }
        @media (max-width: 720px) { .navbar { flex-direction: column; align-items: stretch; padding: 18px 20px; } .hero { flex-direction: column; } .nav-links { justify-content: flex-start; } }
    </style>
</head>
<body>
    <header class="navbar">
        <div>
            <a class="brand" href="{{ route('transaksi.index') }}">O! Save</a>
            <p class="brand-subtitle">Sistem kasir modern untuk toko kelontong dan manajemen transaksi</p>
        </div>
        <nav class="nav-links">
            <a href="{{ route('transaksi.index') }}">Transaksi</a>
            <a href="{{ route('transaksi.create') }}">Tambah Transaksi</a>
            <a href="{{ route('barang.index') }}">Barang</a>
            <a href="{{ route('barang.create') }}">Tambah Barang</a>
        </nav>
    </header>
    <main class="container">
        @if(session('success'))
            <div class="alert">{{ session('success') }}</div>
        @endif
        @yield('content')
    </main>
</body>
</html>
