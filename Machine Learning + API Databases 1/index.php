<?php
declare(strict_types=1);

require __DIR__ . '/../shared/portal_helpers.php';

$pdo = portal_db_pdo('ml_api_db');
$isConnected = $pdo !== null;

$stats = [
    'users' => (int) portal_value($pdo, 'SELECT COUNT(*) FROM users'),
    'datasets' => (int) portal_value($pdo, 'SELECT COUNT(*) FROM datasets'),
    'models' => (int) portal_value($pdo, 'SELECT COUNT(*) FROM ml_models'),
    'predictions' => (int) portal_value($pdo, 'SELECT COUNT(*) FROM predictions'),
];

$datasets = portal_rows(
    $pdo,
    'SELECT dataset_name, total_records, created_at FROM datasets ORDER BY created_at DESC LIMIT 4'
);
$models = portal_rows(
    $pdo,
    'SELECT model_name, model_type, algorithm, status FROM ml_models ORDER BY created_at DESC LIMIT 4'
);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ML & API Data Science Workspace</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fira+Code:wght@400;500;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #0d1117; color: #c9d1d9; }
        h1, h2, h3, .font-mono { font-family: 'Fira Code', monospace; }
        .glass-panel { background: #161b22; border: 1px solid #30363d; border-radius: 12px; }
    </style>
</head>
<body class="antialiased selection:bg-emerald-500/30 selection:text-emerald-200">
    <div class="max-w-7xl mx-auto px-6 py-12">
        <header class="glass-panel p-8 mb-8 relative overflow-hidden flex flex-col md:flex-row justify-between items-center gap-8">
            <div class="absolute top-0 right-0 w-64 h-64 bg-emerald-500/10 rounded-full blur-[80px] pointer-events-none"></div>
            <div class="z-10 flex-1">
                <div class="flex items-center gap-3 mb-4">
                    <span class="px-3 py-1 bg-emerald-500/10 text-emerald-400 font-mono text-xs rounded-full border border-emerald-500/20">Data Science</span>
                    <span class="px-3 py-1 bg-blue-500/10 text-blue-400 font-mono text-xs rounded-full border border-blue-500/20">Flask API</span>
                </div>
                <h1 class="text-3xl md:text-4xl font-mono font-bold text-white mb-4">ML & API <span class="text-emerald-400">Workspace</span></h1>
                <p class="text-gray-400 leading-relaxed max-w-2xl mb-6">
                    Pusat kontrol eksperimen Machine Learning Anda. Memadukan kemudahan interface PHP dengan performa backend Python (Flask) untuk deployment model.
                </p>
                <div class="flex flex-wrap gap-4 font-mono text-sm">
                    <a href="/Machine Learning + API Databases/frontend/dashboard.html" class="px-5 py-2.5 bg-emerald-600 hover:bg-emerald-500 text-white rounded-md transition-colors shadow-lg shadow-emerald-500/20">Launch Visualizer</a>
                    <a href="/" class="px-5 py-2.5 bg-[#21262d] hover:bg-[#30363d] text-white border border-[#363b42] rounded-md transition-colors">cd /main-hub</a>
                </div>
            </div>
            <div class="z-10 w-full md:w-80 bg-[#0d1117] border border-[#30363d] rounded-lg p-5 font-mono text-xs text-gray-400">
                <div class="flex justify-between items-center mb-3 pb-3 border-b border-[#30363d]">
                    <span class="text-white">System Status</span>
                    <span class="flex items-center gap-2 text-emerald-400"><span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span> OK</span>
                </div>
                <div class="space-y-2">
                    <div class="flex justify-between"><span>Database:</span> <span class="text-blue-400">ml_api_db</span></div>
                    <div class="flex justify-between"><span>MySQL:</span> <span class="<?= $isConnected ? 'text-emerald-400' : 'text-red-400' ?>"><?= $isConnected ? 'Connected' : 'Offline' ?></span></div>
                    <div class="flex justify-between"><span>API Port:</span> <span class="text-purple-400">:5000</span></div>
                </div>
            </div>
        </header>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-8">
            <div class="glass-panel p-6 border-l-4 border-l-emerald-500">
                <h3 class="text-gray-400 font-mono text-sm mb-1">Users</h3>
                <div class="text-3xl font-bold text-white"><?= portal_number($stats['users']) ?></div>
            </div>
            <div class="glass-panel p-6 border-l-4 border-l-blue-500">
                <h3 class="text-gray-400 font-mono text-sm mb-1">Datasets</h3>
                <div class="text-3xl font-bold text-white"><?= portal_number($stats['datasets']) ?></div>
            </div>
            <div class="glass-panel p-6 border-l-4 border-l-purple-500">
                <h3 class="text-gray-400 font-mono text-sm mb-1">Active Models</h3>
                <div class="text-3xl font-bold text-white"><?= portal_number($stats['models']) ?></div>
            </div>
            <div class="glass-panel p-6 border-l-4 border-l-pink-500">
                <h3 class="text-gray-400 font-mono text-sm mb-1">Predictions</h3>
                <div class="text-3xl font-bold text-white"><?= portal_number($stats['predictions']) ?></div>
            </div>
        </div>
        <div class="grid md:grid-cols-2 gap-8">
            <div class="glass-panel overflow-hidden">
                <div class="p-5 border-b border-[#30363d] bg-[#161b22] flex justify-between items-center">
                    <h2 class="font-mono text-white">Dataset Registry</h2>
                </div>
                <div class="p-0">
                    <?php if ($datasets === []): ?>
                        <div class="p-8 text-center text-gray-500 font-mono text-sm">No datasets found. Import data via backend.</div>
                    <?php else: ?>
                        <table class="w-full text-left text-sm">
                            <thead class="bg-[#0d1117] text-gray-400 font-mono text-xs uppercase">
                                <tr><th class="px-5 py-3">Dataset Name</th><th class="px-5 py-3">Records</th><th class="px-5 py-3">Created</th></tr>
                            </thead>
                            <tbody class="divide-y divide-[#30363d]">
                                <?php foreach ($datasets as $dataset): ?>
                                <tr class="hover:bg-[#21262d] transition-colors">
                                    <td class="px-5 py-3 text-blue-400 font-medium"><?= portal_h($dataset['dataset_name']) ?></td>
                                    <td class="px-5 py-3 font-mono"><?= portal_number($dataset['total_records']) ?></td>
                                    <td class="px-5 py-3 text-gray-500 text-xs"><?= portal_h((string) $dataset['created_at']) ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php endif; ?>
                </div>
            </div>
            <div class="glass-panel overflow-hidden">
                <div class="p-5 border-b border-[#30363d] bg-[#161b22] flex justify-between items-center">
                    <h2 class="font-mono text-white">Model Deployments</h2>
                </div>
                <div class="p-0">
                    <?php if ($models === []): ?>
                        <div class="p-8 text-center text-gray-500 font-mono text-sm">No models deployed yet.</div>
                    <?php else: ?>
                        <div class="divide-y divide-[#30363d]">
                            <?php foreach ($models as $model): ?>
                            <div class="p-5 hover:bg-[#21262d] transition-colors flex justify-between items-center">
                                <div>
                                    <h3 class="text-emerald-400 font-bold mb-1"><?= portal_h($model['model_name']) ?></h3>
                                    <p class="text-xs font-mono text-gray-400"><?= portal_h($model['model_type']) ?> <span class="text-gray-600">|</span> <?= portal_h($model['algorithm'] ?: 'N/A') ?></p>
                                </div>
                                <span class="px-2.5 py-1 rounded bg-[#21262d] border border-[#30363d] text-xs font-mono text-purple-400 uppercase"><?= portal_h($model['status']) ?></span>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>