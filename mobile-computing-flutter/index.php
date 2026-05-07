<?php
require_once __DIR__ . '/api/config/database.php';

$db = null;
$isConnected = false;
$stats = [
    'products' => 0,
    'categories' => 0,
    'low_stock' => 0,
    'avg_price' => 0,
    'today_sales' => 0,
    'today_orders' => 0,
];
$categories = [];
$featuredProducts = [];
$recentProducts = [];
$bestSellers = [];
$errorMessage = null;

try {
    $database = new Database();
    $db = $database->getConnection();
    $isConnected = true;

    $statsQuery = "
        SELECT
            (SELECT COUNT(*) FROM products WHERE is_active = 1) AS total_products,
            (SELECT COUNT(*) FROM categories WHERE is_active = 1) AS total_categories,
            (SELECT COUNT(*) FROM products WHERE stock <= min_stock_level AND is_active = 1) AS total_low_stock,
            (SELECT COALESCE(AVG(price), 0) FROM products WHERE is_active = 1) AS average_price,
            (SELECT COALESCE(SUM(final_amount), 0) FROM orders WHERE DATE(order_date) = CURDATE()) AS today_sales,
            (SELECT COUNT(*) FROM orders WHERE DATE(order_date) = CURDATE()) AS today_orders
    ";
    $stats = $db->query($statsQuery)->fetch();

    $categoryStmt = $db->query("
        SELECT c.category_id, c.category_name, COUNT(p.product_id) AS total_products
        FROM categories c
        LEFT JOIN products p ON p.category_id = c.category_id AND p.is_active = 1
        WHERE c.is_active = 1
        GROUP BY c.category_id, c.category_name
        ORDER BY c.sort_order ASC, c.category_name ASC
        LIMIT 6
    ");
    $categories = $categoryStmt->fetchAll();

    $featuredStmt = $db->query("
        SELECT
            p.product_id,
            p.product_name,
            p.sku,
            p.price,
            p.stock,
            p.rating,
            c.category_name
        FROM products p
        INNER JOIN categories c ON c.category_id = p.category_id
        WHERE p.is_active = 1
        ORDER BY p.is_featured DESC, p.rating DESC, p.product_name ASC
        LIMIT 8
    ");
    $featuredProducts = $featuredStmt->fetchAll();

    $recentStmt = $db->query("
        SELECT
            product_name,
            sku,
            price,
            stock,
            created_at
        FROM products
        WHERE is_active = 1
        ORDER BY created_at DESC, product_id DESC
        LIMIT 5
    ");
    $recentProducts = $recentStmt->fetchAll();

    $bestSellerStmt = $db->query("
        SELECT
            p.product_name,
            p.sku,
            SUM(oi.quantity) AS total_qty,
            SUM(oi.subtotal) AS total_value
        FROM order_items oi
        INNER JOIN orders o ON o.order_id = oi.order_id
        INNER JOIN products p ON p.product_id = oi.product_id
        GROUP BY p.product_id, p.product_name, p.sku
        ORDER BY total_qty DESC, total_value DESC
        LIMIT 5
    ");
    $bestSellers = $bestSellerStmt->fetchAll();
} catch (Throwable $exception) {
    $errorMessage = $exception->getMessage();
}

function rupiah($value): string {
    return 'Rp ' . number_format((float) $value, 0, ',', '.');
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alfamart Mobile Dashboard - Retail Management System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f3f4f6; }
        .alfa-red { background-color: #e31837; }
        .alfa-red-text { color: #e31837; }
        .alfa-blue { background-color: #00529b; }
        .alfa-blue-text { color: #00529b; }
        .alfa-yellow { background-color: #ffc220; }
    </style>
</head>
<body class="antialiased text-gray-800">
    <div class="flex h-screen overflow-hidden">
        <aside class="w-64 bg-white border-r border-gray-200 hidden md:flex flex-col shadow-sm z-10">
            <div class="p-6 border-b border-gray-100 flex items-center justify-center gap-3">
                <div class="w-10 h-10 rounded-lg alfa-red flex items-center justify-center shadow-md shadow-red-500/20">
                    <span class="text-white font-bold text-xl">A</span>
                </div>
                <h1 class="font-bold text-xl alfa-blue-text tracking-tight">Alfamart <span class="alfa-red-text">POS</span></h1>
            </div>
            <nav class="flex-1 p-4 space-y-1 overflow-y-auto">
                <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl alfa-blue text-white font-medium shadow-md shadow-blue-500/20">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                    Dashboard
                </a>
                <a href="/phpmyadmin/" class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-500 hover:bg-gray-50 hover:text-gray-900 font-medium transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"></path></svg>
                    Manage Database
                </a>
                <a href="/" class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-500 hover:bg-gray-50 hover:text-gray-900 font-medium transition-colors mt-auto">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Back to Hub
                </a>
            </nav>
            <div class="p-6 border-t border-gray-100 bg-gray-50/50">
                <div class="flex items-center gap-3">
                    <div class="w-2 h-2 rounded-full <?= $isConnected ? 'bg-green-500 animate-pulse' : 'bg-red-500' ?>"></div>
                    <div class="text-xs font-semibold text-gray-500 uppercase tracking-wider">
                        API Status: <span class="<?= $isConnected ? 'text-green-600' : 'text-red-600' ?>"><?= $isConnected ? 'ONLINE' : 'OFFLINE' ?></span>
                    </div>
                </div>
            </div>
        </aside>
        <main class="flex-1 flex flex-col h-screen overflow-hidden">
            <header class="bg-white border-b border-gray-200 px-8 py-4 flex justify-between items-center shadow-sm z-10">
                <div>
                    <h2 class="text-xl font-bold text-gray-800">Store Overview</h2>
                    <p class="text-sm text-gray-500">Retail Management System</p>
                </div>
                <div class="flex gap-3">
                    <a href="database/alfamart_laragon_ready.sql" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-semibold rounded-lg transition-colors">Unduh SQL</a>
                    <button class="px-5 py-2 alfa-red hover:bg-red-700 text-white text-sm font-semibold rounded-lg transition-colors shadow-md shadow-red-500/20">Kasir Baru</button>
                </div>
            </header>
            <div class="flex-1 overflow-y-auto p-8">
                <?php if ($errorMessage): ?>
                    <div class="mb-8 p-4 bg-red-50 border border-red-200 rounded-xl text-red-600 flex gap-4 items-start shadow-sm">
                        <svg class="w-6 h-6 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <div>
                            <h3 class="font-bold mb-1">Database tidak ditemukan</h3>
                            <p class="text-sm">Silakan buat database <code>alfamart</code> di phpMyAdmin dan import file SQL yang tersedia.</p>
                            <p class="text-xs mt-2 text-red-400 font-mono"><?= htmlspecialchars($errorMessage) ?></p>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-8">
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center justify-between group hover:border-blue-200 transition-colors">
                        <div>
                            <p class="text-sm text-gray-500 font-medium mb-1">Total Produk</p>
                            <h3 class="text-3xl font-bold alfa-blue-text"><?= (int) $stats['total_products'] ?></h3>
                        </div>
                        <div class="w-12 h-12 rounded-full bg-blue-50 text-blue-500 flex items-center justify-center group-hover:bg-blue-500 group-hover:text-white transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                        </div>
                    </div>
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center justify-between group hover:border-red-200 transition-colors">
                        <div>
                            <p class="text-sm text-gray-500 font-medium mb-1">Stok Menipis</p>
                            <h3 class="text-3xl font-bold text-red-500"><?= (int) $stats['total_low_stock'] ?></h3>
                        </div>
                        <div class="w-12 h-12 rounded-full bg-red-50 text-red-500 flex items-center justify-center group-hover:bg-red-500 group-hover:text-white transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                        </div>
                    </div>
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center justify-between group hover:border-green-200 transition-colors">
                        <div>
                            <p class="text-sm text-gray-500 font-medium mb-1">Orders Hari Ini</p>
                            <h3 class="text-3xl font-bold text-green-600"><?= (int) $stats['today_orders'] ?></h3>
                        </div>
                        <div class="w-12 h-12 rounded-full bg-green-50 text-green-500 flex items-center justify-center group-hover:bg-green-500 group-hover:text-white transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                        </div>
                    </div>
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center justify-between group hover:border-yellow-200 transition-colors">
                        <div>
                            <p class="text-sm text-gray-500 font-medium mb-1">Sales Hari Ini</p>
                            <h3 class="text-2xl font-bold text-yellow-600"><?= rupiah($stats['today_sales']) ?></h3>
                        </div>
                        <div class="w-12 h-12 rounded-full bg-yellow-50 text-yellow-500 flex items-center justify-center group-hover:bg-yellow-400 group-hover:text-white transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                    </div>
                </div>
                <div class="grid lg:grid-cols-3 gap-8">
                    <div class="lg:col-span-2 space-y-8">
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                            <div class="px-6 py-5 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                                <h3 class="font-bold text-gray-800">Katalog Produk</h3>
                                <span class="text-xs font-semibold bg-white border border-gray-200 text-gray-600 px-3 py-1 rounded-full shadow-sm">Preview</span>
                            </div>
                            <div class="p-0 overflow-x-auto">
                                <?php if (!$featuredProducts): ?>
                                    <div class="p-12 text-center text-gray-400">Belum ada produk untuk ditampilkan.</div>
                                <?php else: ?>
                                    <table class="w-full text-left text-sm whitespace-nowrap">
                                        <thead class="bg-white text-gray-500 uppercase text-xs tracking-wider border-b border-gray-100">
                                            <tr>
                                                <th class="px-6 py-4 font-semibold">SKU / Nama</th>
                                                <th class="px-6 py-4 font-semibold">Kategori</th>
                                                <th class="px-6 py-4 font-semibold">Harga</th>
                                                <th class="px-6 py-4 font-semibold text-right">Stok</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-50">
                                            <?php foreach ($featuredProducts as $product): ?>
                                                <tr class="hover:bg-blue-50/50 transition-colors">
                                                    <td class="px-6 py-4">
                                                        <div class="font-bold text-gray-800"><?= htmlspecialchars($product['product_name']) ?></div>
                                                        <div class="text-xs text-gray-400 font-mono mt-0.5"><?= htmlspecialchars($product['sku']) ?></div>
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        <span class="inline-block px-2.5 py-1 bg-gray-100 text-gray-600 rounded-md text-xs font-medium border border-gray-200">
                                                            <?= htmlspecialchars($product['category_name']) ?>
                                                        </span>
                                                    </td>
                                                    <td class="px-6 py-4 font-semibold text-green-600"><?= rupiah($product['price']) ?></td>
                                                    <td class="px-6 py-4 text-right">
                                                        <span class="font-bold <?= $product['stock'] < 10 ? 'text-red-500' : 'text-gray-700' ?>"><?= (int) $product['stock'] ?></span>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="space-y-6">
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                            <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50">
                                <h3 class="font-bold text-gray-800">Top Categories</h3>
                            </div>
                            <div class="p-4 space-y-2">
                                <?php if (!$categories): ?>
                                    <p class="text-center text-sm text-gray-400 py-4">Tidak ada kategori.</p>
                                <?php else: ?>
                                    <?php foreach ($categories as $cat): ?>
                                        <div class="flex justify-between items-center p-3 rounded-xl border border-transparent hover:border-gray-100 hover:bg-gray-50 transition-colors">
                                            <span class="font-medium text-gray-700"><?= htmlspecialchars($cat['category_name']) ?></span>
                                            <span class="px-2.5 py-1 bg-blue-50 text-blue-600 text-xs font-bold rounded-lg"><?= $cat['total_products'] ?> item</span>
                                        </div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                            <div class="px-6 py-4 border-b border-gray-100 alfa-blue">
                                <h3 class="font-bold text-white">Top Sellers</h3>
                            </div>
                            <div class="p-0">
                                <?php if (!$bestSellers): ?>
                                    <p class="text-center text-sm text-gray-400 py-6">Belum ada transaksi.</p>
                                <?php else: ?>
                                    <div class="divide-y divide-gray-100">
                                        <?php foreach ($bestSellers as $seller): ?>
                                            <div class="p-4 hover:bg-gray-50 transition-colors">
                                                <div class="flex justify-between items-start mb-1">
                                                    <h4 class="font-bold text-sm text-gray-800 truncate pr-4"><?= htmlspecialchars($seller['product_name']) ?></h4>
                                                    <span class="text-xs font-bold alfa-red-text bg-red-50 px-2 py-0.5 rounded"><?= $seller['total_qty'] ?>x</span>
                                                </div>
                                                <div class="text-xs font-semibold text-green-600"><?= rupiah($seller['total_value']) ?></div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>