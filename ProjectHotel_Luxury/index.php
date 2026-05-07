<?php
declare(strict_types=1);

require __DIR__ . '/../shared/portal_helpers.php';

$pdo = portal_db_pdo('project_hotel');
$isConnected = $pdo !== null;

$stats = [
    'hotels' => (int) portal_value($pdo, 'SELECT COUNT(*) FROM hotels'),
    'bookings' => (int) portal_value($pdo, 'SELECT COUNT(*) FROM bookings'),
    'articles' => (int) portal_value($pdo, 'SELECT COUNT(*) FROM articles'),
    'users' => (int) portal_value($pdo, 'SELECT COUNT(*) FROM users'),
];

$hotels = portal_rows(
    $pdo,
    'SELECT name, location, price_per_night, rating FROM hotels ORDER BY rating DESC, price_per_night DESC LIMIT 4'
);
$articles = portal_rows(
    $pdo,
    'SELECT title, author, published_date FROM articles ORDER BY published_date DESC, id DESC LIMIT 4'
);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Luxury Stays - Exclusive Hotels</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600;800&family=Montserrat:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Montserrat', sans-serif; background-color: #0a0a0a; color: #f3f4f6; }
        h1, h2, h3, .font-serif { font-family: 'Cinzel', serif; }
        .gold-gradient { background: linear-gradient(135deg, #d4af37 0%, #aa7c11 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
        .glass-dark { background: rgba(20, 20, 20, 0.7); backdrop-filter: blur(16px); border: 1px solid rgba(212, 175, 55, 0.15); }
    </style>
</head>
<body class="antialiased selection:bg-yellow-600 selection:text-black">
    <nav class="fixed w-full z-50 glass-dark border-b-0">
        <div class="max-w-7xl mx-auto px-6 py-5 flex justify-between items-center">
            <div class="text-2xl font-serif font-bold tracking-widest text-white">LUXURY<span class="text-yellow-500">STAYS</span></div>
            <div class="flex items-center gap-6">
                <span class="text-xs uppercase tracking-widest text-gray-400">Database: <span class="<?= $isConnected ? 'text-emerald-400' : 'text-red-400' ?>"><?= $isConnected ? 'Connected' : 'Offline' ?></span></span>
                <a href="/" class="text-sm font-medium hover:text-yellow-500 transition-colors">Main Hub</a>
            </div>
        </div>
    </nav>
    <header class="relative pt-40 pb-32 overflow-hidden flex items-center justify-center min-h-[70vh]">
        <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1542314831-c6a4d27ce6a2?q=80&w=2070&auto=format&fit=crop')] bg-cover bg-center opacity-20"></div>
        <div class="absolute inset-0 bg-gradient-to-b from-black/80 via-black/50 to-[#0a0a0a]"></div>
        <div class="max-w-4xl mx-auto px-6 relative z-10 text-center">
            <span class="text-yellow-500 font-medium tracking-[0.3em] uppercase text-sm mb-6 block">Elite Hospitality Experience</span>
            <h1 class="text-5xl md:text-7xl font-serif leading-tight mb-8">
                <span class="gold-gradient">Extraordinary</span><br/>Hotels & Resorts
            </h1>
            <p class="text-lg text-gray-300 mb-12 leading-relaxed max-w-2xl mx-auto font-light">
                Platform pemesanan hotel premium yang memadukan keindahan antarmuka Flutter dengan ketangguhan backend PHP & MySQL.
            </p>
            <div class="flex flex-wrap justify-center gap-6">
                <a href="/ProjectHotel_Luxury/api/hotels.php" class="px-8 py-4 bg-gradient-to-r from-yellow-600 to-yellow-500 text-black uppercase tracking-widest text-xs font-bold rounded-none hover:from-yellow-500 hover:to-yellow-400 transition-all">Test API Endpoint</a>
                <a href="/phpmyadmin/" class="px-8 py-4 glass-dark text-white uppercase tracking-widest text-xs font-bold hover:bg-white/10 transition-all">Manage Database</a>
            </div>
        </div>
    </header>
    <main class="max-w-7xl mx-auto px-6 py-12">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 -mt-32 relative z-20 mb-24">
            <div class="glass-dark p-8 text-center border-t-2 border-t-yellow-500 transform hover:-translate-y-2 transition-all duration-300">
                <div class="text-4xl font-serif text-white mb-2"><?= portal_number($stats['hotels']) ?></div>
                <div class="text-xs text-yellow-500 uppercase tracking-widest">Properties</div>
            </div>
            <div class="glass-dark p-8 text-center border-t-2 border-t-yellow-500 transform hover:-translate-y-2 transition-all duration-300">
                <div class="text-4xl font-serif text-white mb-2"><?= portal_number($stats['bookings']) ?></div>
                <div class="text-xs text-yellow-500 uppercase tracking-widest">Bookings</div>
            </div>
            <div class="glass-dark p-8 text-center border-t-2 border-t-yellow-500 transform hover:-translate-y-2 transition-all duration-300">
                <div class="text-4xl font-serif text-white mb-2"><?= portal_number($stats['articles']) ?></div>
                <div class="text-xs text-yellow-500 uppercase tracking-widest">Articles</div>
            </div>
            <div class="glass-dark p-8 text-center border-t-2 border-t-yellow-500 transform hover:-translate-y-2 transition-all duration-300">
                <div class="text-4xl font-serif text-white mb-2"><?= portal_number($stats['users']) ?></div>
                <div class="text-xs text-yellow-500 uppercase tracking-widest">Members</div>
            </div>
        </div>
        <div class="mb-20">
            <div class="flex justify-between items-end mb-12 border-b border-white/10 pb-6">
                <div>
                    <span class="text-yellow-500 font-medium tracking-[0.2em] uppercase text-xs mb-2 block">Curated Selection</span>
                    <h2 class="text-3xl md:text-4xl font-serif text-white">Featured Properties</h2>
                </div>
                <a href="#" class="text-sm text-yellow-500 hover:text-yellow-400 uppercase tracking-widest hidden md:block">View All</a>
            </div>
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                <?php foreach ($hotels as $hotel): ?>
                    <div class="glass-dark group cursor-pointer overflow-hidden relative">
                        <div class="h-48 bg-zinc-800 relative overflow-hidden">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent z-10"></div>
                            <div class="absolute bottom-4 left-4 z-20">
                                <div class="flex items-center gap-1 text-yellow-500 text-sm font-bold">
                                    <span>★</span> <?= portal_h((string) $hotel['rating']) ?>
                                </div>
                            </div>
                        </div>
                        <div class="p-6 relative z-20 bg-zinc-900/50 group-hover:bg-zinc-800/80 transition-colors">
                            <h3 class="font-serif text-xl text-white mb-1 truncate"><?= portal_h($hotel['name']) ?></h3>
                            <p class="text-gray-400 text-xs tracking-wider uppercase mb-4 truncate"><?= portal_h($hotel['location']) ?></p>
                            <div class="text-yellow-500 font-medium"><?= portal_money($hotel['price_per_night']) ?> <span class="text-gray-500 text-xs">/night</span></div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="grid lg:grid-cols-3 gap-12 border-t border-white/10 pt-20 pb-12">
            <div class="lg:col-span-1">
                <span class="text-yellow-500 font-medium tracking-[0.2em] uppercase text-xs mb-2 block">Journal</span>
                <h2 class="text-3xl font-serif text-white mb-6">Travel Inspiration</h2>
                <p class="text-gray-400 text-sm leading-relaxed mb-8">
                    Temukan panduan eksklusif, ulasan resor, dan tips perjalanan premium yang ditulis oleh pakar hospitality.
                </p>
            </div>
            <div class="lg:col-span-2 grid sm:grid-cols-2 gap-6">
                <?php foreach ($articles as $article): ?>
                    <div class="glass-dark p-6 hover:border-yellow-500/50 transition-colors">
                        <p class="text-xs text-yellow-500 tracking-widest uppercase mb-3"><?= portal_h((string) $article['published_date']) ?></p>
                        <h3 class="font-serif text-lg text-white mb-3 line-clamp-2"><?= portal_h($article['title']) ?></h3>
                        <p class="text-gray-500 text-xs uppercase tracking-wider">By <?= portal_h($article['author'] ?: 'Editor') ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </main>
    <footer class="border-t border-white/5 bg-black py-12 text-center mt-auto">
        <div class="font-serif text-2xl tracking-widest text-white mb-4">LUXURY<span class="text-yellow-500">STAYS</span></div>
        <p class="text-gray-600 text-xs tracking-widest uppercase">Flutter & PHP API Project Showcase</p>
    </footer>
</body>
</html>