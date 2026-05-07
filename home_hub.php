<?php
declare(strict_types=1);

require __DIR__ . '/shared/portal_helpers.php';

$projects = [
    [
        'name' => 'Antigravity Hub',
        'url' => 'http://localhost:5173/',
        'stack' => 'React + Vite + Tailwind',
        'database' => null,
        'summary' => 'Pusat ekosistem Prompt dan Showcase modern Anti-Gravity.',
    ],
    [
        'name' => 'Jakarta Luxury AI',
        'url' => '/jakarta-luxury-ai/',
        'stack' => 'Laravel 12 + MySQL',
        'database' => 'jakarta_luxury_ai',
        'summary' => 'Platform concierge premium dengan pengalaman Laravel penuh.',
    ],
    [
        'name' => 'DarkUniverse Pro',
        'url' => '/DarkUniverse/',
        'stack' => 'PHP + MySQL',
        'database' => 'bank_system',
        'summary' => 'Dashboard transaksi, biaya, lowongan, dan karyawan bergaya cyber dark.',
    ],
    [
        'name' => 'ProjectHotel Luxury',
        'url' => '/ProjectHotel_Luxury/',
        'stack' => 'PHP API + Flutter + MySQL',
        'database' => 'project_hotel',
        'summary' => 'Portal booking hotel elit dengan API aktif dan data artikel perjalanan.',
    ],
    [
        'name' => 'RetailDash (Toko 1)',
        'url' => '/Toko_Barang1/',
        'stack' => 'PHP + MySQL',
        'database' => 'toko_barang1',
        'summary' => 'Sistem inventori toko modern dengan statistik kategori dan supplier.',
    ],
    [
        'name' => 'Facetology Studio',
        'url' => '/Facetology/',
        'stack' => 'PHP + MySQL',
        'database' => 'facetology',
        'summary' => 'Landing page eksklusif studio skincare dengan jadwal spesialis.',
    ],
    [
        'name' => 'Web & Framework Labs',
        'url' => '/WebsiteBaru/',
        'stack' => 'React, Vue, Next, Angular',
        'database' => null,
        'summary' => 'Galeri satu pintu untuk benchmark dan perbandingan semua framework JS.',
    ],
    [
        'name' => 'Alfamart Mobile',
        'url' => '/mobile-computing-flutter/',
        'stack' => 'PHP + MySQL + Flutter',
        'database' => 'alfamart',
        'summary' => 'Etalase minimarket dan sistem kasir dengan Flutter API.',
    ],
    [
        'name' => 'ML & API Data Science',
        'url' => '/Machine Learning + API Databases/',
        'stack' => 'Python + Flask + PHP',
        'database' => 'ml_api_db',
        'summary' => 'Workspace data science untuk deployment model Machine Learning via API.',
    ],
];

$totalDatabases = 0;
$laravelProjects = 0;
$availableProjects = 0;

foreach ($projects as &$project) {
    if ($project['database']) {
        $project['database_ready'] = portal_database_exists($project['database']);
        $totalDatabases += $project['database_ready'] ? 1 : 0;
    } else {
        $project['database_ready'] = true;
    }
    
    // Antigravity hub is running on port 5173
    if ($project['name'] === 'Antigravity Hub') {
        $project['folder_ready'] = true;
    } else {
        $folderPath = __DIR__ . DIRECTORY_SEPARATOR . trim(parse_url($project['url'], PHP_URL_PATH), '/');
        $project['folder_ready'] = is_dir($folderPath);
    }
    
    $project['ready'] = $project['folder_ready'] && $project['database_ready'];
    $availableProjects += $project['ready'] ? 1 : 0;
    $laravelProjects += str_contains(strtolower($project['stack']), 'laravel') ? 1 : 0;
}
unset($project);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laragon Super Hub - Enterprise Edition</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@400;700&display=swap');
        body { font-family: 'Outfit', sans-serif; background-color: #030712; color: #f9fafb; overflow-x: hidden; }
        .font-mono { font-family: 'JetBrains Mono', monospace; }
        .glass-panel { background: rgba(17, 24, 39, 0.7); backdrop-filter: blur(16px); border: 1px solid rgba(255,255,255,0.05); }
        
        /* Animated Background Mesh */
        .mesh-bg {
            position: fixed; inset: 0; z-index: -1;
            background-image: 
                radial-gradient(at 40% 20%, rgba(56, 189, 248, 0.15) 0px, transparent 50%),
                radial-gradient(at 80% 0%, rgba(168, 85, 247, 0.15) 0px, transparent 50%),
                radial-gradient(at 0% 50%, rgba(236, 72, 153, 0.15) 0px, transparent 50%);
            filter: blur(40px);
        }
        
        /* Custom Scrollbar */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #030712; }
        ::-webkit-scrollbar-thumb { background: #374151; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #4b5563; }
    </style>
</head>
<body class="antialiased selection:bg-cyan-500/30 selection:text-cyan-200">

<div class="mesh-bg"></div>

<!-- Navigation -->
<nav class="fixed w-full z-50 glass-panel border-b-0 shadow-2xl shadow-black/50">
    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-cyan-400 to-blue-600 flex items-center justify-center shadow-lg shadow-cyan-500/20">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
            </div>
            <div>
                <h1 class="text-xl font-bold tracking-tight text-white">Laragon <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-blue-500">SuperHub</span></h1>
                <p class="text-[10px] text-cyan-400 font-mono uppercase tracking-widest leading-none">Enterprise Ecosystem</p>
            </div>
        </div>
        <div class="flex items-center gap-4">
            <div class="hidden md:flex items-center gap-2 px-4 py-2 rounded-lg bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-sm font-medium">
                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span> Core Services Online
            </div>
            <a href="/phpmyadmin/" target="_blank" class="px-5 py-2.5 rounded-lg bg-white text-gray-900 text-sm font-bold hover:bg-gray-200 transition-colors shadow-lg">
                phpMyAdmin
            </a>
        </div>
    </div>
</nav>

<main class="pt-32 pb-24 px-6 max-w-7xl mx-auto">
    <!-- Hero Section -->
    <div class="text-center mb-20 relative">
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[300px] bg-cyan-500/10 rounded-full blur-[100px] -z-10"></div>
        <h2 class="text-5xl md:text-7xl font-extrabold tracking-tight mb-6 leading-tight">
            Unified <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 via-cyan-400 to-emerald-400">Development</span> Workspace
        </h2>
        <p class="text-xl text-gray-400 max-w-3xl mx-auto leading-relaxed font-light">
            Seluruh infrastruktur website Anda—mulai dari Laravel, React, Next.js, Flutter API, hingga Machine Learning—kini terintegrasi dalam satu hub kontrol yang sempurna dan elegan.
        </p>
        
        <div class="mt-12 grid grid-cols-2 md:grid-cols-4 gap-4 max-w-4xl mx-auto">
            <div class="glass-panel p-6 rounded-2xl border-t-2 border-t-cyan-400">
                <div class="text-4xl font-bold text-white mb-1"><?= count($projects) ?></div>
                <div class="text-xs text-gray-400 uppercase tracking-widest font-semibold">Total Projects</div>
            </div>
            <div class="glass-panel p-6 rounded-2xl border-t-2 border-t-emerald-400">
                <div class="text-4xl font-bold text-white mb-1"><?= $availableProjects ?></div>
                <div class="text-xs text-gray-400 uppercase tracking-widest font-semibold">Ready to Launch</div>
            </div>
            <div class="glass-panel p-6 rounded-2xl border-t-2 border-t-purple-400">
                <div class="text-4xl font-bold text-white mb-1"><?= $totalDatabases ?></div>
                <div class="text-xs text-gray-400 uppercase tracking-widest font-semibold">Active Databases</div>
            </div>
            <div class="glass-panel p-6 rounded-2xl border-t-2 border-t-rose-400">
                <div class="text-4xl font-bold text-white mb-1"><?= $laravelProjects ?></div>
                <div class="text-xs text-gray-400 uppercase tracking-widest font-semibold">Laravel Cores</div>
            </div>
        </div>
    </div>

    <!-- Search & Filter Bar -->
    <div class="mb-10 flex flex-col md:flex-row gap-4 justify-between items-center">
        <div class="relative w-full md:w-96">
            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            </div>
            <input type="text" id="searchInput" class="w-full bg-gray-900/50 border border-gray-700 text-white rounded-xl pl-11 pr-4 py-3 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent transition-all placeholder-gray-500 font-mono text-sm" placeholder="Search by name, stack, or database...">
        </div>
        <div class="flex gap-2 w-full md:w-auto overflow-x-auto pb-2 md:pb-0 hide-scrollbar">
            <button class="px-4 py-2 rounded-lg bg-white text-gray-900 text-sm font-semibold whitespace-nowrap">All Projects</button>
            <button class="px-4 py-2 rounded-lg glass-panel text-gray-300 hover:text-white text-sm font-medium whitespace-nowrap transition-colors">Laravel</button>
            <button class="px-4 py-2 rounded-lg glass-panel text-gray-300 hover:text-white text-sm font-medium whitespace-nowrap transition-colors">React/Next</button>
            <button class="px-4 py-2 rounded-lg glass-panel text-gray-300 hover:text-white text-sm font-medium whitespace-nowrap transition-colors">PHP Native</button>
        </div>
    </div>

    <!-- Project Grid -->
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6" id="projectGrid">
        <?php foreach ($projects as $project): ?>
            <div class="project-card glass-panel rounded-2xl p-6 flex flex-col h-full hover:-translate-y-1 hover:shadow-2xl hover:shadow-cyan-500/10 hover:border-cyan-500/50 transition-all duration-300 group cursor-pointer" onclick="window.open('<?= $project['url'] ?>', '<?= $project['name'] === 'Antigravity Hub' ? '_blank' : '_self' ?>')">
                <div class="flex justify-between items-start mb-4">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-xl bg-gray-800 border border-gray-700 flex items-center justify-center group-hover:bg-cyan-500/20 group-hover:border-cyan-500/50 transition-colors">
                            <svg class="w-6 h-6 text-gray-400 group-hover:text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01"></path></svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-lg text-white group-hover:text-cyan-400 transition-colors"><?= htmlspecialchars($project['name']) ?></h3>
                            <div class="flex items-center gap-1.5 mt-1">
                                <span class="w-1.5 h-1.5 rounded-full <?= $project['ready'] ? 'bg-emerald-500' : 'bg-amber-500' ?>"></span>
                                <span class="text-[10px] text-gray-400 font-mono uppercase"><?= $project['ready'] ? 'Online' : 'Needs Config' ?></span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <p class="text-sm text-gray-400 leading-relaxed mb-6 flex-1"><?= htmlspecialchars($project['summary']) ?></p>
                
                <div class="flex flex-col gap-3 mt-auto">
                    <div class="bg-gray-900/80 border border-gray-800 rounded-lg p-3">
                        <div class="text-[10px] text-gray-500 uppercase font-bold tracking-wider mb-1">Tech Stack</div>
                        <div class="text-xs font-mono text-cyan-300 truncate"><?= htmlspecialchars($project['stack']) ?></div>
                    </div>
                    <?php if ($project['database']): ?>
                        <div class="bg-gray-900/80 border border-gray-800 rounded-lg p-3 flex justify-between items-center">
                            <div>
                                <div class="text-[10px] text-gray-500 uppercase font-bold tracking-wider mb-1">Database</div>
                                <div class="text-xs font-mono text-purple-400 truncate"><?= htmlspecialchars($project['database']) ?></div>
                            </div>
                            <a href="/phpmyadmin/" onclick="event.stopPropagation();" target="_blank" class="p-2 rounded-md hover:bg-gray-800 text-gray-400 hover:text-white transition-colors" title="Manage Database">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"></path></svg>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</main>

<footer class="border-t border-gray-800/50 py-8 text-center mt-10">
    <p class="text-gray-500 text-sm font-mono tracking-widest">© 2026 LARAGON SUPERHUB • POWERED BY ANTIGRAVITY AI</p>
</footer>

<script>
    // Simple search functionality
    document.getElementById('searchInput').addEventListener('input', function(e) {
        const term = e.target.value.toLowerCase();
        const cards = document.querySelectorAll('.project-card');
        
        cards.forEach(card => {
            const text = card.textContent.toLowerCase();
            if (text.includes(term)) {
                card.style.display = 'flex';
            } else {
                card.style.display = 'none';
            }
        });
    });
</script>

</body>
</html>
