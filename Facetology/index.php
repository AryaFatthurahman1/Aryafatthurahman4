<?php
declare(strict_types=1);

require __DIR__ . '/../shared/portal_helpers.php';

$pdo = portal_db_pdo('facetology');
$isConnected = $pdo !== null;

$stats = [
    'services' => (int) portal_value($pdo, 'SELECT COUNT(*) FROM services'),
    'specialists' => (int) portal_value($pdo, 'SELECT COUNT(*) FROM specialists'),
    'appointments' => (int) portal_value($pdo, 'SELECT COUNT(*) FROM appointments'),
    'average_price' => (float) portal_value($pdo, 'SELECT COALESCE(AVG(price), 0) FROM services'),
];

$services = portal_rows(
    $pdo,
    'SELECT name, category, duration_minutes, price, highlight FROM services ORDER BY price DESC, name ASC LIMIT 6'
);
$specialists = portal_rows(
    $pdo,
    'SELECT full_name, specialty, years_experience, is_available FROM specialists ORDER BY years_experience DESC, full_name ASC LIMIT 4'
);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facetology Studio - Premium Skincare</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;1,400&family=Plus+Jakarta+Sans:wght@300;400;500;600&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #faf9f6; color: #3f3e3e; }
        h1, h2, h3, .font-serif { font-family: 'Playfair Display', serif; }
        .glass { background: rgba(255, 255, 255, 0.8); backdrop-filter: blur(12px); border: 1px solid rgba(255,255,255,0.5); }
    </style>
</head>
<body class="antialiased">

<div class="min-h-screen">
    <!-- Hero Section -->
    <header class="relative pt-20 pb-32 overflow-hidden">
        <div class="absolute inset-0 z-0">
            <div class="absolute top-0 right-0 w-1/2 h-full bg-rose-50 rounded-bl-[100px] opacity-70"></div>
            <div class="absolute -top-24 -left-24 w-96 h-96 bg-orange-50 rounded-full mix-blend-multiply filter blur-3xl opacity-50"></div>
        </div>
        
        <div class="max-w-7xl mx-auto px-6 relative z-10">
            <div class="flex justify-between items-center mb-16">
                <div class="text-2xl font-serif font-semibold tracking-wider">FACETOLOGY.</div>
                <div class="flex gap-4">
                    <div class="flex items-center gap-2 px-4 py-2 rounded-full glass text-sm font-medium <?= $isConnected ? 'text-emerald-600' : 'text-rose-500' ?>">
                        <span class="w-2 h-2 rounded-full <?= $isConnected ? 'bg-emerald-500 animate-pulse' : 'bg-rose-500' ?>"></span>
                        <?= $isConnected ? 'Database Terhubung' : 'Offline' ?>
                    </div>
                </div>
            </div>

            <div class="max-w-3xl">
                <span class="text-rose-400 font-medium tracking-widest uppercase text-sm mb-4 block">Premium Skincare Studio</span>
                <h1 class="text-5xl md:text-7xl font-serif leading-tight mb-6 text-gray-900">
                    Wajah baru untuk <br/>kulit sehat Anda.
                </h1>
                <p class="text-xl text-gray-600 mb-10 leading-relaxed max-w-2xl font-light">
                    Facetology menghadirkan layanan facial modern dengan teknologi terkini. Temukan treatment yang tepat bersama spesialis terbaik kami.
                </p>
                <div class="flex flex-wrap gap-4">
                    <a href="#services" class="px-8 py-4 bg-gray-900 text-white rounded-full hover:bg-gray-800 transition-all font-medium">Lihat Layanan</a>
                    <a href="/phpmyadmin/" class="px-8 py-4 glass rounded-full hover:bg-white transition-all font-medium text-gray-900 shadow-sm">Kelola Database</a>
                </div>
            </div>
        </div>
    </header>

    <!-- Stats Grid -->
    <section class="max-w-7xl mx-auto px-6 -mt-16 relative z-20 mb-24">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            <div class="glass p-8 rounded-3xl shadow-lg shadow-rose-900/5 text-center transform hover:-translate-y-1 transition-all">
                <div class="text-rose-400 text-sm font-medium mb-2 uppercase tracking-wide">Total Layanan</div>
                <div class="text-4xl font-serif text-gray-900 mb-2"><?= portal_number($stats['services']) ?></div>
                <div class="text-xs text-gray-500">Treatment Aktif</div>
            </div>
            <div class="glass p-8 rounded-3xl shadow-lg shadow-rose-900/5 text-center transform hover:-translate-y-1 transition-all">
                <div class="text-rose-400 text-sm font-medium mb-2 uppercase tracking-wide">Spesialis</div>
                <div class="text-4xl font-serif text-gray-900 mb-2"><?= portal_number($stats['specialists']) ?></div>
                <div class="text-xs text-gray-500">Tenaga Profesional</div>
            </div>
            <div class="glass p-8 rounded-3xl shadow-lg shadow-rose-900/5 text-center transform hover:-translate-y-1 transition-all">
                <div class="text-rose-400 text-sm font-medium mb-2 uppercase tracking-wide">Reservasi</div>
                <div class="text-4xl font-serif text-gray-900 mb-2"><?= portal_number($stats['appointments']) ?></div>
                <div class="text-xs text-gray-500">Klien Terdaftar</div>
            </div>
            <div class="glass p-8 rounded-3xl shadow-lg shadow-rose-900/5 text-center transform hover:-translate-y-1 transition-all">
                <div class="text-rose-400 text-sm font-medium mb-2 uppercase tracking-wide">Avg. Harga</div>
                <div class="text-2xl font-serif text-gray-900 mb-2"><?= portal_money($stats['average_price']) ?></div>
                <div class="text-xs text-gray-500">Per Treatment</div>
            </div>
        </div>
    </section>

    <div class="max-w-7xl mx-auto px-6 pb-24 grid lg:grid-cols-3 gap-16" id="services">
        
        <!-- Services List -->
        <section class="lg:col-span-2">
            <div class="mb-10">
                <span class="text-rose-400 font-medium tracking-widest uppercase text-sm mb-2 block">Service Menu</span>
                <h2 class="text-4xl font-serif text-gray-900">Treatment Unggulan</h2>
            </div>
            <div class="grid md:grid-cols-2 gap-6">
                <?php foreach ($services as $service): ?>
                    <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm hover:shadow-md transition-shadow group">
                        <div class="flex justify-between items-start mb-4">
                            <h3 class="font-serif text-xl text-gray-900 group-hover:text-rose-500 transition-colors"><?= portal_h($service['name']) ?></h3>
                            <span class="text-sm font-medium bg-rose-50 text-rose-600 px-3 py-1 rounded-full"><?= portal_h($service['category']) ?></span>
                        </div>
                        <p class="text-gray-500 text-sm mb-6 leading-relaxed line-clamp-2"><?= portal_h($service['highlight']) ?></p>
                        <div class="flex items-center justify-between pt-4 border-t border-gray-50">
                            <div class="text-gray-900 font-semibold"><?= portal_money($service['price']) ?></div>
                            <div class="text-sm text-gray-400 flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                <?= portal_h((string) $service['duration_minutes']) ?> menit
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>

        <!-- Specialists -->
        <aside>
            <div class="mb-10">
                <span class="text-rose-400 font-medium tracking-widest uppercase text-sm mb-2 block">Spesialis</span>
                <h2 class="text-4xl font-serif text-gray-900">Tim Ahli Kami</h2>
            </div>
            <div class="space-y-4">
                <?php foreach ($specialists as $specialist): ?>
                    <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm flex items-center gap-4">
                        <div class="w-14 h-14 rounded-full bg-rose-100 flex items-center justify-center text-rose-500 font-serif text-xl shrink-0">
                            <?= substr(portal_h($specialist['full_name']), 0, 1) ?>
                        </div>
                        <div class="flex-1 min-w-0">
                            <h3 class="font-serif text-lg text-gray-900 truncate"><?= portal_h($specialist['full_name']) ?></h3>
                            <p class="text-sm text-gray-500 truncate"><?= portal_h($specialist['specialty']) ?></p>
                        </div>
                        <div class="text-right shrink-0">
                            <div class="text-xs font-medium <?= $specialist['is_available'] ? 'text-emerald-500' : 'text-amber-500' ?> mb-1">
                                <?= $specialist['is_available'] ? 'Tersedia' : 'Penuh' ?>
                            </div>
                            <div class="text-xs text-gray-400"><?= portal_h((string) $specialist['years_experience']) ?> thn exp</div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            
            <div class="mt-12 bg-gray-900 text-white p-8 rounded-3xl text-center">
                <h3 class="font-serif text-2xl mb-3">Siap untuk glowing?</h3>
                <p class="text-gray-400 text-sm mb-6">Konsultasikan kebutuhan kulit Anda sekarang.</p>
                <button class="w-full bg-white text-gray-900 py-3 rounded-xl font-medium hover:bg-gray-100 transition-colors">Booking Sekarang</button>
            </div>
        </aside>

    </div>
</div>

</body>
</html>
