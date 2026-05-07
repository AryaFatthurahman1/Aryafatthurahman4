<?php
declare(strict_types=1);

require __DIR__ . '/../shared/portal_helpers.php';

$pdo = portal_db_pdo('toko_barang1');
$isConnected = $pdo !== null;

$stats = [
    'barang' => (int) portal_value($pdo, 'SELECT COUNT(*) FROM barang'),
    'kategori' => (int) portal_value($pdo, 'SELECT COUNT(*) FROM kategori'),
    'supplier' => (int) portal_value($pdo, 'SELECT COUNT(*) FROM supplier'),
    'stok' => (int) portal_value($pdo, 'SELECT COALESCE(SUM(stok), 0) FROM barang'),
    'harga_rata' => (float) portal_value($pdo, 'SELECT COALESCE(AVG(harga_jual), 0) FROM barang'),
];

$categories = portal_rows(
    $pdo,
    'SELECT id_kategori, nama_kategori FROM kategori ORDER BY nama_kategori ASC'
);

$products = portal_rows(
    $pdo,
    'SELECT kode_barang, nama_barang, harga_jual, stok, satuan FROM barang ORDER BY stok DESC, nama_barang ASC LIMIT 6'
);

function rupiah($value): string {
    return 'Rp ' . number_format((float) $value, 0, ',', '.');
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventori - Toko Barang 1</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f8fafc; color: #334155; }
        .dashboard-card { background: white; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03); border-radius: 1rem; }
    </style>
</head>
<body class="antialiased">
    <div class="flex min-h-screen bg-slate-50">
        <aside class="w-64 bg-slate-900 text-white flex-shrink-0 hidden md:flex flex-col">
            <div class="p-6 border-b border-slate-800">
                <h1 class="text-xl font-bold tracking-tight text-blue-400">Retail<span class="text-white">Dash</span></h1>
                <p class="text-xs text-slate-400 mt-1 uppercase tracking-wider">Toko Barang 1</p>
            </div>
            <nav class="flex-1 p-4 space-y-2">
                <a href="#" class="flex items-center gap-3 bg-blue-600/20 text-blue-400 px-4 py-3 rounded-xl font-medium border border-blue-500/30">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                    Dashboard
                </a>
                <a href="/phpmyadmin/" class="flex items-center gap-3 text-slate-400 hover:text-white hover:bg-slate-800 px-4 py-3 rounded-xl font-medium transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"></path></svg>
                    Database
                </a>
                <a href="/" class="flex items-center gap-3 text-slate-400 hover:text-white hover:bg-slate-800 px-4 py-3 rounded-xl font-medium transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Main Hub
                </a>
            </nav>
            <div class="p-6 border-t border-slate-800">
                <div class="flex items-center gap-2 text-sm font-medium <?= $isConnected ? 'text-emerald-400' : 'text-rose-400' ?>">
                    <span class="w-2 h-2 rounded-full <?= $isConnected ? 'bg-emerald-400 animate-pulse' : 'bg-rose-400' ?>"></span>
                    <?= $isConnected ? 'System Online' : 'DB Offline' ?>
                </div>
            </div>
        </aside>
        <main class="flex-1 overflow-y-auto">
            <header class="bg-white border-b border-slate-200 px-8 py-5 flex justify-between items-center sticky top-0 z-20 shadow-sm">
                <div>
                    <h2 class="text-xl font-bold text-slate-800">Inventori & Stok</h2>
                    <p class="text-sm text-slate-500">Ringkasan data toko hari ini.</p>
                </div>
                <div class="flex items-center gap-4">
                    <a href="/phpmyadmin/" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-lg text-sm font-medium transition-colors shadow-sm shadow-blue-600/20">Input Barang Baru</a>
                </div>
            </header>
            <div class="p-8 max-w-7xl mx-auto space-y-8">
                <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div class="dashboard-card p-6 border-l-4 border-l-blue-500">
                        <p class="text-sm font-semibold text-slate-500 uppercase tracking-wider mb-1">Total Barang</p>
                        <div class="text-3xl font-bold text-slate-800"><?= portal_number($stats['barang']) ?> <span class="text-sm font-normal text-slate-400">item</span></div>
                    </div>
                    <div class="dashboard-card p-6 border-l-4 border-l-emerald-500">
                        <p class="text-sm font-semibold text-slate-500 uppercase tracking-wider mb-1">Total Stok</p>
                        <div class="text-3xl font-bold text-slate-800"><?= portal_number($stats['stok']) ?> <span class="text-sm font-normal text-slate-400">pcs</span></div>
                    </div>
                    <div class="dashboard-card p-6 border-l-4 border-l-amber-500">
                        <p class="text-sm font-semibold text-slate-500 uppercase tracking-wider mb-1">Rata-rata Harga</p>
                        <div class="text-3xl font-bold text-slate-800"><?= portal_money($stats['harga_rata']) ?></div>
                    </div>
                    <div class="dashboard-card p-6 border-l-4 border-l-purple-500">
                        <p class="text-sm font-semibold text-slate-500 uppercase tracking-wider mb-1">Supplier</p>
                        <div class="text-3xl font-bold text-slate-800"><?= portal_number($stats['supplier']) ?> <span class="text-sm font-normal text-slate-400">vendor</span></div>
                    </div>
                </div>
                <div class="grid lg:grid-cols-3 gap-8">
                    <div class="dashboard-card lg:col-span-2 flex flex-col h-[500px]">
                        <div class="px-6 py-5 border-b border-slate-100 flex justify-between items-center bg-slate-50/50 rounded-t-xl">
                            <h3 class="font-bold text-slate-800">Barang Tersedia</h3>
                            <span class="text-xs font-medium bg-blue-100 text-blue-700 px-3 py-1 rounded-full">Top 6</span>
                        </div>
                        <div class="flex-1 overflow-auto p-0">
                            <?php if ($products === []): ?>
                                <div class="h-full flex flex-col items-center justify-center text-slate-400 p-8">
                                    <svg class="w-12 h-12 mb-3 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                                    <p>Tabel barang masih kosong.</p>
                                </div>
                            <?php else: ?>
                                <table class="w-full text-left text-sm whitespace-nowrap">
                                    <thead class="bg-white sticky top-0 shadow-sm shadow-slate-200/50">
                                        <tr>
                                            <th class="px-6 py-4 font-semibold text-slate-500 uppercase text-xs tracking-wider">Kode</th>
                                            <th class="px-6 py-4 font-semibold text-slate-500 uppercase text-xs tracking-wider">Nama Barang</th>
                                            <th class="px-6 py-4 font-semibold text-slate-500 uppercase text-xs tracking-wider">Harga</th>
                                            <th class="px-6 py-4 font-semibold text-slate-500 uppercase text-xs tracking-wider text-right">Stok</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-slate-100">
                                        <?php foreach ($products as $product): ?>
                                            <tr class="hover:bg-slate-50 transition-colors">
                                                <td class="px-6 py-4"><code class="text-xs bg-slate-100 text-slate-600 px-2 py-1 rounded border border-slate-200"><?= portal_h($product['kode_barang']) ?></code></td>
                                                <td class="px-6 py-4 font-medium text-slate-800"><?= portal_h($product['nama_barang']) ?></td>
                                                <td class="px-6 py-4 text-emerald-600 font-medium"><?= portal_money($product['harga_jual']) ?></td>
                                                <td class="px-6 py-4 text-right">
                                                    <span class="font-bold <?= $product['stok'] < 10 ? 'text-red-500' : 'text-slate-700' ?>"><?= portal_number($product['stok']) ?></span>
                                                    <span class="text-xs text-slate-400 ml-1"><?= portal_h($product['satuan'] ?: 'pcs') ?></span>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="dashboard-card flex flex-col h-[500px]">
                        <div class="px-6 py-5 border-b border-slate-100 bg-slate-50/50 rounded-t-xl">
                            <h3 class="font-bold text-slate-800">Kategori Katalog</h3>
                        </div>
                        <div class="flex-1 overflow-auto p-6 space-y-3">
                            <?php if ($categories === []): ?>
                                <p class="text-slate-400 text-sm text-center">Belum ada kategori.</p>
                            <?php endif; ?>
                            <?php foreach ($categories as $category): ?>
                                <div class="flex items-center justify-between p-4 rounded-xl border border-slate-200 hover:border-blue-300 hover:shadow-md hover:shadow-blue-500/5 transition-all group cursor-pointer bg-white">
                                    <span class="font-medium text-slate-700 group-hover:text-blue-600 transition-colors"><?= portal_h($category['nama_kategori']) ?></span>
                                    <code class="text-xs text-slate-400 bg-slate-50 px-2 py-1 rounded"><?= portal_h($category['id_kategori']) ?></code>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>