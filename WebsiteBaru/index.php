<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WebsiteBaru - Multi-Framework Dev Portal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&family=Inter:wght@400;500&display=swap');
        body { font-family: 'Inter', sans-serif; background-color: #000000; color: #ededed; }
        h1, h2, h3, .font-mono { font-family: 'Space Grotesk', sans-serif; }
        .grid-bg { background-size: 40px 40px; background-image: linear-gradient(to right, rgba(255, 255, 255, 0.05) 1px, transparent 1px), linear-gradient(to bottom, rgba(255, 255, 255, 0.05) 1px, transparent 1px); }
        .glass-card { background: rgba(20, 20, 20, 0.6); backdrop-filter: blur(12px); border: 1px solid rgba(255,255,255,0.1); }
        .framework-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 24px; }
        .fw-card { background: linear-gradient(135deg, rgba(255,255,255,0.05), rgba(255,255,255,0.01)); border: 1px solid rgba(255,255,255,0.1); border-radius: 16px; padding: 24px; transition: all 0.3s ease; }
        .fw-card:hover { transform: translateY(-8px); border-color: rgba(255,255,255,0.3); box-shadow: 0 20px 40px rgba(0,0,0,0.3); }
        .fw-icon { width: 48px; height: 48px; border-radius: 12px; display: flex; align-items: center; justify-content: center; margin-bottom: 16px; }
    </style>
</head>
<body class="antialiased min-h-screen relative selection:bg-purple-500 selection:text-white">
    <div class="fixed inset-0 grid-bg z-0 opacity-50 pointer-events-none"></div>
    <div class="fixed top-0 left-1/2 -translate-x-1/2 w-[800px] h-[400px] bg-purple-600/20 rounded-full blur-[120px] pointer-events-none z-0"></div>
    <nav class="relative z-20 border-b border-white/10 glass-card">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <div class="font-mono text-xl font-bold tracking-tight">Website<span class="text-purple-500">Baru</span> <span class="text-xs ml-2 px-2 py-1 bg-white/10 rounded-md text-gray-400">Labs</span></div>
            <a href="/" class="text-sm font-medium text-gray-400 hover:text-white transition-colors">Main Hub</a>
        </div>
    </nav>
    <main class="relative z-10 max-w-7xl mx-auto px-6 py-20">
        <header class="text-center mb-24">
            <span class="px-4 py-1.5 rounded-full border border-purple-500/30 bg-purple-500/10 text-purple-400 text-sm font-medium mb-6 inline-block">Framework Showcase</span>
            <h1 class="text-5xl md:text-7xl font-bold tracking-tight mb-6">
                Galeri <span class="text-transparent bg-clip-text bg-gradient-to-r from-purple-400 to-pink-600">Multi-Framework</span>
            </h1>
            <p class="text-xl text-gray-400 max-w-2xl mx-auto leading-relaxed">
                Eksplorasi, bandingkan, dan pelajari berbagai arsitektur framework modern langsung dari satu workspace terpusat.
            </p>
            <div class="mt-10 flex flex-wrap justify-center gap-4">
                <a href="/WebsiteBaru/framework-showcase.html" class="px-6 py-3 rounded-xl bg-white text-black font-medium hover:bg-gray-200 transition-colors">Legacy Showcase</a>
                <a href="/phpmyadmin/" class="px-6 py-3 rounded-xl glass-card text-white font-medium hover:bg-white/10 transition-colors">Database</a>
            </div>
        </header>
        <div class="mb-8 flex items-center justify-between">
            <h2 class="text-2xl font-bold">Available Environments</h2>
            <div class="text-sm text-gray-400"><span class="text-white font-bold">6</span> Active Projects</div>
        </div>
        <div class="framework-grid">
            <div class="fw-card">
                <div class="fw-icon bg-gradient-to-br from-red-500 to-pink-600"><svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg></div>
                <h3 class="text-xl font-bold mb-3 hover:text-purple-400 transition-colors">Angular App</h3>
                <p class="text-gray-400 text-sm leading-relaxed mb-4">Showcase Angular yang sudah memiliki folder dist dan source lengkap.</p>
                <span class="px-2.5 py-1 bg-white/5 border border-white/10 rounded-md text-xs text-gray-400 font-mono">v16.0</span>
            </div>
            <div class="fw-card">
                <div class="fw-icon bg-gradient-to-br from-cyan-400 to-blue-500"><svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg></div>
                <h3 class="text-xl font-bold mb-3 hover:text-purple-400 transition-colors">React App</h3>
                <p class="text-gray-400 text-sm leading-relaxed mb-4">Eksperimen frontend React untuk perbandingan komponen.</p>
                <span class="px-2.5 py-1 bg-white/5 border border-white/10 rounded-md text-xs text-gray-400 font-mono">v18.2</span>
            </div>
            <div class="fw-card">
                <div class="fw-icon bg-gradient-to-br from-emerald-400 to-teal-500"><svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg></div>
                <h3 class="text-xl font-bold mb-3 hover:text-purple-400 transition-colors">Vue App</h3>
                <p class="text-gray-400 text-sm leading-relaxed mb-4">Area uji cepat untuk komponen dan state sederhana Vue.</p>
                <span class="px-2.5 py-1 bg-white/5 border border-white/10 rounded-md text-xs text-gray-400 font-mono">v3.3</span>
            </div>
            <div class="fw-card">
                <div class="fw-icon bg-gradient-to-br from-slate-600 to-black"><svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg></div>
                <h3 class="text-xl font-bold mb-3 hover:text-purple-400 transition-colors">Next App</h3>
                <p class="text-gray-400 text-sm leading-relaxed mb-4">Starter modern untuk rendering hybrid dan route berbasis file.</p>
                <span class="px-2.5 py-1 bg-white/5 border border-white/10 rounded-md text-xs text-gray-400 font-mono">v13.4</span>
            </div>
            <div class="fw-card">
                <div class="fw-icon bg-gradient-to-br from-rose-500 to-red-600"><svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg></div>
                <h3 class="text-xl font-bold mb-3 hover:text-purple-400 transition-colors">Laravel Sample</h3>
                <p class="text-gray-400 text-sm leading-relaxed mb-4">Contoh project backend Laravel mini di dalam workspace showcase.</p>
                <span class="px-2.5 py-1 bg-white/5 border border-white/10 rounded-md text-xs text-gray-400 font-mono">v10.0</span>
            </div>
            <div class="fw-card">
                <div class="fw-icon bg-gradient-to-br from-blue-500 to-indigo-600"><svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg></div>
                <h3 class="text-xl font-bold mb-3 hover:text-purple-400 transition-colors">TypeScript Sample</h3>
                <p class="text-gray-400 text-sm leading-relaxed mb-4">Sandbox utilitas TypeScript untuk eksperimen struktur kode.</p>
                <span class="px-2.5 py-1 bg-white/5 border border-white/10 rounded-md text-xs text-gray-400 font-mono">v5.0</span>
            </div>
        </div>
    </main>
    <footer class="relative z-10 border-t border-white/10 text-center py-8 mt-12">
        <p class="text-gray-600 text-sm">Powered by Laragon & Tailwind CSS. Monorepo Showcase 2026.</p>
    </footer>
</body>
</html>